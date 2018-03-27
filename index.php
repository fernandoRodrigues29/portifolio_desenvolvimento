<?php
/*
Author: Fernando Rodrigues
16 -03-2018
 */
require_once 'vendor/autoload.php';
//require('autoload.php');
session_start();
$url = $_SERVER['REQUEST_URI'];
//
	if(strlen($url) > 1){
		$url_explode = explode('/', $url);
		//echo print_r($url_explode);
		//class
		$controller = $url_explode[1];
		//method
		$method = (count($url_explode) > 2)? $url_explode[2] : '';
		$params = (count($url_explode) > 3)? $url_explode[4] : '';	
			if(!empty($method)){
					
					$estancia = new $controller();
					//$estancia = new CtrCategoria();
					if(!empty($params)){
						$estancia-> $method($params);	
					}else{
						$estancia-> $method();	
					}
						
			}else{
				new $controller();
			}
	}else{
		if(!isset($_SESSION['logado'])){
			$_SESSION['msg'] = "area restrita!";
			$url = 'http://localhost:8090/Login/index';
			header('Location: '.$url);
		}

		$classe = 'TesteComplemento';
		$estancia =  new $classe(null);
	}
	



?>