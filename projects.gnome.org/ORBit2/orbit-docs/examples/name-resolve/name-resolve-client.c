/*
 * Echo client program.. Hacked by Ewan Birney <birney@sanger.ac.uk>
 * from echo test suite, update for ORBit2 by Frank Rehberger
 * <F.Rehberger@xtradyne.de>
 *
 * Client reads object reference (IOR) from local file 'echo.ior' and
 * forwards console input to echo-server. A dot . as single character
 * in input terminates the client.
 */

#include <stdio.h>
#include <signal.h>
#include <orbit/orbit.h>

/*
 * This header file was generated from the idl
 */

#include "name-resolve.h"
#include "examples-toolkit.h" /* provides etk_abort_if_exception */ 


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
                CORBA_Object              service,
                CORBA_Environment        *ev)
{
        /* releasing managed object */
        CORBA_Object_release(service, ev);
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
client_run (Examples_NameResolve_Service  service,
	    CORBA_Environment            *ev)
{
	char filebuffer[1024+1];

	g_print("Type any text to console to be sent to server,\n"
		"a single dot in line will terminate input\n");
	
	while( fgets(filebuffer,1024,stdin) ) {
		if( filebuffer[0] == '.' && filebuffer[1] == '\n' ) 
			break;
		
		/* chop the newline off */
		filebuffer[strlen(filebuffer)-1] = '\0';
      
		/* using the echoString method in the Echo object 
		 * this is defined in the echo.h header, compiled from
		 * echo.idl */

		Examples_NameResolve_Service_echoString (service,
							 filebuffer,
							 ev);
		if (etk_raised_exception (ev)) return;
	}
}

/*
 * main 
 */
int
main(int argc, char* argv[])
{
	Examples_NameResolve_Service service = CORBA_OBJECT_NIL;
	CosNaming_NamingContext name_service = CORBA_OBJECT_NIL;

	gchar *id[] = {"Examples", "NameResolve", "Service", NULL};

        CORBA_Environment ev[1];
        CORBA_exception_init(ev);

	client_init (&argc, argv, &global_orb, ev);
	etk_abort_if_exception(ev, "init failed");

	g_print ("Resolving service reference from name-service with id \"%s/%s/%s\"\n", id[0], id[1], id[2]);

	name_service = etk_get_name_service (global_orb, ev);
	etk_abort_if_exception(ev, "failed resolving name-service");

	service 
	  = (Examples_NameResolve_Service) 
		etk_name_service_resolve (name_service, id, ev);
	etk_abort_if_exception(ev, "failed resolving service at name-service");

	client_run (service, ev);
        etk_abort_if_exception(ev, "service not reachable");
 
	client_cleanup (global_orb, service, ev);
        etk_abort_if_exception(ev, "cleanup failed");
 
        exit (0);
}
