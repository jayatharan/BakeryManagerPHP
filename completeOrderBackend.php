<?php

$id = $_GET["id"];

require_once("dbController.php");
$db_handle = new DBController();

$db_handle->set_order_completed($id);

header("Location: http://localhost/bakeryManager/orders.php");
die();
