PREFIX=/opt
CC = gcc
TARGETS=calculator-client calculator-server
ORBIT_IDL=orbit-idl-2
CFLAGS=-DORBIT2=1 -D_REENTRANT -I$(PREFIX)/include/orbit-2.0 \
       -I$(PREFIX)/include/linc-1.0 -I$(PREFIX)/include/glib-2.0 \
       -I$(PREFIX)/lib/glib-2.0/include -g
LDFLAGS= -Wl,--export-dynamic -L$(PREFIX)/lib -lORBit-2 -llinc -lgmodule-2.0 \
             -ldl -lgobject-2.0 -lgthread-2.0 -lpthread -lglib-2.0 -lm
IDLOUT=calculator-common.c calculator-stubs.c calculator-skels.c calculator.h

all: $(IDLOUT) calculator-client calculator-server

calculator-client : calculator-client.o calculator-common.o calculator-stubs.o 
calculator-server : calculator-server.o calculator-common.o calculator-skels.o 

$(IDLOUT): calculator.idl
	$(ORBIT_IDL) calculator.idl

clean:
	rm -rf *.o *~ $(IDLOUT)

distclean: clean
	rm -rf calculator-client calculator-server
