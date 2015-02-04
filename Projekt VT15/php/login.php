<?php

include_once("db.php");
include_once("validations.php");

session_start();

class login{
	
	private static $dal = "";
	private static $session = "";
	
	public function __construct(){
		//TODO: Eventual initiation
		self::$dal = new \php\dal();
	}
	
	/**
	 * User is validated for login
	 */
	public function validateUserForLogin($userInfo){
		if(self::$dal->validateUserForLogin($userInfo)){
			$_SESSION["session"] = $userInfo[0];
			
			return true;
		}
		
		return false;
	}
	
	/**
	 * A session is created via facebook-login
	 */
	public function facebookLogin($user){
		$_SESSION["session"] = $user;
		
		return $_SESSION["session"];
	}
	
	public function logOut(){
		session_destroy();
	}
}

/**
 * The session is checked
 */
function isUserLoggedIn(){
	if(isset($_SESSION["session"])){
		return $_SESSION["session"];
	}
	else{
		return false;
	}
}

/**
 * GET- and POST-requests from client
 */

$login = new login();

if(isset($_GET["checksessionstatus"])){
	if(!(isUserLoggedIn())){
		echo false;
	}
	else{
		echo isUserLoggedIn();
	}
}

if(isset($_POST["facebookLogin"])){
	echo $login->facebookLogin($_POST["facebookLogin"]);
}

if(isset($_POST["userinfo"])){
	$validations = new \php\validations();
	
	for($i = 0; $i < 2; $i++){
		if(!($validations->checkEmptyString($_POST["userinfo"][$i]))){
			echo "You must enter both a username and password!";
			
			return false;
		}
	}
	
	if($login->validateUserForLogin($_POST["userinfo"])){
		echo isUserLoggedIn();	
	}
	else{
		echo "This user was not found!";
	}
}

if(isset($_GET["logout"])){
	$login->logOut();
	
	echo "";
}
