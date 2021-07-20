<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <script src="./cookieControll.js"></script>
</head>


<body>

    <div class="container-fluid">
        <div class="row">
            <?php
            require_once("dbController.php");
            require_once("utils.php");
            $db_handle = new DBController();
            $utils = new Utils();
            //$product_array = $db_handle->runQuery("SELECT * FROM product WHERE category_id =" . $_GET['category']);
            $product_array = $db_handle->get_products($_GET['category']);
            if (!empty($product_array)) {
                foreach ($product_array as $key => $value) {
            ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card">
                            <!-- <img src="..." class="card-img-top" alt="..."> -->
                            <div class="card-body">
                                <h5 class="card-title mb-0"><?php echo $product_array[$key]["name"]; ?></h5>
                                <div>
                                    <div>Available : <?php echo $product_array[$key]["quantity"]; ?></div>
                                    <div>Price : <?php echo $utils->price_format($product_array[$key]["price"]) ?> </div>
                                    <a data-bs-toggle="collapse" href="#productDescription<?php echo $product_array[$key]["id"]; ?>"><small>description</small></a>
                                    <div class="collapse" id="productDescription<?php echo $product_array[$key]["id"]; ?>">
                                        <div class="card card-body p-1">
                                            <small><?php echo $product_array[$key]["description"]; ?></small>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100 mt-1" onclick='addToCard({
                                    "p_id":<?php echo $product_array[$key]["id"]; ?>,
                                    "p_name":"<?php echo $product_array[$key]["name"]; ?>",
                                    "qty":1,
                                    "price":<?php echo $product_array[$key]["price"]; ?>,
                                    "available":<?php echo $product_array[$key]["quantity"]; ?> 
                                },1)'>Add to Card</button>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>