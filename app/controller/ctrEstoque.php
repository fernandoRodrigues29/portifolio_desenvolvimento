<?php
//require('app/model/estoqueDAO.php');
class CtrEstoque {
	private $produtoDAO;
	private $categoriaDAO;
	private $fornecedorDAO;
	private $estoqueDAO;
	private $produto;
	private $categoria;
	private $fornecedor;
	private $estoque;
	function __construct()
	{
		if(!isset($_SESSION['logado'])){
			$_SESSION['msg'] = "area restrita!";
			$url = 'http://localhost:8090/Login/index';
			header('Location: '.$url);
		}
		$this->produtoDAO = new ProdutoDAO();
		$this->categoriaDAO = new CategoriaDAO();
		$this->fonecedorDAO = new FornecedorDAO();
		$this->estoqueDAO = new EstoqueDAO();
		
		$this->produto = new Produto();
		$this->categoria = new Categoria();
		$this->fornecedor = new Fornecedor();
		$this->estoque = new Estoque();
		//$this->carregar();
	}

	function index(){
		$this->carregar();
	}

	function carregar(){
		$data['titulo'] = 'Estoque';
			$sql = "SELECT e.id as id, p.produto as produto, e.qtd as qtd, e.status as status FROM produto as p,estoque as e ".
				   "WHERE p.id = e.produto";
			$rs = $this->estoqueDAO->lista($sql);
				$data['lista'] = $rs;
					$data['campo'] = "produto";
						new View('listar.php',$data);
	}
	
	function cad(){


		$data['form'] = array(
			 array(
				'name' => 'qtd',
				'label' =>'Quantidade',
				'type'  => 'text',
				'place' => 'Quantidade',
				'value' => '',
				'class' => ''
				),
			 array(
				'name' => 'status',
				'label' =>'Status',
				'type'  => 'text',
				'place' => 'Status',
				'value' => '',
				'class' => ''
				),
			);
		//carregar select
			//categoria
			$sql = "SELECT id,produto FROM produto";
				$rsProduto  = $this->produtoDAO->lista($sql);
		
			$data['form_select'] =  array(
					array(
						'name'  => 'produto',
						'label' => 'Produto',
						'rs'    => $rsProduto
					)
				);					

		if($_POST){
				$this->produto->setId($_POST['produto']);
				$this->estoque->setProduto($this->produto);
				$this->estoque->setQtd($_POST['qtd']);
				$this->estoque->setStatus($_POST['status']);
				$rs = $this->estoqueDAO->cadastra('estoque',$this->estoque);
				if($rs){
					$_SESSION['msg'] = "cadastro com sucesso";
				}else{
					$_SESSION['msg'] = "erro no cadastro cadastro";
				}
		}		
		$data['form_action'] ='cad';
		$data['titulo'] = 'Estoque - Cadastrar';
		new View('cad.php',$data);
	}
	
	function editar($id){
		if(isset($id)) {
			$id = intval($id);
			$sql = "SELECT  produto,qtd,status FROM estoque WHERE id = :id";
			$rs = $this->produtoDAO->listaId($sql,$id);
			
			$sql = "SELECT id,produto FROM produto";
				$rsProduto  = $this->estoqueDAO->lista($sql);
		
			foreach ($rs as $key => $value) {
				$data['form'] = array(
							array(
								'name' => 'qtd',
								'label' =>'Quantidade',
								'type'  => 'text',
								'place' => 'Quantidade',
								'value' =>$value['qtd'],
								'class' => ''
								),
							array(
								'name' => 'status',
								'label' =>'Status',
								'type'  => 'text',
								'place' => 'Status',
								'value' =>$value['status'],
								'class' => ''
								)																						
						);
				$data['form_select'] =  array(
					array(
						'name'  => 'produto',
						'label' => 'Produto',
						'rs'    => $rsProduto,
						'select' => $value['produto']
					)
				);				
			}

			$data['id_hidden'] = $id;
			$data['form_action'] ='/CtrEstoque/postEditar';
			$data['titulo'] = 'Estoque - Editar';
			new View('editar.php',$data);
				
		}  
	}

	function postEditar(){
		if($_POST){
				echo "<pre>";
				$this->estoque->setId($_POST['id']);
				$this->produto->setId($_POST['produto']);
				$this->estoque->setProduto($this->produto);
				$this->estoque->setQtd($_POST['qtd']);
				$this->estoque->setStatus($_POST['status']);
				//print_r($this->estoque);
				if($this->estoqueDAO->editar($this->estoque)){
					$_SESSION['msg'] = "atualizado com sucesso";	
				}else{
					$_SESSION['msg'] = "erro na atualização";
				}
				/**/
				$url = 'http://localhost:8090/CtrEstoque/carregar';
						header('Location: ' . $url);
				/**/		
		}
	}
	
	function excluir($id){
		$id = intval($id);
		$rs = $this->estoqueDAO->excluir($id);
		  if($rs){
			$_SESSION['msg'] = "excluido com sucesso";
		  }else{
			$_SESSION['msg'] = "erro na exclusão";
		  }
		  	$url = 'http://localhost:8090/CtrEstoque/carregar';
			header('Location: ' . $url);
	}	
}
?>