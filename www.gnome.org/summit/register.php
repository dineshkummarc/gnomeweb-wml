<html>
  <head>
    <title>Boston GNOME Summit - July 2002</title>
  </head>

  <body bgcolor="#ffffff" text="#000000">

    <center>

      <!-- Table for the black border. -->
      <table border="0" cellspacing="0" cellpadding="0" width="790">
	<tr><td bgcolor="#000000" colspan=3>
	    <!-- Table for the content image. -->
	    <table border="0" cellspacing="4" cellpadding="4" width="100%">
	      <tr><td bgcolor="#ffffff" align="left">

		  <!-- The image -->
		  <img src="boston-summit.jpg" border=0>

		  <!-- The text -->
		  <table border=0 cellpadding=50><tr><td>
  <h1>Register for Summit</h1>

<?
  $bad_elements = array();
  $errors = array();

  if ($submit) {

#--------------------------------------
# Error Checking
#--------------------------------------

      if (! $contactname){
        $bad_elements[] = "contactname";
        $errors[] = "Please enter your name.";
      }
      if (! $email) {
        $bad_elements[] = "email";
        $errors[] = "Please enter an email address we can use to contact you.";
      }
      if (! $contactphone) {
        $bad_elements[] = "contactphone";
        $errors[] = "Please enter a phone number complete with area code and country code.";
      }
      if (! $gfmember) {
        $bad_elements[] = "gfmember";
        $errors[] = "You must be a <a href=\"http://foundation.gnome.org/membership-form.html\">GNOME Foundation member</a> to register.";
      }



      #-----------------
      # Do we submit?
      #-----------------

      if (count($bad_elements) == 0)
      {
        // make the mail 

        $formmail = "";
        $formmail .= "Name: " . $contactname . "\n";
        $formmail .= "Title: " . $contacttitle . "\n";
        $formmail .= "Email: " . $email . "\n\n";

        $formmail .= "Address: " . $addr1 . "\n";
        $formmail .= "Address2: " . $addr2 . "\n";
        $formmail .= "City: " . $city . "\n";
        $formmail .= "State: " . $state . "\n";
        $formmail .= "Zip: " . $zip . "\n";
        $formmail .= "Country: " . $country . "\n";
        $formmail .= "Phone: " . $contactphone . "\n\n";

	$formmail .= "Need a place to stay: " . $placetostay . "\n\n";

        $formmail .= "GNOME Foundation Member: " . $gfmember ."\n\n";


        $formmail .= "\nComments:\n";
        $formmail .= "$comments\n\n";

        $headers = "From: summit_register@gnome.org \n";

        // send the mail

        mail("summit-registration@ximian.com", "GNOME Summit Registration form", $formmail, $headers);

        // print the thank you page

        print ("
          <h2>Thank you for registering for the Boston GNOME Summit.  You can now go back to the <a href=\"http://www.gnome.org/summit\">Boston GNOME Summit web page</a>.</h2>

             ");
       } 

  }


#----------------------------------
#  End error-checking/collecting and submittal
#----------------------------------

  if (! $submit || count($bad_elements) != 0) {  ?>

  <p>

    Please fill in the following to register for the Boston GNOME
    Summit.  The deadline for registration is July 1st, 2002.

  </p>
    <ul>

      <!-- print any errors -->
      
      <?  if (count($bad_elements) != 0)
            {
             print("<font color=\"red\">");
             foreach ($errors as $error)
               { print("<li>$error</li>");}
             print("</font>");
            }
      ?>

    </ul>

    <form action="<?=$PHP_SELF?>" method="POST">
      <table>
	<tr>
	  <td>*Name:</td>
	  <td>
	    <input type="text" name="contactname" 
		   size="30" value="<? echo $contactname ?>">
	  </td>
	</tr>
	<tr>
	  <td>Title:</td>
	  <td>
	    <input type="text" name="contacttitle" 
		   size="30" value="<? echo $contacttitle ?>">
	  </td>
	</tr>
	<tr>
	  <td>*Email:</td>
	  <td>
	    <input type="text" name="email" 
		   size="30" value="<? echo $email ?>">
	  </td>
	</tr>
	<tr>
	  <td>*Phone:</td>
	  <td>
	    <input type="text" name="contactphone" 
		   size="30" value="<? echo $contactphone ?>">
	  </td>
	</tr>
	<tr>
	  <td>Address:</td>
	  <td>
	    <input type="text" name="addr1" 
		   size="30" value="<? echo $addr1 ?>">
	  </td>
	</tr>
	<tr>
	  <td>Address2:</td>
	  <td>
	    <input type="text" name="addr2" 
		   size="30" value="<? echo $addr2 ?>">
	  </td>
	</tr>
	<tr>
	  <td>City:</td>
	  <td>
	    <input type="text" name="city" 
		   size="30" value="<? echo $city ?>">
	  </td>
	</tr>
	<tr>
	  <td>State:</td>
	  <td>
	    <input type="text" name="state" 
		   size="3" value="<? echo $state ?>">
	  </td>
	</tr>
	<tr>
	  <td>Country:</td>
	  <td>
	    <input type="text" name="country" 
		   size="30" value="<? echo $country ?>">
	  </td>
	</tr>
	<tr>
	  <td>Postal Code:</td>
	  <td>
	    <input type="text" name="zip" 
		   size="30" value="<? echo $zip ?>">
	  </td>
	</tr>
        <tr>
          <td colspan=2>
             <input type="checkbox" name="placetostay"> Help!  I need a place to crash while I'm in town.
          </td>
        </tr>
        <tr>
          <td colspan=2>
             <input type="checkbox" name="gfmember"> *I am a GNOME Foundation member.
          </td>
        </tr>
      </table>
      <table>
	<tr>
	  <td valign="top" colspan="3">&nbsp;</td>
	</tr>
        <tr>
	  <td valign="top" colspan="3">
	    Comments:
	  </td>
	<tr>
	  <td valign="top">&nbsp;</td>
	  <td valign="top" colspan="2">
	    <textarea name="comments" cols="70" rows="5"></TEXTAREA>
	  </td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td valign="top">
	    <input type="submit" name="submit" value="Submit">
	      <input type="reset" name="reset" value="Clear">
	  </td>
	  <td>&nbsp;</td>
	</tr>
      </table>
    </form>


<? } ?>

	  </td></tr>
      </table>
	  </td></tr>
      </table>
	  </td></tr>
      </table>
    </center>
  </body>

</html>









