PREFIX ?= /usr
CC = gcc
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --cflags)
LDFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --libs)

TARGETS=callback-client callback-server
IDLOUT=callback-client-common.c callback-client-stubs.c callback-client-skels.c callback-client.h 

all: $(IDLOUT) callback-client

callback-client.o: callback-client.c callback-client-skelimpl.c callback-client.h

callback-client : callback-client.o callback-client-skels.o callback-client-common.o callback-client-stubs.o examples-toolkit.o 

$(IDLOUT): callback-client.idl
	$(ORBIT_IDL) -I . -I ../server callback-client.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) -I . -I ../server --skeleton-impl $^

clean:
	rm -rf *.o *~  $(IDLOUT) *.ior *.ref callback-client

distclean: clean
	rm -rf callback-client 
