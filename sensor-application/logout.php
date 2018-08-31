<?php

include_once("autoloader.php");
//destroys session and logout
if(isset($_POST['submit'])) {

  $session->logOut();
  header("Location: index.php");
}
 ?>
