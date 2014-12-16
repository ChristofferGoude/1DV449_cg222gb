<?php
	$database;

	try{
		$database = new PDO('sqlite:db.db');
		$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		die("Error! Message: " . $e->getMessage());
	}
