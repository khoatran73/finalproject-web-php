<?php
    session_start();
    if (isset($_SESSION['email'])) {
        header('location: index.php');
        exit();
    }
    
    require_once('database.php');
    $email = $_GET['email'];
    $token = $_GET['token'];

    $token_real = getTokenAccount($email);

    if (!password_verify($token, $token_real)) {
        header('location: index.php');
        exit();
    }

    if (isset($_POST["submit"])) {
        $pass = $_POST["password"];
        $confirm_pass = $_POST["confirm-password"];

        if (strlen($pass) < 6) {
            $error = "Mật khẩu phải có ít nhât 6 ký tự";
        } else if ($pass == $confirm_pass) {
            $_SESSION['success'] = true;
            updatePassword($email, $pass);
            deleteTokenAccount($email);
            // header('location: login.php');
            // exit();
        } else {
            $error = "Nhập lại mật khẩu không đúng";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<?php
    require_once('general/head.php');
?>
<body>
    <main class="l-main">
        <div class="container code__container">
            <?php 
            if (!isset($_SESSION['success'])) {
            ?>
            <div class="wrapper">
                <section class="form">
                    <header>Khôi phục mật khẩu</header>
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="field input">
                            <label for="">Mật khẩu mới</label>
                            <input type="password" name="password" placeholder="Nhập mật khẩu mới" <?php if (isset($pass)) {echo "value=\"$pass\"";}?>>
                            <i class="fas fa-eye" id="pass-i"></i>
                        </div>   
                        <div class="field input">
                            <label for="">Xác nhận mật khẩu</label>
                            <input type="password" name="confirm-password" placeholder="Nhập lại mật khẩu" <?php if (isset($confirm_pass)) {echo "value=\"$confirm_pass\"";}?>>
                            <i class="fas fa-eye" id="confirm-pass-i"></i>
                        </div>                         
                        <div class="field submit">
                            <input type="submit" name="submit" value="Xác nhận">
                        </div>
                        <div class="error-message">
                            <?php if (isset($error)) echo $error ?>
                        </div>
                    </form>
                    <div class="link">Trở về trang <a href="login.php">đăng nhập</a></div>
                </section>
            </div>
            <?php
            } else { 
            ?>
            <div class="wrapper">
                <section class="form">
                    <?php
                    unset($_SESSION['success']);
                    ?>
                    <header>Khôi phục mật khẩu thành công</header>
                    <div class="link"><a href="login.php">đăng nhập?</a></div>
                </section>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
<script src="main.js"></script>
</html>
