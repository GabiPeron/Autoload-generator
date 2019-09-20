<?php

class PdoGenerator {
    public function __construct(){}

    public function generate($filepath) {
        $data = json_decode(file_get_contents($filepath))->pdo;

$file = '<?php

/**
 * Connection
 */
class Connection
{

    private $conn;
    private $database_name= '."'$data->name'".';
    private $database_type= '."'$data->driver'".';
    private $host= '."'$data->host'".';
    private $username= '."'$data->name'".';
    private $password= '. "'$data->password'".';

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
';

        file_put_contents("./src/files/connection.php", $file);

        echo "sucesso!";
    }
}

?>