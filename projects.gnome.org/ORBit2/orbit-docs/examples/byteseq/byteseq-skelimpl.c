/* This is a template file generated by command */
/* orbit-idl-2 --skeleton-impl byteseq.idl */
/* User must edit this file, inserting servant  */
/* specific code between markers. */

#include "byteseq.h"

/*** App-specific servant structures ***/

typedef struct
{
   POA_Examples_ByteSeq_Storage servant;
   PortableServer_POA poa;

   /* ------ add private attributes here ------ */  
   Examples_ByteSeq_Chunk * chunk;
   /* ------ ---------- end ------------ ------ */
} impl_POA_Examples_ByteSeq_Storage;

/*** Implementation stub prototypes ***/

static void
impl_Examples_ByteSeq_Storage__fini(impl_POA_Examples_ByteSeq_Storage *
				    servant, CORBA_Environment * ev);
static void
impl_Examples_ByteSeq_Storage_set(impl_POA_Examples_ByteSeq_Storage * servant,
				  const Examples_ByteSeq_Chunk * chunk,
				  CORBA_Environment * ev);

static Examples_ByteSeq_Chunk
   *impl_Examples_ByteSeq_Storage_get(impl_POA_Examples_ByteSeq_Storage *
				      servant, CORBA_Environment * ev);


/*** epv structures ***/

static PortableServer_ServantBase__epv impl_Examples_ByteSeq_Storage_base_epv
   = {
   NULL,			/* _private data */
   (gpointer) & impl_Examples_ByteSeq_Storage__fini,	/* finalize routine */
   NULL,			/* default_POA routine */
};
static POA_Examples_ByteSeq_Storage__epv impl_Examples_ByteSeq_Storage_epv = {
   NULL,			/* _private */
   (gpointer) & impl_Examples_ByteSeq_Storage_set,

   (gpointer) & impl_Examples_ByteSeq_Storage_get
};

/*** vepv structures ***/

static POA_Examples_ByteSeq_Storage__vepv impl_Examples_ByteSeq_Storage_vepv = {
   &impl_Examples_ByteSeq_Storage_base_epv,
   &impl_Examples_ByteSeq_Storage_epv,
};

/*** Stub implementations ***/

static Examples_ByteSeq_Storage
impl_Examples_ByteSeq_Storage__create(PortableServer_POA poa,
				      CORBA_Environment * ev)
{
   Examples_ByteSeq_Storage retval;
   impl_POA_Examples_ByteSeq_Storage *newservant;
   PortableServer_ObjectId *objid;

   newservant = g_new0(impl_POA_Examples_ByteSeq_Storage, 1);
   newservant->servant.vepv = &impl_Examples_ByteSeq_Storage_vepv;
   newservant->poa =
      (PortableServer_POA) CORBA_Object_duplicate((CORBA_Object) poa, ev);

   POA_Examples_ByteSeq_Storage__init((PortableServer_Servant) newservant,
				      ev);
   /* Before servant is going to be activated all
    * private attributes must be initialized.  */

   /* ------ init private attributes here ------ */
   newservant->chunk = ORBit_sequence_alloc (TC_CORBA_sequence_CORBA_octet, 64);   /* ------ ---------- end ------------- ------ */

   objid = PortableServer_POA_activate_object(poa, newservant, ev);
   CORBA_free(objid);
   retval = PortableServer_POA_servant_to_reference(poa, newservant, ev);

   return retval;
}

/**
 * impl_Examples_ByteSeq_Storage__fini
 * 
 * Destructor called after servant has been deactivated finally.
 * In case any operation is invoked, application is being delayed.
**/
static void
impl_Examples_ByteSeq_Storage__fini(impl_POA_Examples_ByteSeq_Storage *
				    servant, CORBA_Environment * ev)
{
   CORBA_Object_release((CORBA_Object) servant->poa, ev);

   /* No further remote method calls are delegated to 
    * servant and you may free your private attributes. */
   /* ------ free private attributes here ------ */
   CORBA_free (servant->chunk);
   /* ------ ---------- end ------------- ------ */

   POA_Examples_ByteSeq_Storage__fini((PortableServer_Servant) servant, ev);

   g_free(servant);
}

static void
impl_Examples_ByteSeq_Storage_set(impl_POA_Examples_ByteSeq_Storage * servant,
				  const Examples_ByteSeq_Chunk * chunk,
				  CORBA_Environment * ev)
{
   /* ------   insert method code here   ------ */
   fprintf (stderr, "+");
 
   ORBit_sequence_set_size (servant->chunk, chunk->_length);
    
   {
           CORBA_long i=0;
           for (i = 0; i < chunk->_length; ++i)
                   ORBit_sequence_index (servant->chunk, i)
                           = ORBit_sequence_index (chunk, i);
   }
   /* ------ ---------- end ------------ ------ */
}

static Examples_ByteSeq_Chunk *
impl_Examples_ByteSeq_Storage_get(impl_POA_Examples_ByteSeq_Storage * servant,
				  CORBA_Environment * ev)
{
   Examples_ByteSeq_Chunk *retval;

   /* ------   insert method code here   ------ */
   fprintf (stderr, "-");

   retval = ORBit_sequence_alloc (TC_CORBA_sequence_CORBA_octet,
                                  servant->chunk->_length);

   {
           CORBA_long i=0;
           for (i = 0; i < servant->chunk->_length; ++i)
                   ORBit_sequence_index (retval, i)
                           = ORBit_sequence_index (servant->chunk, i);
   }
   /* ------ ---------- end ------------ ------ */

   return retval;
}
