<?php
    session_start();
    if (!isset($_SESSION['email'])) {
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
    if (isset($_POST['submit'])) {
        $image = $_FILES['image']; 
        
        // test extension image
        $name_image = basename($image["name"]);
        $image_ext = strtolower(pathinfo($name_image, PATHINFO_EXTENSION));
        $allow_extension_image = array("png", "gif", "jpeg", "jpg");

        if (!in_array($image_ext, $allow_extension_image)) {
            $error = "Sai định dạng ảnh";
        } else {
            $_SESSION['image'] = updateImage($_SESSION['email'], $image);
        }    
    }
?>

<body>
    <div class="container">
        <?php
        if (!isset($_POST['submit'])) {
        ?>
        <div class="wrapper">
            <section class="form signup">
                <header>Đổi avatar</header>
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="custom-file">  
                        <input type="file" name="image" class="custom-file-input" id="image" required>
                        <label class="custom-file-label" for="image">Chọn ảnh đại diện ...</label>
                    </div>
                    <div class="field submit">
                        <input type="submit" name="submit" value="Xác nhận">
                    </div>          
                    <div class="error-message">
                        <?php if (isset($error)) {echo $error;} ?>
                    </div>
                </form>
            </section>
        </div>
        <?php
        } else {
            ?>
            <div class="wrapper">
                <section class="form">
                    <header>Đổi avatar thành công</header>
                    <div class="link">Nhấn <a href="profile.php">vào đây</a> để trở về trang cá nhân</div>
                </section>
            </div>
        <?php
        }
        ?>
    </div>
    <script src="main.js"></script>  
</body>

</html>