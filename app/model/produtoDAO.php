<?php
//require('app/model/produto.php');

class ProdutoDAO 
{
	private $con;

	function __construct()
	{
		$base = new Conexao(array('localhost','mercado','root',''));
		$this->con = $base->getConnection();
	}

	public function cadastra($tabela,$produto){
		//print_r($produto);
		$sql = "INSERT INTO $tabela VALUES (?,?,?,?,?,?)";
				$stmt = $this->con->prepare($sql);
				$stmt->bindValue(1,NULL);
				$stmt->bindValue(2,$produto->getProduto());
				$stmt->bindValue(3,$produto->getValor());
				$stmt->bindValue(4,$produto->getDescricao());
				$stmt->bindValue(5,$produto->getCategoria()->getId());
				$stmt->bindValue(6,$produto->getFornecedor()->getId());
					if($stmt->execute()){
						return TRUE;
					}else {
						print_r($stmt->errorInfo());
						return FALSE;
					}	
	
	}
	public function lista($sql){
		$sql = $sql;
		$stmt = $this->con->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll();
		return $result;
	}

	public function listaId($sql,$id){
		$sql = $sql;
			$stmt = $this->con->prepare($sql);
			$stmt->bindValue(":id",$id);
				$stmt->execute();

		$result = $stmt->fetchAll();
		return $result;
	}

	public function editar($data){
		$sql = "UPDATE produto SET". 
			   " produto = ? , valor = ?, descricao = ?, fk_categoria = ?, fk_fornecedor = ? ".
			   " WHERE id = ?";
			//echo var_dump($data);
			/**/
			$stmt = $this->con->prepare($sql);
			
			$p = $data->getProduto();
			$v = $data->getValor();
			$d = $data->getDescricao();
			$fc = $data->getCategoria()->getId();
			$ff = $data->getFornecedor()->getId();
			$id = $data->getId();
				$stmt->bindParam(1,$p);
				$stmt->bindParam(2,$v);
				$stmt->bindParam(3,$d);
				$stmt->bindParam(4,$fc);
				$stmt->bindParam(5,$ff);
				$stmt->bindParam(6,$id);
					if($stmt->execute()){
						print_r($stmt);
						return TRUE;
					}else {
						print_r($stmt->errorInfo());
						return FALSE;
					}
			/**/			   
	}

	public function excluir($id){
		$sql = "DELETE from  produto WHERE id = :id";
		$stmt = $this->con->prepare($sql);
		$stmt->bindParam(':id',$id);
			if($stmt->execute()) {
				return TRUE;
			} else {
				return FALSE;
			}

	}

	function popularClasse($id){
		$sql = "SELECT id, produto, valor, descricao ,fk_categoria, fk_fornecedor FROM produto WHERE id = ?";	
			$stmt = $this->con->prepare($sql);
				$stmt->bindValue(1,$id);
					$stmt->execute();
						$result = $stmt->fetchAll();
						
							return $result;		
	}
}
?>