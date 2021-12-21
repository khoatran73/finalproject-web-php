<?php
    session_start();
    if (!isset($_SESSION['email']) || $_SESSION['status'] == 'verified') {
        header('Location: index.php');
        exit();
    }

    require_once('database.php');
?>

<!DOCTYPE html>
<html lang="en">

<?php
    require_once("general/head.php");
?>
<body>
    <?php
        require_once("general/header.php"); 
    ?>
    <main class="l-main">
    <?php   
        if (!isset($_POST['submit'])) {
            $code_real = sendMail($_SESSION['email'], $_SESSION['name'], 'Xác minh danh tính');
            $_SESSION['code_real'] = $code_real;
        } else {
            $code_enter = intval($_POST['code']);

            if ($code_enter == $_SESSION['code_real']) {
                $_SESSION['status'] = update_status($_SESSION['email']);
                $success = true;
                unset($_SESSION['code_real']);
            } else {
                $error = "Mã xác minh không đúng. Mã đã được gửi một lần nữa";
            }
        }
    ?>
        <div class="container code__container">
            <?php
                if (!isset($success)) {
                ?>
                <div class="wrapper">
                    <section class="form">
                        <header>Xác minh email</header>
                        <div id="code">
                            <?php
                                if (isset($error)) {
                                    echo $error;
                                } else {
                                    echo "Mã xác minh đã được gửi đến email của bạn";
                                }
                            ?>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="field input">
                                <input type="text" name="code" placeholder="Nhập mã xác minh" maxlength="6">
                            </div>                          
                            <div class="field submit">
                                <input type="submit" name="submit" value="Xác minh">
                            </div>
                        </form>
                    </section>
                </div>
                <?php
                } else {
                    ?>        
                    <div class="wrapper">
                        <section class="form">
                            <header id="header-noneborder">Xác minh tài khoản thành công</header>
                            <div class="link">Nhấn <a href="profile.php">vào đây</a> để trở về trang cá nhân</div>
                        </section>
                    </div>
                    <?php
                }
            ?>
        </div>
    <?php
        require_once("general/footer.php");
    ?>
</body>
<script src="main.js"></script>
</html>