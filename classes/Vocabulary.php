<?php
class Vocabulary
{
    private $connection;
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->connection = $db->getConnection();
    }

    public function addWord($user_id, $word, $meaning)
    {
        $query = "INSERT INTO words(user_id, word, meaning) VALUES ('{$user_id}','{$word}','{$meaning}')";
        mysqli_query($this->connection,$query);
    }

    public function getWords($user_id, $searchedText = null)
    {
        if($searchedText)
        {
            $query = "SELECT * FROM words WHERE user_id='{$user_id}' AND word LIKE '{$searchedText}%' ORDER BY word";
        }
        else
        {
            $query = "SELECT * FROM  words WHERE user_id='{$user_id}'";
        }

        $result = mysqli_query($this->connection, $query);
        $data = [];

        while($_data = mysqli_fetch_assoc($result))
        {
            array_push($data, $_data);
        }

        return $data;
    }

}