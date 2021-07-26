<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ariana Bakers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                <a class="nav-link" href="cart.php">Cart</a>
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <a class="nav-link" href="myOrders.php">My Orders</a>
                    <?php if ($_SESSION['user']['user_type'] == 0) { ?>
                        <a class="nav-link" href="products.php">Products</a>
                        <a class="nav-link" href="orders.php">Orders</a>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </div>
            <div class="navbar-nav">
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <a class="nav-link">
                        Hi, <?php echo $_SESSION['user']['name'] ?>
                    </a>
                    <a class="nav-link" aria-current="page" href="logoutBackend.php">Logout</a>
                <?php
                } else {
                ?>
                    <a class="nav-link" aria-current="page" href="register.php">Register</a>
                    <a class="nav-link" aria-current="page" href="login.php">Login</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</nav>