<?php
session_start();

$name = $_POST["name"];
$cat_id = $_POST["category"];
$description = $_POST["description"];
$price = $_POST["price"];

echo $name;
echo $cat_id;
echo $description;
echo $price;

require_once("dbController.php");
$db_handle = new DBController();

$status = $db_handle->addProduct($name, $cat_id, $price, 0, $description);

if ($status) {
    header("Location: http://localhost/bakeryManager/products.php");
    die();
} else {
    header("Location: http://localhost/bakeryManager/addProduct.php");
    die();
}
