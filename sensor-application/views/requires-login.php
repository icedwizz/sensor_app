<?php
include_once('view-protection.php');
//Protects pages requiring you to be logged in
if(!$session->loggedIn()){
	header("Location: index.php");
}