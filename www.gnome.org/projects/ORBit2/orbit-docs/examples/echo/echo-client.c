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
#include <orbit/orbit.h>

/*
 * This header file was generated from the idl
 */

#include "echo.h"

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
main (int argc, char *argv[])
{
	FILE * ifp;
	char * ior;
	char filebuffer[1024];

	CORBA_Environment ev[1];
	CORBA_ORB orb;            /* ORB */
	Echo echo_client;         /* the service */

	/*
	 * Standard initalisation of the orb. Notice that
	 * ORB_init 'eats' stuff off the command line
	 */

	CORBA_exception_init(ev);
	orb = CORBA_ORB_init(&argc, argv, "orbit-local-orb", ev);
	abort_if_exception(ev, "init ORB failed");

	/*
	 * Get the IOR (object reference). It should be written out
	 * by the echo-server into the file echo.ior. So - if you
	 * are running the server in the same place as the client,
	 * this should be fine!
	 */

	ifp = fopen("echo.ior","r");
	if( ifp == NULL ) {
		g_error("can not open \"echo.ior\"");
		abort ();
	}

	fgets(filebuffer,1023,ifp);
	ior = g_strdup(filebuffer);

	fclose(ifp);

	/*
	 * Actually get the object. So easy!
	 */

	echo_client = CORBA_ORB_string_to_object(orb, ior, ev);
	abort_if_exception(ev, "bind failed");

	/*
	 * Ok. Now we use the echo object...
	 */

	g_print("Type messages to the server\n"
		"a single dot in line will terminate input\n");

	while( fgets(filebuffer,1024,stdin) ) {
		if( filebuffer[0] == '.' && filebuffer[1] == '\n' ) 
			break;

		/* chop the newline off */
		filebuffer[strlen(filebuffer)-1] = '\0';
      
		/* using the echoString method in the Echo object 
		 * this is defined in the echo.h header, compiled from
		 * echo.idl */

		Echo_echoString(echo_client,filebuffer,ev);
		abort_if_exception(ev, "service not reachable");
	}
      
	/* Clean up */
	CORBA_Object_release(echo_client, ev);
	abort_if_exception(ev, "releasing service failed");

	CORBA_ORB_destroy (orb, ev);
	abort_if_exception(ev, "cleanup failed");
    
	/* successfull termination */
	exit (0);
}
