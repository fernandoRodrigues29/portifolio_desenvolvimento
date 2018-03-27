<?php
/*usava antes do classmap*/
	function __autoload($class_name){
	$archives = ['app/conexao/'.$class_name.'.php',
			'app/controller/'.$class_name.'.php',
			'app/model/'.$class_name.'.php',
			'app/view/'.$class_name.'.php'];
		
		foreach ($archives as $archive) {
			if(file_exists($archive)){
				require_once $archive;		
			}
		}
		
	}
?>