<?php
	class database{
		public $conn;
		public $stml;
		public $sql;
		public $table;
	}
	function __construct(){
		try{
			$this->conn =new PDO('mysql:host='.DB_HOST.',DB_USER,)
		}
	}
?>