PREFIX ?= /usr
CC = gcc
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --cflags)
LDFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --libs)

TARGETS=badcall-client badcall-server
IDLOUT=badcall-common.c badcall-stubs.c badcall-skels.c badcall.h

all: $(IDLOUT) badcall-client badcall-server

badcall-server.o: badcall-server.c badcall-skelimpl.c

badcall-client : badcall-client.o badcall-stubs.o badcall-common.o examples-toolkit.o
badcall-server : badcall-server.o badcall-skels.o badcall-common.o examples-toolkit.o

$(IDLOUT): badcall.idl
	$(ORBIT_IDL) badcall.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT) *.ior *.ref

distclean: clean
	rm -rf badcall-client badcall-server
