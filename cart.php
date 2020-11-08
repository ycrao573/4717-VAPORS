<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>

<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit();


    echo '<section id="cart" class="cart">
        <form method="POST" action="checkout.php">
            <div style="margin: 2.5%;"><br>
                <h2>Shopping cart</h2>
                <br><br>
                <div>  
                    <table style="width: 80%; min-width: 900px; margin: auto;">
                        <tr class="tablerow">
                            <th>Image</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </table>';
    ?>
    </div>
    </div>
    <br><br><br><br><br><br><br><br>
    <a href="./checkout.php"><button class="submitbutton" style="max-width: 200px; float: right;">Go to Checkout</button></a>
    </form>
    <br><br><br><br>
    </section>

</body>
<?php include './common/copyright.php';?>

</html>