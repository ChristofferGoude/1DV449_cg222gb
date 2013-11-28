<?php
namespace View;

class scraperView{
	/**
	 * @var $newScrape (The button for initiating a new scrape)
	 */
	private static $newScrape = "self::newScrape";
	private $message = "";
	
	/**
	 * @param $scrapeResult (The result from the scrape, empty if nothing has been scraped)
	 */
	public function drawPage($scrapeResult){
		return "<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'
				'http://www.w3.org/TR/html4/strict.dtd'>
				<html xmlns='http://www.w3.org/1999/xhtml' lang='en'>
				<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			    	<link rel='stylesheet' media='screen' href='stylesheet.css'>
					<title>Välkommen!</title>
					<meta name='author' content='Christoffer' />
				</head>
				<body>
					<div id='wrapper'>
						<h2>Välkommen till denna lilla webbskrapa</h1>
						<p>Klicka nedan för att göra en ny skrapning!</p>
						<p class='messages'>" . $this->message . "</p>
						<form action='?' method='POST'>
							<input type='submit' name='" . self::$newScrape . "' value='Ny skrapning' />
						</form>
						<p>
							" . $scrapeResult . "
						</p>
					</div>	
				</body>	
				</html>";
	}
	
	/**
	 * @param $string (The error message)
	 */
	public function setErrorMessage($string){
		$this->message = $string;
	}
	
	/**
	 * @return boolean (Wether or not the user initiates new scrape)
	 */
	public function newScrape(){
		return isset($_POST[self::$newScrape]);
	}
}
