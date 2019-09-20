<?php

/**
 * Connection
 */
class Connection
{

    private $conn;
    private $database_name= 'generator';
    private $database_type= 'mysql';
    private $host= 'localhost';
    private $username= 'generator';
    private $password= '';

    /**
     * Constructor
     * 
     * @param String $database_name, $database_type, $host, $username, $password
     */
    public function __construct($database_name, $database_type, $host, $username, $password)
    {
        $this->database_name = $database_name;
        $this->database_type = $database_type;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }
    
    /**
     * Setters
     */
    public function __set($name, $value) 
    {
        $this->$name = $value;
    }

    /**
     * Getters
     */
    public function __get($name) 
    {
        return $this->$name;
    }

    /**
     * Create a connection with database
     * 
     * @param null
     * @return void
     */
    private function connect()
    {
    try {
        $newConn = new PDO(
            "{$this->database_type}:host={$this->host};dbname={$this->database_name}", 
            $this->username, 
            $this->password
        );
        $newConn->setAttribute(
            PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION
        );
        $this->conn = $newConn;
    } catch (PDOException $exception) {
        throw $exception;
    }
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->conn = null;
    }

}
