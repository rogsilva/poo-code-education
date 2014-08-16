<?php

namespace SON\Database;


class Connection {

    private $conn;

    private $host;
    private $dbname;
    private $user;
    private $password;
    private $driver;

    public function __construct($host, $dbname, $user, $password, $driver = 'mysql')
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
        $this->driver = $driver;
    }

    public function connect()
    {
        try {
            $this->conn = new \PDO("{$this->driver}:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        return $this->conn;
    }

    public function disconnect()
    {
        $this->conn = null;
    }
} 