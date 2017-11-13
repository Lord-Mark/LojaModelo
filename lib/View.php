<?php

/**
* Essa classe é responsável por renderizar os arquivos HTML
*/
class View
{
  /**
  * Armazena o nome do arquivo HTML
  * @var string
  */
  private $st_contents;

  /**
  * Armazena o nome do arquivo de vizualização
  * @var string
  */
  private $st_view;

  /**
  * Armazena dados que devem ser mostrados ao renderizar o aruivo de visualização.
  * @var Array
  */
  private $v_params;

  /**
  * Armazena todos os arquivos a serem carregados na view
  * @var Array
  */
  private $v_outputView;

  /**
  * arquivo header que sempre será carregado
  * @var string
  */
  private $st_header;

  /**
  * arquivo footer que sempre será carregado
  * @var string
  */
  private $st_footer;

  /**
  * $st_view é o nome do arquivo de visualização a ser usado e
  * $v_params são os dados que devem ser utilizados pela camada de visualização.
  * @param string $st_view
  * @param Array $v_params
  */
  function __construct($st_header = null, $st_footer = null, $st_view = null, $v_params = null)
  {
    if ($st_header != null)
      $this->st_header = $st_header;

    if($st_view != null)
      $this->setView($st_view);
      
    if ($st_footer != null)
      $this->st_footer = $st_footer;

    $this->v_params = $v_params;
  }

  /**
  * Adiciona outro arquivo no final do anterior (Ou seja, caso você queira criar um arquivo "mestre", como um header
  * que será carregado em todas as páginas, basta passá-lo como primeiro argumento e depois adicionar o arquivo da pág atual)
  * @param string nomeDoArquivoASerCarregado
  */
  public function addView($st_outputView)
  {
    if (file_exists($st_outputView)) {
      $this->v_outputView[] = $st_outputView;
    }else{
      throw new Exception('Arquivo View "'.$st_outputView.'" não existe');
    }
  }

  /**
  * Define qual arquivo html deve ser renderizado como footer
  * @param string $st_footer
  * @throws Exception
  */
  public function setFooter($st_footer)
  {
    if (file_exists($st_footer)) {
      $this->st_footer = $st_footer;
    }else{
      throw new Exception('Arquivo footer "'.$st_footer.'" não existe');
    }
  }
  
  public function getFooter()
  {
    return $this->st_footer;
  }

  /**
  * Define qual arquivo html deve ser renderizado como header
  * @param string $st_header
  * @throws Exception
  */
  public function setHeader($st_header)
  {
    if (file_exists($st_header)) {
      $this->st_header = $st_header;
    }else{
      throw new Exception('Arquivo header "'.$st_header.'" não existe');
    }
  }
  
  public function getHeader()
  {
    return $this->st_header;
  }

  /**
  * Define qual arquivo html deve ser renderizado
  * @param string $st_view
  * @throws Exception
  */
  public function setView($st_view)
  {
    if (file_exists($st_view)) {
      $this->v_outputView[] = $st_view;
    }else{
      throw new Exception('Arquivo View "'.$st_view.'" não existe');
    }
  }

  /**
  * Retorna os nomes dos arquivos que devem ser renderizados
  * @return Array $v_outputView
  */
  public function getView()
  {
    return $this->v_outputView;
  }

  public function resetView()
  {
    unset($this->v_outputView);
  }

  /**
  * Define os dados que devem ser repassados à view
  * @param Array $v_params
  */
  public function setParams(Array $v_params)
  {
      $this->v_params = $v_params;
  }

  /**
  * Retorna os dados que forem ser repassados ao arquivo de visualização.
  * @return Array
  */
  public function getParams()
  {
    return $this->v_params;
  }

  /**
  * Retorna uma string contendo todo o conteudo do arquivo de visualização.
  * @return string
  */
  public function getContents()
  {
    ob_start();

    if ($this->st_header != null)
      require_once $this->st_header;

    if (count($this->v_outputView)>0) {
      foreach ($this->v_outputView as $output) {
        require_once $output;
      }
    }
    if ($this->st_footer != null)
      require_once $this->st_footer;
    
    $this->st_contents = ob_get_contents();
    ob_end_clean();
    return $this->st_contents;
    }

    /**
    * Imprime o arquivo de visualização
    */
    public function showContents()
    {
        echo $this->getContents();
        exit();
    }

}