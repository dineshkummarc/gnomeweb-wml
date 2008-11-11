PREFIX ?= /usr
CC = gcc
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --cflags)
LDFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --libs)

TARGETS=factory-client factory-server
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
