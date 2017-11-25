<?php
/**
* Classe responsável por buscar os dados do produto no database
*/
class ProdutosModel extends PersistModelAbstract
{
    private $data;

    function __construct($id = null)
    {
        #inicia a variável o_db (PDO)
        parent::__construct();

        #seta o primeiro produto
        if ($id != null)
            $this->checkProdutos($id);
    }

    /**
    * define o produto a ser pesquisado no database
    */
    public function checkProdutos($id = null, $nome = null, $order = "id_produto")
    {
        #checa se o item existe no database, se existe, retornará uma array, caso contrário retornará false
        
        #se id não for nulo, então o nome será (não faz sentido passar os dois parâmetros) 
        if ($id != null) {
            $produto = $this->checkItem($id, null, $order);
        }
        #se nome não for nulo, então o id será (não faz sentido passar os dois parâmetros)
        elseif ($nome != null) {
            $produto = $this->checkItem(null, $nome, $order);
        }
        #listará todos os arquivos
        else {
            $produto = $this->checkItem();
        }

        if ($produto !== false) {
            $this->data = $produto;
            return $produto;
        } else {
            echo "Oops";
            $error = "O produto não foi encontrado";
            return $error;
        }
    }

    private function checkItem($id = null, $nome = null, $order = "id_produto")
    {
        if ($id != null) {
            $sql = "SELECT * FROM `tbl_produtos` WHERE id_produto = $id ORDER BY $order";
        } elseif ($nome != null) {
            $sql = "SELECT * FROM `tbl_produtos` WHERE nome_produto = $nome ORDER BY $order";
        } else {
            $sql = "SELECT * FROM `tbl_produtos` ORDER BY $order";
        }

        $return = $this->o_db->prepare($sql);
        $return->execute();

        $check = $return->fetchALL(PDO::FETCH_ASSOC);
        
        #retornará false caso o produto não exista e true caso contrário
        if (count($check) <= 0) {
            return false;
        } else {
            return $check;
        }
    }
    public function getDataProduto()
    {
        return $this->data;
    }
}