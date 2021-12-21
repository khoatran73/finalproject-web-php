<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('location: index.php');
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
    <div class="container">
        <div class="card">
            <img class="background-img" src="image/background.jpg"></img>
            <img class="avatar" src="<?= $_SESSION['image']?>"><a href="editAvatar.php"><i class="fas fa-camera"></i></a></img>
            <div class="about">
                <div class="name-email">
                    <div>
                        <p class="name"><span class="standard">Tên:</span><?= $_SESSION['name']?></p>
                        <a href="editName.php"><i class="fas fa-edit zoom"></i></a>
                    </div>
                    <div><span class="standard">Email:</span><?= $_SESSION['email']?></div>
                    <div><span class="standard">Trạng thái:</span><?= $_SESSION['status']?></div>  
                    <?php
                        if ($_SESSION['status'] == 'not verified') {
                            echo "<a href=\"verifyEmail.php\"><i class=\"fas fa-key zoom\"></i></a>";
                        }        
                    ?>
                    <div><span class="standard">Bạn là:</span><?= $_SESSION['typeAccount']?></div>
                    <?php
                        if ($_SESSION['typeAccount'] == 'User' && !checkDeveloper($_SESSION['email'])) {
                            echo "<a href=\"upgrade.php\"><i class=\"fas fa-angle-double-up fa-lg\"></i></a>";
                        }        
                    ?>
                </div>
            </div>
            <div class="hr"></div>
            <div class="info">
                <?php
                if ($_SESSION['typeAccount'] != 'Admin') {
                ?>
                <div><span class="standard">Số dư:</span><?= $_SESSION['tien']?> VND</div>
                <a href="inputMoney.php"><i class="fas fa-hand-holding-usd zoom"></i></a>
                
                <?php 
                    if ($_SESSION['typeAccount'] == 'User') {
                        echo "<div class=\"mt-10\"><a href=\"historyApp.php\" class=\"info-btn downloaded\">Ứng dụng đã mua</a></div>";
                    } else if ($_SESSION['typeAccount'] == 'Developer') {
                        echo "<div class=\"mt-10\"><a href=\"appManagement.php\" class=\"info-btn downloaded\">Quản lý ứng dụng</a></div>";
                    }
                ?> 
                <div class="mt-10"><a href="historyMoney.php" class="info-btn money-history">Lịch sử nạp</a></div>
                <?php
                } else {
                    ?>
                        <div class="btn__container">
                            <a href="adminAccount.php" class="info-btn downloaded">Quản lí tài khoản</a>
                            <a href="adminApp.php" class="info-btn downloaded">Quản lý ứng dụng</a>
                            <a href="adminCard.php" class="info-btn downloaded">Quản lí thẻ cào</a>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>

    </div>
    <?php
        require_once("general/footer.php");
    ?>
</body>
<script src="main.js"></script>
</html>