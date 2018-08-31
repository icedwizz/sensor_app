<?php

class SessionController{

	public function __construct(){
		session_start();
	}

	public function setupUser($user){
		global $_SESSION;
		$_SESSION['s_id'] = microtime();
    $_SESSION['s_first'] = $user['first_name'];
    $_SESSION['s_last'] = $user['last_name'];
    $_SESSION['s_email'] = $user['email'];
    $_SESSION['s_uid'] = $user['user_uid'];
	}

	public function loggedIn(){
		return isset($_SESSION['s_id']);
	}

	public function logOut(){
		session_unset();
  	session_destroy();
	}

	public function __destruct(){

	}

}

$session = new SessionController;