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
                        } ?>
                        <?php
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
                ?>
                <div style="float: right; margin: 4%; width: 42%">
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
                            </tr>
                            <tr class="tablerow">
                                <td>
                                    NIKE MAX 2020
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    $200.00
                                </td>
                            </tr>

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
                                    <div>$200.00</div>
                                    <div>$6.00</div>
                                    <div>$206.00
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <button type="submit" class="submitbutton" id="confirm_checkout">
                        checkout
                    </button>
                    <br>
                    <?php
                    if (isset($_POST["checkout"]) && $islogin) {
                        if (isset($_SESSION["email"])) {
                            $msg = "VAPORS: Thanks for purchasing shoes in VAPORS.";
                            mail("f32ee@localhost", "VAPORS: Transaction Successful", $msg);
                        }
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