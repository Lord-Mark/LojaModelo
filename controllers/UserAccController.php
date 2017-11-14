<?php
#Incluindo classes da camada Model
require_once 'models/UserModel.php';

class UserAccController
{
	/**
	* Variável responsável por salvar os parâmetros que devem ser enviados para a view
	*/
	private $v_params = array();

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

		# Parâmetro que diz se o usuário está logado ou não, neste caso
		# uma conta está sendo registrada ou logada, ou seja, ainda não há usuário logado.
		$this->v_params["logged"] = false;
	}

	/**
	* Primeiro método a ser executado na página de registro.
	* Responsável por passar os parãmetros para a View e exibir o arquivo.
	*/
	public function registerAction()
	{
		#O parâmetro "active" é responsável por dizer para o header qual página está ativa.
		$this->v_params["active"] = 'registrar';

		#adiciona o arquivo de registro na View (após o header).
		$this->o_view->addView("views/userRegister.phtml");

		#passa os parâmetros para a View.
		$this->o_view->setParams($this->v_params);

		#exibe o conteúdo carregado pela View.
		$this->o_view->showContents();
	}

	/**
	* Verifica se os dados passados estão corretos e os armazena no SQL.
	* Responsável por receber os dados do formulário de registro.
	*/
	public function validateRegisterAction()
	{
		#Caso as senhas não batam ou estejam vazias, o else será executado, lançando um erro para a view
		if ( !is_null($_REQUEST["st_pass1"]) && !is_null($_REQUEST["st_pass2"]) && $_REQUEST["st_pass1"] == $_REQUEST["st_pass2"]) {
			
			# Um IF só pra garantir que o usuário não dê uma de espertinho 
			# e mande um input vazio (mesmo com os "patterns" isso é possível, é só alterar o valor do html).
			if ( $_REQUEST["st_email"] != "" && $_REQUEST["st_nome"] != "" ){
				
				$o_user = new UserModel();

				#vai retornar 0 para $b_registro em caso de sucesso, em caso de falha será retornado uma mensagem de erro
				$b_registro = $o_user->insertRegister($_REQUEST["st_email"], $_REQUEST["st_pass1"], $_REQUEST["st_nome"]);
				
				/**
				* caso $b_registro == 0 então -> sucesso e o if será executado,
				* caso contrário o else será executado mandando a mensagem de erro (armazenada na variável) para a view.
				*/
				if (!$b_registro){
					header("Location: ?controle=Home&acao=index");
				}else{
					$this->v_params["error"] = $b_registro;
					$this->registerAction();
				}
			}else{
				$this->v_params["error"] = "Os campos DEVEM ser preenchidos.";
				$this->registerAction();
			}
		}else{
			$this->v_params["error"] = "As senhas não batem, digite novamente (com muita parcimônia u.u).";
			$this->registerAction();
		}
	}

	/**
	* Primeiro método a ser executado na página de login.
	* Responsável por passar os parâmetros para a View e exibir o arquivo.
	*/
	function loginAction()
	{
		$this->o_view->addView("views/userLogin.phtml");
		$this->v_params["logged"] = false;

		#se a sessão de uma conta estiver ativa, então será exibida uma mensagem na view, dizendo que há uma conta salva.   
		if (isset($_SESSION['email']) && isset($_SESSION['senha'])){
			
			#esse será o parâmetro que será checado pela view para saber se há alguma conta salva.
			$this->v_params["lastLogin"] = true;

			#parâmetros com os dados da conta.
			$this->v_params["email"] = $_SESSION['email'];
			$this->v_params["senha"] = $_SESSION['senha'];
		}else{
			$this->v_params["lastLogin"] = false;
		}
		$this->v_params["active"] = 'login';
		$this->o_view->setParams($this->v_params);
		$this->o_view->showContents();
	}

	public function loginCheckerAction($st_email = null, $st_senha = null)
	{
		$o_user = new UserModel();
		if (!is_null($st_email) && !is_null($st_senha)) {
			if ($o_user->login($st_email, $st_senha)) {
				$this->v_params["lastLogin"] = true;

				$this->v_params["email"] = $st_email;
				$this->v_params["senha"] = $st_senha;
				
				$_SESSION["logged"] = true;

				header("Location: ?controle=Home&acao=index");
			}else{
				$this->v_params["error"] = "Verifique se os dados inseridos estão corretos e tente novamente.";
				$this->loginAction();
			}
		}else{
			if ($o_user->login($_REQUEST['st_email'], $_REQUEST['st_senha'])) {
				$_SESSION["logged"] = true;
				$_SESSION["email"] = $_REQUEST['st_email'];
				$_SESSION["senha"] = $_REQUEST['st_senha'];

				$this->v_params["lastLogin"] = true;
				$this->v_params["email"] = $_REQUEST['st_email'];
				$this->v_params["senha"] = $_REQUEST['st_senha'];
				header("Location: ?controle=Home&acao=index");
			}else{
				$this->v_params["error"] = "Verifique se os dados inseridos estão corretos e tente novamente.";
				$this->loginAction();
			}
		}
	}
	
	public function lastLoginAction()
	{
		$this->loginCheckerAction($_SESSION["email"], $_SESSION["senha"]);
	}
	
	public function disconnectAction()
	{
		unset($this->v_params);
		$this->cleanLastLoginAction(false);
		header("Location: ?controle=Home&acao=index");
	}

	public function cleanLastLoginAction($relog = true)
	{
		$this->v_params["logged"] = false;
		unset($_SESSION["email"]);
		unset($_SESSION["senha"]);

		session_destroy();
		
		if ($relog)
			$this->loginAction();
	}
}