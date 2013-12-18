<?

class getTrafficInfo{
	private static $trafficURL =  "http://api.sr.se/api/v2/traffic/messages/size=100?pagination=false&format=json&sort=Date[desc]";
	
	public function getDataFromAPI(){
		$ch = curl.init();
		curl_setopt($ch, CURLOPT_URL, self::$trafficURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		
		if ($http_status == "404") {
	        return false;
        }

        $trafficInfo = json_decode($data, true);
        $cleanData = $this->cleanData($trafficInfo["messages"]);
		
        return json_encode($cleanData);	
	
	}
	
	private function cleanData($uncleanData){
		$cleanData = array();
		
		$createddate = "createddate";
		$title = "title";
		$description = "description";
		$latitude = "latitude";
		$longitude = "longitude";
		$category = "category";
		
		foreach($uncleanData as $message){
			$cleanMessage = array();	
				
			if(array_key_exists($createddate, $message)){
				$cleanMessage[$createddate] = $message[$createddate];
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
				$cleanMessage[$latitude] = "Latitudkoordinater ej tillgängliga";
			}
			if(array_key_exists($longitude, $message)){
				$cleanMessage[$longitude] = $message[$longitude];
			}
			else{
				$cleanMessage[$longitude] = "Longitudkoordinater ej tillgängliga";
			}
			if(array_key_exists($category, $message)){
				$cleanMessage[$category] = $message[$category];
				// TODO: Lägg till funktionalitet för olika markers
			}
			else{
				$cleanMessage[$category] = "3";
			}
			
			array_push($cleanData, $cleanMessage);
		}

		return $cleanData;
	}
}

$trafficController = new getTrafficInfo();

if(isset($_GET["request"])){
	$trafficNews = $trafficController->getDataFromAPI();
	
	if($trafficNews != false){
		echo $trafficNews;
	}
}
else{
	echo("TEST");
}




