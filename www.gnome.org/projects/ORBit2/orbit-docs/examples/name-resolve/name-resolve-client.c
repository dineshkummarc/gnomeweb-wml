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
#include "name-resolve.h"


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
client_run (Examples_NameResolve_Factory  factory,
	    CORBA_Environment            *ev)
{
	CORBA_char  service_id [100] = "";
	gint i = 0;
	gint j = 0;

	for (i = 0; TRUE; ++i)
	{
		sprintf (service_id, "service %d", i);

		Examples_NameResolve_Service service 
			= Examples_NameResolve_Factory_produce (factory, 
								service_id, 
								ev);
		if (etk_raised_exception (ev)) return;
		
		for (j = 0; j < 10; ++j)
		{
			CORBA_char *mesg = "hallo welt";
			Examples_NameResolve_Service_doit (service, mesg, ev);
			if (etk_raised_exception (ev)) return;
			
			usleep (10*1000);
		}

		Examples_NameResolve_Service_destroy (service, ev);
		if (etk_raised_exception (ev)) return;

		CORBA_Object_release ((CORBA_Object) service, ev);
		if (etk_raised_exception (ev)) return;

	}
}


/*
 * main 
 */
int
main(int argc, char* argv[])
{
	gchar *id_vec[] = {"Examples", "NameResolve", "Factory", NULL};

	CosNaming_NamingContext name_service  = CORBA_OBJECT_NIL;
        CORBA_Object            servant       = CORBA_OBJECT_NIL;

        CORBA_Environment ev[1];
        CORBA_exception_init(ev);

	client_init (&argc, argv, &global_orb, ev);
	etk_abort_if_exception(ev, "init failed");

	name_service = etk_get_name_service (global_orb, ev);
        etk_abort_if_exception(ev, "get name-service failed");

	g_print ("Resolve object reference for /%s/%s/%s\n\n", 
		 id_vec [0], id_vec [1], id_vec [2]);

	servant = etk_name_service_resolve (name_service,
					    id_vec,
					    ev);
        etk_abort_if_exception(ev, "resolving servant failed");

	client_run (servant, ev);
        etk_abort_if_exception(ev, "client stopped");
 
	client_cleanup (global_orb, servant, ev);
        etk_abort_if_exception(ev, "cleanup failed");
 
        exit (0);
}


