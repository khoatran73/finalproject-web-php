<?php
    require_once('database.php');
    session_start();
    if (isset($_SESSION['email'])) {
        header('location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php
    require_once('general/head.php');
?>

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
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['name'] = $data['name'];
                    $_SESSION['image'] = $data['image'];
                    $_SESSION['typeAccount'] = $data['typeAccount'];
                    $_SESSION['tien'] = $data['tien'];
                    $_SESSION['status'] = $data['status'];

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
    <div class="container">
        <div class="wrapper">
            <section class="form">
                <header>Google Play</header>
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    
                    <div class="field input">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Nhập email" <?php if (isset($email)) {echo "value=\"$email\"";}?>>
                    </div>
                    <div class="field input">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" placeholder="Nhập mật khẩu" <?php if (isset($password)) {echo "value=\"$password\"";}?>>
                        <i class="fas fa-eye" id="pass-i"></i>
                    </div>
                    
                    <div class="field submit">
                        <input type="submit" name="submit" value="Đăng nhập">
                    </div>

                    <div class="error-message">
                        <?php if (isset($error)) echo $error ?>
                    </div>
                </form>
                <div class="link"><a href="forgotPassword.php">Quên mật khẩu?</a></div>
                <div class="link">Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a></div>
            </section>
        </div>
    </div>

    <script src="main.js"></script>

</body>
</html>