<html>
  <head>
    <title>GNOME Users and Developers Survey</title>
  </head>

  <body bgcolor="#ffffff" text="#000000">

    <center>

      <!-- Table for the black border. -->
      <table border="0" cellspacing="0" cellpadding="0" width="790">
        <tr><td bgcolor="#000000">
            <!-- Table for the content image. -->

            <table border="0" bgcolor="#000000" cellspacing="3" cellpadding="2" width="100%"> 
              <tr><!-- The text --><td>

                  <table border=0 bgcolor="#ffffff" cellpadding=50 width="100%"> <!-- start content -->
                    <tr><td>
                        <h1>GNOME Users and Developers Survey:</h1>

<?
  $bad_elements = array();
  $errors = array();

  if (count($attend) != 0) {
    $none = $paris = $copenhagen = $seville = 0;
    foreach ($attend as $location) {
      if ($location == "none") { 
        $none = 1;
      } 
      if ($location == "paris") {
	$paris = 1;
      } 
      if ($location == "copenhagen") {
	$copenhagen = 1;
      } 
      if ($location == "seville") {
	$seville = 1;
      } 
    }
  }

  if ($submit) {

      if (!$contactname){
        $bad_elements[] = "contactname";
        $errors[] = "Please enter your name.";
      }
      if (!$contactaddress){
        $bad_elements[] = "contactaddress";
        $errors[] = "Please enter your country of residence.";
      }
      if (!$email) {
        $bad_elements[] = "email";
        $errors[] = "Please enter an email address we can use to contact you.";
      }
      if ($user_developer == "developer" && !$contributions){
        $bad_elements[] = "contributions";
        $errors[] = "Please enter your contributions to GNOME.";
      }
 
     if (!$none && !$paris && !$copenhagen && !$seville) {
	$bad_elements[] = "attend";
	$errors[] = "Please specify if you have previously attended GUADEC.";
     }


      if (count($bad_elements) == 0)
      {
        // make the mail 

        $formmail = "";
        $formmail .= "Name:\t" . $contactname . "\n";
        $formmail .= "Age:\t" . $contactage . "\n";
        $formmail .= "Residence:\t" . $contactaddress . "\n";
	$formmail .= "Affiliation [if any]:\t". $affiliation . "\n";
        $formmail .= "Email:\t" . $email . "\n\n";

	$formmail .= "User/Developer:\t" . $user_developer . "\n";
//        $formmail .= "User:\t" . $user . "\n";
//        $formmail .= "Developer:\t" . $developer . "\n";

        $formmail .= "Contributions:\n" . $contributions . "\n\n";

        $formmail .= "Interested in attending GUADEC 4:\t" . $guadec . "\n\n";

	$no_guadecs=count($attend);

    	$guadecs_attended = "";
	for ($i=0; $i<$no_guadecs; $i++) {
    		$guadecs_attended .= $attend[$i] . " ";
	}
	
	$formmail .= "GUADECs Attended:\t" . $guadecs_attended . "\n\n";
        $formmail .= "Needs Sponsorship:\t" . $sponsor . "\n\n";
        $formmail .= "Paid Tutorials:\t" . $tutorial . "\n\n";
        $formmail .= "Not interested in paid tutorials:\t" . $notutorial . "\n\n";

        $formmail .= "GNOME Foundation Member:\t" . $gfmember ."\n\n";

        $formmail .= "\nSuggestions:\n";
        $formmail .= "$suggestions\n\n";

        $headers = "From: guadec_pre_register@gnome.org \n";

        // send the mail

//        mail("glynn.foster@sun.com", "GNOME Users and Developers Survey :: reply", $formmail, $headers);
        mail("micke@codefactory.se", "GNOME Users and Developers Survey :: reply", $formmail, $headers);

        // print the thank you page

        print ("
          <h2>Thank you for giving your responses. Your information will
	      help us to target the needs of our users and contributors more
	      effectively and plan better for future GNOME events.</h2> ");
       }

  }


  if (! $submit || count($bad_elements) != 0) {  ?>

  <p>
    Please fill in the following to details to give us better information
    of GNOME's users and contributors. 
  </p>
    <ul>

      <!-- print any errors -->
      
      <?  if (count($bad_elements) != 0)
            {
             print("<font color=\"red\">");
             foreach ($errors as $error) { 
		print("<li>$error</li>");
	     }
             print("</font>");
            }
      ?>

    </ul>

    <form action="<?=$PHP_SELF?>" method="POST">
      <table>
	<tr>
	  <td><font color="red">*</font>Name:</td>
	  <td>
	    <input type="text" name="contactname" 
		   size="30" value="<? if ($contactname) { echo $contactname; } ?>">
	  </td>
	</tr>
	<tr>
	  <td>&nbsp;Age:</td>
	  <td>
	    <input type="text" name="contactage" 
		   size="3" value="<? if ($contactage) { echo $contactage; } ?>">
	  </td>
	</tr>
	<tr>
	  <td><font color="red">*</font>Country of residence:</td>
	  <td>
	    <input type="text" name="contactaddress" 
		   size="30" value="<? if ($contactaddress) { echo $contactaddress; } ?>"> 
	  </td>
	</tr>
	<tr>
	  <td>&nbsp;Affiliation:</td>
	  <td>
	    <input type="text" name="affiliation" 
		   size="30" value="<? if ($affiliation) { echo $affiliation; } ?>">
	  </td>
	<tr>
	  <td><font color="red">*</font>Email:</td>
	  <td>
	    <input type="text" name="email" 
		   size="30" value="<? if ($email) { echo $email; } ?>">
	  </td>
	</tr>
	<tr>
	  <td colspan=2>&nbsp;</td>
	</tr>
        <tr>
          <td colspan=2>
              <input type="radio" name="user_developer" value="user" <? if ($user_developer == "user") { ?> checked <? } ?> >  I am a GNOME user.
          </td>
        </tr>
        <tr>
          <td colspan=2>
               <input type="radio" name="user_developer" value="developer" <? if ($user_developer == "developer") { ?> checked <? } ?> >  I am a GNOME contributor.
          </td>
        </tr>
	<tr>
	  <td colspan=2>&nbsp;</td>
	</tr>
        <tr>
	  <td valign="top" colspan="2">
	    <font color="red">*</font>Contributions to GNOME [if contributor]:
	  </td>
        </tr>
	<tr>
	  <td valign="top" colspan="2">
	    <textarea name="contributions" cols="70" rows="5" wrap=virtual><? if (trim($contributions)) { echo trim($contributions); } ?></textarea>
	  </td>
	</tr>
	<tr>
	  <td colspan=2>&nbsp;</td>
	</tr>
        <tr>
          <td valign="top" colspan="2">
	    <font color="red">*</font>Previous GUADEC attendance:
          </td>
        </tr>
        <tr>
          <td colspan=2>
             <select name="attend[]" multiple>
             <option value="none" <? if ($none) { ?> selected <? } ?> > I have not attended a past GUADEC</option>

	     <option value="paris" <? if ($paris) { ?> selected <? } ?> > I attended GUADEC 1 (Paris, France)</option>

             <option value="copenhagen" <? if ($copenhagen) { ?> selected <? } ?> > I attended GUADEC 2 (Copenhagen, Denmark)</option>

             <option value="seville" <? if ($seville) { ?> selected <? } ?> > I attended GUADEC 3 (Seville, Spain)</option>

	     </select>
          </td>
        </tr>
	<tr>
	  <td colspan=2>&nbsp;</td>
	</tr>
        <tr>
          <td colspan=2>
             <input type="checkbox" name="guadec" <? if ($guadec) { ?> checked <? } ?> >  I am interested in attending GUADEC in 2003.
          </td>
        </tr>
        <tr>
          <td colspan=2>
                 <input type="checkbox" name="sponsor" <? if ($sponsor) { ?> checked <? } ?> >  I will need sponsorship to attend GUADEC in 2003.
          </td>
        </tr>
	<tr>
	  <td colspan=2>&nbsp;</td>
	</tr>
        <tr>
          <td colspan=2>
            <input type="checkbox" name="tutorial" <? if ($tutorial) { ?> checked <? } ?> >  I am interested in attending professional tutorials about GTK+ and GNOME technology for a fee.
          </td>
        </tr>
        <tr>
          <td colspan=2>
            <input type="checkbox" name="notutorial" <? if ($notutorial) { ?> checked <? } ?> >  I am <B>not</B> interested in attending any professional tutorials for a fee.
          </td>
        </tr>
	<tr>
	  <td colspan=2>&nbsp;</td>
	</tr>
        <tr>
          <td colspan=2>
             <input type="checkbox" name="gfmember" <? if ($gfmember) { ?> checked <? } ?> >  I am a GNOME Foundation member.
          </td>
        </tr>
	</tr>
	<tr>
	  <td valign="top" colspan="2">&nbsp;</td>
	</tr>
        <tr>
	  <td valign="top" colspan="2">
	    Suggestions:
	  </td>
	<tr>
	  <td valign="top" colspan="2">
	    <textarea name="suggestions" cols="70" rows="5" wrap=virtual><? if (trim($suggestions)) { echo trim($suggestions); } ?></textarea>
	  </td>
	</tr>
	<tr>
	  <td colspan=2 valign="top">
	    <input type="submit" name="submit" value="Submit">
	      <input type="reset" name="reset" value="Clear">
	  </td>
	</tr>
      </table>
    </form>


<? } ?>

	  </td></tr>
      </table>  <!-- end content-->

	  </td></tr>
      </table>

	  </td></tr>
      </table>
    </center>
  </body>

</html>
