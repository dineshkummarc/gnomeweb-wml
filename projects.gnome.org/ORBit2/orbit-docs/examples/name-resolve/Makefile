TARGETS=name-resolve-client name-resolve-server
IDLOUT=name-resolve-common.c name-resolve-stubs.c name-resolve-skels.c name-resolve.h

PREFIX ?= /usr
CC = gcc
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --cflags)
LDFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --libs)

all: $(IDLOUT) name-resolve-client name-resolve-server

name-resolve-server.o: name-resolve-server.c name-resolve-skelimpl.c

name-resolve-client : name-resolve-client.o name-resolve-stubs.o name-resolve-common.o examples-toolkit.o
name-resolve-server : name-resolve-server.o name-resolve-skels.o name-resolve-common.o examples-toolkit.o name-resolve-skelimpl.o

$(IDLOUT): name-resolve.idl
	$(ORBIT_IDL) name-resolve.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT) *.ior *.ref name-resolve-client name-resolve-server

distclean: clean
	rm -rf name-resolve-client name-resolve-server
