/* account-client.c hacked by Frank Rehberger
 * <F.Rehberger@xtradyne.de>.  */

#include <assert.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <orbit/orbit.h>

#include "badcall.h"

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
                CORBA_Object              servant,
                CORBA_Environment        *ev)
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
                                 CORBA_char        *filename,
                                 CORBA_Environment *ev)
{
        CORBA_Object  obj    = NULL;
        FILE         *file   = NULL;
  
        /* write objref to file */
          
        if ((file=fopen(filename, "r"))==NULL)
                g_error ("could not open %s\n", filename);
     
        obj= client_import_service_from_stream (orb, file, ev);
         
        fclose (file);
 
        return obj;
}
 


/**
 *
 */
static
void
client_run (Examples_BadCall          servant,
	    CORBA_Environment        *ev)
{
	CORBA_long N=getenv("BADCALL_N")!=NULL?atoi(getenv("BADCALL_N")):1000;
	CORBA_long i=0;

	/* increment sequence length, beginning with 0 up to 2048 */
	for (i=0; i<N; ++i)
	{
		Examples_BadCall_Foo *out_arg=NULL;
		Examples_BadCall_Foo  ret_val;
		CORBA_long in_arg=i;
		
		ret_val = Examples_BadCall_trigger (servant, 
						    in_arg, 
						    out_arg,
						    ev); 
		
		switch(ev->_major) {
		case CORBA_NO_EXCEPTION:/* successful outcome*/
			/* process out and inout arguments */

			break;

		case CORBA_USER_EXCEPTION:/* a user-defined exception */
			if (strcmp(ex_Examples_BadCall_NoParam,
				   CORBA_exception_id(ev)) == 0) {
				
				/* NoParam exception  does not own members */ 
				Examples_BadCall_NoParam *bc 
					= (Examples_BadCall_NoParam*)CORBA_exception_value(ev);
				g_assert (bc==NULL);  
 				g_print ("BadCall::trigger raised exception: %s\n",  
 					 CORBA_exception_id(ev));
			}
			else if (strcmp(ex_Examples_BadCall_SingleParam,
				   CORBA_exception_id(ev)) == 0) {
				Examples_BadCall_SingleParam *bc 
					= (Examples_BadCall_SingleParam*)CORBA_exception_value(ev);
				g_assert (bc!=NULL);
				g_print ("BadCall::trigger raised exception: %s\n"
					 " message: %s\n",  
					 CORBA_exception_id(ev),
					 bc->mesg);
			}
			else if (strcmp(ex_Examples_BadCall_DoubleParam,
				   CORBA_exception_id(ev)) == 0) {
				Examples_BadCall_DoubleParam *bc 
					= (Examples_BadCall_DoubleParam*)CORBA_exception_value(ev);
				g_assert (bc!=NULL);
				g_print ("BadCall::trigger raised exception: %s\n"
					 " message: %s\n"
					 " code: %d\n",  
					 CORBA_exception_id(ev),
					 bc->mesg,
					 bc->val);
			}
			else {       /* should never get here ... */
				g_print ("unknown user-defined exception -%s\n",
					 CORBA_exception_id(ev));
			}
			break;
		default: /* standard exception */
			/*
			 * CORBA_exception_id() can be used to determine
			 * which particular standard exception was
			 * raised; the minor member of the struct
			 * associated with the exception (as yielded by
			 * CORBA_exception_value()) may provide additional
			 * system-specific information about the exception
			 */
			g_print ("BadCall::trigger raised system exception: %s\n",  
				 CORBA_exception_id(ev));

			break;
		}
		/* free any storage associated with exception */
		CORBA_exception_free(ev);

		CORBA_free (out_arg); /* free Foo data */
/* 		CORBA_free (ret_val); /\* free Foo data *\/ */
	}
}


/*
 * main 
 */
int
main(int argc, char* argv[])
{
	CORBA_char filename[] = "badcall.ior";

        Examples_BadCall  servant = CORBA_OBJECT_NIL;

        CORBA_Environment ev[1];
        CORBA_exception_init(ev);

	client_init (&argc, argv, &global_orb, ev);
	abort_if_exception(ev, "init failed");

	g_print ("Reading service reference from file \"%s\"\n", filename);

	servant = client_import_service_from_file (global_orb,
						   filename,
						   ev);
        abort_if_exception(ev, "exporting IOR failed");

	client_run (servant, ev);
        abort_if_exception(ev, "client stopped");
 
	client_cleanup (global_orb, servant, ev);
        abort_if_exception(ev, "cleanup failed");
 
        exit (0);
}


