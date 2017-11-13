<?php


/**
* 
*/
class UserModel extends PersistModelAbstract
{
	private $st_nome = "gest";
	private $st_senha;
	private $in_id;
	private $st_email;
	private $boo_isLogged = false;
	private $v_userData = array();

	function __construct()
	{
		parent::__construct();
		#cria a tabela dos usuários caso não haja
		$this->createTableUsers();
	}

	#### Setters & Getters ####

	public function setNome($st_nome)
	{
		$this->st_nome = $st_nome;
		return $this;
	}

	public function getNome()
	{

		return $this->st_nome;
	}

	public function setEmail($st_email)
	{
		$this->st_email = $st_email;
		return $this;
	}

	public function getEmail()
	{
		return $this->st_email;
	}

	public function setSenha($st_senha)
	{
		$this->st_senha = $st_senha;
		return $this;
	}
	public function getSenha()
	{
		return $this->st_senha;
	}

	public function isLogged()
	{
		return $this->boo_isLogged;
	}
	public function setUserData($st_nome, $st_senha, $st_email)
	{
		$this->v_userData["st_nome"] = $this->setNome($st_nome);
		$this->v_userData["st_senha"] = $this->setSenha($st_senha);
		$this->v_userData["st_email"] = $this->setEmail($st_email);
	}
	public function getuserData()
	{
		$this->v_userData["st_nome"] = $this->getNome();
		$this->v_userData["st_senha"] = $this->getSenha();
		$this->v_userData["st_email"] = $this->getEmail();

		return $this->v_userData;
	}
	### Fim dos Setters & Getters ###

	/**
	* Verifica se os dados de login estão no MySQL, retorna true se existirem e falso caso contrário.
	* @return boolean
	*/
	public function insertRegister($st_email, $st_senha, $st_nome)
	{
		if (!$this->loginValidator($st_email)) {
			$st_senha = hash("sha1", $st_senha);
			$sql = "INSERT INTO `tbl_users` 
							(
								`con_st_nome`,
								`con_st_senha`,
								`con_st_email`
							)
					VALUES (
								'$st_nome',
								'$st_senha',
								'$st_email'
							)";
			try {
				$this->o_db->exec($sql);
				return 0;
			} catch (PDOException $e) {
				throw new Exception("Não foi possível inserir o usuário '$st_nome' no banco de dados.");
			}
		}else{
			return "O email $st_email já está registrado";
		}
	}

	/**
	* Apenas checa se a conta já está registrada.
	* Retorna false caso já esteja registrada e true caso contrário.
	*/
	private function loginValidator($st_email, $st_senha = null){
		if (is_null($st_senha))
			$sql = "SELECT * FROM `tbl_users` WHERE `con_st_email` LIKE '$st_email'";
		else
			$sql = "SELECT * FROM `tbl_users` WHERE `con_st_email` LIKE '$st_email' AND `con_st_senha` = '$st_senha'";

		$ret = $this->o_db->prepare($sql);
		$ret->execute();

		$users = $ret->fetchAll(PDO::FETCH_ASSOC);
		if (count($users) <= 0)
		    return false;
		else{
			$users = array_shift($users);
			$this->setUserData($users["con_st_nome"], $users["con_st_senha"], $users["con_st_email"]);
			return true;
		}

	}
	/**
	* Recebe as informações de login, caso sejam válidas o usuário será logado em sua conta, caso seja nulo ou inválido
	* o usuário será logado como gest, sendo considerado não logado; retorna true se logado e false caso contrário.
	* @param String $st_email, $st_senha
	* @return boolean
	*/
	public function login($st_email = null, $st_senha = null)
	{
		if (!is_null($st_email) && !is_null($st_senha))
			$st_senha = hash("sha1", $st_senha);
			if ($this->loginValidator($st_email, $st_senha)){
				$this->boo_isLogged = true;
				$this->st_email = $st_email;
				$this->st_senha = $st_senha;
				return true;
			}
		else
			$this->boo_isLogged = false;
			return false;
	}
	/**
	* Caso a tabela não exista ela será criada.
	*/
	private function createTableUsers()
	{
		$sql = "CREATE TABLE IF NOT EXISTS tbl_users
                    (
                        con_in_id INTEGER NOT NULL AUTO_INCREMENT,
                        con_st_nome CHAR(200),
                        con_st_senha CHAR(200),
                        con_st_email CHAR(100),
                        PRIMARY KEY(con_in_id)
                    )";
 
        //executando a query;
        try
       {
            $this->o_db->exec($sql);
        }
        catch(PDOException $e)
        {
            throw $e;
        }
	}
}