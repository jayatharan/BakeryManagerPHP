<?php
// Start the session
session_start();

require_once("dbController.php");
$db_handle = new DBController();

if (isset($_SESSION['user'])) {
    echo "User set";
} else {
    echo "User not set";
}


$email = "indranjayatharan3@gmail.com";
$password = "1234";

$user = $db_handle->login($email, $password)[0];

if (!empty($user)) {
    $_SESSION['user'] = $user;
    print_r($_SESSION);
} else
    echo FALSE;
