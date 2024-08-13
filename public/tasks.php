<?php

session_start();

require_once "../classes/Database.php";
require_once "../classes/User.php";
require_once "../classes/Vocabulary.php";

$db = new Database();
$user = new User($db);
$vocabulary = new Vocabulary($db);

$action = $_POST['action']??'';
$status = 0;

if('register' == $action)
{
    $email = $_POST['email']??'';
    $password = $_POST['password']??'';

    if($email && $password)
    {
        $status = $user->register($email, $password);
    }
    else
    {
        $status = 2;
    }
    header("Location:index.php?status={$status}");
}
else if('login' ==  $action)
{
    $email = $_POST['email']??'';
    $password = $_POST['password']??'';

    if($email && $password)
    {
        $result = $user->login($email, $password);
        if($result === true)
        {
            header("Location:words.php");
            die();
        }
        else
        {
            $status = $result;
        }
    }
    else{
        $status = 2;
    }
    header("Location:index.php?status={$status}");
}
else if('addWord' == $action)
{
    $word = $_POST['word']??'';
    $meaning = $_POST['meaning']??'';
    $user_id = $_SESSION['id']??0;
    if($word && $meaning && $user_id)
    {
        $vocabulary->addWord($user_id, $word, $meaning);
    }
    header("Location:words.php");
}