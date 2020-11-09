<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>
<style>
.content{
  display: block;
  width: 90%;
  max-width: 1280px;
  margin-left: auto;
  margin-right: auto;
}
</style>
<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit(); ?>
    <section class="checkout">
        <div class="container">
            <div class="content">
            <form method="post" id="checkout" onsubmit="return validatecheckout();">
                <input type="hidden" name="checkout" value="checkout">
                <div style="float: left; margin: 4%; width: 42%">
                    <br>
                    <div>
                        <h3>Shipping Information</h3>
                        <br>
                        <?php
                        // fetch all the data for autocompletion use
                        if (isset($_SESSION["email"])) {
                            $islogin = true;
                            $email = $_SESSION["email"];
                            $qry = 'SELECT * FROM accounts AS a WHERE a.email ="' . $email . '";';
                            $res = $conn->query($qry);

                            $account = $res->fetch_assoc();

                            $id = $account['id'];
                            $name = $account['name'];
                            $gender = $account["gender"];
                            $address = $account["address"];
                            $phone = $account["phone"];
                            $postal = $account["postal"];
                            $ship = 'standard';

                            $res->free();
                        } 
                        echo '
                            <label for="name">
                                Full Name*
                            </label>
                            <span class="input">
                                <input type="text" name="name" id="name" placeholder="Your Full Name" onblur="validateName()" ' . (($islogin && !empty($name)) ? (' value="' . $name . '" disabled') : '') . '>
                            </span><br>

                            <label for="email">
                                Email*
                            </label>

                            <span class="input"><input type="email" name="email" id="email" onblur="validateEmail()" placeholder="name@vapor.sg" required ' . (($islogin && !empty($email)) ? (' value="' . $email . '" disabled') : '') . '></span>' . '

                            <br>

                            <label for="gender">Gender*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="radio" name="gender" value="men" id="men" ' . (($islogin && !empty($gender)) ? ($gender == "M" ? ' checked disabled' : ' disabled') : '') . '/>
                            <label for="gender-men">Men&nbsp;&nbsp;&nbsp;</label>
                            <input type="radio" name="gender" id="women" value="women" ' . (($islogin && !empty($gender)) ? ($gender == "W" ? ' checked disabled' : ' disabled') : '') . ' />
                            <label for="gender-women">Women</label>

                            <br><br>';
                        ?>

                        <label for="phone">
                            Phone Number<br>
                        </label>
                        <span class="input">
                            <input type="text" name="phone" id="phone" placeholder="e.g. 55556666" onblur="validatePhone()" required>
                        </span><br>

                        <label for="address">
                            Shipping Address<br>
                        </label>
                        <span class="input">
                            <input type="text" name="address" id="address" placeholder="e.g. 50 Nanyang Ave" onblur="validateAddress()" required>
                        </span><br>

                        <label for="postal">
                            Postal Code<br>
                        </label>
                        <span class="input">
                            <input type="text" name="postal" id="postal" placeholder="639798" onblur="validatePostalCode()">
                        </span><br>
                        <label for="shipping">
                            <input type="radio" name="shipping" value="standard" id="shipping-standard" class="input-radio" checked>
                            <span><strong>Home Delivery</strong></span>
                            <br>
                            <span>$6.00, 3-5 working days</span>
                        </label><br><br>
                        <span style="float: right">* Required Field<br></span>
                    </div>
                </div>
                <div style="float: right; width: 30px"></div>
                <?php
                if (isset($_POST["checkout"]) && $islogin) {
                    if (isset($_SESSION["email"])) {
                        $msg = "VAPORS: Thanks for purchasing shoes in VAPORS.";
                        mail("f32ee@localhost", "VAPORS: Transaction Successful", $msg);
                    }
                    $msg = "VAPORS: New transaction from " . $name . " received";
                    mail("f32ee@localhost", "VAPORS: New Transaction", $msg);
                    array_splice($_SESSION["cart"], 0, sizeof($items));
                    $validCheckout = true;
                }
                
                echo '<div style="float: right; margin: 4%; width: 42%">
                    <div class="invoice">
                        <br>
                        <h3>Order Confirmation</h3><br>
                        <table class="order-confirmation" style="width: 100%">
                            <tr class="tablerow">
                            <th>
                                    Item
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Subtotal
                                </th>
                            </tr>';

                    $qry = 'SELECT * FROM accounts WHERE email = '. '\'' . $_SESSION["email"] . '\'';
                        $query_result = $conn->query($qry);
                        $row_no = $query_result->num_rows;
                        $row = $query_result->fetch_assoc();
                        $current_id = $row["id"];  
                        // echo $qry;
  
                        $cancheckout = false;
                        $qry = 'SELECT * FROM carts WHERE accountId = '. '\'' . $current_id . '\'';
                        $qry = $qry . ' AND paid = 0';
                        $qry = $qry . ' ORDER BY name, color, size';
                        $qry = $qry . ';';
                        echo $qry;
                        $query_result = $conn->query($qry);
                        $row_no = $query_result->num_rows;
                        if ($row_no > 0) {
                            for ($i = 0; $i < $row_no; $i++) {
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

                                echo '<tr class="tablerow">';
                                echo '
                                <td>' . $name. ' ['. ucfirst($color) . ', '. $size . ']</td>
                                <td>' . $quantity . '</td>'
                                ;
                                echo '<td>'.
                                    number_format($subtotal, 2) . '
                                                        </td>
                                                    </tr>';
                                                    
                            }
                        }else{
                            echo '<br><h3>Nothing to checkout!</h3>';
                            $cancheckout = false;
                        }
                    echo '
                    <tr class="tablerow">
                    <td></td>
                    <td>
                        <div>Subtotal</div>
                        <div>Shipping</div>
                        <div>
                            <h3>Total</h3>
                        </div>
                    </td>                               
                    <td>
                        <div>$' . $total . '</div>
                        <div>$6.00</div>
                        <div>$' . ($total + 6) .'
                        </div>
                    </td>
                    </tr>
                    </table>';
                    echo '
                    </div>
                    <button type="submit" class="submitbutton" id="confirm_checkout">
                        checkout
                    </button>
                    <br>';

                    if (isset($_POST["checkout"]) && $islogin) {
                        if (isset($_SESSION["email"])) {
                            $msg = "VAPORS: Thanks for purchasing shoes in VAPORS.";
                            mail("f32ee@localhost", "VAPORS: Transaction Successful", $msg);
                        }

                        $qry = 'UPDATE carts SET paid = 1 WHERE accountId = ' . $current_id . ' AND paid = 0';
                        // $qry = $qry . ' AND name = ' . '\'' . $name . '\'';
                        // $qry = $qry . ' AND lower(color) = ' . '\'' . ucfirst($input_color) . '\'';
                        // $qry = $qry . ' AND gender = ' . '\'' . $gender . '\'';
                        // $qry = $qry . ' AND size = ' . '\'' . $input_size . '\'';
                        $qry = $qry . ';';
                        echo $qry;
                        $query_result = $conn->query($qry);

                        echo '<h2 style="color: green">Transaction Successful!</h2><br>';
                        echo '<h3><a href="./index.php">Back to the home page</a></h3>';
                        echo '<br><h4>Confirmation Email Sent! <a href="https://192.168.56.2:20000">Check Here</a></h4>';
                    }
                    ?>
                </div>
            </form>
            </div>
        </div>
        </div>
    </section>

    <?php
    include './common/copyright.php';
    ?>
</body>
</html>