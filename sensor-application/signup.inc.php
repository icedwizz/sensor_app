<?php //check if user clicked submit button so code can't be accessed through URL
if (!isset($_POST['submit'])) {
  header("Location: signup.php");
}
include_once 'autoloader.php';

$user = (object)[
  "first_name" => $_POST['first'],
  "last_name" => $_POST['last'],
  "email" => $_POST['email'],
  "uid" => $_POST['uid'],
  "password" => $_POST['user_password'],
];

//error handling
//Checks that no fields are empty
if (empty($user->first_name) || empty($user->last_name) || empty($user->email) || empty($user->uid) || empty($user->password)) {
  header("Location: signup.php?signup=empty");//error message
}
//checks that first and last name have valid characters
if(!preg_match("/^[a-zA-Z]*$/", $user->first_name) || !preg_match("/^[a-zA-Z]*$/", $user->last_name)) {
  header("Location: signup.php?signup=invalid");
}
//checks that e-mail is valid
if(!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
  header("Location: signup.php?signup=invalidemail");
}
if ($query->userExists($user->uid)) {
  header("Location: signup.php?signup=usertaken");
}
if ($query->emailExists($user->email)) {
  header("Location: signup.php?signup=emailtaken");
}
$query->createUser($user);
header("Location: signup.php?signup=success");
