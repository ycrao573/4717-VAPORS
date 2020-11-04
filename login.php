<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>

<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit();
    if ($_POST["modal"] == "login") {
        $flagLogin = true;
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            $md5password = md5($password);
            $qry = 'SELECT * FROM accounts AS a WHERE a.email ="' . $email . '" AND a.password="' . $md5password . '";';
            $res = $conn->query($qry);
            
            if($res && $res->num_rows == 1){
                $account = $res->fetch_assoc();

                $id = $account['id'];
                $name = $account['name'];
                $gender = $account["gender"];
                $address = $account["address"];
                $phone = $account["phone"];
                $postal = $account["postal"];

                $res->free();

                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;      
            }else{
                $flagLogin = false;
            }
        }
    }

    echo'<br><br>';
    include './common/loginsec.php';
    echo'<br><br>';
    include './common/copyright.php';
    ?>
</body>
</html>