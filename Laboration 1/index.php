<?php

require_once("Controller/appController.php");

session_start();
$run = new \Controller\appController();

echo $run->runApp();
