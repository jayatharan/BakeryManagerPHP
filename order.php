<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="./cookieControll.js"></script>
    <title>Document</title>
</head>

<body>
    <?php require('nav.php'); ?>
    <div class="container-fluid bg">
        <?php
        require_once("dbController.php");
        require_once("utils.php");

        $db_handle = new DBController();
        $utils = new Utils();

        $id = $_GET["id"];

        $user_type = $user = $_SESSION['user']["user_type"];

        $order = $db_handle->get_order($id);
        $orderItems = $db_handle->get_order_items($id);

        //echo json_encode($orderItems);
        ?>

        <div class="container card">
            <h3 class="mb-2 mt-2">Order Summary </h3><br>
            <label>Customer Name : </label><span><?php echo $order['user']['name'] ?></span><br>
            <label>Address : </label><span><?php echo $order['address']['address'] ?></span><br>
            <label>Phone No:</label><span><?php echo $order['address']['phone_no'] ?></span><br>

            <label>Date:</label><span><?php echo $order['order']['date'] ?></span><br>

            <?php
            if ($user_type == 0) {
                if ($order['order']['completed'] == 0) {
            ?>
                    <a type="button" href="completeOrderBackend.php?id=<?php echo $id ?>" class="btn btn-success ">Complete this order</a>
            <?php
                }
            }
            ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Sub Total</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($orderItems)) {
                        foreach ($orderItems as $key => $value) {
                    ?>
                            <tr>
                                <td><?php echo $orderItems[$key]['product']['name'] ?></td>
                                <td><?php echo $orderItems[$key]['order_item']['price'] ?></td>
                                <td><?php echo $orderItems[$key]['order_item']['quantity'] ?></td>
                                <td><?php echo $utils->price_format($orderItems[$key]['order_item']['price'] * $orderItems[$key]['order_item']['quantity']) ?></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>