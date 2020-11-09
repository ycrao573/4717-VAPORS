<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>

<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit();

    if (isset($_POST["send"])) {
        $name = $_POST['name'];
        $email = $_POST["email"];
        $msg = $_POST["message"];
        $to      = 'f32ee@localhost';
        mail($to, "Enquires from Customer " . $name . " Email: " . $email, $msg);
    }

    include './common/contactinfo.php';
    include './common/copyright.php';
    ?>
</body>