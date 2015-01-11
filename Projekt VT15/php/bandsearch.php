<?php

include_once("db.php");

class bandsearch{
	
	private static $bioUrl = "http://en.wikipedia.org/w/api.php?action=opensearch&limit=1&namespace=0&format=json&search=";
	private static $releaseUrl = "http://musicbrainz.org/ws/2/release/?query=release:";
	
	public function __construct(){
		
	}
	
	public function getBandInformation($query){
		//$bandInfoArray = array();
		
		$bandInfoArray = $this->getBioInformation($query);
		//$bandInfoArray[] = $this->getReleaseInformation($query);
		
		return $bandInfoArray;
	}
	
	public function getBioInformation($query){
		//Get biography from Wikipedia API
		
		$searchURL = self::$bioUrl . $query;
						
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $searchURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if ($httpstatus == "404" || $httpstatus == "500") {
	        return false;
        }
		
		//Note that no json_encode is needed because the Wiki API
		//already has the option to return information in JSON.
		//Therefore the data is directly decoded.
		$array = json_decode($data);
		
		
		//TODO: Clean this up, so the returned result is only the string (Bio) for the band!
		$arr1 = $array[2];
		$string = $arr1[0];
		
		return $string;
	}
	
	public function getReleaseInformation($query){
		//Get releaseinformation from MusicBrainz API here
		
		$searchURL = self::$releaseUrl . $query;
						
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $searchURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if ($httpstatus == "404" || $httpstatus == "500") {
	        return false;
        }
		
		$json = json_encode($data);
		$array = json_decode($json);
		
		return $array;
	}
	
	public function getBiography(){
		//Get biography from wiki API here
	}
	
	public function getRelatedArtists(){
		//Get related artists information from Last.FM here
	}
	
}

$bandsearch = new bandsearch();

if(isset($_POST["bandquery"])){
	$bandInfo = $bandsearch->getBandInformation($_POST["bandquery"]);	
	
	var_dump($bandInfo);
}
