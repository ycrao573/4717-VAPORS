<section class="register">
    <div class="container">
        <div class="row">
            <div style="margin: auto; display: block; width: 500px">
                <form onsubmit="return validateRegister();" method="post">
                    <input type="hidden" name="send">
                    <h2>Register</h2><br><hr>
                    <br>
                    <div>
                        <label for="email">
                            Email*
                        </label>
                        <br>

                        <span class="input"><input type="email" name="email" id="email" onblur="validateEmail()" placeholder="name@vapor.sg" required></span>
                        <br><br>

                        <label for="gender">Gender*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="radio" name="gender" value="men" id="men" />
                        <label for="gender-men">Men&nbsp;&nbsp;&nbsp;</label>
                        <input type="radio" name="gender" id="never" value="never" />
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
                            <input type="password" name="second-password" id="second-password" placeholder="Re-enter password" onblur="validateSecPwd()" required>
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

                        <button type="submit" class="submitbutton">
                            Confirm Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>