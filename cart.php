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
    <style>
        .qtyInput {
            width: 80px;
        }
    </style>

    <?php require('nav.php'); ?>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">SubTotal</th>
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
        <div class="d-flex justify-content-end">
            <a type="button" href="checkout.php" class="btn btn-outline-success">Place This Order</a>
        </div>
    </div>


    <script>
        updateDetails()

        const updateCartQty = (p_id) => {
            const qty = document.getElementById("qty" + p_id).value
            updateToCard(p_id, qty)
            location.reload();
        }

        const removeItemFromCart = (p_id) => {
            updateToCard(p_id, 0)
            location.reload()
        }

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
            cell4.innerHTML = '<div class="d-flex">' +
                '<input type="number" class="qtyInput" value="' + item.qty + '" id="qty' + item.p_id + '" min="1" >' +
                '<input type = "submit" value = "Update" onClick="updateCartQty(' + item.p_id + ')" > </div>'
            cell5.innerHTML = '<div class="text-end">' + (parseFloat(item.price) * parseInt(item.qty)).toFixed(2) + '</div>';
            cell6.innerHTML = '<div class="text-danger" onClick="removeItemFromCart(' + item.p_id + "," + 0 + ')">X</div>'
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>