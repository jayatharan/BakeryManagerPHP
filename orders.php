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
    <div class="container">

        <?php
        require_once("dbController.php");
        require_once("utils.php");

        $db_handle = new DBController();
        $utils = new Utils();

        $completed_orders = $db_handle->get_completed_orders();
        $new_orders = $db_handle->get_new_orders();
        ?>

        <h3>New Order</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($new_orders)) {
                    foreach ($new_orders as $key => $value) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $key + 1 ?></th>
                            <td><?php echo $new_orders[$key]['user']['name'] ?></td>
                            <td><?php echo $new_orders[$key]['address']['phone_no'] ?></td>
                            <td><?php echo $new_orders[$key]['order']['date'] ?></td>
                            <td><a type="button" href="order.php?id=<?php echo $new_orders[$key]['order']['id'] ?>" class="btn btn-primary">View</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>


        <h3>Old Order</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Date</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($completed_orders)) {
                    foreach ($completed_orders as $key => $value) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $key + 1 ?></th>
                            <td><?php echo $completed_orders[$key]['user']['name'] ?></td>
                            <td><?php echo $completed_orders[$key]['address']['phone_no'] ?></td>
                            <td><?php echo $completed_orders[$key]['order']['date'] ?></td>
                            <td><a type="button" href="order.php?id=<?php echo $completed_orders[$key]['order']['id'] ?>" class="btn btn-primary">View</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>