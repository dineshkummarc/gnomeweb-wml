/* account-client.c hacked by Frank Rehberger
 * <F.Rehberger@xtradyne.de>.  */

#include <assert.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <unistd.h>
#include <orbit/orbit.h>

#include "examples-toolkit.h" /* etk_ functions */ 
#include "factory.h"


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
                CORBA_Object              servant,
                CORBA_Environment        *ev)
{
        /* releasing managed object */
        CORBA_Object_release(servant, ev);
        if (etk_raised_exception(ev))
		return;
 
        /* tear down the ORB */
        if (orb != CORBA_OBJECT_NIL)
        {
                /* going to destroy orb.. */
                CORBA_ORB_destroy(orb, ev);
                if (etk_raised_exception(ev)) 
			return;
        }
}

/**
 *
 */
static
void
client_run (Examples_Factory_Producer     factory,
	    CORBA_Environment            *ev)
{
	#define MAX_ID_LEN 100

	CORBA_char  service_id [MAX_ID_LEN+1] = "";
	gint i = 0;
	gint j = 0;

	for (i = 0; i<20; ++i)
	{
		snprintf (service_id, MAX_ID_LEN, "id-%d", i);

		g_printf ("abstract-service: create,");
		Examples_Factory_AbstractService service 
			= Examples_Factory_Producer_produce (factory, 
							     service_id, 
							     ev);
		if (etk_raised_exception (ev)) 
			return;
		
		for (j = 0; j < 5; ++j)
		{
			g_printf (" apply,");

			CORBA_char *mesg = "hallo welt";
			Examples_Factory_AbstractService_doit (service, 
							       mesg, 
							       ev);
			if (etk_raised_exception (ev)) 
				return;
		}

		g_printf (" destroy\n");

		Examples_Factory_AbstractService_destroy (service, ev);
		if (etk_raised_exception (ev)) 
			return;

		CORBA_Object_release ((CORBA_Object) service, ev);
		if (etk_raised_exception (ev)) 
			return;

	}
	#undef MAX_IDL_LEN
}

/*
 * main 
 */
int
main(int argc, char* argv[])
{
        CORBA_char filename[] = "factory.ref";
         
        Examples_Factory_Producer producer = CORBA_OBJECT_NIL;
 
        CORBA_Environment ev[1];
        CORBA_exception_init(ev);
 
        client_init (&argc, argv, &global_orb, ev);
        etk_abort_if_exception(ev, "init failed");
 
        g_print ("Reading service reference from file \"%s\"\n", filename);
 
        producer 
          = (Examples_Factory_Producer) 
		etk_import_object_from_file (global_orb,
					     filename,
					     ev);
        etk_abort_if_exception(ev, "import service failed");
 
        client_run (producer, ev);
        etk_abort_if_exception(ev, "service not reachable");
  
        client_cleanup (global_orb, producer, ev);
        etk_abort_if_exception(ev, "cleanup failed");
  
        exit (0);
}


