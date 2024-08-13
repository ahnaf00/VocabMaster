<?php

class User
{
    private $db;
    private $connection;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->connection = $db->getConnection();
    }

    public function register($email, $password)
    {
        $email = mysqli_real_escape_string($this->connection, $email);
        $password = mysqli_real_escape_string($this->connection, $password);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users(email, password) VALUES ('{$email}', '{$hashedPassword}')";


        try
        {
            $result = mysqli_query($this->connection, $query);
            if(!$result)
            {
                throw new Exception(mysqli_error($this->connection));
            }
        }
        catch(Exception $exception)
        {
            error_log($exception->getMessage());
            return 1;
        }
    }

    public function login($email, $password)
    {
        $email = mysqli_real_escape_string($this->connection, $email);
        $query = "SELECT id, password FROM users WHERE email='{$email}'"; 
        $result = mysqli_query($this->connection, $query);

        if(mysqli_num_rows($result) >0)
        {
            $data = mysqli_fetch_assoc($result);
            $_id = $data['id'];
            $_password = $data['password'];

            if(password_verify($password, $_password))
            {
                $_SESSION['id'] = $_id;
                return true;
            }
            else
            {
                return 4;
            }
        }else
        {
            return 5;
        }
    }
}
