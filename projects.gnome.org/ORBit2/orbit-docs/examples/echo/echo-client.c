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
#include <signal.h>
#include <orbit/orbit.h>

/*
 * This header file was generated from the idl
 */

#include "echo.h"


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
                CORBA_Object              service,
                CORBA_Environment        *ev)
{
        /* releasing managed object */
        CORBA_Object_release(service, ev);
        if (etk_raised_exception(ev)) return;
 
        /* tear down the ORB */
        if (orb != CORBA_OBJECT_NIL)
        {
                /* going to destroy orb.. */
                CORBA_ORB_destroy(orb, ev);
                if (etk_raised_exception(ev)) return;
        }
}

/**
 *
 */
/* static */
/* CORBA_Object */
/* client_import_service_from_stream (CORBA_ORB          orb, */
/* 				   FILE              *stream, */
/* 				   CORBA_Environment *ev) */
/* { */
/* 	CORBA_Object obj = CORBA_OBJECT_NIL; */
/* 	gchar *objref=NULL; */
    
/* 	fscanf (stream, "%as", &objref);  /\* FIXME, handle input error *\/  */
	
/* 	obj = (CORBA_Object) CORBA_ORB_string_to_object (global_orb, */
/* 							 objref,  */
/* 							 ev); */
/* 	free (objref); */
	
/* 	return obj; */
/* } */

/**
 *
 */
/* static */
/* CORBA_Object */
/* client_import_service_from_file (CORBA_ORB          orb, */
/* 				 char              *filename, */
/* 				 CORBA_Environment *ev) */
/* { */
/*         CORBA_Object  obj    = NULL; */
/*         FILE         *file   = NULL; */
 
/*         /\* write objref to file *\/ */
         
/*         if ((file=fopen(filename, "r"))==NULL) */
/*                 g_error ("could not open %s\n", filename); */
    
/* 	obj=client_import_service_from_stream (orb, file, ev); */
	
/* 	fclose (file); */

/* 	return obj; */
/* } */


/**
 *
 */
static
void
client_run (Echo  echo_service,
	    CORBA_Environment        *ev)
{
	char filebuffer[1024+1];

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

		Echo_echoString(echo_service,filebuffer,ev);
		if (etk_raised_exception (ev)) return;
	}
}

/*
 * main 
 */
int
main(int argc, char* argv[])
{
	CORBA_char filename[] = "echo.ref";
        
	Echo echo_service = CORBA_OBJECT_NIL;

        CORBA_Environment ev[1];
        CORBA_exception_init(ev);

	client_init (&argc, argv, &global_orb, ev);
	etk_abort_if_exception(ev, "init failed");

	g_print ("Reading service reference from file \"%s\"\n", filename);

	echo_service = (Echo) etk_import_object_from_file (global_orb,
							   filename,
							   ev);
        etk_abort_if_exception(ev, "import service failed");

	client_run (echo_service, ev);
        etk_abort_if_exception(ev, "service not reachable");
 
	client_cleanup (global_orb, echo_service, ev);
        etk_abort_if_exception(ev, "cleanup failed");
 
        exit (0);
}
