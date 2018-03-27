<?php
class ConfigDAO 
{
	private $con;
	function __construct()
	{
		$base = new Conexao(array('localhost','mercado','root',''));
		$this->con = $base->getConnection();
	}
	function cadLogin($tabela,$data){
		$sql = "INSERT INTO $tabela VALUES (?,?,?,?)";
			$stmt = $this->con->prepare($sql);
				$stmt->bindValue(1,NULL);
				$stmt->bindValue(2,$data['usuario']);
				$stmt->bindValue(3,$data['senha']);
				$stmt->bindValue(4,$data['nome']);
					if($stmt->execute()){
						return TRUE;
					}else {
						return FALSE;
					}		
	}

	function autenticarUsuario($tabela,$data){
		$sql = "SELECT id FROM $tabela WHERE usuario = ? AND senha = ?";
		$stmt = $this->con->prepare($sql);
			$stmt->bindValue(1,$data['usuario']);
			$stmt->bindValue(2,$data['senha']);
				$stmt->execute();
				$result = $stmt->fetchAll();
					if(count($result) > 0){
						return TRUE;
					}else{
						return FALSE;
					} 
	}
}
?> 