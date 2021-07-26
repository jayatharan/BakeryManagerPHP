<?php
session_start();

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

require_once("dbController.php");
$db_handle = new DBController();

$status = $db_handle->addUser($name, $email, $password);

if ($status) {
    header("Location: http://localhost/bakeryManager/login.php");
    die();
} else {
    header("Location: http://localhost/bakeryManager/register.php");
    die();
}
