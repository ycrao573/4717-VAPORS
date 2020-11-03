<section class="register">
    <div class="container">
        <div class="row">
            <div class="qtr col"></div>
            <div class="halfwid col">
                <form onsubmit="return validateEmail();" method="post">
                    <input type="hidden" name="send">
                    <h2>Register</h2>
                    <br>
                    <div>
                        <label for="email">
                            Email
                        </label>
                        <br>
                        <span class="input"><input type="email" name="email" id="email" onblur="validateEmail()" placeholder="name@vapor.sg" required></span>
                        <br><br>
                        <label for="gender">Gender</label>
                        <input type="radio" name="gender" value="men" id="men" />
                        <label for="gender-men">Men</label>

                        <input type="radio" name="gender" id="never" value="never" />
                        <label for="gender-women">Women</label>
                        <br><br>
                        <label for="password">
                            Password<br>
                        </label>
                        <span class="input">
                            <input type="password" name="password" id="password" placeholder="Enter password" required>
                        </span><br><br>
                        <label for="re-password">
                            Verify Your Password<br>
                        </label>
                        <span class="input">
                            <input type="password" name="second-password" id="second-password" placeholder="Re-enter password" required>
                        </span><br><br>
                        <button type="submit" class="submitbutton">
                            Confirm Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>