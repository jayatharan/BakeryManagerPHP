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
        <div class="d-flex justify-content-center">
            <div class="p-2 mt-3 card shadow">
                <h4>Add Product</h4>
                <div>
                    <form class="form" method="post" action="addProductBackend.php">
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Product name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Category</label>
                            <select name="category" class="form-select" required>
                                <option></option>
                                <?php
                                require_once("dbController.php");
                                require_once("utils.php");

                                $db_handle = new DBController();
                                $utils = new Utils();

                                $category_array = $db_handle->get_categories();
                                if (!empty($category_array)) {
                                    foreach ($category_array as $key => $value) {
                                ?>
                                        <option value="<?php echo $category_array[$key]['id']; ?>"><?php echo $category_array[$key]['name']; ?></option>
                                <?php
                                    }
                                }

                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Price" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Add Product</button>
                    </form>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>