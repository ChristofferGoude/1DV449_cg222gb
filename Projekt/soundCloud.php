<?php
    
class soundCloudController{
	private static $baseURL = "http://api.soundcloud.com/users/";
	private static $endURL = ".json?client_id=6d6c7cbe793dbda448e19d3d70267e10";
	private static $tracks = "/tracks";
	
	private $cleanUser  = array();
	private $cleanTracks = array();
	
	private $user = "user";
	private $username = "username";
	private $title = "title";
	private $artwork = "artwork_url";
	private $avatar_url = "avatar_url";
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
	
	/*
	 * @param string
	 * @return data
	 */
	public function retrieveUser($query){
		$searchURL = self::$baseURL . $query . self::$endURL;
						
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
	
	/*
	 * @param string
	 * @return data
	 */
	public function retrieveTracks($query){
		$searchURL = self::$baseURL . $query . self::$tracks . self::$endURL;
						
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $searchURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if ($httpstatus == "404" || $httpstatus == "500") {
	        return false;
        }
		
		// TODO: Fix cleanup function to show a proper tracklist!
		$trackList = json_decode($data);
		$cleanTracks = $this->cleanUpTracks($trackList);
		
		return json_encode($cleanTracks);
	}
	
	public function cleanUpUser($user){
		$cleanUser = array();
		
		if($user->username != null && $user->username != ""){
			$cleanUser[$this->username] = "<h3 class='text-center'>" . $user->username . "</h3>";
		}
		else{
			$cleanUser[$this->username] = "<h3 class='text-center'>Username not availible</h3>";
		}
		if($user->avatar_url != null && $user->avatar_url != ""){
			$cleanUser[$this->avatar_url] = "<img class='center-block img-circle' src='" . $user->avatar_url . "' width='100' height='100' />";
		}
		else{
			$cleanUser[$this->avatar_url] = "<img class='center-block img-circle' src='media/pics/defaultartwork.png' width='100' height='100' />";
		}
		
		if(empty($cleanUser)){
			$cleanUser[$this->username] = "<h3 class='text-center'>User not found</h3>";
			$cleanUser[$this->avatar_url] = "<img class='center-block img-circle' src='media/pics/defaultartwork.png' width='100' height='100' />";
		}

		return $cleanUser;
	}
	
	public function cleanUpTracks($trackList){
		$cleanTrackList = array();
		
		foreach($trackList as $track){
			$cleanTrack = array();	
			
			if(array_key_exists($this->title, $track)){
				$cleanTrack[$this->title] = "<p><b>Title: </b>" . $track->title . "</p>";
			}
			else{
				$cleanTrack[$this->title] = "Not availible.";
			}
			if(array_key_exists($this->artwork, $track)){
				
				$cleanTrack[$this->artwork] = "<img class='floatleft img-circle' src='";
				
				if($track->artwork_url == null){
					$cleanTrack[$this->artwork] .= "media/pics/defaultartwork.png' />";
				}
				else{
					$cleanTrack[$this->artwork] .= $track->artwork_url . "' />";	
				}
			}
			if(array_key_exists($this->permalink_url, $track)){
				$cleanTrack[$this->permalink_url] = "<p><b>Link: </b><a href='" . $track->permalink_url . "' target='_blank'>" . $track->title . "</a></p>";
			}
			else{
				$cleanTrack[$this->permalink_url] = "<p><b>Link: </b>Not availible</p>";
			}
			
			array_push($cleanTrackList, $cleanTrack);
		}	
		
		if(empty($cleanTrackList)){
			$noTrack = array();
			$noTrack[$this->title] = "<p class='text-center'>Nothing was found here, we're sorry for this!</p>";
			$noTrack[$this->genre] = "";
			$noTrack[$this->permalink_url] = "";
			
			array_push($cleanTrackList, $noTrack);
		}	
		return $cleanTrackList;
	}
}

$query = new soundCloudController();

if(isset($_POST["user"])){
	$queryResult = $query->newUserQuery($_POST["user"]);
	
	echo $queryResult;
}

if(isset($_POST["tracks"])){
	$queryResult = $query->newTrackQuery($_POST["tracks"]);	

	echo $queryResult;
}
