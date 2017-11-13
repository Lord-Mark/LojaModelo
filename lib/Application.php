<?php

/**
* Essa função garante que todas as classes da pasta
* lib serão carregadas automaticamente.
*/
function __autoload($st_class)
{
	if(file_exists('lib/'.$st_class.'.php'))
		require_once 'lib/'.$st_class.'.php';
}

/**
* Verifica qual classe controller o usuário deseja chamar
* e qual método dessa classe (Action) deseja executar.
* Caso o controller não seja expecificado, o IndexController
* será o padrão.
* Caso o método (Action) não seja especificado , o IndexAction
* será o padrão
*/

class Application
{
	/**
	* Usada para guardar o nome da classe
	* de controle a ser executada
	* @var string
	*/
	protected $st_controller;

	/**
	* Usada para guardar o nome do método
	* de controle da classe a ser executada
	* @var string
	*/
	protected $st_action;

	/**
	* Verifica se os parâmetros de controle e de ação foram
	* passados via "Post" ou "Get" e os carrega 
	* nos atributos da classe.
	*/

	private function loadRoute()
	{
		/**
		* Se o controller não foi passado por GET,
		* assume-se como padrão o controller 'IndexController'
		*/
		$this->st_controller = isset($_REQUEST['controle']) ? $_REQUEST['controle'] : 'Index';

		/*
        * Se a action nao for passada por GET,
        * assume-se como padrão a action 'IndexAction';
        */
        $this->st_action = isset($_REQUEST['acao']) ?  $_REQUEST['acao'] : 'index';
	}

	/**
    *
    * Instancia classe referente ao Controlador (Controller) e executa
    * método referente e  acao (Action)
    * @throws Exception
    */
    public function dispatch()
    {
        $this->loadRoute();

        #Verifica se o arquivo de controle existe.
        $st_controller_file = 'controllers/'.$this->st_controller.'Controller.php';
        if (file_exists($st_controller_file)) {
        	require_once $st_controller_file;
        }else{
        	throw new Exception('Arquivo '.$st_controller_file.'não encontrado');
        }

        #Verifica se a classe existe.
        $st_class = $this->st_controller.'Controller';
        if (class_exists($st_class)) {
        	$o_class = new $st_class;
        }else{
        	throw new Exception('A classe "'.$st_class.'" não existe no arquivo "'.$st_controller_file.'"');
        }

        #Verifica se o Método existe.
        $st_method = $this->st_action.'Action';
        if (method_exists($o_class, $st_method)) {
        	$o_class->$st_method();
        }else{
        	throw new Exception('O método "'.$st_method.'" NON ECZISTE');
        }
    }

    /**
    * Redireciona a chamada http para outra página
    * @param string st_uri
    */
    static function redirect( $st_uri )
    {
    	header("Loaction: $st_uri");
    }

}