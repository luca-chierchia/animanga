<?php

// dati di connessione
class Dsn{
    private  $host;
    private  $database;

    public function __construct($host,$databaseName){

            $this->host= $host;

            $this->database=$databaseName;


    }

    public function toString(){
        return "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
    }


}
