<?php
namespace Model;

class webScraper{
	private static $url = "http://vhost3.lnu.se:20080/~1dv449/scrape/";
	private static $secureUrl = "http://vhost3.lnu.se:20080/~1dv449/scrape/secure/";
	private static $login = "http://vhost3.lnu.se:20080/~1dv449/scrape/check.php";
	private static $cookie = "/cookie.txt";
	private static $saveFile = "/scraperesult.txt";
	private static $session = "SessionHandler";
	private $loginData;
	private $itemArray = array();
	
	public function __construct(){
		$this->loginData = array(
					"username" => "admin",
					"password" => "admin");	
	}
	
	/**
	 * @return String (The result of the scrape)
	 */
	public function doWebScrape(){
		$urlToScrape = $this->tryLogin();

		//Checks if the login worked, and starts scraping if it did.
		if(empty($urlToScrape)){
			throw new \Exception("Inloggningen misslyckades!");
		}
		$targetHtml = $this->getUrlToScrape($urlToScrape);
		$nodeList = $this->getNodeList($targetHtml, "//tr//td/a");
		$companyList = $this->getCompanyList($nodeList);
		$this->doCompanyScrape($companyList);
		
		return $this->getScrapeResult();
	}

	/**
	 * @return String (The url to be scraped, empty if the login fails)
	 */
	public function tryLogin(){
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$login);
        curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->loginData);
		curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).self::$cookie);
        
		$resource = curl_exec($ch);
        $checkedURL = "";
		
		if (preg_match('#Location: (.*)#', $resource, $result)){
			$location = trim($result[1]);
			$checkedURL = self::$url.$location;
		}

        return $checkedURL;	
	}
	
	/**
	 * @param $url (The url of the page to be scraped)
	 * @return String (The HTML data to check for nodes)
	 */
	public function getUrlToScrape($url) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__).self::$cookie);
		
	    $resource = curl_exec($ch);
		$checkHTTP = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($checkHTTP == "404"){
			$resource = "";
		}
	    return $resource;
	}
	
	/**
	 * @param $url (The url to to grab DOM-nodes from)
	 * @param $DOMtarget (The target for the DOM to get nodes from)
	 * @return Array (List of nodes to scrape)
	 */
	private function getNodeList($html, $DOMtarget){
		$dom = new \DomDocument();
		libxml_use_internal_errors(true);	

		if ($dom->loadHTML($html)){
			$xPath = new \DOMXPath($dom);
			$DOMitems = $xPath->query($DOMtarget);
			return $DOMitems;
		}
		libxml_clear_errors();
		return false;
	}
	
	private function getCompanyList($nodes){
        if ($nodes == false) {
                return false;
        }
        $companyList = array();

        foreach ($nodes as $node){
            $id = 0;
			
            if (preg_match("/producent_([\d]+)/", $node->getAttribute("href"), $result)) {
                    $id = $result[1];
            }
			
            $company = array(
                    "id" => (int)$id,
                    "link" => self::$secureUrl.$node->getAttribute("href")
                    );
            array_push($companyList, $company);                        
        }
        return $companyList;
	}
	
	private function doCompanyScrape($companyLinks){
        foreach ($companyLinks as $companyLink){
            $html = $this->getUrlToScrape($companyLink["link"]);
			
            if (!empty($html)){
                $id = $companyLink["id"];
                $name = $this->getNodeList($html, "/html/body/div[2]/div/h1/text()");
                $picture = $this->getNodeList($html, "/html/body/div[2]/div/img/@src");                
                $url = $this->getNodeList($html, "/html/body/div[2]/div//a/@href");
                $location = $this->getNodeList($html, "/html/body/div[2]/div/p/span[@class = 'ort']/text()");

				// Validating the nodes and giving them proper values
				$id = "Producent-ID: " . $id;
				if($this->nodeIsNotNull($name)){
					$name = "Namn: " . $name->item(0)->nodeValue;
				}
				else{
					$name = "Namnet kunde inte hittas.";
				}
				if($this->nodeIsNotNull($picture)){
					$picture = "Bildkälla: " . $picture->item(0)->nodeValue;
				}
				else{
					$picture = "Bildens källa kunde inte hittas.";
				}
				if($this->nodeIsNotNull($url)){
					$url = "URL: " . $url->item(0)->nodeValue;
				}
				else{
					$url = "Denna url kunde inte hittas.";
				}
				if($this->nodeIsNotNull($location)){
					$location = $location->item(0)->nodeValue;	
				}
				else{
					$location = "Denna ort kunde inte hittas.";
				}
	
                $this->saveScrapeResult($id, $name, $picture, $url, $location);
        	}                
    	}                        
    }
	/**
	 * @param $node (Node to be checked)
	 * @return boolean (Wether or not node contains anything)
	 */
	private function nodeIsNotNull($node){
		if($node->length > 0){
			return true;
		}
		return false;
	}

	/**
	 * @param $id (The ID of the company)
	 * @param $name (The name of the company)
	 * @param $picSrc (The src of the picture, if there are any)
	 * @param $url (The url of the company)
	 * @param $location (The location of the company of the site)
	 */
	private function saveScrapeResult($id, $name, $picSrc, $url, $location){
		//TODO: HTML in model? Are you crazy!? Fix this please.
		$data = $id . "<br />" . 
				$name . "<br />" . 
				$picSrc . "<br />" . 
				$url . "<br />" . 
				$location . "<br />" .
				"<br /><br />";

		file_put_contents(dirname(__FILE__).self::$saveFile, $data, FILE_APPEND);
	}
	
	/**
	 * @return String (The results from the scraping)
	 */
	public function getScrapeResult(){
		$scrapeResult = file_get_contents(dirname(__FILE__).self::$saveFile);
		
		return $scrapeResult;
	}
	
	public function clearScrapeResult(){
		file_put_contents(dirname(__FILE__).self::$saveFile, "");
	}
}