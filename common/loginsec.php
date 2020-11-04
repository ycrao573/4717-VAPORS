<section class="login">
    <div class="container">
        <div class="row">
            <div style="margin: auto; display: block; width: 400px">
                <?php
                if (isset($_SESSION["name"])) {
                    echo '<h2 style="color: green">Login Success!</h2><br><br>';
                    echo '<h3><a href="./index.php">Back to the home page</a></h3>';
                }
                else{
                echo'
                <form method="post" id="login" onsubmit="return validateLogin();">
                    <input type="hidden" name="modal" value="login">
                    <h2>Login</h2>
                    <br>
                    <hr>
                    <br>
                    <div>
                        <label for="email">
                            Email<br>
                        </label>
                        <span class="input"><input type="email" name="email" id="email" onblur="validateEmail()" placeholder="name@email.com" required></span>

                        <label for="message">
                            Password<br>
                        </label>
                        <span class="input">
                            <input type="password" name="password" id="password" onblur="validatePwd()" placeholder="Enter password" required>
                        </span>
                        <button type="submit" class="submitbutton">
                            Login
                        </button>
                        <span style="float: right"><br>Not A VAPORS Member?&nbsp;&nbsp;&nbsp;&nbsp;<a href="register.php"><span class="buttontext">Create a free account now!</span></a></span>
                    </div>
                </form>';
                }
                ?>
            </div>
        </div>
    </div>
</section>