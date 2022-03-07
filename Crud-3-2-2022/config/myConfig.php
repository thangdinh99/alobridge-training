<?php
    class Database {
    protected $host = 'localhost';
    protected $user = 'root';
    protected $passw ='';
    protected $database = 'alobridge_crud';
    protected $conn ;
    public function __construct() {
        $this->connect();
    }
    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->passw, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    }
