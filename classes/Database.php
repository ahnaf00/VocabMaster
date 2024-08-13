<?php
include_once "../config/config.php";
class Database
{
    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if(!$this->connection)
        {
            throw new Exception("Could not connect to database");
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}