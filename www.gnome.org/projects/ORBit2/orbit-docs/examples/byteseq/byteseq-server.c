/*
 * echo-server program. Hacked from Echo test suite by by Frank
 * Rehberger <F.Rehberger@xtradyne.de>
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <orbit/orbit.h>

#include "byteseq.h"
#include "byteseq-skelimpl.c" 

#include "examples-toolkit.h" /* ie. etk_etk_abort_if_exception() */

static CORBA_ORB  global_orb = CORBA_OBJECT_NIL; /* global orb */
	
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
server_init (int               *argc_ptr, 
	     char              *argv[],
	     CORBA_ORB         *orb,
	     CORBA_Environment *ev)
{
	/* init signal handling */

	signal(SIGINT,  server_shutdown);
	signal(SIGTERM, server_shutdown);
	
	/* create Object Request Broker (ORB) */
	
        (*orb) = CORBA_ORB_init(argc_ptr, argv, "orbit-local-orb", ev);
	if (etk_raised_exception(ev)) return;
}

/* Creates servant and registers in context of ORB @orb. The ORB will
 * delegate incoming requests to specific servant object.  @return
 * object reference. If error occures @ev points to exception object
 * on return.
 */
static 
Examples_ByteSeq_Storage
server_activate_service (CORBA_ORB         orb,
			 CORBA_Environment *ev)
{
	Examples_ByteSeq_Storage   servant     = CORBA_OBJECT_NIL; 
	PortableServer_POA         poa         = CORBA_OBJECT_NIL; 
	PortableServer_POAManager  poa_manager = CORBA_OBJECT_NIL; 

        /* get Portable Object Adaptor (POA) */

        poa = 
	 (PortableServer_POA) CORBA_ORB_resolve_initial_references(orb,
								   "RootPOA",
								   ev);
	if (etk_raised_exception(ev)) return CORBA_OBJECT_NIL;

       /* create servant in context of poa container */

	servant = impl_Examples_ByteSeq_Storage__create (poa, ev);
	if (etk_raised_exception(ev)) return CORBA_OBJECT_NIL;
	
        /* activate POA Manager */

        poa_manager = PortableServer_POA__get_the_POAManager(poa, ev);
	if (etk_raised_exception(ev)) return CORBA_OBJECT_NIL;

	PortableServer_POAManager_activate(poa_manager, ev);
	if (etk_raised_exception(ev)) return CORBA_OBJECT_NIL;

	return servant;
}

/* Entering main loop @orb handles incoming request and delegates to
 * servants. If error occures @ev points to exception object on
 * return.
 */
static 
void 
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
static 
void 
server_cleanup (CORBA_ORB                 orb,
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

/* 
 * main 
 */

int
main (int argc, char *argv[])
{
	CORBA_char filename[] = "byteseq.ior";

	Examples_ByteSeq_Storage servant = CORBA_OBJECT_NIL;

	CORBA_Environment  ev[1];
	CORBA_exception_init(ev);
	
	server_init (&argc, argv, &global_orb, ev);
	etk_abort_if_exception(ev, "init failed");

	servant = server_activate_service (global_orb, ev);
	etk_abort_if_exception(ev, "activating service failed");

	g_print ("Writing service reference to: %s\n\n", filename);

	etk_export_object_to_file (global_orb, 
				   servant, 
				   filename, 
				   ev);
	etk_abort_if_exception(ev, "exporting IOR failed");
	
	server_run (global_orb, ev);
	etk_abort_if_exception(ev, "entering main loop failed");

	server_cleanup (global_orb, servant, ev);
	etk_abort_if_exception(ev, "cleanup failed");

	exit (0);
}
	

