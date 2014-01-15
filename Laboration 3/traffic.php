<?php

class trafficInfo{
	private static $trafficURL =  "http://api.sr.se/api/v2/traffic/messages/size=100?pagination=false&format=json&sort=Date[desc]";
	
	private $priority = "priority";
	private $createddate = "createddate";
	private $title = "title";
	private $description = "description";
	private $latitude = "latitude";
	private $longitude = "longitude";
	private $category = "category";
	/**
	 * @return JSON || boolean (Listan med trafikinformation i JSONformat, eller false om httpstatusen är 404 eller 500)
	 */
	public function getDataFromAPI(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::$trafficURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		
		if ($httpstatus == "404" || $httpstatus == "500") {
	        return false;
        }

        $trafficInfo = json_decode($data, true);
        $cleanData = $this->cleanData($trafficInfo["messages"]);
		
		$checkedData = $this->checkForSpecifics($cleanData);
		
        return json_encode($checkedData);	
	}
	
	/**
	 * @param $uncleanData (Den oredigerade JSON-datan)
	 * @return Array (En array med upprensad data)
	 */
	private function cleanData($uncleanData){
		$cleanData = array();
		
		foreach($uncleanData as $message){
			$cleanMessage = array();	
			
			if(array_key_exists($this->priority, $message)){
				// TODO: Lägg till funktionalitet för olika markers
				
				if($message[$this->priority] == 1){
					$cleanMessage[$this->priority] = "Mycket allvarlig händelse";
				}
				else if($message[$this->priority] == 2){
					$cleanMessage[$this->priority] = "Stor händelse";
				}
				else if($message[$this->priority] == 3){
					$cleanMessage[$this->priority] = "Störning";
				}
				else if($message[$this->priority] == 4){
					$cleanMessage[$this->priority] = "Information";
				}
				else if($message[$this->priority] == 5){
					$cleanMessage[$this->priority] = "Mindre störning";
				}				
			}
			else{
				$cleanMessage[$this->priority] = "Information";
			}
			if(array_key_exists($this->createddate, $message)){
				$cleanMessage[$this->createddate] = $this->convertTime($message[$this->createddate]);
			}
			else{
				$cleanMessage[$createddate] = "Datum ej tillgängligt";
			}
			if(array_key_exists($this->title, $message)){
				$cleanMessage[$this->title] = $message[$this->title];
			}
			else{
				$cleanMessage[$this->title] = "Titel ej tillgänglig";
			}
			if(array_key_exists($this->description, $message)){
				$cleanMessage[$this->description] = $message[$this->description];
			}
			else{
				$cleanMessage[$this->description] = "Beskrivning ej tillgänglig";
			}
			if(array_key_exists($this->latitude, $message)){
				$cleanMessage[$this->latitude] = $message[$this->latitude];
			}
			else{
				$cleanMessage[$this->latitude] = 62;
			}
			if(array_key_exists($this->longitude, $message)){
				$cleanMessage[$this->longitude] = $message[$this->longitude];
			}
			else{
				$cleanMessage[$this->longitude] = 18;
			}
			if(array_key_exists($this->category, $message)){
				if($message[$this->category] == 0){
					$cleanMessage[$this->category] = "Vägtrafik";
				}
				else if($message[$this->category] == 1){
					$cleanMessage[$this->category] = "Kollektivtrafik";
				}
				else if($message[$this->category] == 2){
					$cleanMessage[$this->category] = "Planerad störning";
				}
				else if($message[$this->category] == 3){
					$cleanMessage[$this->category] = "Övrigt";
				}						
			}
			else{
				$cleanMessage[$this->category] = "Övrigt";
			}
			
			array_push($cleanData, $cleanMessage);
		}

		return $cleanData;
	}

	private function checkForSpecifics($cleanData){
		$checkedData = array();
		
		if(isset($_GET["roads"])){		
			foreach($cleanData as $message){
				if($message[$this->category] == "Vägtrafik"){
					array_push($checkedData, $message);
				}
			}
			
			$cleanData = $checkedData;
		}
		else if(isset($_GET["public"])){
			foreach($cleanData as $message){
				if($message[$this->category] == "Kollektivtrafik"){
					array_push($checkedData, $message);
				}
			}
			
			$cleanData = $checkedData;
		}
		else if(isset($_GET["planned"])){
			foreach($cleanData as $message){
				if($message[$this->category] == "Planerad störning"){
					array_push($checkedData, $message);
				}
			}
			
			$cleanData = $checkedData;
		}
		else if(isset($_GET["other"])){
			foreach($cleanData as $message){
				if($message[$this->category] == "Övrigt"){
					array_push($checkedData, $message);
				}
			}
			
			$cleanData = $checkedData;
		}
		
		return $cleanData;
	}

	/**
	 * @param $JSONtime (Tidsangivelsen från API-datat)
	 * @return String (Datumet i svenskt format, annars meddelande om att datumet inte var angivet)
	 */
    private function convertTime($JSONtime) {
        if (preg_match("/[^\(][0-9]{12}/", $JSONtime, $realTime)) {        
                $cleanTime = floor($realTime[0] / 1000);

                return date("Y-m-d \k\l H:i", $cleanTime);
        }
        return "Tid ej angiven";
    }
}

$trafficController = new trafficInfo();

if(isset($_GET["request"])){
	$trafficNews = $trafficController->getDataFromAPI();
	
	if($trafficNews != false){
		echo $trafficNews;
	}
}
else if(isset($_GET["roads"])){
	$trafficNews = $trafficController->getDataFromAPI();
	
	if($trafficNews != false){
		echo $trafficNews;
	}
}
else if(isset($_GET["public"])){
	$trafficNews = $trafficController->getDataFromAPI();
	
	if($trafficNews != false){
		echo $trafficNews;
	}
}
else if(isset($_GET["planned"])){
	$trafficNews = $trafficController->getDataFromAPI();
	
	if($trafficNews != false){
		echo $trafficNews;
	}
}
else if(isset($_GET["other"])){
	$trafficNews = $trafficController->getDataFromAPI();
	
	if($trafficNews != false){
		echo $trafficNews;
	}
}
