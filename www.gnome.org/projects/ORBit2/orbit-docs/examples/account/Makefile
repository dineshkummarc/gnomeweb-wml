CC = gcc
TARGETS=account-client account-server
ORBIT_IDL=orbit-idl-2
CFLAGS= -DORBIT2=1 -D_REENTRANT -I/usr/include/orbit-2.0 \
         -I/usr/include/linc-1.0 -I/usr/include/glib-2.0 \
         -I/usr/lib/glib-2.0/include
LDFLAGS= -Wl,--export-dynamic -lORBit-2 -llinc -lgmodule-2.0 \
             -ldl -lgobject-2.0 -lgthread-2.0 -lpthread -lglib-2.0 -lm
IDLOUT=account-common.c account-stubs.c account-skels.c account.h

all: $(IDLOUT) account-client account-server

account-client : account-client.o account-common.o account-stubs.o 
account-server : account-server.o account-common.o account-skels.o 

$(IDLOUT): account.idl
	$(ORBIT_IDL) account.idl

clean:
	rm -rf *.o *~ $(IDLOUT)

distclean: clean
	rm -rf account-client account-server
