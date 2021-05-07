<?php
    session_start();
    if (isset($_SESSION['email'])) {
        header('Location: index.php');
        exit();
    }

    require_once('database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="style/styles.css">
    <title>Đăng nhập</title>
</head>

<body>
    <?php
        $error = "";
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            // if (isset($_POST["submit"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            if (strlen($email) == 0) {
                $error = "Vui lòng nhập Email";
            } else if (strlen($password) == 0) {
                $error = "Vui lòng nhập Mật khẩu";
            } else {
                $data = login($email, $password);

                if ($data) {
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['name'] = $data['name'];

                    if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
                        header('Location: index.php');
                        exit();
                    }    
                } else {
                    $error = "Sai email hoặc mật khẩu";
                }
            }
        }
    ?>
    <div class="wrapper">
        <section class="form loginn">
            <header>EASYSTUDY</header>
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="field input">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Nhập email" <?php if (isset($email)) {echo "value=\"$email\"";}?>>
                </div>
                <div class="field input">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu" <?php if (isset($password)) {echo "value=\"$password\"";}?>>
                    <i class="fas fa-eye" id="pass-i"></i>
                </div>
                
                <div class="field button">
                    <input type="submit" name="submit" value="Đăng nhập">
                </div>

                <div class="error-message" style="color: red; text-align: center;">
                    <?php if (strlen($error) > 0) echo $error ?>
                </div>
            </form>
            <div class="link">Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <!-- <script src="javascript/login.js"></script> -->

</body>

</html>