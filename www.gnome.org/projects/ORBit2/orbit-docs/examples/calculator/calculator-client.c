/* calculator-client.c hacked by Frank Rehberger
 * <F.Rehberger@xtradyne.de>.  */

#include <assert.h>
#include <stdio.h>
#include <orbit/orbit.h>

#include "calculator.h"

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

/*
 * main 
 */
int
main(int argc, char* argv[])
{
	char*             ior;

        CORBA_ORB         orb;
        CORBA_Object      server;

        CORBA_double      result=0.0;
	
        CORBA_Environment ev[1];
        CORBA_exception_init(ev);

	/* init - ORB might 'eat' arguments from command line */
        orb = CORBA_ORB_init(&argc, argv, "orbit-local-orb", ev);
	abort_if_exception(ev, "init ORB failed");

	/* make sure servant's IOR is given as command argument */
	if (argc<2)
		g_error ("usage: %s <ior>", argv[0]);
	ior=argv[1];
	
	/* establish servant connection */
        server = CORBA_ORB_string_to_object(orb, ior, ev);
	abort_if_exception(ev, "bind failed");

	/* 
	 * use calculator server 
	 */ 
        result = Calculator_add(server, 1.0, 2.0, ev);
	abort_if_exception(ev, "service not reachable");

	/* prints results to console */
        g_print("Result: 1.0 + 2.0 = %2.0f\n", result);

	/* tear down object reference and ORB */
        CORBA_Object_release(server,ev);
	abort_if_exception(ev, "releasing service failed");

	CORBA_ORB_destroy (orb, ev);
	abort_if_exception(ev, "cleanup failed");

	/* successfull termination */
	exit(0);
}
