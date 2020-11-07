<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>

<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit();
    include './common/copyright.php';

    echo '<a href="./checkout.php"><button class="submitbutton" style="max-width: 200px; float: right;">Go to Checkout</button></a>'
    ?>
</body>
</html>