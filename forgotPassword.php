<?php
    session_start();
    if (isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }   
    require_once("database.php");

    if (isset($_POST['restore'])) {
        $email = $_POST['email'];

        if (is_exists_email($email)) {
            if (sendMail($email, '', 'reset password')) {
                $check = true;
            }
        } else {
            $error = "Email không tồn tại";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php
    require_once("general/head.php");
?>
<body>
    <main class="l-main">
        <div class="container code__container">
        <?php
        if (!isset($_POST['restore']) && !isset($check) || isset($error)) {
        ?>
            <div class="wrapper">
                <section class="form">
                    <header>Khôi phục mật khẩu</header>
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="field input">
                            <input type="text" name="email" placeholder="Nhập email" value="<?php if (isset($email)) { echo $email; }?>">
                        </div>                          
                        <div class="field submit">
                            <input type="submit" name="restore" value="Khôi phục mật khẩu">
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
                <header>Link khôi phục đã được gửi đến email của bạn</header>
                <div class="link">Trở về trang <a href="login.php">đăng nhập</a></div>
            </section>
        </div>

        <?php
        }
        ?>
        </div>
</body>
<script src="main.js"></script>
</html>