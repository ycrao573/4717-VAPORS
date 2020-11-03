<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>
<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit();
    include './common/contactinfo.php';
    include './common/copyright.php';
    ?>
</body>