/*
 * echo-server program. Hacked from Echo test suite by
 * <birney@sanger.ac.uk>, ORBit2 udpate by Frank Rehberger
 * <F.Rehberger@xtradyne.de>
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <orbit/orbit.h>

#include "echo.h"
#include "echo-skelimpl.c" 

/** 
 * test for exception */
static
gboolean 
raised_exception(CORBA_Environment *ev) {
	return ((ev)->_major != CORBA_NO_EXCEPTION);
}

/**
 * in case of any exception this macro will abort the process  */
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
echo_server_shutdown (int sig)
{
	CORBA_Environment  local_ev[1];
	CORBA_exception_init(local_ev);

        if (global_orb != CORBA_OBJECT_NIL)
        {
                CORBA_ORB_shutdown (global_orb, FALSE, local_ev);
                abort_if_exception (local_ev, "caught exception");

                global_orb=CORBA_OBJECT_NIL;
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
echo_server_init (int               *argc_ptr, 
		  char              *argv[],
		  CORBA_ORB         *orb,
		  CORBA_Environment *ev)
{
	/* init signal handling */

	signal(SIGINT,  echo_server_shutdown);
	signal(SIGTERM, echo_server_shutdown);
	
	/* create Object Request Broker (ORB) */
	
        (*orb) = CORBA_ORB_init(argc_ptr, argv, "orbit-local-orb", ev);
	if (raised_exception(ev)) return;
}

/* Creates servant and registers in context of ORB @orb. The ORB will
 * delegate incoming requests to specific servant object.  @return
 * object reference. If error occures @ev points to exception object
 * on return.
 */
static 
Echo
echo_server_activate_service (CORBA_ORB         orb,
			      CORBA_Environment *ev)
{
	Echo                       servant     = CORBA_OBJECT_NIL; 
	PortableServer_POA         poa         = CORBA_OBJECT_NIL; 
	PortableServer_POAManager  poa_manager = CORBA_OBJECT_NIL; 

        /* get Portable Object Adaptor (POA) */

        poa = 
	 (PortableServer_POA) CORBA_ORB_resolve_initial_references(orb,
								   "RootPOA",
								   ev);
	if (raised_exception(ev)) return CORBA_OBJECT_NIL;

       /* create servant in context of poa container */

	servant = impl_Echo__create (poa, ev);
	if (raised_exception(ev)) return CORBA_OBJECT_NIL;
	
        /* activate POA Manager */

        poa_manager = PortableServer_POA__get_the_POAManager(poa, ev);
	if (raised_exception(ev)) return CORBA_OBJECT_NIL;

	PortableServer_POAManager_activate(poa_manager, ev);
	if (raised_exception(ev)) return CORBA_OBJECT_NIL;

	return servant;
}

/* Writes stringified object reference of @servant to file
 * @filename. If error occures @ev points to exception object on
 * return.
 */
static 
void 
echo_server_export_service_to_file (CORBA_ORB          orb,
				    Echo               servant,
				    char              *filename, 
				    CORBA_Environment *ev)
{
        CORBA_char *objref = NULL;
	FILE       *file   = NULL;

	/* write objref to file */
	
        objref = CORBA_ORB_object_to_string (orb, servant, ev);
	if (raised_exception(ev)) return;

	if ((file=fopen(filename, "w"))==NULL) 
		g_error ("could not open %s\n", filename);
	
        /* print ior to terminal */
	fprintf (file, "%s\n", objref);
	fflush (file);
	fclose (file);
	
        CORBA_free (objref);
}

/* Entering main loop @orb handles incoming request and delegates to
 * servants. If error occures @ev points to exception object on
 * return.
 */
static 
void 
echo_server_run (CORBA_ORB          orb,
		 CORBA_Environment *ev)
{
        /* enter main loop until SIGINT or SIGTERM */
	
        CORBA_ORB_run(orb, ev);
	if (raised_exception(ev)) return;

        /* user pressed SIGINT or SIGTERM and in signal handler
	 * CORBA_ORB_shutdown(.) has been called */
}

/* Releases @servant object and finally destroys @orb. If error
 * occures @ev points to exception object on return.
 */
static 
void echo_server_cleanup (CORBA_ORB          orb,
			   Echo               servant,
			   CORBA_Environment *ev)
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

/* 
 * main 
 */

int
main (int argc, char *argv[])
{
	Echo servant = CORBA_OBJECT_NIL;

	CORBA_Environment  ev[1];
	CORBA_exception_init(ev);
	
	echo_server_init (&argc, argv, &global_orb, ev);
	abort_if_exception(ev, "init failed");

	servant = echo_server_activate_service (global_orb, ev);
	abort_if_exception(ev, "activating service failed");

	echo_server_export_service_to_file (global_orb, 
					    servant, 
					    "echo.ior", 
					    ev);
	abort_if_exception(ev, "exporting IOR failed");
	
	echo_server_run (global_orb, ev);
	abort_if_exception(ev, "entering main loop failed");

	echo_server_cleanup (global_orb, servant, ev);
	abort_if_exception(ev, "cleanup failed");

	exit (0);
}
	

