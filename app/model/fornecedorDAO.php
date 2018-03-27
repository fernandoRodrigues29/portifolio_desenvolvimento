<?php
//require('app/conexao/conexao.php');
//require('app/model/fornecedor.php');
class FornecedorDAO 
{
	private $con;

	function __construct()
	{
		$base = new Conexao(array('localhost','mercado','root',''));
		$this->con = $base->getConnection();
	}
	public function cadastra($tabela,$fornecedor){
		$sql = "INSERT INTO $tabela VALUES (?,?)";
			$stmt = $this->con->prepare($sql);
				$stmt->bindValue(1,NULL);
				$stmt->bindValue(2,$fornecedor->getFornecedor());
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
		$sql = $sql;
			$stmt = $this->con->prepare($sql);
			$stmt->bindValue(":id",$id);
				$stmt->execute();

		$result = $stmt->fetchAll();
		return $result;
	}

	public function editar($sql,$data){
		$sql = "UPDATE fornecedor SET". 
			   " fornecedor = ? ".
			   " WHERE id = ?";
			$stmt = $this->con->prepare($sql);
				$categoria =  $data->getFornecedor();
				$id =  $data->getId();
				
				$stmt->bindParam(1,$categoria);
				$stmt->bindParam(2,$id);
				
				/**/
					if($stmt->execute()){
						return TRUE;
					}else {
						print_r($stmt->errorInfo());
						return FALSE;

					}
				/**/		   
	}


	public function excluir($id){
		$sql = "DELETE from  fornecedor WHERE id = :id";
		$stmt = $this->con->prepare($sql);
		$stmt->bindParam(':id',$id);
			if($stmt->execute()) {
				return TRUE;
			} else {
				return FALSE;
			}

	}
		public function popularBean($fornecedor,$id){
			$sql = "SELECT id, fornecedor FROM fornecedor WHERE id = :id";
			$stmt = $this->con->prepare($sql);
			$stmt->bindValue(":id",$id);
				$stmt->execute();

		$result = $stmt->fetchAll();
		foreach ($result as $key => $value) {
			$fornecedor->setId($value['id']);
			$fornecedor->setFornecedor($value['fornecedor']);
		}
		return $fornecedor;
	}	
}
?>