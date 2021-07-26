<?php
session_start();

$u_id = $_POST["u_id"];
$address = $_POST["address"];
$phone = $_POST["phone"];


require_once("dbController.php");
$db_handle = new DBController();

$db_handle->addAddress($u_id, $address, $phone);

header("Location: http://localhost/bakeryManager/checkout.php");
die();
