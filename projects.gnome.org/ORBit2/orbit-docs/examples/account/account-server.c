/*
 * account-server program. Hacked from Frank Rehberger
 * <F.Rehberger@xtradyne.de>.
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <orbit/orbit.h>

#include "account.h"
#include "account-skelimpl.c"

#include "examples-toolkit.h" /* provides etk_abort_if_exception */ 

static CORBA_ORB          global_orb = CORBA_OBJECT_NIL; /* global orb */
static PortableServer_POA root_poa   = CORBA_OBJECT_NIL; /* root POA
	
/* Is called in case of process signals. it invokes CORBA_ORB_shutdown()
 * function, which will terminate the processes main loop.
 */
static
void
server_shutdown (int sig)
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
 * echo_server_shutdown function in case of SIGINT and SIGTERM
 * signals.  If error occures @ev points to exception object on
 * return.
 */static 
void 
server_init (int                 *argc_ptr, 
	     char                *argv[],
	     CORBA_ORB           *orb,
	     PortableServer_POA  *poa,
	     CORBA_Environment   *ev)
{
	PortableServer_POAManager  poa_manager = CORBA_OBJECT_NIL; 

	CORBA_Environment  local_ev[1];
	CORBA_exception_init(local_ev);

	/* init signal handling */
	signal(SIGINT,  server_shutdown);
	signal(SIGTERM, server_shutdown);
	
	/* create Object Request Broker (ORB) */
	
        (*orb) = CORBA_ORB_init(argc_ptr, argv, "orbit-local-mt-orb", ev);
	if (etk_raised_exception(ev)) 
		goto failed_orb;

        (*poa) = (PortableServer_POA) 
		CORBA_ORB_resolve_initial_references(*orb, "RootPOA", ev);
	if (etk_raised_exception(ev)) 
		goto failed_poa;

        poa_manager = PortableServer_POA__get_the_POAManager(*poa, ev);
	if (etk_raised_exception(ev)) 
		goto failed_poamanager;

	PortableServer_POAManager_activate(poa_manager, ev);
	if (etk_raised_exception(ev)) 
		goto failed_activation;

        CORBA_Object_release ((CORBA_Object) poa_manager, ev);
	return;

 failed_activation:
 failed_poamanager:
        CORBA_Object_release ((CORBA_Object) poa_manager, local_ev);
 failed_poa:
	CORBA_ORB_destroy(*orb, local_ev);		
 failed_orb:
	return;
}

/* Entering main loop @orb handles incoming request and delegates to
 * servants. If error occures @ev points to exception object on
 * return.
 */
static void 
server_run (CORBA_ORB          orb,
	    CORBA_Environment *ev)
{
        /* enter main loop until SIGINT or SIGTERM */
	
        CORBA_ORB_run(orb, ev);
	if (etk_raised_exception(ev)) return;

        /* user pressed SIGINT or SIGTERM and in signal handler
	 * CORBA_ORB_shutdown(.) has been called */
}

/* Releases @servant object and finally destroys @orb. If error
 * occures @ev points to exception object on return.
 */
static void 
server_cleanup (CORBA_ORB           orb,
		PortableServer_POA  poa,
		CORBA_Object        ref,
		CORBA_Environment  *ev)
{
	PortableServer_ObjectId   *objid       = NULL;

	objid = PortableServer_POA_reference_to_id (poa, ref, ev);
	if (etk_raised_exception(ev)) return;
		
	/* Servant: deactivatoin - will invoke  __fini destructor */
	PortableServer_POA_deactivate_object (poa, objid, ev);
	if (etk_raised_exception(ev)) return;

	PortableServer_POA_destroy (poa, TRUE, FALSE, ev);
	if (etk_raised_exception(ev)) return;

	CORBA_free (objid);

        CORBA_Object_release ((CORBA_Object) poa, ev);
	if (etk_raised_exception(ev)) return;
	
        CORBA_Object_release (ref, ev);
	if (etk_raised_exception(ev)) return;

        /* ORB: tear down the ORB */
        if (orb != CORBA_OBJECT_NIL)
        {
                /* going to destroy orb.. */
                CORBA_ORB_destroy(orb, ev);
		if (etk_raised_exception(ev)) return;
        }
}

/* Creates servant and registers in context of ORB @orb. The ORB will
 * delegate incoming requests to specific servant object.  @return
 * object reference. If error occures @ev points to exception object
 * on return.
 */
static CORBA_Object
server_activate_service (CORBA_ORB           orb,
			 PortableServer_POA  poa,
			 CORBA_Environment  *ev)
{
	Account ref = CORBA_OBJECT_NIL; 

	ref = impl_Account__create (poa, ev);
	if (etk_raised_exception(ev)) 
		return CORBA_OBJECT_NIL;
	
	return ref;
}

/* 
 * main 
 */

int
main (int argc, char *argv[])
{
	CORBA_Object servant = CORBA_OBJECT_NIL;
	
	CORBA_char filename[] = "account.ref";

	CORBA_Environment  ev[1];
	CORBA_exception_init(ev);
	
	server_init (&argc, argv, &global_orb, &root_poa, ev);
	etk_abort_if_exception(ev, "failed ORB init");

	servant = server_activate_service (global_orb, root_poa, ev);
	etk_abort_if_exception(ev, "failed activating service");

	g_print ("Writing service reference to: %s\n\n", filename);

	etk_export_object_to_file (global_orb, 
				   servant, 
				   filename, 
				   ev);
	etk_abort_if_exception(ev, "failed exporting IOR");
	
	server_run (global_orb, ev);
	etk_abort_if_exception(ev, "failed entering main loop");

	server_cleanup (global_orb, root_poa, servant, ev);
	etk_abort_if_exception(ev, "failed cleanup");

	exit (0);
}
	


