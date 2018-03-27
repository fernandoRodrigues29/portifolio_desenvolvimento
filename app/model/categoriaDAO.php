<?php
/**
require('app/conexao/conexao.php');
require('app/model/categoria.php');
/**/
class CategoriaDAO 
{
	private $con;

	function __construct()
	{
		$base = new Conexao(array('localhost','mercado','root',''));
		$this->con = $base->getConnection();
	}
	public function cadastra($tabela,$categoria){
		$sql = "INSERT INTO $tabela VALUES (?,?)";
			$stmt = $this->con->prepare($sql);
				$stmt->bindValue(1,NULL);
				$stmt->bindValue(2,$categoria->getCategoria());
					if($stmt->execute()){
						return TRUE;
					}else {
						return $stmt->errorInfo();
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
		//$sql = $sql;
			$stmt = $this->con->prepare($sql);
			$stmt->bindValue(":id",$id);
				$stmt->execute();

		$result = $stmt->fetchAll();
		return $result;
	}

	public function editar($data){
		$sql = "UPDATE categoria SET". 
			   " categoria = ? ".
			   " WHERE id = ?";
			$stmt = $this->con->prepare($sql);
				$stmt->bindParam(1,$data['categoria']);
				$stmt->bindParam(2,$data['id']);
					if($stmt->execute()){
						return TRUE;
					}else {
						print_r($stmt->errorInfo());
						return FALSE;

					}	   
	}


	public function excluir($id){
		$sql = "DELETE from  categoria WHERE id = :id";
		$stmt = $this->con->prepare($sql);
		$stmt->bindParam(':id',$id);
			if($stmt->execute()) {
				return TRUE;
			} else {
				return FALSE;
			}

	}

	public function popularBean($categoria,$id){
			$sql = "SELECT id, categoria FROM categoria WHERE id = :id";
			$stmt = $this->con->prepare($sql);
			$stmt->bindValue(":id",$id);
				$stmt->execute();

		$result = $stmt->fetchAll();
		foreach ($result as $key => $value) {
			$categoria->setId($value['id']);
			$categoria->setCategoria($value['categoria']);
		}
		return $categoria;
	}	
}
?>