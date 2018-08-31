<?php

class DatabaseController{

	private $charset = "utf8mb4";
	private $query;
	private $connection;
	private $parameters;

	public function __construct(){
		global $dbHost, $dbName, $dbUsername, $dbPassword;

		$dsn = "mysql:host=$dbHost;dbname=$dbName;charset={$this->charset}";

		$options = [
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    PDO::ATTR_EMULATE_PREPARES   => false,
		];

		$this->connection = new PDO($dsn, $dbUsername, $dbPassword, $options);
	}

	public function query($query){
		$this->query = $this->connection->prepare($query);
	}

	public function addParameters($array = []){
		$this->parameters = $array;
	}

	public function execute(){
		$this->query->execute($this->parameters);
		$this->parameters = null;
	}

	public function count(){
		return $this->query->rowCount();
	}

	public function result(){
		return $this->query->fetchAll();
	}

}
