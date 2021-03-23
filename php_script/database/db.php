<?php


class Connection{

	protected $connection;

	public static function setGet($dbServername, $dbUsername, $dbPassword, $dbName){
		$this->connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
		return $this->connection;
	}

	public static function getConnection(){

		$dbServername = "localhost";
		$dbUsername = "root";
		$dbPassword = "";
		$dbName = "fullstack";

		$connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
		return $connection;
	}

	
}

?>