PREFIX ?= /usr
CC = gcc
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --cflags)
LDFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --libs)

TARGETS=callback-server
IDLOUT=callback-server-common.c callback-server-stubs.c callback-server-skels.c callback-server.h 

all: $(IDLOUT) callback-server

callback-server.o: callback-server.c callback-server-skelimpl.c callback-server.h

callback-server : callback-server.o callback-server-skels.o callback-server-common.o callback-server-stubs.o examples-toolkit.o


$(IDLOUT): callback-server.idl
	$(ORBIT_IDL) -I . callback-server.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) -I . --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT) *.ior *.ref

distclean: clean
	rm -rf callback-server
