/*
 * calculator-server program. Hacked from Frank Rehberger
 * <F.Rehberger@xtradyne.de>.
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <orbit/orbit.h>

#include "calculator.h"
#include "calculator-skelimpl.c"

#include "examples-toolkit.h"

static CORBA_ORB          global_orb  = CORBA_OBJECT_NIL; /* global orb */
static PortableServer_POA default_poa = CORBA_OBJECT_NIL; /* default POA */
	
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

/**

 */
PortableServer_POA
server_create_multi_threaded_poa (CORBA_ORB                  orb, 
				  PortableServer_POA         poa,
				  PortableServer_POAManager  poa_mgr,
				  CORBA_Environment         *ev)
{
	const static        MAX_POLICIES  = 1;
	PortableServer_POA  child_poa     = CORBA_OBJECT_NIL;
	CORBA_PolicyList   *poa_policies;

	poa_policies           = CORBA_PolicyList__alloc ();
        poa_policies->_maximum = MAX_POLICIES;
        poa_policies->_length  = MAX_POLICIES;
        poa_policies->_buffer  = CORBA_PolicyList_allocbuf (MAX_POLICIES);
        CORBA_sequence_set_release (poa_policies, CORBA_TRUE);
                                                                                
        poa_policies->_buffer[0] = (CORBA_Policy)
		PortableServer_POA_create_thread_policy (
			poa,
			PortableServer_ORB_CTRL_MODEL,
			ev);

	child_poa = PortableServer_POA_create_POA (poa,
                                                   "Thread Per Request POA",
                                                   poa_mgr,
                                                   poa_policies,
                                                   ev);
	if (etk_raised_exception(ev)) 
		goto failed_create_poa;

	ORBit_ObjectAdaptor_set_thread_hint ((ORBit_ObjectAdaptor) child_poa, 
					     ORBIT_THREAD_HINT_PER_REQUEST);

	
        CORBA_Policy_destroy (poa_policies->_buffer[0], ev); 
	if (etk_raised_exception(ev)) 
		goto failed;
        CORBA_free (poa_policies);	
	
	return child_poa;
	
 failed_create_poa:
	/* FIXME, in case of error, ev is set, but destructor should not
	 * return except anyway */
        CORBA_Policy_destroy (poa_policies->_buffer[0], ev); 
        CORBA_free (poa_policies);	
 failed:
	return CORBA_OBJECT_NIL;
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
	PortableServer_POA         rootpoa     = CORBA_OBJECT_NIL;
	PortableServer_POAManager  rootpoa_mgr = CORBA_OBJECT_NIL; 

	CORBA_Environment  local_ev[1];
	CORBA_exception_init(local_ev);

	/* init signal handling */
	signal(SIGTERM, server_shutdown);
	
	/* create Object Request Broker (ORB) */
	
        (*orb) = CORBA_ORB_init(argc_ptr, argv, "orbit-local-mt-orb", ev);
	if (etk_raised_exception(ev)) 
		goto failed_orb;

        rootpoa = (PortableServer_POA) 
		CORBA_ORB_resolve_initial_references(*orb, "RootPOA", ev);
	if (etk_raised_exception(ev)) 
		goto failed_poa;
	
        rootpoa_mgr = PortableServer_POA__get_the_POAManager(rootpoa, ev);
	if (etk_raised_exception(ev)) 
		goto failed_poamanager;

	/* create default POA with specific policies */

	(*poa) = server_create_multi_threaded_poa (*orb, 
						   rootpoa, 
						   rootpoa_mgr, 
						   ev);
	if (etk_raised_exception(ev)) 
		goto failed_child_poa;

	PortableServer_POAManager_activate(rootpoa_mgr, ev);
	if (etk_raised_exception(ev)) 
		goto failed_activation;

        CORBA_Object_release ((CORBA_Object) rootpoa_mgr, ev);
	return;

 failed_activation:
 failed_child_poa:
 failed_poamanager:
        CORBA_Object_release ((CORBA_Object) rootpoa_mgr, local_ev);
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
	Calculator  ref = CORBA_OBJECT_NIL; 

	ref = impl_Calculator__create (poa, ev);
	if (etk_raised_exception(ev)) 
		return CORBA_OBJECT_NIL;
	
	return ref;
}

/* 
 * background task 
 */
typedef struct {
	int    argc;
	char **argv;
} BackgroundData;

static gpointer
server_in_background (BackgroundData *data)
{
	int    argc = data->argc;
	char **argv = data->argv;

	CORBA_Object servant = CORBA_OBJECT_NIL;
	
	CORBA_char filename[] = "calculator.ref";

	CORBA_Environment  ev[1];
	CORBA_exception_init(ev);
	
	server_init (&argc, argv, &global_orb, &default_poa, ev);
	etk_abort_if_exception(ev, "failed ORB init");

	servant = server_activate_service (global_orb, default_poa, ev);
	etk_abort_if_exception(ev, "failed activating service");

	g_print ("Writing service reference to: %s\n\n", filename);

	etk_export_object_to_file (global_orb, 
				   servant, 
				   filename, 
				   ev);
	etk_abort_if_exception(ev, "failed exporting IOR");
	
	server_run (global_orb, ev);
	etk_abort_if_exception(ev, "failed entering main loop");

	server_cleanup (global_orb, default_poa, servant, ev);
	etk_abort_if_exception(ev, "failed cleanup");

	g_thread_exit (NULL);
}

static
void
main_shutdown (int sig)
{
	/* progate SIGTERM signal to every process/thread in process
	 * group */ 
	kill (0, 15);
	
	/* terminate main thread */ 
	exit (0);
}

/* 
 * main 
 */
int 
main (int argc, char *argv[])
{
	BackgroundData data[1];
	gint     i      = 0;
	GError  *err    = NULL;
	GThread *thread = NULL;

	g_thread_init (NULL);

	data->argc = argc;
	data->argv = argv;

	thread = g_thread_create ((GThreadFunc) server_in_background, 
				  data, 
				  TRUE,   /*joinable */
				  &err);

	/* init signal handling */
	signal(SIGINT,  main_shutdown);
	signal(SIGHUP,  main_shutdown);
	
	/* concurrent main task */ 
	while (i++ < 1000) {
		g_print ("main thread active\n");
		sleep (1);
	}
	
	g_print ("main thread waiting for background task\n");
	g_thread_join (thread);
	
	exit (0);	
}
