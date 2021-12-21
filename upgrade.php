<?php
    session_start();
    require_once('database.php');
    
    if (!isset($_SESSION['email']) || $_SESSION['typeAccount'] != 'User' || check_developer($_SESSION['email'])) {
        header('location: index.php');
        exit();
    }   

    if (isset($_POST['submit'])) {
        $name_provider = $_POST['name_provider'];
        $image1 = $_FILES['image1']; 
        $image2 = $_FILES['image2']; 
        
        // test extension image
        $name_image1 = basename($image1["name"]);
        $image_ext1 = strtolower(pathinfo($name_image1, PATHINFO_EXTENSION));

        $name_image2 = basename($image2["name"]);
        $image_ext2 = strtolower(pathinfo($name_image2, PATHINFO_EXTENSION));

        $allow_extension_image = array("png", "gif", "jpeg", "jpg");

        if (!in_array($image_ext1, $allow_extension_image) || !in_array($image_ext2, $allow_extension_image)) {
            $error = "Sai định dạng ảnh"; 
        } else {
            $_SESSION['success'] = true;
            addDeveloper($_SESSION['email'], $name_provider, $image1, $image2);
            $_SESSION['tien'] = updateTien($_SESSION['email'], 0, 500000);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php
    require_once('general/head.php');
?>
<body>
<?php
    require_once('general/header.php');
?>

<?php
    if ($_SESSION['tien'] >= 500000 && !isset($_SESSION['success'])) {
        ?>
        <div class="container">
            <div class="wrapper">
                <section class="form">
                    <header>Nâng cấp thành Developer</header>
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="error-text">Bạn sẽ phải trả 500000 VND để nâng cấp thành nhà phát triển</div>
                        <div class="field input">
                            <label for="">Tên nhà cung cấp</label>
                            <input type="text" name="name_provider" placeholder="Nhập tên nhà cung cấp ..." required>
                        </div>      
                        <div class="custom-file">  
                            <input type="file" name="image1" class="custom-file-input" id="image1" accept="image/*" required>
                            <div class="custom-file-label" for="image1">CMND mặt trước ...</div>
                        </div>
                        <div class="custom-file mt-10">  
                            <input type="file" name="image2" class="custom-file-input" id="image2" accept="image/*" required>
                            <div class="custom-file-label" for="image2">CMND mặt sau ...</div>
                        </div>                    
                        <div class="field submit">
                            <input type="submit" name="submit" value="Xác nhận">
                        </div>
                        <div class="error-message">
                            <?php if (isset($error)) echo $error ?>
                        </div>
                    </form>
                    <div class="link">Nhấn <a href="profile.php">vào đây</a> để quay lại</div>
                </section>
            </div>
        </div>
        <?php
    } else if (!isset($_SESSION['success'])) {
        ?>
        <div class="container">
            <div class="wrapper">
                <section class="form">
                    <header>Tài khoản của bạn không đủ</header>
                    <div class="link"><a href="inputMoney.php">Nạp thêm tiền?</a></div>
                    <div class="link"><a <?php echo "href=\"profile.php\""?>>Quay lại</a></div>
                </section>
            </div>
        </div>
        <?php
    } else {
        unset($_SESSION['success']);
        ?>
        <div class="container">
            <div class="wrapper">
                <section class="form">
                    <header>Gửi yêu cầu thành công</header>
                    <div class="link">Bạn hiện còn <span class="color"><?= $_SESSION['tien'] ?> VND</span> trong tài khoản<br>Hãy đợi quản trị viên duyệt nhé</div>
                    <div class="link">Nhấn <a href="profile.php">vào đây</a> để quay lại</div>
                </section>
            </div>
        </div>
        <?php
    }
    ?>
        
?>
</body>
<script src="main.js"></script>
</html>