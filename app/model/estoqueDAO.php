<?php
//require('app/model/estoque.php');

class EstoqueDAO 
{
	private $con;

	function __construct()
	{
		$base = new Conexao(array('localhost','mercado','root',''));
		$this->con = $base->getConnection();
	}

	public function cadastra($tabela,$estoque){
		//print_r($produto);
		$sql = "INSERT INTO $tabela VALUES (?,?,?,?)";
				print_r($estoque);
				$stmt = $this->con->prepare($sql);
				$stmt->bindValue(1,NULL);
				$stmt->bindValue(2,$estoque->getProduto()->getId());
				$stmt->bindValue(3,$estoque->getQtd());
				$stmt->bindValue(4,$estoque->getStatus());
					if($stmt->execute()){
						return TRUE;
					}else {
						//print_r($stmt->errorInfo());
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

	public function editar($estoque){
		$sql = "UPDATE estoque SET". 
			   " produto = ? , qtd = ?, status = ? ".
			   " WHERE id = ?";
			$stmt = $this->con->prepare($sql);
				$idP = $estoque->getProduto()->getId();
				$qtd = $estoque->getQtd();
				$status = $estoque->getStatus();
				$id = $estoque->getId();
				
					$stmt->bindParam(1,$idP);
					$stmt->bindParam(2,$qtd);
					$stmt->bindParam(3,$status);
					$stmt->bindParam(4,$id);
						if($stmt->execute()){
							print_r($stmt);
							return TRUE;
						}else {
							print_r($stmt->errorInfo());
							return FALSE;
						}
	}

	public function excluir($id){
		$sql = "DELETE from  estoque WHERE id = :id";
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