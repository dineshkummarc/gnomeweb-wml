PREFIX=/usr
CC = gcc
TARGETS=account-client account-server
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=-DORBIT2=1 -D_REENTRANT -I$(PREFIX)/include/orbit-2.0 \
       -I$(PREFIX)/include/linc-1.0 -I$(PREFIX)/include/glib-2.0 \
       -I$(PREFIX)/lib/glib-2.0/include -g
LDFLAGS= -Wl,--export-dynamic -L$(PREFIX)/lib -lORBit-2 -llinc -lgmodule-2.0 \
             -ldl -lgobject-2.0 -lgthread-2.0 -lpthread -lglib-2.0 -lm       \
             -lORBitCosNaming-2

IDLOUT=account-common.c account-stubs.c account-skels.c account.h

all: $(IDLOUT) account-client account-server

account-client : account-client.o account-stubs.o account-common.o examples-toolkit.o
account-server : account-server.o account-skels.o account-common.o examples-toolkit.o


$(IDLOUT): account.idl
	$(ORBIT_IDL) account.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT)

distclean: clean
	rm -rf account-client account-server
