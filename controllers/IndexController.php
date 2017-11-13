<?php

/**
* Controller que será chamado quando nenhum outro for especificado
*/
class IndexController
{
	/**
	* Ação que será executada quando nenhuma outra for
	* especificada, assim como o "index.php" é
	* executado quando nenhum arquivo é referenciado.
	*/
	function indexAction()
	{
		# redirecionando para a página principal
		header('Location: ?controle=Home&acao=index');
	}
}