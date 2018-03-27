<?php
class Fornecedor 
{
	
	private $id;
	private $fornercedor;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

    }
    
    public function getFornecedor()
    {
        return $this->fornercedor;
    }

    public function setFornecedor($fornercedor)
    {
        $this->fornercedor = $fornercedor;

    }
   
}
?>