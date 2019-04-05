<?php 

class Conexao{

    public $conn;
    public $hostname = '127.0.0.1';
    public $database = 'systeminfotest';
    public $charset = "utf8";
    public $user = "root";
    public $password = "";
    public $tablename = "userpcinfo";

	public function __construct(){
        $this->conn = new PDO (
            "mysql:host=$this->hostname; 
            dbname=$this->database; 
            charset=$this->charset",
            $this->user,
            $this->password
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

	public function query($string_query){
		$this->conn->exec($string_query);
    }

    public function selectAll($string_query, $param){
        $stmt = $this->conn->prepare($string_query); 
        $stmt->bindParam(1, $param, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;  
    }

    public function select($string_query, $param){
        $stmt = $this->conn->prepare($string_query); 
        $stmt->bindParam(1, $param, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        return $result;
    }
    
    public function getTableName(){
        return $this->tablename;
    }

    public function setTableName($tablename){
        $this->tablename = $tablename;
    }
    
    public function __destruct(){
        $this->conn = null;
    }
}

?>