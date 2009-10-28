PREFIX ?= /usr
CC = gcc
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --cflags)
LDFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --libs)

TARGETS=calculator-client mt-calculator-server
IDLOUT=calculator-common.c calculator-stubs.c calculator-skels.c calculator.h

all: $(IDLOUT) calculator-client mt-calculator-server

mt-calculator-server.o : mt-calculator-server.c calculator-skelimpl.c

calculator-client : calculator-client.o calculator-stubs.o calculator-common.o examples-toolkit.o 
mt-calculator-server : mt-calculator-server.o calculator-skels.o calculator-common.o examples-toolkit.o 

$(IDLOUT): calculator.idl
	$(ORBIT_IDL) calculator.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT) *.ior *.ref calculator-client mt-calculator-server

distclean: clean
	rm -rf calculator-client mt-calculator-server
