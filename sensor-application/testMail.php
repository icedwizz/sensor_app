<?php

include 'autoloader.php';

if($query->thresholdBreached()){
  $users = $query->getAllUsers();
  $subject = "WARNING!!";
  $message = "The threshold that you set has been breached.  Please check your plants!";
  foreach($users as $user){
    print_r($user);
    mail ( $user['email'] , $subject , $message);
    echo "Mail Sent to ". $user['email'];
  }
  echo "Mail Triggered";
}
