<?php
namespace php;

class validations{
	public function __construct(){
		
	}
	
	public function checkEmptyString($string){
		if($string == ""){
			return false;
		}
		else{
			return true;
		}
	}
	
	public function checkStringForTags($string){
		if(strip_tags($string) == $string){
			return true;
		}
		else{
			return false;
		}
	}
}
