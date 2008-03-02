SIZE=256
PNG=$(shell find -name "*.png")
MINI= $(PNG:%.png=%-mini.png)

all: $(MINI)

%-mini.png: %.png Makefile
	convert $< \
	-size x$(SIZE) \
	-bordercolor white -border 6 \
	-bordercolor grey -border 2 \
	-background black \( +clone -shadow 60x4+4+4 \) +swap \
	-background none -flatten \
	-background none -rotate `perl -e 'print rand() * 4 - 2'` \
	-resize x$(SIZE) \
	 $@

clean:
	find -name "*mini.png" -exec rm {} \;
