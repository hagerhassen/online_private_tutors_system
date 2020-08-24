<?php

class DBH{
    private string $host = "localhost";
    private string $user = "root";
    private string $pwd = "";
    private string $dbname = "TutorsData";

    protected function connect(){
        $dsn="mysql:host=".$this->host.";dbname=".$this->dbname;
        $pdo=new PDO($dsn,$this->user,$this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $pdo;
    }
}

