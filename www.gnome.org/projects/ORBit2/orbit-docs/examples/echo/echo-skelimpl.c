#include "echo.h"

/*** App-specific servant structures ***/

typedef struct
{
   POA_Echo servant;
   PortableServer_POA poa;

   /* ------ add private attributes here ------ */
   /* ------ ---------- end ------------ ------ */
}
impl_POA_Echo;

/*** Implementation stub prototypes ***/

static void impl_Echo__destroy(impl_POA_Echo * servant,
			       CORBA_Environment * ev);
static void
impl_Echo_echoString(impl_POA_Echo * servant,
		     const CORBA_char * input, CORBA_Environment * ev);

/*** epv structures ***/

static PortableServer_ServantBase__epv impl_Echo_base_epv = {
   NULL,			/* _private data */
   (gpointer) & impl_Echo__destroy,	/* finalize routine */
   NULL,			/* default_POA routine */
};
static POA_Echo__epv impl_Echo_epv = {
   NULL,			/* _private */
   (gpointer) & impl_Echo_echoString,

};

/*** vepv structures ***/

static POA_Echo__vepv impl_Echo_vepv = {
   &impl_Echo_base_epv,
   &impl_Echo_epv,
};

/*** Stub implementations ***/

static Echo
impl_Echo__create(PortableServer_POA poa, CORBA_Environment * ev)
{
   Echo retval;
   impl_POA_Echo *newservant;
   PortableServer_ObjectId *objid;

   newservant = g_new0(impl_POA_Echo, 1);
   newservant->servant.vepv = &impl_Echo_vepv;
   newservant->poa = poa;
   POA_Echo__init((PortableServer_Servant) newservant, ev);
   /* Before servant is going to be activated all
    * private attributes must be initialized.  */

   /* ------ init private attributes here ------ */
   /* ------ ---------- end ------------- ------ */

   objid = PortableServer_POA_activate_object(poa, newservant, ev);
   CORBA_free(objid);
   retval = PortableServer_POA_servant_to_reference(poa, newservant, ev);

   return retval;
}

static void
impl_Echo__destroy(impl_POA_Echo * servant, CORBA_Environment * ev)
{
   /* No further remote method calls are delegated to 
    * servant and you may free your private attributes. */
   /* ------ free private attributes here ------ */
   /* ------ ---------- end ------------- ------ */

   POA_Echo__fini((PortableServer_Servant) servant, ev);
}

static void
impl_Echo_echoString(impl_POA_Echo * servant,
		     const CORBA_char * input, CORBA_Environment * ev)
{
   /* ------   insert method code here   ------ */
	g_print ("%s\n", input);
   /* ------ ---------- end ------------ ------ */
}
