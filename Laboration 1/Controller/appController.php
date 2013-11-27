<?php
namespace Controller;

require_once("Model/webScraper.php");
require_once("View/scraperView.php");

class appController{
		
	private $model;
	private $view;
	private $scrapeResult = "";
	
	public function __construct(){
		$this->model = new \Model\webScraper();
		$this->view = new \View\scraperView();
		$this->scrapeResult = $this->model->getScrapeResult();
	}
	
	/**
	 * @return String (Html to draw page)
	 */
	public function runApp(){
		if($this->view->newScrape()){
			try{
				$this->scrapeResult = $this->model->doWebScrape();
			}
			catch(\Exception $e){
				$this->view->setErrorMessage($e->getMessage());
			}
		}
		
		return $this->view->drawPage($this->scrapeResult);	
	}
}
