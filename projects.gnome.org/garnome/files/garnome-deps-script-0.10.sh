#!/bin/bash
#
# Script by Boris Goldowsky (boris at alum mit edu)
#
# Checks to see if you have all of the dependencies 
# installed for GARNOME on a RPM based system.
#
# Most of these pacakges are part of the Red Hat/Fedora 
# Core Distributions.

deps_gnu_tool_chain="
gcc
gcc-c++
make
gettext
patch
flex
bison
byacc
"

deps_desktop="
wget
gzip
bzip2-devel
zlib-devel
xorg-x11-libs
xorg-x11-devel
libpng-devel
libjpeg-devel
libtiff-devel
ncurses-devel
libcap-devel
expat-devel
samba
sgml-common
docbook-dtds
docbook-style-dsssl
docbook-style-xsl
docbook-utils
openjade
python-devel
Pyrex
PyXML
libexif-devel
pilot-link-devel
libtermcap-devel
aspell-devel
openldap-devel
krb5-devel
gnutls-devel
libvorbis-devel
cdparanoia-devel
SDL-devel
mozilla-devel
Hermes-devel
libmad-devel
"

deps_office="
mysql-devel
openssl-devel
"

deps_fifth_toe="
pcre-devel
curl-devel
gimp-print-devel
gpgme-devel
tcl-devel
"

deps_hacker_tools="
pcre-devel
valgrind
"

deps_geektoys="
cups-devel
pwlib-devel
openh323-devel
howl-devel
lame-devel
mpeg2dec-devel
wireless-tools
gdk-pixbuf-devel
gtk+-devel
cracklib
cracklib-dicts
libogg-devel
libvorbis-devel
libdvdread-devel
a52dec-devel
"

deps_bindings="
gcc-java
"

deps_mono="
lcms-devel
gphoto2-devel
gdbm-devel
libid3tag-devel
flac-devel
gtkspell-devel
"

deps_matchbox=""

for list in ${!deps_*}; do
  echo "Testing items in $list:";
  missing=""
  for i in ${!list}; do
    rpm -q $i || missing="$missing $i";
  done;
  if [ "$missing" ]; then
    message="${message}MISSSING for $list: $missing
";
  fi
  echo
done

if [ -z "$message" ]; then
  echo "All dependencies appear to be satisfied";
else
  echo "$message"
fi


# end of script
