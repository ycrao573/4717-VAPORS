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
    $query_result = $conn->query($qry);
    $row_no = $query_result->num_rows;
    if ($row_no > 0) {
        for ($i = 0; $i < $row_no; $i++) {
            $row = $query_result->fetch_assoc();
            
            $name = $row["name"];
            $qry = 'SELECT p.id from products AS p where name = "'.$name .'"';
            $res = $conn->query($qry);
            $prod = $res->fetch_assoc();
            $id = $row["id"];
            $gender = $row["gender"];
            $color = $row["color"];
            $size = $row["size"];
            $price = $row["price"];
            $discount = $row["discount"];
            
            $query = 'SELECT stock
            FROM inventory WHERE
            productID = ' . $prod["id"] . '
            AND color ="' . $color .'"
            AND size=' . $size . '
            ;';
            $result = $conn->query($query);
            $stockres = $result->fetch_assoc();
            
            $quantity = min($stockres["stock"], $row["quantity"]);

            $conn->query('UPDATE carts SET quantity =
                        '. $quantity .' WHERE id = '. $id .';');
            
            if(!$quantity){
                $conn->query('DELETE from carts WHERE id = '. $id .'');
                continue;
            }

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
    if ($total){
    echo'
    <br><br><h2 style="float:right">Total $<span id="total-price">'
     . number_format($total, 2) . '</span></h2>';
    }else{
        echo '<br><h3 style="float:right">Nothing to Checkout!</h3>';
    }
    ?>
    </div>
    </div>
    <br>
    <?php if ($total){
        echo '
        <button type="submit" class="submitbutton" style="max-width: 250px;
        float: right; margin-right: 2%"><h4>GO TO CHECKOUT</h4></button>';
    }
    ?>
    </form>
    <br><br><br>
    </section>

</body>
<?php include './common/copyright.php';?>

</html>