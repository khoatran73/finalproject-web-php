<?php
    session_start();
    if(!isset($_SESSION['email']) || $_SESSION['typeAccount'] != 'Admin') {
        header('location: index.php');
        exit();
    }

    require_once('database.php');

    if (isset($_POST['submit'])) {
        $seri = $_POST['seri'];
        $mathe = $_POST['mathe'];
        $menhgia = intval($_POST['menhgia']);

        add_thecao($seri, $mathe, $menhgia);
        $_SESSION['success'] = true;    
    }

?>
<!DOCTYPE html>
<html lang="en">
<?php
    require_once("general/head.php");
?>

<body>
    <?php
        require_once "general/header.php";
    ?>
    <main class="l-main">
        <div class="container margin-top">
            <?php
            if (!isset($_SESSION['success'])) {
            ?>
            <div class="wrapper">
                <section class="form signup">
                    <header>Tạo thẻ cào</header>
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="field input">
                            <label for="name">Số seri</label>
                            <input id="name" type="text" name="seri" placeholder="Nhập số seri" required maxlength="11">
                        </div>
                        <div class="field input">
                            <label for="price">Mã thẻ</label>
                            <input id="price" type="text" name="mathe" placeholder="Nhập mã thẻ" required maxlength="13">
                        </div>
                        <div class="field input">
                            <label>Chọn mệnh giá</label>
                            <select class="form-control" name="menhgia" required>
                                <option value="">Chọn mệnh giá</option>
                                <option value="20000">20000 VND</option>
                                <option value="50000">50000 VND</option>  
                                <option value="100000">100000 VND</option> 
                                <option value="200000">200000 VND</option> 
                                <option value="500000">500000 VND</option> 
                            </select>
                        </div>
                        <div class="field submit">
                            <input type="submit" name="submit" value="Tạo thẻ cào">
                        </div>          
                    </form>
                </section>
            </div>
            <?php
            } else {
                unset($_SESSION['success']);
            ?>
            <div class="wrapper">
                <section class="form">
                    <header>Tạo thẻ cào thành công</header>
                    <div class="link">Nhấn <a href="adminCard.php">vào đây</a> để quay lại</div>
                </section>
            </div>
            <?php
            }
            ?>
        </div>
    </main>
    <?php
        require_once "general/footer.php";
    ?>
</body>
<script src="main.js"></script>

</html>