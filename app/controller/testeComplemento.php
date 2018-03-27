<?php
require("app/view/view.php");
class TesteComplemento 
{
	function __construct()	{
		$data['titulo'] = 'default';
		new View('listar.php',$data);
	}
}
?>