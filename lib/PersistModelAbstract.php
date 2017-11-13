<?php
/**
* Classe Abstrata responsável por centralizar a conexão
* com o Database
*/
abstract class PersistModelAbstract
{
    /**
    * Variável responsável por guardar dados da conexão do banco
    * @var resource
    */
    protected $o_db;
      
    function __construct()
    {
         
        /* Inicio de conexão com SQLite     
        $this->o_db = new PDO("sqlite:./databases/db.sq3");
        $this->o_db->setAttribute ( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
        Fim de conexão com SQLite
        */  
         
        
        //Inicio de conexão com MySQL 
        $st_host = 'localhost';
        $st_banco = 'JavaDaDepre';
        $st_usuario = 'root';
        $st_senha = '';

        $st_dsn = "mysql:host=$st_host;dbname=$st_banco"; 
        $this->o_db = new PDO
        (
            $st_dsn,
            $st_usuario,
            $st_senha
        );
        //Fim de conexão com MySQL 
    }
}