PREFIX=/opt
CC = gcc
TARGETS=byteseq-client byteseq-server
ORBIT_IDL=orbit-idl-2
CFLAGS=-g -DORBIT2=1 -D_REENTRANT -I$(PREFIX)/include/orbit-2.0 \
         -I$(PREFIX)/include/linc-1.0 -I$(PREFIX)/include/glib-2.0 \
         -I$(PREFIX)/lib/glib-2.0/include 
LDFLAGS= -Wl,--export-dynamic  -L$(PREFIX)/lib -lORBit-2 -llinc -lgmodule-2.0 \
             -ldl -lgobject-2.0 -lgthread-2.0 -lpthread -lglib-2.0 -lm
IDLOUT=byteseq-common.c byteseq-stubs.c byteseq-skels.c byteseq.h

all: $(IDLOUT) byteseq-client byteseq-server

byteseq-client : byteseq-client.o byteseq-common.o byteseq-stubs.o 
byteseq-server : byteseq-server.o byteseq-common.o byteseq-skels.o 

$(IDLOUT): byteseq.idl
	$(ORBIT_IDL) byteseq.idl

clean:
	rm -rf *.o *~ $(IDLOUT)

distclean: clean
	rm -rf byteseq-client byteseq-server
