<?php


class model{
    private $dbuser=DB_USER;
    private $dbname=DB_NAME;
    private $dbpass=DB_PASS;
    private $dbhost=DB_HOST;

    private $statment;
    private $error;
    private $conn;

    public function __construct(){
        $dsn='mysql:host='.$this->dbhost.';dbname='.$this->dbname;
        $options=array(
            PDO::ATTR_PERSISTENT =>true,
            PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->conn=new PDO($dsn,$this->dbuser,$this->dbpass,$options);
        } catch (PDOExecption $e) {
            $this->error=$e->getMessage();
            echo $this->error;
        }
    }

    //write query
    public function query($sql){
        $this->statment=$this->conn->prepare($sql);
    }

    //bind value
    public function bind($parameter,$value,$type=null){
        switch (is_null($type)) {
            case is_int($value):
                $type=PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type=PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type=PDO::PARAM_NULL;
                break;
            
            default:
                $type=PDO::PARAM_STR;
                break;
        }
        $this->statment->bindValue($parameter,$value,$type);

    }

    //execute 
    public function execute(){
        return $this->statment->execute();
    }

    //return values
    public function getUser(){
        $this->execute();
        return $this->statment->fetchAll(PDO::FETCH_OBJ);
    }

    //return single user
    public function single(){
        $this->execute();
        return $this->statment->fetch(PDO::FETCH_OBJ);

    }

    //get number of rows
    public function getRows(){
        return $this->statment->rowCount();
    }

}