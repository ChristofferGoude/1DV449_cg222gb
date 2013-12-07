<?php
require_once("sec.php");

// check tha POST parameters
$u = $_POST['username'];
$p = $_POST['password'];

// Check if user is OK
if(userValidation($u) && userValidation($p)){
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
function userValidation($s){
	$cleanS = strip_tags($s);
	if($s === $cleanS){
		if(preg_match('/\d/', $s) == 0){
			return true;
		}
	}	
	return false;
}
