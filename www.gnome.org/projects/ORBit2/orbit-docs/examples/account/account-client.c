/* account-client.c hacked by Frank Rehberger
 * <F.Rehberger@xtradyne.de>.  */

#include <assert.h>
#include <signal.h>
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
                abort_if_exception (local_ev, "caught exception");
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
        if (raised_exception(ev)) return;
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
        if (raised_exception(ev)) return;
 
        /* tear down the ORB */
        if (orb != CORBA_OBJECT_NIL)
        {
                /* going to destroy orb.. */
                CORBA_ORB_destroy(orb, ev);
                if (raised_exception(ev)) return;
        }
}

/**
 *
 */
static
CORBA_Object
client_import_service_from_stream (CORBA_ORB          orb,
				   FILE              *stream,
				   CORBA_Environment *ev)
{
	CORBA_Object obj = CORBA_OBJECT_NIL;
	gchar *objref=NULL;
    
	fscanf (stream, "%as", &objref);  /* FIXME, handle input error */ 
	
	obj = (CORBA_Object) CORBA_ORB_string_to_object (global_orb,
							 objref, 
							 ev);
	free (objref);
	
	return obj;
}


/**
 *
 */
static
CORBA_Object
client_import_service_from_file (CORBA_ORB          orb,
				 char              *filename,
				 CORBA_Environment *ev)
{
        CORBA_Object  obj    = NULL;
        FILE         *file   = NULL;
 
        /* write objref to file */
         
        if ((file=fopen(filename, "r"))==NULL)
                g_error ("could not open %s\n", filename);
    
	obj=client_import_service_from_stream (orb, file, ev);
	
	fclose (file);

	return obj;
}


/**
 *
 */
static
void
client_run (Account            service,
	    CORBA_long         amount,
	    CORBA_Environment *ev)
{
	CORBA_long balance=0;

	/*
         * use calculator server
         */
         
        balance = Account__get_balance (service, ev);
	if (raised_exception (ev)) return;
         
        g_print ("balance %5d, ", balance);
         
        if (amount > 0)
        {
                Account_deposit (service, amount, ev);
                if (raised_exception (ev)) return;
        }
        else
        {
                Account_withdraw (service, abs(amount), ev);
                if (raised_exception (ev)) return;
        }
                                                                               
        balance = Account__get_balance (service, ev);
	if (raised_exception (ev)) return;
                                                                               
        g_print ("new balance %5d\n", balance);
}

/*
 * main 
 */
int
main(int argc, char* argv[])
         
{
        CORBA_char        filename[] = "account.ior";
        CORBA_long        amount=0;

	Account service = CORBA_OBJECT_NIL;

        CORBA_Environment ev[1];
        CORBA_exception_init(ev);

	client_init (&argc, argv, &global_orb, ev);
	abort_if_exception(ev, "init failed");

        if (argc<2)
                g_error ("usage: %s <amount>", argv[0]);

        amount  = atoi(argv[1]);

	g_print ("Reading service reference from file \"%s\"\n", filename);

	service = (Account) client_import_service_from_file (global_orb,
							     filename,
							     ev);
        abort_if_exception(ev, "import service failed");

	client_run (service, amount, ev);
        abort_if_exception(ev, "service not reachable");
 
	client_cleanup (global_orb, service, ev);
        abort_if_exception(ev, "cleanup failed");
 
        exit (0);
}
