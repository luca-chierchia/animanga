<?php

/*
 *
 *  Questa classe permette di stabilire una connessione con il DB.
 *
 *
 */


class Database{
    private string $host;
    private string $db;
    private string $username;
    private string $password;
    private string $dsn;
    private ?PDO $connection =  null;


    // costruttore da migliorare
    public function __construct(array $array)
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

    public function connectToDatabase(): PDO{
        if ($this->connection === null) {
            try {
                $this->connection = new PDO($this->dsn, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Errore di connessione: " . $e->getMessage();
            }
        }
        return $this->connection;
    }

}