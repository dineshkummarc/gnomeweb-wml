<?php

include ("./util.php");

?>

<?php write_page_header ("Bounty Contest Rules"); ?>

<?php box_start ("Contest Rules"); ?>

<ol>

<li>All submissions must be open source, without any known
intellectual property encumbrances that might stop the submission from
being distributed as free software.</li><br>

<li>Patch acceptance by module maintainers into the main development
branch of the affected modules is a prerequisite for bounty payment.
For example, for <a STYLE="text-decoration:none"
href="http://www.gnome.org/projects/evolution">Evolution</a>, this
means that your patch must be reviewed (through <a STYLE="text-decoration:none"
href="">evolution-patches</a>), accepted and checked into the 2.0
development branch before you qualify to receive a bounty.</li><br>

<li>Eligible entries must be submitted and accepted by all the
applicable module maintainers.</li><br>

<li>Your patch has to work, and it has to work <i>nicely</i>. <p> "I
just got it working," or "it works most of the time," or "it works but
the UI is just a placeholder," or "what &mdash; I have to add UI?"
don't cut it.  (Some of the bounties below include UI mockups, but
these may not necessarily be the best possible solutions.)
<p> See rule #5 below for further incentive to do a
good job.</li><br>

<li>At the top of each bounty item, in the little header, there's a
link to a bug in bugzilla.gnome.org.  If you intend to work on a
bounty, please add a comment to this bug registering your intent to
work on it.  That way, if multiple people want to work on the same
task, they can more easily find each other and collaborate.  Please do
not close this bug; it will be marked <tt>FIXED</tt> by the contest
organizers when the prize is claimed.</li><br>

<li>In the case of multiple submissions for the same bounty, the
judging panel will do its best to choose the highest-quality
submission and award a bounty to the submitter responsible for
it.</li><br>

<li>Submissions by a group are not allowed.  If you want to work on
these tasks as a team, appoint one person you trust to be the official
submitter, and he or she can divide the bounty up after it is
awarded.</li><br>

<li>Novell employees in the Ximian division are not eligible to
participate.</li><br>

<li>You may elect to not collect your bounty winnings.  The unclaimed
money will go to the "Pay it Forward" program and will be used to fund
more desktop bounties.</li><br>

<li>Bounties that are completed by submitting a patch and got accepted should be claimed 
with in a month of time. After a month the unclaimed money will go to 
the "Pay it Forward" program and will be used to fund more desktop bounties.
</li> <br>

<li>And, sorry to have to do it, but the catch-all: The awarding of
bounties is at the sole discretion of the judging panel, and we may
refuse to award a bounty to anyone for any reason at any time.  <p>
But we're good people, so as long as you play nice, we will too.</li>

</ol>

<?php box_end (); ?>

<?php write_page_footer (); ?>


</body>
</html>
