#include "account.h"

/*** App-specific servant structures ***/

typedef struct
{
   POA_Account servant;
   PortableServer_POA poa;

   /* ------ add private attributes here ------ */
   CORBA_long attr_balance;
   /* ------ ---------- end ------------ ------ */
}
impl_POA_Account;

/*** Implementation stub prototypes ***/

static void impl_Account__destroy(impl_POA_Account * servant,
				  CORBA_Environment * ev);
static void
impl_Account_deposit(impl_POA_Account * servant,
		     const CORBA_unsigned_long amount,
		     CORBA_Environment * ev);

static void
impl_Account_withdraw(impl_POA_Account * servant,
		      const CORBA_unsigned_long amount,
		      CORBA_Environment * ev);

static CORBA_long
impl_Account__get_balance(impl_POA_Account * servant, CORBA_Environment * ev);

/*** epv structures ***/

static PortableServer_ServantBase__epv impl_Account_base_epv = {
   NULL,			/* _private data */
   (gpointer) & impl_Account__destroy,	/* finalize routine */
   NULL,			/* default_POA routine */
};
static POA_Account__epv impl_Account_epv = {
   NULL,			/* _private */
   (gpointer) & impl_Account_deposit,

   (gpointer) & impl_Account_withdraw,

   (gpointer) & impl_Account__get_balance,

};

/*** vepv structures ***/

static POA_Account__vepv impl_Account_vepv = {
   &impl_Account_base_epv,
   &impl_Account_epv,
};

/*** Stub implementations ***/

static Account
impl_Account__create(PortableServer_POA poa, CORBA_Environment * ev)
{
   Account retval;
   impl_POA_Account *newservant;
   PortableServer_ObjectId *objid;

   newservant = g_new0(impl_POA_Account, 1);
   newservant->servant.vepv = &impl_Account_vepv;
   newservant->poa =       
      (PortableServer_POA) CORBA_Object_duplicate((CORBA_Object) poa, ev);
   POA_Account__init((PortableServer_Servant) newservant, ev);
   /* Before servant is going to be activated all
    * private attributes must be initialized.  */

   /* ------ init private attributes here ------ */
   newservant->attr_balance = 0;
   /* ------ ---------- end ------------- ------ */

   objid = PortableServer_POA_activate_object(poa, newservant, ev);
   CORBA_free(objid);
   retval = PortableServer_POA_servant_to_reference(poa, newservant, ev);

   return retval;
}

static void
impl_Account__destroy(impl_POA_Account * servant, CORBA_Environment * ev)
{
   CORBA_Object_release((CORBA_Object) servant->poa, ev);
 
   /* No further remote method calls are delegated to 
    * servant and you may free your private attributes. */
   /* ------ free private attributes here ------ */
   /* ------ ---------- end ------------- ------ */

   POA_Account__fini((PortableServer_Servant) servant, ev);
}

static void
impl_Account_deposit(impl_POA_Account * servant,
		     const CORBA_unsigned_long amount, CORBA_Environment * ev)
{
   /* ------   insert method code here   ------ */
   servant->attr_balance += amount;
   /* ------ ---------- end ------------ ------ */
}

static void
impl_Account_withdraw(impl_POA_Account * servant,
		      const CORBA_unsigned_long amount,
		      CORBA_Environment * ev)
{
   /* ------   insert method code here   ------ */
   servant->attr_balance -= amount;
   /* ------ ---------- end ------------ ------ */
}

static CORBA_long
impl_Account__get_balance(impl_POA_Account * servant, CORBA_Environment * ev)
{
   CORBA_long retval;

   /* ------   insert method code here   ------ */
   retval = servant->attr_balance;
   /* ------ ---------- end ------------ ------ */

   return retval;
}
