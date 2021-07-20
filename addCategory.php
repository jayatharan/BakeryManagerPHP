<?php
require_once("dbController.php");
$db_handle = new DBController();

$name = $_POST["name"];

$db_handle->addCategory($name);
