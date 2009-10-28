PREFIX ?= /usr
CC = gcc
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --cflags)
LDFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --libs)

TARGETS=echo-client echo-server
IDLOUT=echo-common.c echo-stubs.c echo-skels.c echo.h

all: $(IDLOUT) echo-client echo-server

echo-server.o: echo-server.c echo-skelimpl.c

echo-client : echo-client.o echo-stubs.o echo-common.o examples-toolkit.o
echo-server : echo-server.o echo-skels.o echo-common.o examples-toolkit.o echo-skelimpl.o

$(IDLOUT): echo.idl
	$(ORBIT_IDL) echo.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT) *.ior *.ref echo-client echo-server

distclean: clean
	rm -rf echo-client echo-server
