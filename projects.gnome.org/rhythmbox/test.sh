#!/bin/sh

# Generate the RB pages for testing purposes

if [ ! -f index.xml ] ; then
	echo This scripts needs to be run from the Rhythmbox website CVS directory
	exit 1
fi

for i in *.xml ; do
	OUTPUT=`echo $i | sed 's/\.xml$/.html/'`
	echo Generating $OUTPUT...
	xsltproc --nonet --stringparam date "`date -R`" -o $OUTPUT mkpage.xsl $i
	xmllint --output /dev/null --valid $OUTPUT
done
	
