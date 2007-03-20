PNG=$(shell find -name "*.png")
MINI= $(PNG:%.png=%-mini.png)

all: $(MINI)

%-mini.png: %.png Makefile
	convert $< \
	-thumbnail x256 \
	-bordercolor white -border 6 \
	-bordercolor grey -border 1 \
	-background black \( +clone -shadow 60x4+4+4 \) +swap \
	-background none -rotate `perl -e 'print rand() * 6 - 4'` \
	-background none -flatten \
	-resize x256 \
	 $@

clean:
	find -name "*mini*.png" -exec rm {} \;
