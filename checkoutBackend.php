<?php
session_start();
require_once("dbController.php");
$db_handle = new DBController();

$a_id = $_POST["a_id"];


$cookie_name = "card";

if (!isset($_COOKIE[$cookie_name])) {
    header("Location: http://localhost/bakeryManager/clearCard.php");
    die();
} else {
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $cookie_data = json_decode($_COOKIE[$cookie_name]);
        $orderItems = $cookie_data->order_items;

        $order_id = $db_handle->addOrder($user["id"], $a_id);

        foreach ($orderItems as $key => $value) {
            $db_handle->addOrderItem($order_id, $orderItems[$key]->p_id, $orderItems[$key]->qty);
        }
        unset($_COOKIE['card']);
        header("Location: http://localhost/bakeryManager/clearCard.php");
        die();
    } else {
        header("Location: http://localhost/bakeryManager/login.php");
        die();
    }
}
