<?php
namespace Model;

class webScraper{
	private static $url = "http://vhost3.lnu.se:20080/~1dv449/scrape/secure";
	private $loginData;
	
	public function __construct(){
	 $this->loginData = array("username" => "admin",
							  "password" => "admin");	
	}
	
	//TODO: Finish all calls to get a list of information after the scrape
	public function doWebScrape(){
		$url = $this->tryLogin();
		$unparsedData = $this->getUrlToScrape($url);
	}
	
	//TODO: Fix login, A function to get the nodelist, A function to get info and more...
	/**
	 * @return
	 */
	public function tryLogin(){
		//TODO: Implement some cookiejar perhaps?	
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->loginData);
        
		$data = curl_exec($ch);
        $checkedURL = "";

        if (preg_match("#Location: (.*)#", $data, $return)) {
			$location = trim($return[1]);
			$checkedURL = self::$baseUrl.$location;
        }
        return $checkedURL;
		
	}
	
	/**
	 * @param $url (The url of the page to be scraped)
	 * @return String (The url to scrape, if there is an error, the url is set to nothing)
	 */
    public function getUrlToScrape($url) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $data = curl_exec($ch);
		$checkHTTP = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if($checkHTTP == "404"){
			$data = "";
		}
		
	    return $data;
	}
}
