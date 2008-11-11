PREFIX ?= /usr
CC = gcc
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --cflags)
LDFLAGS=$(shell pkg-config ORBit-2.0 ORBit-CosNaming-2.0 --libs)

TARGETS=byteseq-client byteseq-server
IDLOUT=byteseq-common.c byteseq-stubs.c byteseq-skels.c byteseq.h

all: $(IDLOUT) byteseq-client byteseq-server

byteseq-server.o: byteseq-server.c byteseq-skelimpl.c
byteseq-client : byteseq-client.o byteseq-stubs.o byteseq-common.o examples-toolkit.o
byteseq-server : byteseq-server.o byteseq-skels.o byteseq-common.o examples-toolkit.o 

$(IDLOUT): byteseq.idl
	$(ORBIT_IDL) byteseq.idl

%-skelimpl.c: %.idl
	$(ORBIT_IDL) --skeleton-impl $^

clean:
	rm -rf *.o *~ $(IDLOUT) *.ior *.ref

distclean: clean
	rm -rf byteseq-client byteseq-server
