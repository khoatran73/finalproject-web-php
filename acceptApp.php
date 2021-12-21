<?php
    session_start();
    require_once('database.php');

    if (!isset($_SESSION['email']) || $_SESSION['typeAccount'] != 'Admin') {
        header('Location: index.php');
        exit();
    }

    if (!isset($_GET['id']) || !isset($_GET['email'])) {
        header('Location: adminApp.php');
        exit();
    }

    $email = $_GET['email'];
    $idproduct = $_GET['id'];

    sendMail($email, '', 'Duyệt app');
    update_product_status($idproduct);
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
        <div class="container code__container">
            <div class="wrapper">
                <section class="form">
                    <header id="header-noneborder">Duyệt app thành công/header>
                    <div class="link">Một email đã được gửi đến người dùng</div>
                    <div class="link">Nhấn <a href="adminApp.php">vào đây</a> để quay lại</div>
                </section>
            </div>
        </div>
    </main>
    <?php
        require_once("general/footer.php"); 
    ?>
</body>