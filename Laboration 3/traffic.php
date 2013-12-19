<?php

class trafficInfo{
	private static $trafficURL =  "http://api.sr.se/api/v2/traffic/messages/size=100?pagination=false&format=json&sort=Date[desc]";
	
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
		
        return json_encode($cleanData);	
	
	}
	
	/**
	 * @param $uncleanData (Den oredigerade JSON-datan)
	 * @return Array (En array med upprensad data)
	 */
	private function cleanData($uncleanData){
		$cleanData = array();
		
		$priority = "priority";
		$createddate = "createddate";
		$title = "title";
		$description = "description";
		$latitude = "latitude";
		$longitude = "longitude";
		$category = "category";
		
		foreach($uncleanData as $message){
			$cleanMessage = array();	
			
			if(array_key_exists($priority, $message)){
				// TODO: Lägg till funktionalitet för olika markers
				
				if($message[$priority] == 1){
					$cleanMessage[$priority] = "Mycket allvarlig händelse";
				}
				else if($message[$priority] == 2){
					$cleanMessage[$priority] = "Stor händelse";
				}
				else if($message[$priority] == 3){
					$cleanMessage[$priority] = "Störning";
				}
				else if($message[$priority] == 4){
					$cleanMessage[$priority] = "Information";
				}
				else if($message[$priority] == 5){
					$cleanMessage[$priority] = "Mindre störning";
				}				
			}
			else{
				$cleanMessage[$priority] = "Information";
			}
			if(array_key_exists($createddate, $message)){
				$cleanMessage[$createddate] = $this->convertTime($message[$createddate]);
			}
			else{
				$cleanMessage[$createddate] = "Datum ej tillgängligt";
			}
			if(array_key_exists($title, $message)){
				$cleanMessage[$title] = $message[$title];
			}
			else{
				$cleanMessage[$title] = "Titel ej tillgänglig";
			}
			if(array_key_exists($description, $message)){
				$cleanMessage[$description] = $message[$description];
			}
			else{
				$cleanMessage[$description] = "Beskrivning ej tillgänglig";
			}
			if(array_key_exists($latitude, $message)){
				$cleanMessage[$latitude] = $message[$latitude];
			}
			else{
				$cleanMessage[$latitude] = 62;
			}
			if(array_key_exists($longitude, $message)){
				$cleanMessage[$longitude] = $message[$longitude];
			}
			else{
				$cleanMessage[$longitude] = 18;
			}
			if(array_key_exists($category, $message)){
				if($message[$category] == 0){
					$cleanMessage[$category] = "Vägtrafik";
				}
				else if($message[$category] == 1){
					$cleanMessage[$category] = "Kollektivtrafik";
				}
				else if($message[$category] == 2){
					$cleanMessage[$category] = "Planerad störning";
				}
				else if($message[$category] == 3){
					$cleanMessage[$category] = "Övrigt";
				}						
			}
			else{
				$cleanMessage[$category] = "Övrigt";
			}
			
			array_push($cleanData, $cleanMessage);
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




