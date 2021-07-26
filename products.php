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
        <div class="row">
            <div class="col-md-3 card mt-1">
                <h4 class="text-center mt-2">Categories</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" onclick="redirectToProduct('')">All</li>
                    <?php
                    require_once("dbController.php");
                    require_once("utils.php");

                    $db_handle = new DBController();
                    $utils = new Utils();

                    $category_array = $db_handle->get_categories();
                    if (!empty($category_array)) {
                        foreach ($category_array as $key => $value) {
                    ?>
                            <li class="list-group-item" onclick="redirectToProduct(<?php echo $category_array[$key]['id']; ?>)"><?php echo $category_array[$key]["name"]; ?></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-9 mt-1">
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="d-flex justify-content-between">
                                <a href="addProduct.php" type="button" class="btn btn-outline-dark btn-sm">Add Product</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $product_array = $db_handle->get_products($_GET["category"]);

                    if (!empty($product_array)) {
                        foreach ($product_array as $key => $value) {
                    ?>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="card p-1">
                                    <p class="card-title mb-0"><?php echo $product_array[$key]["name"]; ?></p>
                                    <a data-bs-toggle="collapse" href="#productDetails<?php echo $product_array[$key]["id"]; ?>"><small>Details</small></a>
                                    <div class="collapse" id="productDetails<?php echo $product_array[$key]["id"]; ?>">
                                        <div class="card card-body p-1 mb-1">
                                            <small><?php echo $product_array[$key]["description"]; ?></small>
                                        </div>
                                    </div>
                                    <form method="post" action="updateInventory.php">
                                        <input name="p_id" type="number" class="w-100 mb-1" placeholder="Quantity" value="<?php echo $product_array[$key]["id"]; ?>" hidden />
                                        <small>
                                            Price : <?php echo $utils->price_format($product_array[$key]["price"]); ?>
                                        </small>
                                        <br>
                                        <small>
                                            <label>Quantity</label>
                                            <input name="quantity" type="number" class="w-100 mb-1" placeholder="Quantity" value="<?php echo $product_array[$key]["quantity"]; ?>" />
                                        </small>
                                        <div class="d-flex justify-content-between">
                                            <a type="button" class="btn btn-warning btn-sm" href="editProduct.php?id=<?php echo $product_array[$key]["id"]; ?>">Edit</a>
                                            <button type="submit" class="btn btn-primary btn-sm py-0">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        const redirectToProduct = (id) => {
            location.replace(`http://localhost/bakeryManager/products.php?category=${id}`)
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>