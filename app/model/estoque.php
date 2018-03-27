<?php
class Estoque
{
	private $id;
	private $Produto;
	private $qtd;
	private $status;


    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }    

    public function getProduto()
    {
        return $this->Produto;
    }

    public function setProduto($Produto)
    {
        $this->Produto = $Produto;

    }

    public function getQtd()
    {
        return $this->qtd;
    }

    public function setQtd($qtd)
    {
        $this->qtd = $qtd;

    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

    }
}
?>