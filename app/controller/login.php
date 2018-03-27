<?php
class Login 
{
	
	function __construct()
	{
		$this->configDAO = new ConfigDAO();

	}

	function index(){
		new ViewLogin('telaLogin.php');
	}

	function auth(){
		if($_POST){
			echo "<pre>";
			print_r($_POST);
			$data['usuario'] = $_POST['usuario'];
			$data['senha'] = md5($_POST['senha']);

			if($this->configDAO->autenticarUsuario('usuario',$data)){
				$_SESSION['logado'] = TRUE;
					$url = 'http://localhost:8090';
						header('Location: '.$url);				
			}else{
				$_SESSION['msg'] = "usuario não encontrado!";
					$url = 'http://localhost:8090/Login/index';
							header('Location: '.$url);
			}
		}
	}
	function cad(){

		if($_POST){
			$data['nome'] = $_POST['nome'];
			$data['usuario'] = $_POST['usuario'];
			$data['senha'] = md5($_POST['senha']);
				if ($this->configDAO->cadLogin('usuario',$data)) {
					$_SESSION['msg'] = "usuario cadastrado com sucesso!";
				}else {
					$_SESSION['msg'] = "erro no cadastro do usuario!";
				}
					$url = 'http://localhost:8090/Login/index';
						header('Location: '.$url);
		}
		new ViewLogin('formLogin.php');
	}


	function sair(){
		unset($_SESSION['logado']);
		$url = 'http://localhost:8090/Login/index';
						header('Location: '.$url);
	}	
}
?>
