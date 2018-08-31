<?php
//login using e-mail/username and password

require_once ("autoloader.php");

//checks submit button has been clicked
if (isset($_POST['submit'])) {

  //Error handling
  //Checks if fields are empty

  if (empty($_POST['user_uid']) || empty($_POST['user_password'])) {
    
    header("Location: index.php?login=empty");
    exit();
  }

  if (!$query->verifyUser($_POST['user_uid'], $_POST['user_password'])) {

    header("Location: index.php?login=error");
    exit();
  }

  $user = $query->getUser($_POST['user_uid']);
  $session->setupUser($user);

  header("Location: loggedIn.php");

  exit();
}else{
  header("Location: index.php?login=loginerror");
  exit();
}
