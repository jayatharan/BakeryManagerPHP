<?php

$p_id = $_POST["p_id"];
$qty = $_POST["quantity"];


require_once("dbController.php");
$db_handle = new DBController();

$status = $db_handle->addInventory($p_id, $qty);

if ($status) {
    header("Location: http://localhost/bakeryManager/products.php");
    die();
} else {
    header("Location: http://localhost/bakeryManager/products.php");
    die();
}
