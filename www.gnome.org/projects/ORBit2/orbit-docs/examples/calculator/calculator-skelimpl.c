#include "calculator.h"

/*** App-specific servant structures ***/

typedef struct
{
   POA_Calculator servant;
   PortableServer_POA poa;

   /* ------ add private attributes here ------ */
   /* ------ ---------- end ------------ ------ */
}
impl_POA_Calculator;

/*** Implementation stub prototypes ***/

static void impl_Calculator__fini (impl_POA_Calculator * servant,
				   CORBA_Environment * ev);
static CORBA_double
impl_Calculator_add(impl_POA_Calculator * servant,
		    const CORBA_double number1,
		    const CORBA_double number2, CORBA_Environment * ev);

static CORBA_double
impl_Calculator_sub(impl_POA_Calculator * servant,
		    const CORBA_double number1,
		    const CORBA_double number2, CORBA_Environment * ev);

/*** epv structures ***/

static PortableServer_ServantBase__epv impl_Calculator_base_epv = {
   NULL,			/* _private data */
   (gpointer) & impl_Calculator__fini,	/* finalize routine */
   NULL,			/* default_POA routine */
};
static POA_Calculator__epv impl_Calculator_epv = {
   NULL,			/* _private */
   (gpointer) & impl_Calculator_add,

   (gpointer) & impl_Calculator_sub,

};

/*** vepv structures ***/

static POA_Calculator__vepv impl_Calculator_vepv = {
   &impl_Calculator_base_epv,
   &impl_Calculator_epv,
};

/*** Stub implementations ***/

static Calculator
impl_Calculator__create (PortableServer_POA poa, CORBA_Environment * ev)
{
   Calculator retval;
   impl_POA_Calculator *newservant;
   PortableServer_ObjectId *objid;

   newservant = g_new0(impl_POA_Calculator, 1);
   newservant->servant.vepv = &impl_Calculator_vepv;
   newservant->poa =       
      (PortableServer_POA) CORBA_Object_duplicate((CORBA_Object) poa, ev);
   POA_Calculator__init((PortableServer_Servant) newservant, ev);
   /* Before servant is going to be activated all
    * private attributes must be initialized.  */

   /* ------ init private attributes here ------ */
   /* ------ ---------- end ------------- ------ */

   objid = PortableServer_POA_activate_object(poa, newservant, ev);
   CORBA_free(objid);
   retval = PortableServer_POA_servant_to_reference(poa, newservant, ev);

   return retval;
}

/**
 * impl_Calculator__fini
 * 
 * Destructor called after servant has been deactivated finally.
 * In case any operation invocation, method invoation is being delayed.
 * Note, in former versions of ORBit2 this function would have been 
 * named impl_Calculator__destroy.
 **/
static void
impl_Calculator__fini (impl_POA_Calculator * servant,
		       CORBA_Environment * ev)
{
   CORBA_Object_release((CORBA_Object) servant->poa, ev);
 
   /* No further remote method calls are delegated to 
    * servant and you may free your private attributes. */
   /* ------ free private attributes here ------ */
   /* ------ ---------- end ------------- ------ */

   POA_Calculator__fini((PortableServer_Servant) servant, ev);
   
   g_free (servant);
}

static CORBA_double
impl_Calculator_add(impl_POA_Calculator * servant,
		    const CORBA_double number1,
		    const CORBA_double number2, CORBA_Environment * ev)
{
   CORBA_double retval;

   /* ------   insert method code here   ------ */
   g_print ("%f + %f\n", number1, number2);
   retval = number1 + number2;
   /* ------ ---------- end ------------ ------ */

   return retval;
}

static CORBA_double
impl_Calculator_sub(impl_POA_Calculator * servant,
		    const CORBA_double number1,
		    const CORBA_double number2, CORBA_Environment * ev)
{
   CORBA_double retval;

   /* ------   insert method code here   ------ */
   g_print ("%f - %f\n", number1, number2);
   retval = number1 - number2;
   /* ------ ---------- end ------------ ------ */

   return retval;
}
