PREFIX ?= /usr
CC = gcc
TARGETS=byteseq-client byteseq-server
ORBIT_IDL=$(PREFIX)/bin/orbit-idl-2
CFLAGS=-g -DORBIT2=1 -D_REENTRANT -I$(PREFIX)/include/orbit-2.0 \
         -I$(PREFIX)/include/linc-1.0 -I$(PREFIX)/include/glib-2.0 \
         -I$(PREFIX)/lib/glib-2.0/include 
LDFLAGS= -Wl,--export-dynamic  -L$(PREFIX)/lib -lORBit-2 -llinc -lgmodule-2.0 \
             -ldl -lgobject-2.0 -lgthread-2.0 -lpthread -lglib-2.0 -lm        \
             -lORBitCosNaming-2
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
