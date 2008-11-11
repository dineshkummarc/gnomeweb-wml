PREFIX ?= /usr
CC = gcc
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --cflags)
LDFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --libs)

TARGETS=account-client account-server
IDLOUT=account-common.c account-stubs.c account-skels.c account.h

all: $(IDLOUT) account-client account-server

account-server.o: account-server.c account-skelimpl.c
account-client : account-client.o account-stubs.o account-common.o examples-toolkit.o
account-server : account-server.o account-skels.o account-common.o examples-toolkit.o


$(IDLOUT): account.idl
	$(ORBIT_IDL) account.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT) *.ior *.ref

distclean: clean
	rm -rf account-client account-server
