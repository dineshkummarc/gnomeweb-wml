PREFIX=/usr
CC = gcc
TARGETS=name-resolve-client name-resolve-server
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=-g -DORBIT2=1 -D_REENTRANT -I$(PREFIX)/include/orbit-2.0 \
         -I$(PREFIX)/include/linc-1.0 -I$(PREFIX)/include/glib-2.0 \
         -I$(PREFIX)/lib/glib-2.0/include 
LDFLAGS= -Wl,--export-dynamic  -L$(PREFIX)/lib -lORBitCosNaming-2 -lORBit-2 -llinc -lgmodule-2.0 \
             -ldl -lgobject-2.0 -lgthread-2.0 -lpthread -lglib-2.0 -lm
IDLOUT=name-resolve-common.c name-resolve-stubs.c name-resolve-skels.c name-resolve.h

all: $(IDLOUT) name-resolve-client name-resolve-server

name-resolve-client : name-resolve-client.o name-resolve-stubs.o name-resolve-common.o examples-toolkit.o
name-resolve-server : name-resolve-server.o name-resolve-skels.o name-resolve-common.o examples-toolkit.o

$(IDLOUT): name-resolve.idl
	$(ORBIT_IDL) name-resolve.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT)

distclean: clean
	rm -rf name-resolve-client name-resolve-server
