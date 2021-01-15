<?php

class db {

    var $errorNum = '0';
    var $errorMsg = null;
    private $login;
    private $pass;
    private $connect;


    public function __construct($db, $login = 'root', $pass=''){
        $this->login = $login;
        $this->pass = $pass;
        $this->db = $db;
        $this->connexion();
    }

    public function connexion()
    {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname='.$this->db.';charset=utf8mb4',
                $this->login,
                $this->pass
            );
        }
        catch (PDOException $e)
        {
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($msg);
        }
    }

    public function q($sql,Array $cond = null){
        $stmt = $this->connect->prepare($sql);

        if($cond){
            foreach ($cond as $v) {
                $stmt->bindParam($v[0],$v[1],$v[2]);
            }
        }

        $stmt->execute();

        return $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt=NULL;
    }
}