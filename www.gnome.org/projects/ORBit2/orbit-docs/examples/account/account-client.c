/* account-client.c hacked by Frank Rehberger
 * <F.Rehberger@xtradyne.de>.  */

#include <assert.h>
#include <stdio.h>
#include <orbit/orbit.h>

#include "account.h"

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
	char*             ior=NULL;
	CORBA_long        val=0;
        CORBA_long        balance=0;
	
        CORBA_ORB         orb;
        Account           server;

        CORBA_Environment ev[1];
        CORBA_exception_init(ev);

	/* init - ORB might 'eat' arguments from command line */
        orb = CORBA_ORB_init(&argc, argv, "orbit-local-orb", ev);
	abort_if_exception(ev, "init failed");

	/* make sure command lines contains two arguments; IOR and
	 * integer value  */
	if (argc<3)
		g_error ("usage: %s <ior> <int>", argv[0]);
	ior = argv[1];
	val = atoi(argv[2]);

	/* establish servant connection */
        server = (Account) CORBA_ORB_string_to_object(orb, ior, ev);
	abort_if_exception(ev, "bind failed");

	/* 
	 * use calculator server 
	 */ 
	
        balance = Account__get_balance (server, ev);
	abort_if_exception(ev, "service not reachable");
	
	g_print ("balance %5d, ", balance);
	
	if (val > 0)
	{
		Account_deposit (server, val, ev);
		abort_if_exception(ev, "service not reachable");
	}
	else
	{
		Account_withdraw (server, abs(val), ev);
		abort_if_exception(ev, "service not reachable");
	}
	
        balance = Account__get_balance (server, ev);
	abort_if_exception(ev, "service not reachable");
	
	g_print ("new balance %5d\n", balance);
	
	/* tear down object reference and ORB */
        CORBA_Object_release(server,ev);
	abort_if_exception(ev, "releasing service failed");

	CORBA_ORB_destroy (orb, ev);
	abort_if_exception(ev, "cleanup failed");

	/* successfull termination */
	exit(0);
}

