<?php
class Database{
    private $host;
    private $username;
    private $password;
    private $dbName;

    public function connect(){
        $this->host = "localhost";
        $this->username = "Database username here";
        $this->password = "Database password here";
        $this->dbName = "Database name here";

        try {
        $dsn="mysql:host=".$this->host.";dbname=".$this->dbName;
        $pdo= new PDO($dsn,$this->username,$this->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        return $pdo;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
}

 ?>
