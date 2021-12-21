<?php
    session_start();
    
    if (!isset($_SESSION['email']) || !isset($_GET['id']) || !isset($_GET['price'])) {
        header('location: index.php');
        exit();
    } 

    require_once('database.php');

    $id = $_GET['id'];
    $price = $_GET['price'];

    $result = get_product_of_account($_SESSION['email']);

    if ($result&& $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $app_info = app_info($row['IdProduct']);
            
            if ($app_info['IdProduct'] == $id) {
                header('location: app-info.php?id='. $id);
                exit();
            }
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
    if (checkTien($_SESSION['email'], $price)) {
        add_product_of_account($_SESSION['email'], $id);
        update_num_of_purchases($id);
        $_SESSION['tien'] =  updateTien($_SESSION['email'], 0, $price);
        ?>
        <div class="container">
            <div class="wrapper">
                <section class="form">
                    <header>Mua ứng dụng thành công</header>
                    <div class="link">Bạn còn <span class="color"><?= $_SESSION['tien'] ?></span> trong tài khoản</div>
                    <div class="link"><a <?php echo "href=\"app-info.php?id=$id\"" ?>>Quay lại</a></div>
                </section>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <div class="wrapper">
                <section class="form">
                    <header>Tài khoản của bạn không đủ</header>
                    <div class="link"><a href="inputMoney.php">Nạp thêm tiền?</a></div>
                    <div class="link"><a <?php echo "href=\"app-info.php?id=$id\""?>>Quay lại</a></div>
                </section>
            </div>
        </div>
        <?php
    }
?>
</body>
<script src="main.js"></script>
</html>