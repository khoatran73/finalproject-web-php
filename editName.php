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
        $name = $_POST['name'];       

        $_SESSION['name'] = updateName($_SESSION['email'], $name);
    }
?>

<body>
    <div class="container">
        <?php
        if (!isset($_POST['submit'])) {
        ?>
        <div class="wrapper">
            <section class="form signup">
                <header>Đổi tên</header>
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="field input">   
                        <label for="name">Họ và tên</label>
                        <input id="name" type="text" name="name" placeholder="Nhập họ và tên" 
                            <?php if (isset($name)) {echo "value=\"$name\"";}?> required>
                    </div> 
                    <div class="field submit">
                        <input type="submit" name="submit" value="Xác nhận">
                    </div>          
                </form>
                <div class="link">Nhấn <a href="profile.php">vào đây</a> để trở về trang cá nhân</div>
            </section>
        </div>
        <?php
        } else {
            ?>
            <div class="wrapper">
                <section class="form">
                    <header>Đổi tên thành công</header>
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