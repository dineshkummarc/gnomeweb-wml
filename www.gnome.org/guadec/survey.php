<html>
  <head>
    <title>GUADEC Survey - 2002</title>
  </head>

  <body bgcolor="#ffffff" text="#000000">

    <center>

      <!-- Table for the black border. -->
      <table border="0" cellspacing="0" cellpadding="0" width="790">

        <tr><td bgcolor="#000000" colspan=3>
            <!-- Table for the content image. -->

            <table border="0" bgcolor="#000000" cellspacing="3" cellpadding="10" width="100%">
              <tr><td bgcolor="#ffffff" align="center"><img src="gnome-foot-large.png" border=0>
                  <img src="plus.png" border=0><img src="guinness.png" border=0>
                  <img src="equals.png" border=0><img src="question.png" border=0>
                  <!-- The text -->
                  <table border=0 bgcolor="#ffffff" cellpadding=50>
                    <tr><td>
                        <h1>GUADEC 4 Pre-Registration Formalities:</h1>

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
      if (! $contactaddress){
        $bad_elements[] = "contactaddress";
        $errors[] = "Please enter your address.";
      }
      if (! $committment){
        $bad_elements[] = "committment";
        $errors[] = "Please enter your committment to GNOME.";
      }
      if (! $email) {
        $bad_elements[] = "email";
        $errors[] = "Please enter an email address we can use to contact you.";
      }



      #-----------------
      # Do we submit?
      #-----------------

      if (count($bad_elements) == 0)
      {
        // make the mail 

        $formmail = "";
        $formmail .= "Name: " . $contactname . "\n";
        $formmail .= "Age: " . $contactage . "\n";
        $formmail .= "Residence: " . $contactaddress . "\n";
        $formmail .= "Email: " . $email . "\n\n";


        $formmail .= "User: " . $user . "\n\n";
        $formmail .= "Developer: " . $developer . "\n\n";
        $formmail .= "Committment: " . $committment . "\n\n";

        $formmail .= "GUADEC: " . $guadec . "\n\n";
        $formmail .= "Attended Previously: " . $attend . "\n\n";
        $formmail .= "Needs Sponsorship: " . $sponsor . "\n\n";
        $formmail .= "Tutorials: " . $tutorial . "\n\n";

        $formmail .= "GNOME Foundation Member: " . $gfmember ."\n\n";

        $formmail .= "\nComments:\n";
        $formmail .= "$comments\n\n";

        $headers = "From: guadec_pre_register@gnome.org \n";

        // send the mail

        mail("glynn.foster@sun.com", "GUADEC Pre-Registration Formality Form", $formmail, $headers);

        // print the thank you page

        print ("
          <h2>Thank you for giving your input into the GUADEC process. We will let you know more information about the conference as
	      soon as it is available.</h2> ");
       } 

  }


#----------------------------------
#  End error-checking/collecting and submittal
#----------------------------------

  if (! $submit || count($bad_elements) != 0) {  ?>

  <p>

    Please fill in the following to details to give us better information
    while organizing GUADEC 4. 
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
	  <td>Age:</td>
	  <td>
	    <input type="text" name="contactage" 
		   size="3" value="<? echo $contactage ?>">
	  </td>
	</tr>
	<tr>
	  <td>*Country of residence:</td>
	  <td>
	    <input type="text" name="contactaddress" 
		   size="30" value="<? echo $contactaddress ?>">
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
          <td colspan=2>
             <input type="checkbox" name="user"> I am a GNOME user.
          </td>
        </tr>
        <tr>
          <td colspan=2>
             <input type="checkbox" name="developer"> I am a GNOME developer.
          </td>
        </tr>
        <tr>
	  <td valign="top" colspan="3">
	    *Committments to GNOME:
	  </td>
        </tr>
	<tr>
	  <td valign="top">&nbsp;</td>
	  <td valign="top" colspan="2">
	    <textarea name="committment" cols="70" rows="5"></TEXTAREA>
	  </td>
	</tr>
        <tr>
          <td colspan=2>
             <input type="checkbox" name="guadec"> I am interested in attending GUADEC in 2003.
          </td>
        </tr>
        <tr>
          <td colspan=2>
             <input type="checkbox" name="attend"> I have attended a past GUADEC.
          </td>
        </tr>
        <tr>
          <td colspan=2>
             <input type="checkbox" name="sponsor"> I will need sponsorship if I am to attend GUADEC in 2003.
          </td>
        </tr>
        <tr>
          <td colspan=2>
             <input type="checkbox" name="tutorial"> I am interested in paying for professional tutorials about GTK+/GNOME technology.
          </td>
        </tr>
        <tr>
          <td colspan=2>
             <input type="checkbox" name="gfmember"> I am a GNOME Foundation member.
          </td>
        </tr>
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
