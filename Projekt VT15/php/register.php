<?php

include_once("db.php");
include_once("validations.php");

class register{
	
	private static $dal = "";
	private static $validations = "";
	
	public function __construct(){
		//TODO: Eventual initiation
		self::$dal = new \php\dal();
	}
	
	/**
	 * The user is attempted to be registered
	 */
	public function registerUser($userinfo){
		if(self::$dal->validateUserForReg($userinfo)){
			return true; //User already exists
		}
		
		self::$dal->registerNewUser($userinfo);
		
		return false;
	}
}

/**
 * GET- and POST-requests from client
 */

if(isset($_POST["userinfo"])){
	$validations = new \php\validations();
	
	for($i = 0; $i < 2; $i++){
		if(!($validations->checkEmptyString($_POST["userinfo"][$i]))){
			echo "You must enter both a username and password!";
			
			return false;
		}
		if(!($validations->checkStringForTags($_POST["userinfo"][$i]))){
			echo "You may not use tags in the username or password!";
			
			return false;
		}
	}
	
	$register = new register();
	
	if($register->registerUser($_POST["userinfo"])){
		echo "This username is already in use, please choose a different one!";
	}
	else{
		echo "Your user profile was registered!";
	}
}
