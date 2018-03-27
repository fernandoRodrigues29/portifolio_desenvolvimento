<?php
class CtrCategoria {
	private $catDAO;
	private $categoria;
	function __construct()
	{
		if(!isset($_SESSION['logado'])){
			$_SESSION['msg'] = "area restrita!";
			$url = 'http://localhost:8090/Login/index';
			header('Location: '.$url);
		}
		$this->catDAO = new CategoriaDAO();
		$this->categoria = new Categoria();
	}

	function index(){
		$this->carregar();
	}
	function carregar(){
		$data['titulo'] = 'Categoria';
			$rs = $this->catDAO->lista('SELECT id, categoria FROM categoria');
				$data['lista'] = $rs;
					$data['campo'] = "categoria";
						new View('listar.php',$data);
	}
	function cad(){

		$data['form'] = array(
			'nome' => array(
				'name' => 'categoria',
				'label' =>'nome do campo',
				'type'  => 'text',
				'place' => 'Campo Texto',
				'value' => '',
				'class' => ''
				)					
			);
		if($_POST){
			$pCategoria = $_POST['categoria'];
				$this->categoria->setCategoria($pCategoria);
					$rs = $this->catDAO->cadastra('categoria',$this->categoria);
					if($rs){
						$msg = " categoria ".$this->categoria->getCategoria()." cadatrada com sucesso!";
						$_SESSION['msg'] = $msg;
					}else{
					   $_SESSION['msg'] = "Erro no Cadastro";
					   // print_r($rs);
					}
		}		

		$data['form_action'] ='cad';
		$data['titulo'] = 'Categoria - Cadastrar';
		new View('cad.php',$data);
	}
	
	function editar($id){
		if(isset($id)) {
			$id = intval($id);
			$sql = "SELECT  categoria FROM categoria WHERE id = :id";
			$rs = $this->catDAO->listaId($sql,$id);
				$campos = $rs[0];
					$categoria_campo = $campos['categoria'];
						$data['form'] = array(
							'nome' => array(
								'name' => 'categoria',
								'label' =>'nome do campo',
								'type'  => 'text',
								'place' => 'Campo Texto',
								'value' => $categoria_campo,
								'class' => ''
								)					
						);	
			$data['id_hidden'] = $id;
			$data['form_action'] ='/CtrCategoria/postEditar';
			$data['titulo'] = 'Categoria - Editar';
			new View('editar.php',$data);		
		}  
	}

	function postEditar(){
		if($_POST){
			echo " no post ".$_POST['categoria'];
				$sql['categoria'] = $_POST['categoria'];
				$sql['id'] = $_POST['id'];
				echo var_dump($sql);
					$rs = $this->catDAO->editar($sql);
						if($rs){
							$msg = " categoria atualizada com sucesso!";
							$_SESSION['msg'] = $msg;
						}else{
							$_SESSION['msg'] = 'não atualizou!';
						}
		$url = 'http://localhost:8090/CtrCategoria/carregar';
		header('Location: ' . $url);
		}
	}
	
	function excluir($id){
		$id = intval($id);
		$rs = $this->catDAO->excluir($id);
		  if($rs){
			$_SESSION['msg'] = 'excluiu com sucesso!';
		  }else{
			$_SESSION['msg'] = "erro na exclusão";
		  }
		  	$url = 'http://localhost:8090/CtrCategoria/carregar';
			header('Location: ' . $url);
	}	
}
?>