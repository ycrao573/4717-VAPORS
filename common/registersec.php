<section class="register">
    <div class="container">
        <div class="row">
            <div style="margin: auto; display: block; width: 500px">
                <?php
                    if (isset($_SESSION["name"])) {
                    echo '<h2 style="color: green">You have successfully Registered!</h2><br><br>';
                    echo '<h3><a href="./index.php">Back to the home page</a></h3>';
                    echo '<br><h4><a href="https://192.168.56.2:20000">Check Your Email!</a></h4>';
                    }else{
                        echo '
                        <form method="post" id="register" onsubmit="return validateRegister();">
                        <input type="hidden" name="modal" value="register">    
                            <h2>Register</h2><br><hr>
                            <br>
                            <div>
                            <label for="name">
                                    Full Name*<br>
                                </label>
                                <span class="input">
                                    <input type="text" name="name" id="name" placeholder="Your Full Name" onblur="validateName()">
                                </span><br><br>
        
                                <label for="email">
                                    Email*
                                </label>
                                <br>
        
                                <span class="input"><input type="email" name="email" id="email" onblur="validateEmail()" placeholder="name@vapor.sg" required></span>
                                <br><br>
        
                                <label for="gender">Gender*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="radio" name="gender" value="men" id="men" />
                                <label for="gender-men">Men&nbsp;&nbsp;&nbsp;</label>
                                <input type="radio" name="gender" id="women" value="women" />
                                <label for="gender-women">Women</label>
                                <br><br>
        
                                <label for="password">
                                    Password*<br>
                                </label>
                                <span class="input">
                                    <input type="password" name="password" id="password" placeholder="Enter password" onblur="validatePwd()" required>
                                </span><br><br>
        
                                <label for="re-password">
                                    Verify Your Password*<br>
                                </label>
                                <span class="input">
                                    <input type="password" name="secondpassword" id="secondpassword" placeholder="Re-enter password" onblur="validateSecPwd()" required>
                                </span><br><br>
        
                                <label for="phone">
                                    Phone Number<br>
                                </label>
                                <span class="input">
                                    <input type="text" name="phone" id="phone" placeholder="e.g. 55556666" onblur="validatePhone()">
                                </span><br><br>
        
                                <label for="address">
                                    Shipping Address<br>
                                </label>
                                <span class="input">
                                    <input type="text" name="address" id="address" placeholder="e.g. 50 Nanyang Ave" onblur="validateAddress()">
                                </span><br><br>
        
                                <label for="postal">
                                    Postal Code<br>
                                </label>
                                <span class="input">
                                    <input type="text" name="postal" id="postal" placeholder="639798" onblur="validatePostalCode()">
                                </span><br><br>
        
                                <span style="float: right">* Required Field<br><br></span>
        
                                <button type="submit" class="submitbutton" id="confirm_registration">
                                    Register
                                </button>
                            </div>
                        </form>
                        
                        
                        ';
                    }?>
            </div>
        </div>
    </div>
</section>