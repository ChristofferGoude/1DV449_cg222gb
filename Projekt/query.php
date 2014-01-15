<?php
require_once("services/Soundcloud.php");
    
class queryController{
	private static $baseURL = "http://api.soundcloud.com/users/";
	private static $endURL = "/tracks.json?client_id=6d6c7cbe793dbda448e19d3d70267e10";
	
	private $userName = "";
	private $title = "title";
	private $artwork = "artwork_url";
	private $genre = "genre";
	
	public function newQuery($query){
		$this->userName = $_POST["query"]; 
		
		$queryResult = $this->retrieveData($query);
		
		if($queryResult != false){
			return $queryResult;
		}
		else{
			return "Ett fel uppstog i sökningen! Sorry!";
		}	
	}
	
	/*
	 * @param string
	 * @return data
	 */
	public function retrieveData($query){
		$searchURL = self::$baseURL . $query . self::$endURL;
						
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $searchURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if ($httpstatus == "404" || $httpstatus == "500" || $httpstatus != "200") {
	        return false;
        }
		
		// TODO: Fix cleanup function to show a proper tracklist!
		$trackList = json_decode($data);
		$cleanData = $this->cleanData($trackList);
		
		return json_encode($cleanData);
	}
	
	public function cleanData($trackList){
		$cleanData = array();
		
		foreach($trackList as $track){
			$cleanTrack = array();	
			
			if(array_key_exists($this->title, $track)){
				$cleanTrack[$this->title] = "<p><b>Title: </b>" . $track->title . "</p>";
			}
			else{
				$cleanTrack[$this->title] = "Not availible.";
			}
			if(array_key_exists($this->artwork, $track)){
				
				$cleanTrack[$this->artwork] = "<img class='floatleft' src='";
				
				if($track->artwork_url == null){
					$cleanTrack[$this->artwork] .= "media/pics/defaultartwork.png' />";
				}
				else{
					$cleanTrack[$this->artwork] .= $track->artwork_url . "' />";	
				}
			}
			if(array_key_exists($this->genre, $track)){
				if($track->genre == ""){
					$cleanTrack[$this->genre] = "<p><b>Genre: </b>Not availible</p>";
				}
				else{
					$cleanTrack[$this->genre] = "<p><b>Genre: </b>" . $track->genre . "</p>";
				}
			}
			
			array_push($cleanData, $cleanTrack);
		}	
			
		return $cleanData;
	}
}

$query = new queryController();

if(isset($_POST["query"])){
	$queryResult = $query->newQuery($_POST["query"]);
	
	if($queryResult != false){
		echo $queryResult;
	}
	else{
		echo "FAIL";
	}
}
