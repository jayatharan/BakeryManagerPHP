<?php

$id = $_POST['id'];
$name = $_POST["name"];
$cat_id = $_POST["category"];
$description = $_POST["description"];
$price = $_POST["price"];

echo $id;
echo $name;
echo $cat_id;
echo $description;
echo $price;

require_once("dbController.php");
$db_handle = new DBController();

$status = $db_handle->update_product($id, $name, $cat_id, $description, $price);

if ($status) {
    header("Location: http://localhost/bakeryManager/products.php");
    die();
} else {
    header("Location: http://localhost/bakeryManager/editProduct.php?id=" . $id);
    die();
}
