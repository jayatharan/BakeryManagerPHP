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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Address</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("dbController.php");
                require_once("utils.php");

                $db_handle = new DBController();
                $utils = new Utils();

                $my_orders = $db_handle->get_my_orders($_SESSION['user']['id']);

                if (!empty($my_orders)) {
                    foreach ($my_orders as $key => $value) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $key + 1 ?></th>
                            <td><?php echo $my_orders[$key]['address']['address'] ?></td>
                            <td><?php echo $my_orders[$key]['order']['date'] ?></td>
                            <td><a type="button" href="order.php?id=<?php echo $my_orders[$key]['order']['id'] ?>" class="btn btn-primary">View</a></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>