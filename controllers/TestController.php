<?php

#A classe a ser testada
require_once 'models/ProdutosModel.php';

/**
* Classe de testes
*/
class TestController
{
    private $asd;
    public function indexAction()
    {
        $this->asd = new ProdutosModel('1');
    }
}