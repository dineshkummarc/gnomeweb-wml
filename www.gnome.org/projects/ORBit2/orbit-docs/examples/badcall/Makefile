PREFIX ?= /usr
CC = gcc
TARGETS=badcall-client badcall-server
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=-g -DORBIT2=1 -D_REENTRANT -I$(PREFIX)/include/orbit-2.0 \
         -I$(PREFIX)/include/linc-1.0 -I$(PREFIX)/include/glib-2.0 \
         -I$(PREFIX)/lib/glib-2.0/include 
LDFLAGS= -Wl,--export-dynamic  -L$(PREFIX)/lib -lORBit-2 -llinc -lgmodule-2.0 \
             -ldl -lgobject-2.0 -lgthread-2.0 -lpthread -lglib-2.0 -lm        \
             -lORBitCosNaming-2

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
