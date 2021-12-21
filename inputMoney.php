<?php
    require_once('database.php');
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: index.php');
        exit();
    }

    
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
        if (isset($_POST['submit'])) {
            $seri = $_POST['seri'];
            $mathe = $_POST['mathe'];

            if ($menhgia = input_money($_SESSION['email'], $seri, $mathe)) {
                $_SESSION['success'] = true;
                $_SESSION['tien'] += $menhgia;
            } else {
                $error = "Sai số seri hoặc mã thẻ";
            }
        }
    ?>
        <div class="container">
            <?php
                if (!isset($_SESSION['success'])) {
                ?>
                <div class="wrapper">
                    <section class="form">
                        <header>Nạp tiền</header>
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="field input">
                                <label>Số seri</label>
                                <input type="text" name="seri" placeholder="Nhập số seri">
                            </div>
                            <div class="field input">
                                <label>Mã thẻ</label>
                                <input type="text" name="mathe" placeholder="Nhập mã thẻ">
                            </div>
                            <div class="error-message">
                                <?php if (isset($error) > 0) echo $error ?>
                            </div>
                            
                            <div class="field submit">
                                <input type="submit" name="submit" value="Nạp tiền">
                            </div>
                        </form>
                    </section>
                </div>
                <?php
                } else {
                    unset($_SESSION['success']);
                    ?>
                    <div class="container">
                        <div class="wrapper">
                            <section class="form">
                                <header>Nạp tiền thành công</header>
                                <div class="field input money">Tài khoản của bạn có: <span class="price"><?= $_SESSION['tien']?> VND</span></div>
                            </section>
                        </div>
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