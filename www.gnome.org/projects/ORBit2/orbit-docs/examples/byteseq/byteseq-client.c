/* account-client.c hacked by Frank Rehberger
 * <F.Rehberger@xtradyne.de>.  */

#include <assert.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <orbit/orbit.h>

#include "byteseq.h"

/** 
 * test for exception 
 */
static
gboolean 
raised_exception(CORBA_Environment *ev) 
{
	return ((ev)->_major != CORBA_NO_EXCEPTION);
}

/**
 * in case of any exception this macro will abort the process  
 */
static
void 
abort_if_exception(CORBA_Environment *ev, const char* mesg) 
{
	if (raised_exception (ev)) {
		g_error ("%s %s", mesg, CORBA_exception_id (ev));
		CORBA_exception_free (ev); 
		abort(); 
	}
}

static CORBA_ORB  global_orb = CORBA_OBJECT_NIL; /* global orb */
 
/* Is called in case of process signals. it invokes CORBA_ORB_shutdown()
 * function, which will terminate the processes main loop.
 */
static
void
client_shutdown (int sig)
{
        CORBA_Environment  local_ev[1];
        CORBA_exception_init(local_ev);
 
        if (global_orb != CORBA_OBJECT_NIL)
        {
                CORBA_ORB_shutdown (global_orb, FALSE, local_ev);
                abort_if_exception (local_ev, "caught exception");
        }
}
 
        
/* Inits ORB @orb using @argv arguments for configuration. For each
 * ORBit options consumed from vector @argv the counter of @argc_ptr
 * will be decremented. Signal handler is set to call
 * echo_client_shutdown function in case of SIGINT and SIGTERM
 * signals.  If error occures @ev points to exception object on
 * return.
 */
static
void
client_init (int               *argc_ptr,
	     char              *argv[],
             CORBA_ORB         *orb,
             CORBA_Environment *ev)
{
        /* init signal handling */
 
        signal(SIGINT,  client_shutdown);
        signal(SIGTERM, client_shutdown);
         
        /* create Object Request Broker (ORB) */
         
        (*orb) = CORBA_ORB_init(argc_ptr, argv, "orbit-local-orb", ev);
        if (raised_exception(ev)) return;
}

/* Releases @servant object and finally destroys @orb. If error
 * occures @ev points to exception object on return.
 */
static
void
client_cleanup (CORBA_ORB                 orb,
                Examples_ByteSeq_Storage  servant,
                CORBA_Environment        *ev)
{
        /* releasing managed object */
        CORBA_Object_release(servant, ev);
        if (raised_exception(ev)) return;
 
        /* tear down the ORB */
        if (orb != CORBA_OBJECT_NIL)
        {
                /* going to destroy orb.. */
                CORBA_ORB_destroy(orb, ev);
                if (raised_exception(ev)) return;
        }
}

/**
 *
 */
static
CORBA_Object
client_import_service_from_stream (CORBA_ORB          orb,
				   FILE              *stream,
				   CORBA_Environment *ev)
{
	CORBA_Object obj = CORBA_OBJECT_NIL;
	gchar *objref=NULL;
    
	fscanf (stream, "%as", &objref);  /* FIXME, handle input error */ 
	
	obj = (CORBA_Object) CORBA_ORB_string_to_object (global_orb,
							 objref, 
							 ev);
	free (objref);
	
	return (Examples_ByteSeq_Storage) obj;
}

/**
 *
 */
static
CORBA_Object
client_import_service_from_file (CORBA_ORB          orb,
                                 CORBA_char        *filename,
                                 CORBA_Environment *ev)
{
        CORBA_Object  obj    = NULL;
        FILE         *file   = NULL;
  
        /* write objref to file */
          
        if ((file=fopen(filename, "r"))==NULL)
                g_error ("could not open %s\n", filename);
     
        obj= client_import_service_from_stream (orb, file, ev);
         
        fclose (file);
 
        return obj;
}
 
/**
 *
 */
static
Examples_ByteSeq_Chunk*
chunk_create (CORBA_long maximum)
{
        Examples_ByteSeq_Chunk* chunk = Examples_ByteSeq_Chunk__alloc();
        /* FIXME, handle out of memory */
        chunk->_buffer  = Examples_ByteSeq_Chunk_allocbuf (maximum);
        /* FIXME, handle out of memory */
        chunk->_maximum = maximum;
        chunk->_length  = 0;

	/* lifetime of _buffer corresponds to chunk */
	CORBA_sequence_set_release (chunk, TRUE);         

        return chunk;
}

/**
 *
 */
static
void
client_run_set (Examples_ByteSeq_Storage  servant,
		CORBA_Environment        *ev)
{
	CORBA_long maximum=2048;
	CORBA_long length =0;

	Examples_ByteSeq_Chunk* chunk = NULL;

	chunk = chunk_create (maximum+1);

	/* increment sequence length, beginning with 0 up to 2048 */
	for (length=0; length<maximum+1; length+=8)
	{
		Examples_ByteSeq_Storage_set (servant, chunk, ev); 
		if (raised_exception(ev)) return;

		chunk->_buffer [(length+1) % maximum] = (CORBA_octet) 0xFF;
		chunk->_length = ((length+1) % maximum) + 1;
	}
	CORBA_free (chunk);
}

/**
 *
 */
static
void
client_run_get (Examples_ByteSeq_Storage  servant,
		CORBA_Environment        *ev)
{
	CORBA_long n=100;
	CORBA_long i=0;

	Examples_ByteSeq_Chunk* chunk = NULL; 

	/* increment sequence length, beginning with 0 up to 2048 */
	for (i=0; i<n; ++i)
	{
		chunk = Examples_ByteSeq_Storage_get (servant, ev); 
		if (raised_exception(ev)) return;

 		CORBA_free (chunk);
	}
}

/**
 *
 */
static
void
client_run_exchange (Examples_ByteSeq_Storage  servant,
		     CORBA_Environment        *ev)
{
	CORBA_long n=100;
	CORBA_long i=0;

	CORBA_long maximum=2048;
	CORBA_long length =0;

	Examples_ByteSeq_Chunk* chunk = chunk_create (maximum+1);

	/* increment sequence length, beginning with 0 up to 2048 */
	for (i=0; i<n; ++i)
	{
		Examples_ByteSeq_Storage_exchange (servant, chunk, ev); 
		if (raised_exception(ev)) return;

		/* now use octet sequence */ 
	}

	CORBA_free (chunk);
}

/*
 * main 
 */
int
main(int argc, char* argv[])
{
	CORBA_char *filename = "byteseq.ior";

        Examples_ByteSeq_Storage  servant = CORBA_OBJECT_NIL;

        CORBA_Environment ev[1];
        CORBA_exception_init(ev);

	client_init (&argc, argv, &global_orb, ev);
	abort_if_exception(ev, "init failed");

	g_print ("Reading service reference from file \"%s\"\n", filename);

	servant = (Examples_ByteSeq_Storage) 
		client_import_service_from_file (global_orb,
						filename,
						ev);
        abort_if_exception(ev, "exporting IOR failed");

	client_run_set (servant, ev);
        abort_if_exception(ev, "client stopped");
 
	client_run_get (servant, ev);
        abort_if_exception(ev, "client stopped");
 
	client_run_exchange (servant, ev);
        abort_if_exception(ev, "client stopped");
 
	client_cleanup (global_orb, servant, ev);
        abort_if_exception(ev, "cleanup failed");
 
        exit (0);
}


