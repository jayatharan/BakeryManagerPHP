<?php
class DBController
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "bakeryManager";
    private $conn;

    function __construct()
    {
        $this->conn = $this->connectDB();
    }

    function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        return $conn;
    }

    function runQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset;
    }

    function numRows($query)
    {
        $result  = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

    function addCategory($name)
    {
        $sql = "INSERT INTO category (name) VALUES (\"" . $name . "\")";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    function addProduct($name, $cat_id, $price, $qty, $desc)
    {
        $sql = "INSERT INTO product (name,category_id,price,quantity,description) VALUES (\"" . $name . "\",\"" . $cat_id . "\",\"" . $price . "\",\"" . $qty . "\",\"" . $desc . "\")";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    function addUser($name, $email, $password)
    {
        $sql = "INSERT INTO User (name,email,password) VALUES (\"" . $name . "\",\"" . $email . "\",\"" . $password . "\")";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    function addAddress($u_id, $address, $p_no)
    {
        $sql = "INSERT INTO address (user_id,address,phone_no) VALUES (\"" . $u_id . "\",\"" . $address . "\",\"" . $p_no . "\")";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    function addOrder($u_id, $a_id)
    {
        $sql = "INSERT INTO bakeryOrder (user_id,address_id) VALUES (\"" . $u_id . "\",\"" . $a_id . "\")";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_insert_id($this->conn);
    }

    function addOrderItem($o_id, $p_id, $qty)
    {
        $product = $this->get_product($p_id);
        $price = $product['price'];
        $this->update_product_qty($p_id, ($product['quantity'] - $qty));
        $sql = "INSERT INTO order_item (order_id,product_id,price,quantity) VALUES (\"" . $o_id . "\",\"" . $p_id . "\",\"" . $price . "\",\"" . $qty . "\")";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    function addInventory($p_id, $qty)
    {
        $this->update_previous_inventory_qty($p_id);
        $sql = "INSERT INTO inventory (product_id, quantity) VALUES (\"" . $p_id . "\",\"" . $qty . "\")";
        $result = mysqli_query($this->conn, $sql);
        $this->update_product_qty($p_id, $qty);
        return $result;
    }

    function get_categories()
    {
        $query = "SELECT * FROM category";
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset;
    }

    function get_category($c_id)
    {
        $query = "SELECT * FROM product WHERE id =" . $c_id;
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset[0];
    }

    function get_products($c_id)
    {
        $query = "SELECT * FROM product WHERE category_id =" . $c_id;
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset;
    }

    function get_product($p_id)
    {
        $query = "SELECT * FROM product WHERE id =" . $p_id;
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset[0];
    }


    function get_user($u_id)
    {
        $query = "SELECT * FROM User WHERE id =" . $u_id;
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset[0];
    }

    function get_addresses($u_id)
    {
        $query = "SELECT * FROM address WHERE user_id =" . $u_id;
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset;
    }

    function get_address($a_id)
    {
        $query = "SELECT * FROM address WHERE id =" . $a_id;
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset[0];
    }

    function get_order($o_id)
    {
        $query = "SELECT * FROM bakeryOrder WHERE id =" . $o_id;
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset)) {
            $order = $resultset[0];
            $user = $this->get_user($order['user_id']);
            $address = $this->get_address($order['address_id']);
            $result = array("order" => $order, "user" => $user, "address" => $address);
            return $result;
        }
    }

    function get_order_items($o_id)
    {
        $query = "SELECT * FROM order_item WHERE order_id =" . $o_id;
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset)) {
            $order_item_array = array();
            foreach ($resultset as $key => $value) {
                $product = $this->get_product($resultset[$key]["product_id"]);
                $order_item_array . array_push($order_item_array, array("order_item" => $resultset[$key], "product" => $product));
            }
            return $order_item_array;
        }
    }

    function get_last_inventory($p_id)
    {
        $query = "SELECT * FROM inventory WHERE product_id =\"" . $p_id . "\" ORDER BY ID DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset[0];
    }

    function update_product_qty($p_id, $qty)
    {
        $sql = "UPDATE product SET quantity =\"" . $qty . "\" WHERE id=" . $p_id;
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    function update_previous_inventory_qty($p_id)
    {
        $last_inventory = $this->get_last_inventory($p_id);
        if (!empty($last_inventory)) {
            $product = $this->get_product($p_id);
            $sql = "UPDATE inventory SET balance_quantity =\"" . $product['quantity'] . "\" WHERE id=" . $last_inventory["id"];
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }
    }

    function login($email, $password)
    {
        $query = "SELECT * FROM User WHERE email =\"" . $email . "\" AND password=\"" . $password . "\"";
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        return $resultset;
    }
}
