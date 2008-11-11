#!/bin/bash
#
# Script by Karsten (Guenther) Brackelmann
#
# Outputs the number of packages that have been built in GARNOME.
#
# Please note though, that this (as is) might report false values
# if you are using more funky things than 'make install'. Particularly
# the 'log-' targets are not filtered here.

for d in */; do printf "%6d /%3d  %s\n" `find $d -maxdepth 5 -type f -name install | wc -l` `ls -d -p $d/* | egrep "/$" | wc -l` $d; done
