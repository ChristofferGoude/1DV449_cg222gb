<?php
namespace Controller;

require_once("Model/webScraper.php");
require_once("View/scraperView.php");

class appController{
		
	private $model;
	private $view;
	
	public function __construct(){
		$this->model = new \Model\webScraper();
		$this->view = new \View\scraperView();
	}
	
	/**
	 * @return String (Html to draw page)
	 */
	public function runApp(){
		$this->model->doWebScrape();
		
		return $this->view->drawPage();	
	}
}
