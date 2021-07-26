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
    <?php

    if (!isset($_SESSION['user'])) {
        header("Location: http://localhost/bakeryManager/login.php");
        die();
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody id="cart_table">

                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">TotalQty</th>
                            <th scope="col" id="total_qty"></th>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Total</th>
                            <th scope="col" id="total"></th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <div class="col-md-5">
                <div>
                    <h4><i class="fa fa-address-card"></i> Checkout</h4>
                    <div>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        My addresses
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body p-1">
                                        <?php
                                        require_once("dbController.php");
                                        require_once("utils.php");

                                        $db_handle = new DBController();
                                        $addresses = $db_handle->get_addresses($_SESSION['user']['id']);

                                        if (!empty($addresses)) {
                                            foreach ($addresses as $key => $value) {
                                        ?>
                                                <div class="card mb-2 p-1" onclick="setData('<?php echo $addresses[$key]['id']; ?>','<?php echo $addresses[$key]['address']; ?>','<?php echo $addresses[$key]['phone_no']; ?>')">
                                                    <div><label for="Address">Address : </label><span><?php echo $addresses[$key]['address']; ?></span><br></div>
                                                    <div><label for="Phone">Phone No:</label><span><?php echo $addresses[$key]['phone_no']; ?></span></div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Add New Address
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body p-1">
                                    <form method="post" action="addAddressBackend.php">
                                        <input name="u_id" value="<?php echo $_SESSION['user']['id'] ?>" hidden />
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                            <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                        </div>
                                        <label>Phone No</label><br>
                                        <input name="phone" class="form-control" type="text" required>
                                        <hr>
                                        <button type="submit" class="btn btn-primary btn">Add Address</button>
                                    </form>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 card p-1">
                        <label for="customername">Customer Name : </label><span><?php echo $_SESSION['user']['name'] ?></span><br>
                        <label for="Address">Address : </label><span id="address"></span><br>
                        <label for="Phone">Phone No:</label><span id="phn_no"></span>
                        <form method="post" action="checkoutBackend.php">
                            <input type="text" name="a_id" id="address_id" hidden required>
                            <button type="submit" class="btn btn-success w-100">Complete Order</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        updateDetails()

        var cart = getCardData()
        console.log(cart)
        cart.map((item, idx) => {
            var cartTable = document.getElementById('cart_table'),
                newRow = cartTable.insertRow(cartTable.length),
                cell1 = newRow.insertCell(0),
                cell2 = newRow.insertCell(1),
                cell3 = newRow.insertCell(2),
                cell4 = newRow.insertCell(3),
                cell5 = newRow.insertCell(4),
                cell6 = newRow.insertCell(5);

            cell1.innerHTML = idx + 1;
            cell2.innerHTML = item.p_name;
            cell3.innerHTML = '<div class="text-end">' + item.price.toFixed(2) + '</div>'
            cell4.innerHTML = '<div class="text-end">' + item.qty + '</div>'
            cell5.innerHTML = '<div class="text-end">' + (parseFloat(item.price) * parseInt(item.qty)).toFixed(2) + '</div>';
        })
    </script>

    <script>
        var address = ""
        var phoneNo = ""
        var a_id = ""

        const setData = (id, ads, phn) => {
            address = ads
            phoneNo = phn
            a_id = id
            updateView()
        }

        const updateView = () => {
            document.getElementById("address").innerText = address
            document.getElementById("phn_no").innerText = phoneNo
            document.getElementById("address_id").value = a_id
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>