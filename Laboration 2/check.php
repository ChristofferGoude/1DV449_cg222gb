<?php
require_once("sec.php");

// check tha POST parameters
$u = $_POST['username'];
$p = $_POST['password'];

// Check if user is OK
if($this->userValidation($u, $p)){
	if(isUser($u, $p)) {
		// set the session
		sec_session_start();
		$_SESSION['login_string'] = hash('sha512', "Come_On_You_Spurs" +$u); 
		$_SESSION['user'] = $u;
		header("Location: img/middle.php");
	}
}
else {
	// To bad
	header('HTTP/1.1 401 Unauthorized');
}

/**
 * @return bool (Wether or not user input is validated)
 */
function userValidation($u, $p){
	$cleanU = strip_tags($u);
	$cleanP = strip_tags($p);
	if($u === $cleanU && $p === $cleanP){
		if(preg_match('/\d/', $u) == 0 && preg_match('/\d/', $p) == 0){
			return true;
		}
	}	
	return false;
}
