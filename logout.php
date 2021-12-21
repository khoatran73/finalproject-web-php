<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<?php 
    require_once('general/head.php');
?>
<body>
    <main class="l-main">
        <div class="container code__container">  
            <div class="wrapper">
                <section class="form">
                    <header>Đăng xuất thành công</header>
                    <div class="link">Nhấn <a href="index.php">vào đây</a> để về trang chủ</div>
                </section>
            </div>
        </div>
    </main>
</body>
</html>