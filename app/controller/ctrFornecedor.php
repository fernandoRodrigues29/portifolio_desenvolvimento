<?php
//require('app/model/fornecedorDAO.php');
class CtrFornecedor {
	private $catDAO;
	private $fornecedor;
	function __construct()
	{
		if(!isset($_SESSION['logado'])){
			$_SESSION['msg'] = "area restrita!";
			$url = 'http://localhost:8090/Login/index';
			header('Location: '.$url);
		}		
		$this->fornecedorDAO = new FornecedorDAO();
		$this->fornecedor = new Fornecedor();
		//$this->carregar();
	}

	function index(){

		$this->carregar();
	}
	function carregar(){
		$data['titulo'] = 'Fornecedor';
			$rs = $this->fornecedorDAO->lista('SELECT id, fornecedor FROM fornecedor');
				$data['lista'] = $rs;
					$data['campo'] = "fornecedor";
						new View('listar.php',$data);
	}
	function cad(){

		$data['form'] = array(
			'nome' => array(
				'name' => 'fornecedor',
				'label' =>'fornecedor',
				'type'  => 'text',
				'place' => 'fornecedor',
				'value' => '',
				'class' => ''
				)					
			);
		if($_POST){
			$pf = $_POST['fornecedor'];
				$this->fornecedor->setFornecedor($pf);
					$rs = $this->fornecedorDAO->cadastra('fornecedor',$this->fornecedor);
					if($rs != FALSE){
						$_SESSION['msg'] = "cadastrado com sucesso";
						
					}else{
					   $_SESSION['msg'] = "erro no cadastro";
					}
		}		

		$data['form_action'] ='cad';
		$data['titulo'] = 'Fornecedor - Cadastrar';
		new View('cad.php',$data);
	}
	
	function editar($id){
		if(isset($id)) {
			$id = intval($id);
			$sql = "SELECT  fornecedor FROM fornecedor WHERE id = :id";
			$rs = $this->fornecedorDAO->listaId($sql,$id);
				$campos = $rs[0];
					$form_campo = $campos['fornecedor'];
						
						$data['form'] = array(
							'nome' => array(
								'name' => 'fornecedor',
								'label' =>'nome do campo',
								'type'  => 'text',
								'place' => 'Campo Texto',
								'value' => $form_campo,
								'class' => ''
								)					
						);	
			$data['id_hidden'] = $id;
			$data['form_action'] ='/CtrFornecedor/postEditar';
			$data['titulo'] = 'Fornecedor - Editar';
			new View('editar.php',$data);		
		}  
	}

	function postEditar(){
		if($_POST){
				$this->fornecedor->setId($_POST['id']);
				$this->fornecedor->setFornecedor($_POST['fornecedor']);
				//echo var_dump($this->fornecedor);
					/**/
					$sql = "UPDATE fornecedor SET". 
						   " fornecedor = ? ".
						   " WHERE id = ?";
					$rs = $this->fornecedorDAO->editar($sql,$this->fornecedor);
						/**/
						if($rs){
							$_SESSION['msg'] = "atualizado com sucesso";
						}else{
							$_SESSION['msg'] = "erro na atualização";
						}
						/**/
					/**/	
		$url = 'http://localhost:8090/CtrFornecedor/carregar';
		header('Location: ' . $url);
		}
	}
	
	function excluir($id){
		$id = intval($id);
		$rs = $this->fornecedorDAO->excluir($id);
		  if($rs){
			$_SESSION['msg'] = "excluido com sucesso";
		  }else{
			$_SESSION['msg'] = "erro na exclusão";
		  }
		  	$url = 'http://localhost:8090/CtrFornecedor/carregar';
			header('Location: ' . $url);
	}	
}
?>