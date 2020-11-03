<section class="login">
    <div class="container">
        <div class="row">
            <div class="qtr col"></div>
            <div class="halfwid col">
                <form onsubmit="return validateEmail();" method="post">
                    <input type="hidden" name="send">
                    <h2>Login</h2>
                    <div>
                        <label for="email">
                            Email<br>
                        </label>
                        <span class="input"><input type="email" name="email" id="email" onblur="validateEmail()" placeholder="name@email.com" required></span>

                        <label for="message">
                            Password<br>
                        </label>
                        <span class="input">
                            <input type="password" name="password" id="password" placeholder="Enter password" required>
                        </span>
                        <button type="submit" class="submitbutton">
                            Login
                        </button>
                        <span style="float: right">New to VAPORS? <a href="register.php"><span class="buttontext">Create free account</span></a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>