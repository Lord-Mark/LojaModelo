<?php

#A classe a ser testada
require_once 'models/ProdutosModel.php';

/**
* Classe de testes
*/
class TestController
{
    private $asd;

    private $v_params = array();
    public function indexAction()
    {
        $this->asd = new ProdutosModel();
        $teste = $this->asd->setProduto(1);
        $v_params = array_merge($this->v_params, $teste);

        $this->o_view = new View();
        $this->o_view->addView("views/produtoShow.phtml");
        $this->o_view->setParams($this->v_params);
        $this->o_view->showContents();
    }
}