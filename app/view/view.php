<?php
class View 
{
	function __construct($url,$data)
	{
		$conteudo = $data;
		include('template/principal.php');		
	}
}
?>