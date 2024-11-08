<?php

include "Dsn.php";
// Classe che permette di creare un istanza del Db
class Database
{
    private $dsn;
    private $username;
    private $password;

    public function __construct(Dsn $dsn, $username, $password){
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        try{
            $db = new PDO($this->dsn, $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connessione stabilita";
        }catch(PDOException $e){
            echo "Errore". $e->getMessage();
        }


    }
}