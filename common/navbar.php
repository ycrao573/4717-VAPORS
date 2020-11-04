<div class="navright">
<?php
if (isset($_SESSION["name"])) {
    echo '<a href="#" <strong>Welcome, ' .
        $_SESSION["name"] . '</a>';
    echo '<form name="form-signout" method="post">
    <input type="hidden" name="user_action" value="logout">';
}
?>

    <a href="./register.php">Register</a>
    <a href="./login.php">Login</a>
    <a href="./contactus.php">Contact Us</a>
</div>
<div class="topnav">
    <a href="./index.php"><img src="./pics/logo.png" width="100"></a>
    <a href="./shop.php">Men</a>
    <a href="./shop.php">Women</a>
    <a style="float: right" href="./cart.php">My Shopping Cart</a>
    <div class="search-container">
        <form action="/shop.php">
            <input type="text" placeholder="Search for your shoes!" name="search">
            <button type="submit">Search</button>
        </form>
    </div>
</div>