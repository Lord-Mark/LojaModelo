<?php
/**
* Classe responsável por buscar os dados do produto no database
*/
class ProdutosModel extends PersistModelAbstract
{
    private $id;
    private $data;

    function __construct($id)
    {
        #inicia a variável o_db (PDO)
        parent::__construct();

        #seta o primeiro produto
        $this->setProduto($id);
    }

    /**
    * define o produto a ser pesquisado no database
    */
    public function setProduto($id)
    {
        $this->id = $id;

        #checa se o item existe no database, se existe, retornará uma array, caso contrário retornará false
        $produto = $this->checkItem();

        if ($produto !== false) {
            $this->data = $produto;
            return $produto;
        } else {
            $error = "O produto não foi encontrado";
            return $error;
        }
    }

    private function checkItem()
    {
        $sql = "SELECT * FROM `tbl_produtos` WHERE id = $this->id";

        $return = $this->o_db->prepare($sql);
        $return->execute();

        $check = $return->fetchALL(PDO::FETCH_ASSOC);
        
        #retornará false caso o produto não exista e true caso contrário
        if (count($check) <= 0) {
            return false;
        } else {
            $check = array_shift($check);
            return $check;
        }
    }
    public function getDataProduto()
    {
        return $this->data;
    }
}