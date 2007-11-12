#!/usr/bin/env python

# Copyright (C) 2007 Patryk Zawadzki <patrys@pld-linux.org>
#
# Licensed under the GNU General Public License Version 2
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#

import dbus
import gst

def iterateCapRange(cap, field, callBack):
	values = cap[field]
	if isinstance(values, list):
		for value in values:
			callBack(value)
	elif isinstance(values, gst.IntRange):
		cur = values.low
		while cur < values.high:
			callBack(cur)
			cur *= 2
		cur = values.high
		while cur > values.low:
			callBack(cur)
			cur /= 2
	elif isinstance(values, gst.DoubleRange) or isinstance(values, gst.FractionRange):
		callBack(values.high)
	else:
		callBack(values)

def iterateCapDoubleRange(cap, field1, field2, callBack):
	values1 = cap[field1]
	values2 = cap[field2]
	if isinstance(values1, list):
		i = 0
		while i < len(values1):
			value1 = values1[i]
			value2 = values2[i]
			callBack((value1, value2))
			i += 1
	elif isinstance(values1, gst.IntRange):
		cur1 = values1.low
		cur2 = values2.low
		while cur1 < values1.high and cur2 < values2.high:
			callBack((cur1, cur2))
			cur1 *= 2
			cur2 *= 2
		cur1 = values1.high
		cur2 = values2.high
		while cur1 > values1.low and cur2 > values2.low:
			callBack((cur1, cur2))
			cur1 /= 2
			cur2 /= 2
	elif isinstance(values1, gst.DoubleRange) or isinstance(values1, gst.FractionRange):
		callBack((values1.high, values2.high))
	else:
		callBack((values1, values2))

def parseCap(cap, sizes = {}):
	def iterateForWidthAndHeight(size):
		def probeRate(rate):
			if size not in sizes:
				sizes[size] = []
			d = {
					'framerate': (rate.num, rate.denom),
					'mime': cap.get_name()
			}
			if 'yuv' in d['mime']:
				d['format'] = cap['format'].fourcc
			if d not in sizes[size]:
				sizes[size].append(d)
		iterateCapRange(cap, 'framerate', probeRate)
	if cap.has_key('width'):
		iterateCapDoubleRange(cap, 'width', 'height', iterateForWidthAndHeight)
	return sizes

def buildCaps(resolution, mode, caps):
	(width, height) = resolution
	capString = '%s, width=(int)%d, height=(int)%d, framerate=(fraction)%d/%d' % (mode['mime'], width, height, mode['framerate'][0], mode['framerate'][1])
	if 'yuv' in mode['mime']:
		capString += ', format=(fourcc)%s' % mode['format']
	caps.append(capString)
	return caps

def parse(elementString):
	pipeline = gst.parse_launch(elementString)
	element = pipeline.get_by_name('source')
	pad = element.get_pad('src')
	deviceName = element.get_property('device-name')
	if not deviceName:
		return None, []
	pipeline.set_state(gst.STATE_PAUSED)
	sizes = {}
	caps = pad.get_caps()
	pipeline.set_state(gst.STATE_NULL)
	for cap in caps:
		sizes = parseCap(cap, sizes)
	capList = []
	for size, caps in sizes.iteritems():
		for cap in caps:
			buildCaps(size, cap, capList)
	return deviceName, capList

def detect():
	bus = dbus.SystemBus()
	try:
		hal_manager_obj = bus.get_object('org.freedesktop.Hal', '/org/freedesktop/Hal/Manager')
		hal_manager = dbus.Interface(hal_manager_obj, 'org.freedesktop.Hal.Manager')
		dev_udi_list = hal_manager.FindDeviceByCapability ('video4linux')
		if dev_udi_list:
			print '<?xml version="1.0" encoding="UTF-8"?> <!-- -*- xml -*- -->'
			print ''
			print '<deviceinfo version="0.2">'
			print '  <device>'
			for udi in dev_udi_list:
				dev_obj = bus.get_object('org.freedesktop.Hal', udi)
				dev = dbus.Interface(dev_obj, 'org.freedesktop.Hal.Device')
				parent_obj = bus.get_object('org.freedesktop.Hal', dev.GetProperty('info.parent'))
				parent = dbus.Interface(parent_obj, 'org.freedesktop.Hal.Device')
				print '    <match key="@info.parent:usb_device.vendor_id" int="0x%0xd">' % parent.GetProperty('usb_device.vendor_id')
				print '      <match key="@info.parent:usb_device.product_id" int="0x%0xd">' % parent.GetProperty('usb_device.product_id')
				(name, caps) = parse('v4l2src name=source device=%s ! fakesink' % dev.GetProperty('video4linux.device'))
				if name:
					print '        <merge key="gstreamer.source" type="string">v4l2src</merge>'
				else:
					(name, caps) = parse('v4lsrc name=source device=%s ! fakesink' % dev.GetProperty('video4linux.device'))
					if name:
						print '        <merge key="gstreamer.source" type="string">v4lsrc</merge>'
				if name:
					print '        <merge key="info.product" type="string">%s</merge>' % name
					for cap in caps:
						print '        <append key="gstreamer.capabilities" type="strlist">%s</append>' % cap
			print '      </match>'
			print '    </match>'
			print '  </device>'
			print '</deviceinfo>'
	except None:
		print 'HAL is down'

detect()
