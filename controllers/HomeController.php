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
				$this->v_params["st_nome"] = $userData["st_nome"];
				$this->v_params["st_senha"] = $userData["st_senha"];
				$this->v_params["st_email"] = $userData["st_email"];
			}else
				$this->v_params["logged"] = false;
		}else{
			$this->v_params["logged"] = false;
		}
	}

	public function indexAction()
	{
		$arrayName = array(
				'asd' => "asda",
				'huehue' => 213
				);
		$this->v_params["active"] = "profile";
		$this->o_view->addView("views/home.phtml");
		$this->o_view->setParams($this->v_params);

		$this->o_view->showContents();
	}
}