<?php

class config{
	
	public $conn;
	const HOST 			= 'localhost';
	const DB_USER 		= 'root';
	const DB_PASSWORD 	= '';
	const DB_NAME 		= 'basepath';
	const BASE_PATH 		= 'htdocs/basepath';
	function __construct(){
		
		$this->db_connection();
		
	}

	public function db_connection(){
		$this->conn = new mysqli(self::HOST,self::DB_USER, self::DB_PASSWORD, self::DB_NAME);
		if($this->conn->connect_error){
			die("EDB Connection Error". $this->conn->connect_error);
		}
		return "Success";
	}
	public  function escape_string($string){
		return $this->conn->real_escape_string($string);
	}


}