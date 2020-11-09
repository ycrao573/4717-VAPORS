<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>

<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit();
    echo '<br><br>';

    if ($_POST["modal"] == "register") {
        $flagReg = true;
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $gender = ucfirst(trim($_POST["gender"]));
        $address = trim($_POST["address"]);
        $phone = trim($_POST["phone"]);
        $password = trim($_POST["password"]);
        $secondpassword = trim($_POST["secondpassword"]);
        $postal = trim($_POST["postal"]);
        if (empty($name) || empty($gender) || empty($password) || empty($secondpassword)) {
            $flagReg = false;
        }

        $md5password = md5($password);

        if ($flagReg) {
            $conn->query("START TRANSACTION;");
            $qry = "INSERT INTO accounts (email, password, name";
            if (!empty($address)) {
                $qry .= ', address';
                $flag1 = true;
            }

            if ($gender[0] == 'W' || $gender[0] == 'M') {
                $qry .= ', gender';
                $flag2 = true;
            }

            if (!empty($phone)) {
                $qry .= ', phone';
                $flag3 = true;
            }

            if (!empty($postal)) {
                $qry .= ', postal';
                $flag4 = true;
            }

            $qry .= ') VALUES ("' . $email . '","' . $md5password . '","' . $name;
            if ($flag1) {
                $qry .= '","' . $address;
            }

            if ($flag2) {
                $qry .= '","' . $gender[0];
            }

            if ($flag3) {
                $qry .= '","' . $phone;
            }

            if ($flag4) {
                $qry .= '","' . $postal;
            }


            $qry .= '");';
            // echo $qry;
            $query_result = $conn->query($qry);

            if (!$query_result || $conn->affected_rows != 1) {
                $flagReg = false;
            }
        }

        if ($flagReg) {
            $qry = 'COMMIT;';
            $conn->query($qry);
            // Implement auto login if session is keeping
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            // member registration email
            $msg = "Dear valued customer, You are now officially a member of VAPORS!";
            $msg = wordwrap($msg, 69);

            // Here we just send to f32ee@localhost for checking
            echo '<span style="color: green">login sucessful!</span>';
            mail('f32ee@localhost', "Registration at VAPORS Successful", $msg);
        } else {
            $conn->query('ROLLBACK;');
        }
    }

    include './common/registersec.php';
    echo '<br><br>';
    include './common/copyright.php';
    ?>
</body>

</html>