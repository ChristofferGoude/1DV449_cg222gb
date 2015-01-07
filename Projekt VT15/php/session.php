<?php

function setSession($sessionID){
	if(!(isset($_SESSION["session"]))){
		$_SESSION["session"] = $sessionID;
	}
}

function getSession(){
	if(isset($_SESSION["session"])){
		return $_SESSION["session"];
	}
	else{
		return false;
	}
}
