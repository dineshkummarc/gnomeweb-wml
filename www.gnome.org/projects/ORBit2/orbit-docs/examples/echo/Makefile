PREFIX=/usr
CC = gcc
TARGETS=echo-client echo-server
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=-DORBIT2=1 -D_REENTRANT -I$(PREFIX)/include/orbit-2.0 \
       -I$(PREFIX)/include/linc-1.0 -I$(PREFIX)/include/glib-2.0 \
       -I$(PREFIX)/lib/glib-2.0/include -g
LDFLAGS= -Wl,--export-dynamic -L$(PREFIX)/lib -lORBit-2 -llinc -lgmodule-2.0 \
             -ldl -lgobject-2.0 -lgthread-2.0 -lpthread -lglib-2.0 -lm       \
             -lORBitCosNaming-2 
IDLOUT=echo-common.c echo-stubs.c echo-skels.c echo.h

all: $(IDLOUT) echo-client echo-server

echo-client : echo-client.o echo-stubs.o echo-common.o examples-toolkit.o
echo-server : echo-server.o echo-skels.o echo-common.o examples-toolkit.o

$(IDLOUT): echo.idl
	$(ORBIT_IDL) echo.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT)

distclean: clean
	rm -rf echo-client echo-server
