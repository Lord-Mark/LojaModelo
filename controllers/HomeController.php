<?php

#Incluindo classes da camada Model
require_once 'models/UserModel.php';

class HomeController
{
	/**
	* Array para guardar os parâmetros a serem passados para a view
	*/
	private $v_params = array();
	
	/**
	* Objeto da classe userModel
	*/
	private $o_user;
	/**
	* Objeto da classe View
	*/
	private $o_view;

	/**
	* Inicializa a view, mandando o header como primeiro arquivo a ser carregado
	*/
	public function __construct()
	{
		session_start();
		$this->o_view = new View("views/master/header.phtml", "views/master/footer.phtml");
		$this->o_user = new UserModel();

		if (isset($_SESSION['email']) && isset($_SESSION['senha']) && isset($_SESSION['logged'])) { 
			
			if($this->o_user->login($_SESSION['email'], $_SESSION['senha'])){
				$this->v_params["logged"] = true;

				#Pega os dados do usuário
				$userData = $this->o_user->getuserData();
				
				#Adiciona os dados do user para depois ser utilizado na view
				$this->v_params["st_nome"] = $this->o_user->getShorterName($userData["st_nome"]);
			}else
				$this->v_params["logged"] = false;
		}else{
			$this->v_params["logged"] = false;
		}
	}

	public function indexAction()
	{
		#define qual aba estará ativa na navbar
		$this->v_params["active"] = "home";
		#adiciona o arquivo home.phtml para ser exibido entre o header e o footer
		$this->o_view->addView("views/home.phtml");
		#adiciona a sidebar
		$this->o_view->addView("views/master/sidebar.phtml");
		#passa os parâmetros para a view (se está logado, nome do user, etc.)
		$this->o_view->setParams($this->v_params);
		#exibe a view
		$this->o_view->showContents();
	}
}