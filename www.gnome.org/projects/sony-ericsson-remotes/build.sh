#!/bin/bash

error()
{
	echo "**" $ERROR "**"
	exit 1
}


SIZES="128x160 176x220 240x320"
APPS="Totem Rhythmbox Evince"

# Clean up ?
if [ -n "$1" -a x"$1" = x"clean" ] ; then
	for size in $SIZES; do
		rm -r ./$size/
	done
	rm -f create-png-version images/screenshot-*.png
	exit 0
fi

# Create the application to create the images
gcc -o create-png-version `pkg-config --libs --cflags cairo-png librsvg-2.0` create-png-version.c || ERROR="Couldn't compile create-png-version" error

# Create the directories
for size in $SIZES; do
	mkdir $size 2> /dev/null
done

# Create the images, and package them with the kcf files
for app in $APPS; do
	for size in $SIZES; do
		echo "Creating $size drawing for $app"
		test -f $app.kcf || ERROR="Missing KCF file for $app" error
		test -f drawing.svg || ERROR="drawing.svg missing" error
		./create-png-version drawing.svg $size $app $app.png || ERROR="Can't create $app. for size $size" error
		convert $app.png $app.jpg || ERROR="Can't convert $app.png $app.jpg" error
		rm -f $app.png
		# Set a specific date on the jpeg file, so that data is compared instead
		touch -c -m -r $app.kcf $app.jpg
		if tar --compare -m --file=$size/$app.hid $app.kcf && tar --compare -m --file=$size/$app.hid $app.jpg; then
			echo "Same key defs and image, not updating hid file"
		else
			tar cf $size/$app.hid $app.kcf $app.jpg
		fi

		# Clean up
		rm -f $app.jpg
	done
done

# Create the screenshot images
for app in $APPS; do
	./create-png-version drawing.svg 360x480 $app images/screenshot-$app.png || ERROR="Can't screenshot $app.png for size $size" error
	./create-png-version drawing.svg 120x160 $app images/screenshot-$app-thumb.png || ERROR="Can't screenshot $app.png for size $size" error
done

rm -f create-png-version
