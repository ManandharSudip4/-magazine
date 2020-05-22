<?php
	 class database{
		protected $conn;
		protected $stmt;
		protected $sql;
		protected $table;

	
		function __construct(){
			try{
				$this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$this->conn->exec('SET NAMES utf8');
				echo "data base connected sucessfully";
				return true;
			}catch(PDOException $e){
				error_log(Date("M d, Y h:i:s a").' : (DB Connection) : '.$e->getMessage(),3,ERROR_PATH.'error.log');
				return false;
			}
		}

		function runQuery($sql){
			try{
				//$this->sql = $sql;
				//$this->stmt = $this->conn->prepare($this->sql);
				$this->stmt = $this->conn->prepare($sql);
				$this->stmt->execute();
				return true;
			}catch(PDOException $e){
				error_log(Date("M d, Y h:i:s a").' : (run Query) : '.$e->getMessage()."\r\n",3,ERROR_PATH.'error.log');
				return false;
			}
		}

		function getDataFromQuery($sql){
			try{
				$this->sql = $sql;
				$this->stmt = $this->conn->prepare($this->sql);
				$this->stmt->execute();
				$data=$this->stmt->fetchAll(PDO::FETCH_OBJ);
				return $data;
			}catch(PDOException $e){
				error_log(Date("M d, Y h:i:s a").' : (getdatafromQuery) : '.$e->getMessage(),3,ERROR_PATH.'error.log');
				return false;
			}
		}

	// 	protected function addData($data,$is_die=false){
	// 		// INSERT INTO TABLE SET

	// 		try{
	// 			$this->sql = "INSERT INTO SET";

	// 			//table name start
	// 			if(isset($this->table) && !empty($this->table)){
	// 					$this->sql.=$this
	// 			}else{
	// 				throw new Exception("DAta cannot be insert wo table name")
	// 			}
	// 	}
	// }

	}
?>

