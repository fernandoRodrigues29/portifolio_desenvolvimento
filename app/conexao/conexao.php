<?php
class Conexao 
{
	
	private $host;
	private $db;
	private $user;
	private $password;

	function __construct($argumnetos)
	{
		$this->setHost($argumnetos[0]);
		$this->setDb($argumnetos[1]);
		$this->setUser($argumnetos[2]);
		$this->setPassword($argumnetos[3]);
	}

	public function getConnection() {
		$dns='mysql:host='.$this->getHost().';dbname='.$this->getDb().'';
		$user =''.$this->getUser().'';
		$pass =$this->getPassword();
		try {
			$pdo = new PDO($dns,$user, $pass);
			return $pdo;
		} catch(PDOException $ex) {
			echo 'ERRO:'.$ex->getMessage();
		}
	}



    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     *
     * @return self
     */
    public function setHost($host)
    {
        $this->host = $host;

    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     *
     * @return self
     */
    public function setDb($db)
    {
        $this->db = $db;

    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;

    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

    }
}
?>