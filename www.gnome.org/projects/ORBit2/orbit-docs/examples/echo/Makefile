CC = gcc
TARGETS=echo-client echo-server
ORBIT_IDL=orbit-idl-2
CFLAGS= -DORBIT2=1 -D_REENTRANT -I/usr/include/orbit-2.0 \
         -I/usr/include/linc-1.0 -I/usr/include/glib-2.0 \
         -I/usr/lib/glib-2.0/include
LDFLAGS= -Wl,--export-dynamic -lORBit-2 -llinc -lgmodule-2.0 \
             -ldl -lgobject-2.0 -lgthread-2.0 -lpthread -lglib-2.0 -lm
IDLOUT=echo-common.c echo-stubs.c echo-skels.c echo.h

all: $(IDLOUT) echo-client echo-server

echo-client : echo-client.o echo-common.o echo-stubs.o 
echo-server : echo-server.o echo-common.o echo-skels.o 

$(IDLOUT): echo.idl
	$(ORBIT_IDL) echo.idl

clean:
	rm -rf *.o *~ $(IDLOUT)
