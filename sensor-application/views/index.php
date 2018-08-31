<?php include_once('view-protection.php'); ?>
<?php include_once 'header.php'; ?>
<section class="main-container">
  <div class="main-wrapper">

<!--content inside website if logged in
session login and signup -->

<h2>Smart Greenhouse System</h2>

</div>
<div class="welcomemessage">
    <?php
    if ($session->loggedIn())  {
      echo "Welcome ".$_SESSION['s_first']." ".$_SESSION['s_last'];
  	}
		?>
<br><br><br>
</div>
  </div>

</section>

<div class="message">


<p>The Smart Greenhouse System allows you to see up-to-date readings from your sensors.</p><br>  <p>There is also an
option to set a threshold value if you wish.</p> <br> If the sensor reading goes beyond your desired threshold, your
will be notified by e-mail
</div>
