<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>

<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit(); ?>
    <section class="checkout">
        <div class="container">
            <div class="row">
                <form method="post" id="checkout" onsubmit="return validatecheckout();">
                    <input type="hidden" name="checkout" value="checkout">
                    <div class="col" style="float: left; width: 10%;"></div>
                    <div class="col" style="float: left; margin: 50px;">
                        <br><br>
                        <div>
                            <h3>Shipping Information</h3>
                            <br>
                            <?php 
                            // fetch all the data for autocompletion use
                            if (isset($_SESSION["email"])){
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
                
                                $res->free();
                            }
                            echo '
                            <label for="name">
                                Full Name*
                            </label>
                            <span class="input">
                                <input type="text" name="name" id="name" placeholder="Your Full Name" onblur="validateName()" ' . (($islogin && !empty($name)) ? (' value="' . $name . '" disabled') : '') .'>
                            </span><br>

                            <label for="email">
                                Email*
                            </label>

                            <span class="input"><input type="email" name="email" id="email" onblur="validateEmail()" placeholder="name@vapor.sg" required ' . (($islogin && !empty($email))? (' value="' . $email . '" disabled') : '') .'></span>'.'

                            <br>

                            <label for="gender">Gender*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="radio" name="gender" value="men" id="men" ' . (($islogin && !empty($gender)) ? ($gender == "M" ? ' checked disabled' : ' disabled') : ''). '/>
                            <label for="gender-men">Men&nbsp;&nbsp;&nbsp;</label>
                            <input type="radio" name="gender" id="women" value="women" ' . (($islogin && !empty($gender)) ? ($gender == "W" ? ' checked disabled' : ' disabled') : ''). ' />
                            <label for="gender-women">Women</label>

                            <br><br>';
                            ?>

                            <label for="phone">
                                Phone Number<br>
                            </label>
                            <span class="input">
                                <input type="text" name="phone" id="phone" placeholder="e.g. 55556666" onblur="validatePhone()">
                            </span><br>

                            <label for="address">
                                Shipping Address<br>
                            </label>
                            <span class="input">
                                <input type="text" name="address" id="address" placeholder="e.g. 50 Nanyang Ave" onblur="validateAddress()">
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
                            </label>
                            <span style="float: right">* Required Field<br></span>

                        </div>
                    </div>
                    <div class="col" style="float: right; width: 30px"></div>
                    <div class="col" style="float: right; display: block; width: 400px; margin: 25px">
                        <button type="submit" class="submitbutton" id="confirm_checkout">
                            checkout
                        </button>
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