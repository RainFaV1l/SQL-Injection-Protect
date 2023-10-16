<?php

// Способы защиты от SQL Injection
// ' OR '1=1

if($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST)) {

    header('Location: ../index.php');

    die();

}

require_once '../database/Database.php';

$connection = new \database\Database('localhost', 'csrf', 'root', '');

$connection = $connection->getConnection();

if(gettype($connection) === 'string') die($connection);

session_start();

//$email = mysqli_real_escape_string($connection, $_POST['email']);
//$password = mysqli_real_escape_string($connection, $_POST['password']);

$sql = "SELECT * FROM `users` where `email` = :email AND `password` = :password";

$user = $connection->prepare($sql);

//$user = $connection->query($sql);

// Способ №2
//$user->bindValue(":email", $_POST['email'], PDO::PARAM_STR);
//$user->bindValue(":password", $_POST['password'], PDO::PARAM_STR);

$user->execute([
    ':email' => $_POST['email'],
    ':password' => $_POST['password'],
]);

if(!$user->fetch()) {

    header('Location: ../index.php');

    $_SESSION['attempt'] = 'Неверный логин или пароль';

    die();

}

// Способ 1 для mysqli
// mysqli_real_escape_string()

// Способ 2 для mysqli
// $connection->bind_param(":variable", $variable);
// $connection->bind_value(":variable", $variable);
// $connection->execute();
// $result = $stmt->get_result();

$user = $user->fetch(PDO::FETCH_COLUMN);

$_SESSION['user'] = $user;

header('Location: ../index.php');