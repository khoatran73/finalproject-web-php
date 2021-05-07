<?php
    session_start();
    if (isset($_SESSION['email'])) {
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="style/styles.css">
    <title>Đăng ký</title>
</head>
<?php
    require_once('database.php');
    $error = '';
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        // $image = "images/". $_FILE['image'];
        // $target_dir = "uploads/";
        // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $target_dir = "images/";
        $image = $target_dir . basename($_FILES["image"]["name"]);
        // $uploadOk = 1;
        // $image = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (strlen($name) == 0) {
            $error = "Vui lòng nhập Họ và tên";
        }else if (strlen($email) == 0) {
            $error = "Vui lòng nhập Email";
        } else if (strlen($password) == 0) {
            $error = "Vui lòng nhập Mật khẩu";
        } else if ($password != $confirm_password) {
            $error = "Mật khẩu nhập lại sai";
        } else {
            if (is_exists_email($email)) {
                $error = "Email đã tồn tại. Vui lòng nhập email khác";
            } else {
                register($name, $email, $password, 'student', $image);
                header('Location: registerSuccess.php');
            }
        }    
    }


?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Hệ thống quản lý khóa học</header>
            <form action="register.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
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
        
                <!-- <div class="field image">
                    <label for="img">Chọn ảnh</label>
                    <input id="img" type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                </div> -->
                <div class="custom-file">  
                    <input type="file" name="image" class="custom-file-input" id="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                    <label class="custom-file-label" for="image">Choose image...</label>
                    <!-- <div class="invalid-feedback">Example invalid custom file feedback</div> -->
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Đăng ký">
                </div>
                
                <div class="error-message" style="color: red; text-align: center;">
                    <?php echo $error ?>
                </div>
            </form>
            <div class="link">Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <!-- <script src="javascript/signup.js"></script> -->

</body>

</html>