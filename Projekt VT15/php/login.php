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
	
	public function validateUserForLogin($userInfo){
		if(self::$dal->validateUserForLogin($userInfo)){
			$_SESSION["session"] = $userInfo[0];
			
			return true;
		}
		
		return false;
	}
	
	public function logOut(){
		session_destroy();
	}
}

function isUserLoggedIn(){
	if(isset($_SESSION["session"])){
		return $_SESSION["session"];
	}
	else{
		return false;
	}
}

$login = new login();

if(isset($_GET["checksessionstatus"])){
	if(!(isUserLoggedIn())){
		echo false;
	}
	else{
		echo "En användare ska vara inloggad med sessionskaka med användarnamn " . isUserLoggedIn() . "!";
	}
}

if(isset($_POST["userinfo"])){
	$validations = new \php\validations();
	
	for($i = 0; $i < 2; $i++){
		if(!($validations->checkEmptyString($_POST["userinfo"][$i]))){
			echo "Du måste fylla i både ett användarnamn och lösenord!";
			
			return false;
		}
	}
	
	if($login->validateUserForLogin($_POST["userinfo"])){
		echo isUserLoggedIn();	
	}
	else{
		echo "Användaren hittades inte och kunde inte loggas in!";
	}
}

if(isset($_GET["logout"])){
	$login->logOut();
	
	echo "";
}
