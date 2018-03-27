<?php
//require('app/model/produtoDAO.php');
class CtrProduto {
	private $produtoDAO;
	private $categoriaDAO;
	private $fornecedorDAO;
	private $produto;
	private $categoria;
	private $fornecedor;
	function __construct()
	{
		if(!isset($_SESSION['logado'])){
			$_SESSION['msg'] = "area restrita!";
			$url = 'http://localhost:8090/Login/index';
			header('Location: '.$url);
		}
		$this->produtoDAO = new ProdutoDAO();
		$this->categoriaDAO = new CategoriaDAO();
		$this->fornecedorDAO = new FornecedorDAO();
		
		$this->produto = new Produto();
		$this->categoria = new Categoria();
		$this->fornecedor = new Fornecedor();
		
	}

	function index(){
		$this->carregar();
	}

	function carregar(){
		$data['titulo'] = 'produto';
			$rs = $this->produtoDAO->lista('SELECT id, produto, valor, descricao FROM produto');
				$data['lista'] = $rs;
					$data['campo'] = "produto";
						new View('listar.php',$data);
	}

	function carregarOBJ(){
		$data['titulo'] = 'produto';
				$rs = $this->produtoDAO->lista('SELECT id, produto, valor, descricao, fk_categoria, fk_fornecedor FROM produto');
				$obj = $this->arrayObj($rs);
				$data['lista'] = $obj;
					$data['campo'] = "produto";
						new View('listarProduto.php',$data);
	}
	
	function cad(){

		$data['form'] = array(
			 array(
				'name' => 'produto',
				'label' =>'produto',
				'type'  => 'text',
				'place' => 'produto',
				'value' => '',
				'class' => ''
				),
			 array(
				'name' => 'descricao',
				'label' =>'descricao',
				'type'  => 'text',
				'place' => 'descricao',
				'value' => '',
				'class' => ''
				),
			 array(
				'name' => 'valor',
				'label' =>'valor',
				'type'  => 'text',
				'place' => 'valor',
				'value' => '',
				'class' => 'valor',
				'ml' => TRUE
				),
			);
		//carregar select
			//categoria
			$sql = "SELECT id,categoria FROM categoria";
				$rsCategoria  = $this->produtoDAO->lista($sql);
			
			$sql = "SELECT id,fornecedor FROM fornecedor";
				$rsFornecedor  = $this->produtoDAO->lista($sql);

			$data['form_select'] =  array(
					array(
						'name'  => 'categoria',
						'label' => 'categoria',
						'rs'    => $rsCategoria
					),
					array(
						'name'  => 'fornecedor',
						'label' => 'fornecedor',
						'rs'    => $rsFornecedor
					)
				);					

		if($_POST){
				$this->categoria->setId($_POST['categoria']);
				$this->fornecedor->setId($_POST['fornecedor']);

				$this->produto->setProduto($_POST['produto']);
				$this->produto->setDescricao($_POST['descricao']);
				$this->produto->setValor($_POST['valor']);

				$this->produto->setCategoria($this->categoria);
				$this->produto->setFornecedor($this->fornecedor);

					$rs = $this->produtoDAO->cadastra('produto',$this->produto);
					if($rs){
						$_SESSION['msg'] = "cadastrado com sucesso";
					}else{
					    $_SESSION['msg'] = "erro no cadastro";
					}
		}		
		$data['form_action'] ='cad';
		$data['titulo'] = 'Produto - Cadastrar';
		new View('cad.php',$data);
	}
	
	function editar($id){
		if(isset($id)) {
			$id = intval($id);
			$sql = "SELECT  produto,valor,descricao,fk_categoria,fk_fornecedor FROM produto WHERE id = :id";
			$rs = $this->produtoDAO->listaId($sql,$id);
			
			$sql = "SELECT id,categoria FROM categoria";
				$rsCategoria  = $this->produtoDAO->lista($sql);
			
			$sql = "SELECT id,fornecedor FROM fornecedor";
				$rsFornecedor  = $this->produtoDAO->lista($sql);


			foreach ($rs as $key => $value) {
				$data['form'] = array(
							array(
								'name' => 'produto',
								'label' =>'Produto',
								'type'  => 'text',
								'place' => 'Campo produto',
								'value' =>$value['produto'],
								'class' => ''
								),
							array(
								'name' => 'valor',
								'label' =>'valor',
								'type'  => 'text',
								'place' => 'Valor',
								'value' =>$value['valor'],
								'class' => 'valor'
								),
							array(
								'name' => 'descricao',
								'label' =>'Descrição',
								'type'  => 'text',
								'place' => 'descricao',
								'value' =>$value['descricao'],
								'class' => ''
								)																						
						);
				$data['form_select'] =  array(
					array(
						'name'  => 'categoria',
						'label' => 'categoria',
						'rs'    => $rsCategoria,
						'select' => $value['fk_categoria']
					),
					array(
						'name'  => 'fornecedor',
						'label' => 'fornecedor',
						'rs'    => $rsFornecedor,
						'select' => $value['fk_fornecedor']
					)
				);				
			}

			$data['id_hidden'] = $id;
			$data['form_action'] ='/CtrProduto/postEditar';
			$data['titulo'] = 'Produto - Editar';
			new View('editar.php',$data);
				
		}  
	}

	function postEditar(){
		if($_POST){
			
				$this->produto->setId($_POST['id']);
				$this->produto->setProduto($_POST['produto']);
				$this->produto->setValor($_POST['valor']);
				$this->produto->setDescricao($_POST['descricao']);
				
				$this->categoria->setId($_POST['categoria']);
				$this->fornecedor->setId($_POST['fornecedor']);
				
				$this->produto->setCategoria($this->categoria);
				$this->produto->setFornecedor($this->fornecedor);
				
				if($this->produtoDAO->editar($this->produto)){
					$_SESSION['msg'] = "atualizado com sucesso";
				}else{
					$_SESSION['msg'] = "erro na atualização";
				}
				//implementar sistema de mensagem
				$url = 'http://localhost:8090/CtrProduto/carregar';
						header('Location: ' . $url);
		}
	}
	
	function excluir($id){
		$id = intval($id);
		$rs = $this->produtoDAO->excluir($id);
		  if($rs){
			$_SESSION['msg'] = "excluir com sucesso";
		  }else{
			$_SESSION['msg'] = "erro na atualização";
		  }
		  	$url = 'http://localhost:8090/CtrProduto/carregar';
			header('Location: ' . $url);
	}

	function arrayObj($rs) {
		$rows = array();
			foreach ($rs as $key=>$value) {
				$colms =  array();
				$obj = new Produto();
				
				$objCategoria = $this->categoriaDAO->popularBean(new Categoria(),$value['fk_categoria']);
				$objFornecedor = $this->fornecedorDAO->popularBean(new Fornecedor(),$value['fk_fornecedor']);
				
					$obj->setId($value['id']);
					$obj->setProduto($value['produto']);
					$obj->setValor($value['valor']);
					$obj->setDescricao($value['descricao']); 
					$obj->setCategoria($objCategoria); 
					$obj->setFornecedor($objFornecedor); 
						$colms['produto'] = $obj;
				$rows[] = $colms;
			}
		return $rows;
	}	
}
?>