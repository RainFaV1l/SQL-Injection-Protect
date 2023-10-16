<?php

if(empty($_POST)) header('Location: ../index.php');

session_start();

if(isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

header('Location: ../index.php');