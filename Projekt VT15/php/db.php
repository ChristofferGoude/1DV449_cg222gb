<?php
namespace php;

class dal{
	private static $dbh = "";
	private static $hostname = "hakkiko-166006.mysql.binero.se";
	private static $localhost = "127.0.0.1";
	private static $dbname = "166006-hakkiko";
	private static $user = "166006_qd46836";
	private static $pass = "";
	private static $session = "";
	
	public function __construct(){
		//TODO: Data access
	}

	/**
	 * Connection is created to the database
	 */
	public function createConnection(){	
		try {
		    self::$dbh = new \PDO("mysql:host=" . self::$hostname . ";dbname=" . self::$dbname . "", self::$user, self::$pass, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			self::$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);		
			
			return self::$dbh;
		} 
		catch (\PDOException $e) {
			throw $e;
		}
	}
	
	/**
	 * User is validated for login via the database
	 * Username and password is checked
	 */
	public function validateUserForLogin($userinfo){
		try{				
			$this->createConnection();	
			
			$sql = "SELECT username FROM users WHERE username = :username AND password = :password";	
			$query = self::$dbh->prepare($sql);
			$query->bindParam(":username", $userinfo[0]);
		  	$query->bindParam(":password", $userinfo[1]);
			$query->execute();
			
			self::$dbh = null;
							  
			if($query->rowCount() > 0){
				return true;
			}	
		}		
		catch (\PDOException $e){
			return false;
		}	  
	}
	
	/**
	 * The username is checked for previous existence in the database
	 * If username were found, returns true.
	 */
	public function validateUserForReg($userinfo){
		try{				
			$this->createConnection();	
			
			$sql = "SELECT username FROM users WHERE username = :username";	
			$query = self::$dbh->prepare($sql);
			$query->bindParam(":username", $userinfo[0]);
			$query->execute();
			
			self::$dbh = null;
							  
			if($query->rowCount() > 0){
				return true;
			}	
		}		
		catch (\PDOException $e){
			return false;
		}	  
	}
	
	/**
	 * New user is registered in the database 
	 */
	public function registerNewUser($userinfo){
		try{				
			$this->createConnection();	
			
			$sql = "INSERT INTO users (username,password) VALUES (:username,:password)";	
			$query = self::$dbh->prepare($sql);
			$query->bindParam(":username", $userinfo[0]);
		  	$query->bindParam(":password", $userinfo[1]);
			$query->execute();
			
			self::$dbh = null;
							  
			return true;
		}		
		catch (\PDOException $e){
			return false;
		}
	}
}
