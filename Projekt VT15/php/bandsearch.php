<?php

include_once("db.php");

class bandsearch{
	
	private static $bioUrl = "http://en.wikipedia.org/w/api.php?action=opensearch&limit=1&namespace=0&format=json&search=";
	private static $lastFmBioUrlBeginning = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=";
	private static $lastFmBioUrlEnd = "&api_key=b62158686e3fa7f35878ce0165047462&format=json";
	private static $releaseUrl = "http://musicbrainz.org/ws/2/release/?query=release:";
	private static $relatedUrlBeginning = "http://ws.audioscrobbler.com/2.0/?method=artist.getsimilar&artist=";
	private static $relatedUrlEnd = "&api_key=b62158686e3fa7f35878ce0165047462&format=json";
	private static $linksUrl = "http://en.wikipedia.org/w/api.php?action=query&prop=extlinks&format=json&titles=";
	
	public function __construct(){
		
	}
	
	public function getBioInformation($query){
		//Get biography from Wikipedia API
		
		$searchURL = self::$lastFmBioUrlBeginning . $query . self::$lastFmBioUrlEnd;
						
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
		$unsortedBio = json_decode($data, true);
		$sortedBio = $this->getSortedBiography($unsortedBio);
		
		return json_encode($sortedBio);
	}
	
	public function getSortedBiography($unsortedList){
		$sortedBio = array();
		
		if(array_key_exists("artist", $unsortedList)){
			array_push($sortedBio, $unsortedList["artist"]["bio"]["summary"]);
			
			if($sortedBio[0] == null){
				array_push($sortedBio, "No biography were found for this artist!");
			}
		}
		else{
			$sortedBio[0] = "No biography were found for this artist!";
		}
		
		return $sortedBio;
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
	
	public function getRelatedArtists($query){
		$searchURL = self::$relatedUrlBeginning . $query . self::$relatedUrlEnd;
						
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $searchURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if ($httpstatus == "404" || $httpstatus == "500") {
	        return false;
        }
		
		$unsortedArtists = json_decode($data, true);
		$sortedArtists = $this->getRelatedArtistList($unsortedArtists);
		
		return json_encode($sortedArtists);
	}
	
	public function getRelatedArtistList($unsortedList){		
		$sortedList = array();
		
		if(array_key_exists("similarartists", $unsortedList)){
			for($i = 0; $i < 5; $i++){
				array_push($sortedList, $unsortedList["similarartists"]["artist"][$i]["name"]);
			}
			
			if($sortedList[0] == null){
				array_push($sortedList, "No related artists!");
			}
		}
		else{
			$sortedList[0] = "No related artists!";
		}

		return $sortedList;
	}
	
	public function getLinks($query){
		$searchURL = self::$linksUrl . $query;
						
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $searchURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if ($httpstatus == "404" || $httpstatus == "500") {
	        return false;
        }
		
		$unsortedLinks = json_decode($data, true);
		$sortedLinks = $this->getLinksList($unsortedLinks);
		
		return json_encode($sortedLinks);
	}
	
	public function getLinksList($unsortedList){
		$sortedList = array();

		$linkList = reset($unsortedList["query"]["pages"]);
		
		if(array_key_exists("extlinks", $linkList)){
			$count = rand(0, sizeof($linkList));	
				
			for($i = $count; $i < $count+5; $i++){
				array_push($sortedList, $linkList["extlinks"][$i]["*"]);
			}
			
			if($sortedList[0] == null){
				$sortedList[0] = "No links where found!";
			}
		}
		else{
			$sortedList[0] = "No links were found!";
		}
		

		return $sortedList;
	}
	
}

$bandsearch = new bandsearch();

if(isset($_POST["biography"])){
	$biography = $bandsearch->getBioInformation($_POST["biography"]);

	echo $biography;
}

if(isset($_POST["relatedArtists"])){
	$relatedArtists = $bandsearch->getRelatedArtists($_POST["relatedArtists"]);	
	
	echo $relatedArtists;
}

if(isset($_POST["links"])){
	$links = $bandsearch->getLinks($_POST["links"]);
	
	echo $links;
}
