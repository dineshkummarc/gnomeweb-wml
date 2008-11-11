#!/bin/bash
#
# Installs all of the dependencies for GARNOME (desktop & platform)
# via yum and rpm for Fedora Core.
#
# Note: You need to add the freshrpms.net repo to get the libmad package.

yum -y install \
gcc \
gcc-c++ \
make \
gettext \
patch \
flex \
bison \
byacc \
wget \
gzip \
bzip2-devel \
zlib-devel \
xorg-x11-libs \
xorg-x11-devel \
libpng-devel \
libjpeg-devel \
libtiff-devel \
ncurses-devel \
libcap-devel \
expat-devel \
samba \
Hermes-devel \
sgml-common \
perl-SGMLSpm \
docbook-dtds \
docbook-style-dsssl \
docbook-style-xsl \
docbook-utils \
openjade \
python-devel \
Pyrex \
PyXML \
libexif-devel \
pilot-link-devel \
libtermcap-devel \
aspell-devel \
openldap-devel \
krb5-devel \
gnutls-devel \
libvorbis-devel \
cdparanoia-devel \
SDL-devel \
liboil-devel \
libsexy-devel \
doxygen \
mozilla-devel \
libmad-devel
