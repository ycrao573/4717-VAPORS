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
                            <th>Item</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>';


                    
    $qry = 'SELECT * FROM accounts WHERE email = '. '\'' . $_SESSION['email'] . '\'';
    $query_result = $conn->query($qry);
    $row_no = $query_result->num_rows;
    $row = $query_result->fetch_assoc();
    $current_id = $row["id"];    

    $qry = 'SELECT * FROM carts WHERE accountId = '. '\'' . $current_id . '\'';
    $qry = $qry . ' AND paid = 0';
    $qry = $qry . ' ORDER BY name, color, size';
    $qry = $qry . ';';
    echo $qry;
    $query_result = $conn->query($qry);
    $row_no = $query_result->num_rows;
    if ($row_no > 0) {
        for ($counter = 0; $counter < $row_no; $counter++) {
            $row = $query_result->fetch_assoc();
            $name = $row["name"];
            $qry = 'SELECT p.id from products AS p where name = "'.$name .'"';
            $res = $conn->query($qry);
            $prod = $res->fetch_assoc();
            // $productid = ($conn->query($qry)->fetch_assoc())["id"];
            $id = $row["id"];
            $gender = $row["gender"];
            $color = $row["color"];
            $size = $row["size"];
            $price = $row["price"];
            $discount = $row["discount"];
            $quantity = $row["quantity"];
            
            $prices_per_item = (1 - $discount / (float)100) * $price;
            $subtotal = $prices_per_item * $quantity;
            $total += $subtotal;

            echo '<tr class="tablerow">
                                      <td>';
            echo '<img src="./pics/' . $prod["id"] . '_' . strtolower($color) . '.jpg" class="cart-thumbnail">';
            echo '    </td>
            <td>' . $name . '</td>
            <td>' . ucfirst($color) . '</td>
            <td>' . $size . '</td>
            <td id="' . $id . '_' . $color . '_' . $size . '_price-single">$' . number_format($prices_per_item, 2) . '</td>
            <td>' . $discount . '%</td>
            <td>' . $quantity . '</td>'
            ;
            echo '<td ><strong>$<span class="price-subtotal" id="' . $id . '_' . $color . '_' . $size . '_price-subtotal">' .
                number_format($subtotal, 2) . '
                                    </span></strong></td>
                                </tr>';

        }

    }
    echo '</table>';
    ?>
    </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br>
    <a href="./checkout.php"><button class="submitbutton" style="max-width: 200px; float: right;">Go to Checkout</button></a>
    </form>
    <br><br><br><br>
    </section>

</body>
<?php include './common/copyright.php';?>

</html>