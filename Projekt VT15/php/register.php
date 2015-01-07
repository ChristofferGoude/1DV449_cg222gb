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
	
	public function registerUser($userinfo){
		if(self::$dal->validateUserForReg($userinfo)){
			return true; //User already exists
		}
		
		self::$dal->registerNewUser($userinfo);
		
		return false;
	}
}

if(isset($_POST["userinfo"])){
	$validations = new \php\validations();
	
	for($i = 0; $i < 2; $i++){
		if(!($validations->checkEmptyString($_POST["userinfo"][$i]))){
			echo "Du måste fylla i både ett användarnamn och lösenord!";
			
			return false;
		}
		if(!($validations->checkStringForTags($_POST["userinfo"][$i]))){
			echo "Du får inte ha taggar i användarnamnet eller lösenordet!";
			
			return false;
		}
	}
	
	$register = new register();
	
	if($register->registerUser($_POST["userinfo"])){
		echo "Användare finns redan!";
	}
	else{
		echo "Användare finns inte, reggades!";
	}
}
