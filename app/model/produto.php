<?php

class Produto 
{
    private $id;
	private $produto;
    private $descricao;
	private $valor;
    private $categoria;
    private $fornecedor;

	public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return  $this->id;
    }

    public function setProduto($produto)
    {
        $this->produto = $produto;

    }
     public function getProduto()
    {
       return $this->produto;

    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

    }
    
    public function setValor($valor)
    {
        $this->valor = $valor;

    }

    public function getValor()
    {
        return $this->valor;
    }    

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

    }

    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    public function setFornecedor($fornecedor)
    {
        $this->fornecedor = $fornecedor;

    }
}
?>