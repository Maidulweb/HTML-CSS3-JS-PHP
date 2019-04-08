<?php 
 class Database{
 	private $host    = 'localhost';
 	private $db_name = 'login_db';
 	private $user    = 'root';
 	private $pass    = '';
 	public  $pdo;
 	public function __construct(){
 		if (!isset($this->pdo)) {
 			try{
 				$link = new PDO("mysql:host=".$this->host."; dbname=".$this->db_name, $this->user, $this->pass);
 				$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 				$this->pdo = $link;
 			}catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
 			}
 		}
 		
 	}
 }


 
 ?>