/* account-client.c hacked by Frank Rehberger
 * <F.Rehberger@xtradyne.de>.  */

#include <assert.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <orbit/orbit.h>

#include "badcall.h"

#include "examples-toolkit.h" /* ie. etk_abort_if_exception() */

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


static 
void
client_trigger_exception (Examples_BadCall          servant,
			  CORBA_long                arg,
			  CORBA_Environment        *ev)
{
	CORBA_long            in_arg  = arg;	
	Examples_BadCall_Foo *out_arg = NULL;

	Examples_BadCall_Foo  ret_val;
	
	ret_val = Examples_BadCall_trigger (servant, 
					    in_arg, 
					    out_arg,
					    ev); 
	
	switch(etk_exception_type(ev)) {
	case CORBA_NO_EXCEPTION:/* successful outcome*/
		
		/* now use data the server delivered to client
		 * over the return-value, or those out- and
		 * inout-parameters */
		
		break;
		
	case CORBA_USER_EXCEPTION:/* a user-defined exception */
		if (etk_raised_exception_is_a (ev, 
					       ex_Examples_BadCall_NoParam)) 
		{
			/* NoParam exception  does not own members */ 
			Examples_BadCall_NoParam *bc 
				= (Examples_BadCall_NoParam*)CORBA_exception_value(ev);
			g_warning ("raised exception: %s\n",  
				   CORBA_exception_id(ev));
		} 
		else if (etk_raised_exception_is_a (ev,
						    ex_Examples_BadCall_SingleParam)) 
		{
			Examples_BadCall_SingleParam *bc 
				= (Examples_BadCall_SingleParam*)
				CORBA_exception_value(ev);
			
			g_warning ("raised exception: %s\n"
				   " mesg: %s\n",  
				   CORBA_exception_id(ev),
				   bc->mesg);

		} else if (etk_raised_exception_is_a 
			   (ev, ex_Examples_BadCall_DoubleParam)) 
		{
			Examples_BadCall_DoubleParam *bc 
				= (Examples_BadCall_DoubleParam*)
				CORBA_exception_value(ev);
			
			g_warning ("raised exception: %s\n"
				   " mesg: %s\n"
				   " val: %d\n",  
				   CORBA_exception_id(ev),
				   bc->mesg,
				   bc->val);
		}
		else 
		{       
			/* should never get here ... */
			g_print ("unexpected CORBA_USER_EXCEPTION -%s\n",
				 CORBA_exception_id(ev));
		}
		break;
		
	case CORBA_SYSTEM_EXCEPTION:
	default: /* standard exception */
		/*
		 * CORBA_exception_id() can be used to determine which
		 * particular standard exception was raised; the minor
		 * member of the struct associated with the exception
		 * (as yielded by CORBA_exception_value()) may provide
		 * additional system-specific information about the
		 * exception
		 */
		g_print ("BadCall::trigger raised system exception: %s\n",  
			 CORBA_exception_id(ev));
		
		break;
	}
	
	/* free any storage associated with exception */
	CORBA_exception_free(ev);
	
	CORBA_free (out_arg); /* free Foo data */
	
}

/**
 *
 */
static
void
client_run (Examples_BadCall          servant,
	    CORBA_Environment        *ev)
{
	CORBA_long N=1000;
	CORBA_long i=0;

	/* increment sequence length, beginning with 0 up to 2048 */
	for (i=0; i<N; ++i)
	{
		client_trigger_exception (servant, i, ev);
	}
}


/*
 * main 
 */
int
main(int argc, char* argv[])
{
	CORBA_char filename[] = "badcall.ref";

        Examples_BadCall  servant = CORBA_OBJECT_NIL;

        CORBA_Environment ev[1];
        CORBA_exception_init(ev);

	client_init (&argc, argv, &global_orb, ev);
	etk_abort_if_exception(ev, "init failed");

	g_print ("Reading service reference from file \"%s\"\n", 
		 filename);

	servant = etk_import_object_from_file (global_orb,
					       filename,
					       ev);
        etk_abort_if_exception(ev, "importing IOR failed");

	client_run (servant, ev);
        etk_abort_if_exception(ev, "client stopped");
 
	client_cleanup (global_orb, servant, ev);
        etk_abort_if_exception(ev, "cleanup failed");
 
        exit (0);
}


