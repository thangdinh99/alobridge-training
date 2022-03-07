<?php
class Database
{
    protected $host = 'localhost';
    protected $user = 'root';
    protected $passw = '';
    protected $database = 'alobridge_crud';

    public static $_instance;
    protected $conn;
    private function __construct()
    {
        $this->connect();
    }
    public function connect()
    {
        if (!$this->conn) {
            $this->conn =  new \mysqli($this->host, $this->user, $this->passw, $this->database);
            if ($this->conn->connect_errno) {
                trigger_error("Failed to conencto to MySQL: " . $this->connect->connect_error, E_USER_ERROR);
            }
        }
    }

    public function disConnect()
    {
        $this->conn->close();
    }

    public function query($sql)
    {
        $this->connect();
        $result = $this->connect->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return "Error: " . $sql . "<br>" . $this->connect->error;
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
