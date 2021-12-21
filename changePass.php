<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('location: index.php');
        exit();
    }
    
    require_once('database.php');


    if (isset($_POST["submit"])) {
        $pre_pass = $_POST["pre-pass"];
        $pass = $_POST["password"];
        $confirm_pass = $_POST["confirm-password"];

        $real_pass = getPassword($_SESSION['email']);
        if (!password_verify($pre_pass, $real_pass)) {
            $error = "Mật khẩu hiện tại không chính xác";
        }else if (strlen($pass) < 6) {
            $error = "Mật khẩu mới phải có ít nhât 6 ký tự";
        } else if ($pass == $confirm_pass) {
            $_SESSION['success'] = true;
            updatePassword($_SESSION['email'], $pass);
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
                    <header>Đổi mật khẩu</header>
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="field input">
                            <label for="">Mật khẩu hiện tại</label>
                            <input type="password" name="pre-pass" placeholder="Nhập mật khẩu hiện tại" <?php if (isset($pre_pass)) {echo "value=\"$pre_pass\"";}?>>
                            <i class="fas fa-eye" id="pass-i"></i>
                        </div> 
                        <div class="field input">
                            <label for="">Mật khẩu mới</label>
                            <input type="password" name="password" placeholder="Nhập mật khẩu mới" <?php if (isset($pass)) {echo "value=\"$pass\"";}?>>
                            <i class="fas fa-eye" id="confirm-pass-i"></i>
                        </div>   
                        <div class="field input">
                            <label for="">Xác nhận mật khẩu</label>
                            <input type="password" name="confirm-password" placeholder="Nhập lại mật khẩu mới" <?php if (isset($confirm_pass)) {echo "value=\"$confirm_pass\"";}?>>
                            <i class="fas fa-eye" id="confirm-pass-i2"></i>
                        </div>                         
                        <div class="field submit">
                            <input type="submit" name="submit" value="Xác nhận">
                        </div>
                        <div class="error-message">
                            <?php if (isset($error)) echo $error ?>
                        </div>
                    </form>
                    <div class="link">Quay lại <a href="index.php">trang chủ</a></div>
                </section>
            </div>
            <?php
            } else { 
                session_destroy();
            ?>
            <div class="wrapper">
                <section class="form">
                    <header>Đổi mật khẩu thành công</header>
                    <div class="link">Bạn vui lòng <a href="login.php">đăng nhập</a> lại</div>
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
