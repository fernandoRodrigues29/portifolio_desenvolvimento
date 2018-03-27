<?php
class Categoria {
	public $id;
	public $categoria;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id; 
	}

	public function getCategoria(){
		return $this->categoria;
	}

	public function setCategoria($categoria){
		$this->categoria = $categoria;
	}

}
?>