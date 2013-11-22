<?php
namespace Model;

class webScraper{
	private static $url = "http://vhost3.lnu.se:20080/~1dv449/scrape/";
	private static $secureUrl = "http://vhost3.lnu.se:20080/~1dv449/scrape/secure";
	private static $login = "http://vhost3.lnu.se:20080/~1dv449/scrape/check.php";
	private static $cookies = "/cookie.txt";
	private $loginData;
	private $itemArray = array();
	
	public function __construct(){
	 $this->loginData = array("username" => "admin",
							  "password" => "admin");	
	}
	
	//TODO: Finish all calls to get a list of information after the scrape
	public function doWebScrape(){
		$url = $this->tryLogin();
		var_dump($url);
		//Checks if the login worked, and starts scraping if it did.
		if(!empty($url)){
			$targetUrl = $this->getUrlToScrape($url);
			$nodeList = $this->getNodeList($targetUrl, "//tr//td/a");			
		}
		else{
			throw new \Exception("Inloggningen misslyckades!");
		}
	}
	
	//TODO: Fix login, A function to get the nodelist, A function to get info and more...
	/**
	 * @return
	 */
	public function tryLogin(){	
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$login);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->loginData);
		curl_setopt($ch, CURLOPT_COOKIEJAR, self::$cookies);
        
		$data = curl_exec($ch);
        $checkedURL = "";
		var_dump($data);

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
	
	/**
	 * @param $url (The url to to grab DOM-nodes from)
	 * @param $DOMtarget (The target for the DOM to get nodes from)
	 * @return Array (List of nodes to scrape)
	 */
	public function getNodeList($url, $DOMtarget){
		$dom = new \DomDocument();		

		if ($dom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' . $url)) {
			$xPath = new \DOMXPath($dom);
			$DOMitems = $xPath->query($DOMtarget);
			return $DOMitems;
		}
		return false;
	}
	
	//TODO: Finish this when scraping is done
	/**
	 * @param $items (A list of the items to be saved)
	 */
	public function saveScrapeResult($items){
		foreach($items as $item){
			//file_put_contents("scraperesult.txt", $data);	
		}
	}
	
	/**
	 * @return String (The results from the scraping);
	 */
	public function getScrapeResult(){
		$scrapeResult = file_get_contents("scraperesult.txt");
		
		if($scrapeResult != ""){
			return $scrapeResult;
		}
		else{
			throw new \Exception("Det finns inget skrapningsresultat att visa!");
		}
	}
}