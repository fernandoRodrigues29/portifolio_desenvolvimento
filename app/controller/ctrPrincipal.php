<?php
//require './model/categoriaDAO'
class CtrPrincipal 
{
	private catDAO = NULL;
	function __construct()
	{
		if(!isset($_SESSION['logado'])){
			$_SESSION['msg'] = "area restrita!";
			$url = 'http://localhost:8090/Login/index';
			header('Location: '.$url);
		}
		$this->catDAO = CategoriaDAO();
	}
	function carregar(){
		
	}
}
?>