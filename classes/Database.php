<?php

/*
 *
 *  Questa classe permette di stabilire una connessione con il DB.
 *
 *
 */


class Database{
    private $host;
    private $db;
    private $username;
    private $password;
    private $dsn;
    private $connection = null;


    // costruttore da migliorare
    public function __construct($array)
    {
        $this->db = $array['dbname'];
        $this->host = $array['host'];
        $this->username = $array['user'];
        $this->password = $array['password'];
        $this->dsn = "mysql:host=". $this->host.";"."dbname=". $this->db . ";" . "charset=utf8mb4";

    }

    public function dbData(){
        return "Dati di istanza:\n".
            "DB: " . $this->db . "\n".
            "Host: " . $this->host . "\n".
            "User: " . $this->username . "\n";
    }

    public function connectToDatabase(){
        if($this->connection == null){
            try{
                $this->connection = new PDO($this->dsn,$this->username,$this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $this->connection;
            }catch(PDOException $e){
                echo "Errore di connesione: " . $e->getMessage();
            }
        }
        else
            return $this->connection;
    }

}