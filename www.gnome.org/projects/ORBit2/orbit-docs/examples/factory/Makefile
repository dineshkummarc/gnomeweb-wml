PREFIX ?= /usr
CC = gcc
TARGETS=factory-client factory-server
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=-g -DORBIT2=1 -D_REENTRANT -I$(PREFIX)/include/orbit-2.0 \
         -I$(PREFIX)/include/linc-1.0 -I$(PREFIX)/include/glib-2.0 \
         -I$(PREFIX)/lib/glib-2.0/include 
LDFLAGS= -Wl,--export-dynamic  -L$(PREFIX)/lib -lORBitCosNaming-2 -lORBit-2 -llinc -lgmodule-2.0 \
             -ldl -lgobject-2.0 -lgthread-2.0 -lpthread -lglib-2.0 -lm
IDLOUT=factory-common.c factory-stubs.c factory-skels.c factory.h

all: $(IDLOUT) factory-client factory-server

factory-server.o: factory-server.c factory-skelimpl.c

factory-client : factory-client.o factory-stubs.o factory-common.o examples-toolkit.o
factory-server : factory-server.o factory-skels.o factory-common.o examples-toolkit.o

$(IDLOUT): factory.idl
	$(ORBIT_IDL) factory.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT) *.ior *.ref

distclean: clean
	rm -rf factory-client factory-server
