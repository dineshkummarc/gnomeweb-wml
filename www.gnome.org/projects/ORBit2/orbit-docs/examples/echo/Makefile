PREFIX ?= /usr
CC = gcc
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --cflags)
LDFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --libs)

TARGETS=echo-client echo-server ssl-server
IDLOUT=echo-common.c echo-stubs.c echo-skels.c echo.h \
       ssl-common.c  ssl-stubs.c  ssl-skels.c  ssl.h 

all: $(IDLOUT) echo-client echo-server ssl-server

echo-server.o: echo-server.c echo-skelimpl.c 
ssl-server.o: ssl-server.c ssl-skelimpl.c 

echo-client : echo-client.o echo-stubs.o echo-common.o examples-toolkit.o
echo-server : echo-server.o echo-skels.o echo-common.o examples-toolkit.o echo-skelimpl.o
ssl-server : ssl-server.o ssl-skels.o ssl-common.o examples-toolkit.o ssl-skelimpl.o

$(IDLOUT): echo.idl ssl.idl
	$(ORBIT_IDL) echo.idl
	$(ORBIT_IDL) ssl.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT) *.ior *.ref

distclean: clean
	rm -rf echo-client echo-server ssl-server
