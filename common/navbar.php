<div class="navright">
    <?php
    if ($_POST["modal"] == "logout") {
        unset($_SESSION["name"]);
        unset($_SESSION["email"]);
    }

    if (isset($_SESSION["name"])) {
        echo '<a href="#" <strong>Welcome, ' .
            $_SESSION["name"] . '</a>';
        echo '
            <form class="logout" name="form-signout" method="post">
            <input type="hidden" name="modal" value="logout">
            <span onclick="document.forms[\'form-signout\'].submit();">
            Log Out</span></form>';
    } else {
        echo '<a href="./register.php">Register</a>
        <a href="./login.php">Login</a>';
    }
    ?>
    <a href="./contactus.php">Contact Us</a>
</div>
<div class="topnav">
    <a href="./index.php"><img src="./pics/logo.png" width="105"></a>
    <a href="./shop.php?gender[]=M">Men</a>
    <a href="./shop.php?gender[]=W">Women</a>
    <a style="float: right" href="./cart.php">My Shopping Cart</a>
    <div class="search-container">
        <form action="./shop.php">
            <input type="text" placeholder="Search for your shoes!" name="search">
            <button type="submit">Search</button>
        </form>
    </div>
</div>