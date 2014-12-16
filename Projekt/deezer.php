<?php

class deezerController{
	private static $baseURL = "http://api.deezer.com/artist/";
	private static $tracks = "/top";
	
	private $cleanUser  = array();
	private $cleanTracks = array();
	
	private $name = "name";
	private $title = "title";
	private $link = "link";
	private $picture = "picture";
	private $avatar = "avatar_url";
	private $genre = "genre";
	private $permalink_url = "permalink_url";
	
	public function newUserQuery($query){	
		$this->cleanUser = $this->retrieveUser($query);
		
		return $this->cleanUser;
	}
	
	public function newTrackQuery($query){
		$this->cleanTracks = $this->retrieveTracks($query);
		
		return $this->cleanTracks;
	}
	
	public function retrieveUser($query){
		$searchURL = self::$baseURL . $query;
						
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $searchURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if ($httpstatus == "404" || $httpstatus == "500") {
	        return false;
        }
		
		$user = json_decode($data);
		$cleanUser = $this->cleanUpUser($user);
		
		return json_encode($cleanUser);
	}
	
	public function retrieveTracks($query){
		$searchURL = self::$baseURL . $query . self::$tracks;
						
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $searchURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if ($httpstatus == "404" || $httpstatus == "500") {
	        return false;
        }
		
		$tracks = json_decode($data);
		$cleanTracks = $this->cleanUpTracks($tracks);
		
		return json_encode($cleanTracks);
	}
	
	public function cleanUpUser($user){
		$cleanUser = array();
		
		if($user->name != null){
			$cleanUser[$this->name] = "<h3 class='text-center'>" . $user->name . "</h3>";
		}
		else{
			$cleanUser[$this->name] = "<h3 class='text-center'>Username not availible</h3>";
		}
		if($user->picture != null){
			$cleanUser[$this->picture] = "<img class='center-block img-circle' src='" . $user->picture . "' width='100' height='100' />";
		}
		else{
			$cleanUser[$this->picture] = "<img class='center-block img-circle' src='media/pics/defaultartwork.png' width='100' height='100' />";
		}
		
		return $cleanUser;
	}
	
	public function cleanUpTracks($trackList){
		$cleanTrackList = array();
		
		
		foreach($trackList->data as $track){
			$cleanTrack = array();	
			
			if(array_key_exists($this->title, $track)){
				$cleanTrack[$this->title] = "<p><b>Title: </b>" . $track->title . "</p>";
			}
			else{
				$cleanTrack[$this->title] = "<p><b>Title: </b>Not availible</p>";
			}
			if(array_key_exists($this->link, $track)){
				$cleanTrack[$this->link] = "<p><b>Link: </b><a href='" . $track->link . "' target='_blank'>" . $track->title . "</a></p>";
			}
			else{
				$cleanTrack[$this->title] = "<p><b>Link: </b>Not availible</p>";
			}
			
			array_push($cleanTrackList, $cleanTrack);
		}	
			
		return $cleanTrackList;
	}
}

$query = new deezerController();

if(isset($_POST["user"])){
	$queryResult = $query->newUserQuery($_POST["user"]);
	
	echo $queryResult;
}

if(isset($_POST["tracks"])){
	$queryResult = $query->newTrackQuery($_POST["tracks"]);	

	echo $queryResult;
}
