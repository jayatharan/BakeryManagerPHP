<?php
session_start();
require_once("dbController.php");
$db_handle = new DBController();


$cookie_name = "card";

if (!isset($_COOKIE[$cookie_name])) {
    //echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    //echo "Cookie '" . $cookie_name . "' is set!<br>";
    //echo "Value is: " . $_COOKIE[$cookie_name];
}

if (isset($_SESSION['user'])) {
    echo "User set";
    $user = $_SESSION['user'];
    $cookie_data = json_decode($_COOKIE[$cookie_name]);
    $orderItems = $cookie_data->order_items;


    $order_id = $db_handle->addOrder($user["id"], 1);

    foreach ($orderItems as $key => $value) {
        $db_handle->addOrderItem($order_id, $orderItems[0]->p_id, $orderItems[0]->qty);
    }
    setcookie("card", '{"order_items":[]}');
} else {
    echo "User not set";
}
