#!/bin/sh

FILES="screenshots.tmp index.tmp"
FOOTER="footer.tmp"

for i in $FILES; do
  cp $i $(echo $i | sed "s/tmp/html/")
  cat $FOOTER >> $(echo $i | sed "s/tmp/html/")
done
