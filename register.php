<?php
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

<?php
    require_once('database.php');
    $error = '';
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $image = $_FILES['image']; 
        
        // test extension image
        $name_image = basename($image["name"]);
        $image_ext = strtolower(pathinfo($name_image, PATHINFO_EXTENSION));
        $allow_extension_image = array("png", "gif", "jpeg", "jpg");

        if (strlen($name) == 0) {
            $error = "Vui lòng nhập Họ và tên";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email không hợp lệ";
        } else if (strlen($password) < 6) {
            $error = "Mật khẩu phải có ít nhất 6 ký tự";
        } else if ($password != $confirm_password) {
            $error = "Mật khẩu nhập lại sai";
        } else if (!in_array($image_ext, $allow_extension_image)) {
            $error = "Sai định dạng ảnh";
        } else {
            if (is_exists_email($email)) {
                $error = "Email đã tồn tại. Vui lòng nhập email khác";
            } else {  
                register($name, $email, $password, 'User', $image, 'not verified');
                $_SESSION['register'] = true;
            }
        }    
    }
?>

<body>
    <div class="container">
        <?php
        if (!isset($_SESSION['register'])) {
        ?>
        <div class="wrapper">
            <section class="form signup">
                <header>Đăng ký</header>
                <form action="register.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="field input">
                        <label for="name">Họ và tên</label>
                        <input id="name" type="text" name="name" placeholder="Nhập họ và tên" <?php if (isset($name)) {echo "value=\"$name\"";}?>>
                    </div>
                    <div class="field input">
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email" placeholder="Nhập Email" <?php if (isset($email)) {echo "value=\"$email\"";}?>> 
                    </div>
                    <div class="field input">
                        <label for="pass">Mật khẩu</label>
                        <input id="pass" type="password" name="password" placeholder="Nhập mật khẩu" <?php if (isset($password)) {echo "value=\"$password\"";}?>>
                        <i class="fas fa-eye" id="pass-i"></i>
                    </div>
                    <div class="field input">
                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input id="confirm-pass" type="password" name="confirm-password" placeholder="Xác nhận mật khẩu" <?php if (isset($confirm_password)) {echo "value=\"$confirm_password\"";}?>>
                        <i class="fas fa-eye" id="confirm-pass-i"></i>
                    </div>
                    <div class="custom-file">  
                        <input type="file" name="image" class="custom-file-input" id="image" required>
                        <label class="custom-file-label" for="image">Chọn ảnh đại diện ...</label>
                    </div>
                    <div class="field submit">
                        <input type="submit" name="submit" value="Đăng ký">
                    </div>          
                    <div class="error-message">
                        <?php if (isset($error)) {echo $error;} ?>
                    </div>
                </form>
                <div class="link">Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></div>
            </section>
        </div>
        <?php
        } else {
            ?>
            <div class="container">
                <div class="wrapper">
                    <section class="form">
                        <header>Đăng ký tài khoản thành công</header>
                        <div class="field input money">
                            <p>Nhấn <a href="login.php" class="red-text">vào đây</a> để đăng nhập, hoặc trang web 
                            sẽ tự động chuyển hướng sau <span class="red-text" id="count">10</span> giây nữa.</p>
                        <a class="index__btn" id="login" href="login.php">Đăng nhập</a>
                    </section>
                </div>
            </div>
        <?php
            unset($_SESSION['register']);
        }
        ?>
    </div>
    <script src="main.js"></script>  
</body>

</html>