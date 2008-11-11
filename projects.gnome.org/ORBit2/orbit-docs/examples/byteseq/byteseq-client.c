/* account-client.c hacked by Frank Rehberger
 * <F.Rehberger@xtradyne.de>.  */

#include <assert.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <orbit/orbit.h>

#include "byteseq.h"

#include "examples-toolkit.h" /* ie. etk_etk_abort_if_exception() */
 
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
                etk_abort_if_exception (local_ev, "caught exception");
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
        if (etk_raised_exception(ev)) return;
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
        if (etk_raised_exception(ev)) return;
 
        /* tear down the ORB */
        if (orb != CORBA_OBJECT_NIL)
        {
                /* going to destroy orb.. */
                CORBA_ORB_destroy(orb, ev);
                if (etk_raised_exception(ev)) return;
        }
}

/**
 *
 */
static
void
client_run_set (Examples_ByteSeq_Storage  servant,
		CORBA_Environment        *ev)
{

	CORBA_long LEN      = 4*1024; /* 4KB */ 
	CORBA_long ITER     = 10; 

	CORBA_long iter     = 0; 

	Examples_ByteSeq_Chunk* chunk = NULL;


	/* flood service witth large chunks of byte streams */
	for (iter = 0; iter < ITER; ++iter)
	{
		CORBA_long len      = 0; 
		CORBA_octet elem    = 'A';

		g_print ("+");

		chunk = ORBit_sequence_alloc (TC_CORBA_sequence_CORBA_octet,0);

		for (len = 0; len < LEN; ++len)
			ORBit_sequence_append (chunk, &elem);

		Examples_ByteSeq_Storage_set (servant, chunk, ev); 
		if (etk_raised_exception(ev)) return;

		CORBA_free (chunk);
	}
}

/**
 *
 */
static
void
client_run_get (Examples_ByteSeq_Storage  servant,
		CORBA_Environment        *ev)
{
	CORBA_long n=10;
	CORBA_long i=0;

	Examples_ByteSeq_Chunk* chunk = NULL; 

	/* increment sequence length, beginning with 0 up to 2048 */
	for (i=0; i<n; ++i)
	{
		g_print ("-");

		chunk = Examples_ByteSeq_Storage_get (servant, ev); 
		if (etk_raised_exception(ev)) return;

 		CORBA_free (chunk);
	}
}

/*
 * main 
 */
int
main(int argc, char* argv[])
{
	CORBA_char *filename = "byteseq.ref";

        Examples_ByteSeq_Storage  servant = CORBA_OBJECT_NIL;

        CORBA_Environment ev[1];
        CORBA_exception_init(ev);

	client_init (&argc, argv, &global_orb, ev);
	etk_abort_if_exception(ev, "init failed");

	g_print ("Reading service reference from file \"%s\"\n", filename);

	servant = (Examples_ByteSeq_Storage) 
		etk_import_object_from_file (global_orb,
					     filename,
					     ev);
        etk_abort_if_exception(ev, "exporting IOR failed");

	client_run_set (servant, ev);
        etk_abort_if_exception(ev, "client stopped");
 
	client_run_get (servant, ev);
        etk_abort_if_exception(ev, "client stopped");
 
	client_cleanup (global_orb, servant, ev);
        etk_abort_if_exception(ev, "cleanup failed");
 
        exit (0);
}


