<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>


<body>
    <div class="container-fluid">
        <h3>Categories</h3>
        <div class="row">
            <?php
            require_once("dbController.php");
            $db_handle = new DBController();

            $category_array = $db_handle->get_categories();

            if (!empty($category_array)) {
                foreach ($category_array as $key => $value) {
            ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="card w-100" style="width: 18rem;">
                            <!-- <img src="https://source.unsplash.com/random" class="card-img-top" alt="..."> -->
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $category_array[$key]["name"]; ?></h5>

                                <button onclick='redirectToProduct("<?php echo $category_array[$key]["id"] ?>")' class='btn btn-primary w-100'>View Cakes </button>


                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
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