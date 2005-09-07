#!/bin/sh
# Run this to generate all the initial makefiles, etc.

srcdir=`dirname $0`
test -z "$srcdir" && srcdir=.

ORIGDIR=`pwd`
cd $srcdir

DIE=0

# Check for autoconf, the required version is set in configure.in
(autoconf --version) < /dev/null > /dev/null 2>&1 || {
	echo
	echo "You must have at minimum autoconf version 2.12 installed"
	echo "to compile ORBit. Download the appropriate package for"
	echo "your distribution, or get the source tarball at"
	echo "ftp://ftp.gnu.org/pub/gnu/"
	DIE=1
}

# Check for automake, the required version is set in configure.in
(automake --version) < /dev/null > /dev/null 2>&1 ||{
	echo
	echo "You must have at minimum automake version 1.4 installed"
	echo "to compile ORBit. Download the appropriate package for"
	echo "your distribution, or get the source tarball at"
	echo "ftp://ftp.cygnus.com/pub/home/tromey/automake-1.4.tar.gz"
	DIE=1
}


if test "$DIE" -eq 1; then
	exit 1
fi

(test -d www.gnome.org && test -d news.gnome.org) || {
	echo "You must run this script in the top-level gnomeweb-wml  directory"
	exit 1
}

if test -z "$*"; then
	echo "I am going to run ./configure with no arguments - if you wish "
        echo "to pass any to it, please specify them on the $0 command line."
fi

aclocal
automake --copy --add-missing
autoconf

cd $ORIGDIR

echo "Running $srcdir/configure --enable-maintainer-mode" "$@"
$srcdir/configure --enable-maintainer-mode "$@"

echo 
echo "Now type 'make' to compile gnomeweb-wml."
