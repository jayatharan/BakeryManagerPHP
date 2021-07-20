<?php

$email = $_POST["email"];
$password = $_POST["password"];

require_once("dbController.php");
$db_handle = new DBController();

$user = $db_handle->login($email, $password)[0];


if (!empty($user)) {
    $_SESSION['user'] = $user;
    //print_r($_SESSION);
    header("Location: http://localhost/bakeryManager/");
    die();
} else {
    header("Location: http://localhost/bakeryManager/Home.html");
    die();
}
