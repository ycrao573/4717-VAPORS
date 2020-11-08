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

                    
    $current_email = $_SESSION["email"];
    $qry = 'SELECT * FROM carts WHERE email = '. '\'' . $current_email . '\'';
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
            $gender = $row["gender"];
            $color = $row["color"];
            $size = $row["size"];
            $price = $row["price"];
            $discount = $row["discount"];
            $quantity = $row["quantity"];
            
            $prices_per_item = (1 - $discount / (float)100) * $price;
            $subtotal = $prices_per_item * $quantity;
            $total += $subtotal;

            echo '<tr class="table__row">
                                      <td>';
            echo '<img src="./pics/' . $id . '_' . $color . '.jpg" class="cart__thumbnail">';
            echo '    </td>
            <td>' . $name . '</td>
            <td>' . ucfirst($color) . '</td>
            <td>' . $size . '</td>
            <td id="' . $id . '_' . $color . '_' . $size . '_price-single">$' . number_format($prices_per_item, 2) . '</td>
            <td>' . $discount . '%</td>
            <td>' . $quantity . '</td>
            <td>' . $subtotal . '</td>'
            ;
            echo '<td class="user-align--right"><strong>$<span class="price-subtotal" id="' . $id . '_' . $color . '_' . $size . '_price-subtotal">' .
                number_format($subtotal, 2) . '
                                      </span></strong></td>
                                  </tr>';
        }

    }
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