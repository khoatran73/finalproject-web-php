<?php
    session_start();
    require_once('database.php');

    $type = array('riddle' => 'Câu đố', 'tactic' => 'Chiến thuật', 'funny-question' => 'Đố vui', 
                'racing' => 'Đua xe', 'education' => 'Giáo dục', 'action' => 'Hành động', 
                'simulation' => 'Mô phỏng', 'role-playing' => 'Nhập vai', 'adventure' => 'Phiêu lưu', 
                'sport' => 'Thể thao', 'date' => 'Hẹn hò', 'makeup' => 'Làm đẹp', 
                'contact' => 'Liên lạc', 'social-media' => 'Mạng xã hội', 'photography' => 'Nhiếp ảnh', 
                'map' => 'Bản đồ và chỉ đường');
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

    <main class="l-main">
        <?php
            require_once('general/search.php');
        ?>

        <!--========== FREE APP ==========-->
        <section class="app section bd-container">
            <div class="section-title">
                <h3 class="title">Ứng dụng miễn phí</h3>
                <a href="app-list.php?price=0"><h3 class="button" >Xem thêm</h3></a>
            </div>
            <div class="app__container bd-grid">
                <?php
                    $result = list_app(0);
                    $count = 0;
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="app__data" href="">
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>"><img class="app__img" src="<?= $row['image'] ?>"></a>
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>"><h3 class="app__title"><?= $row['name'] ?></h3></a>
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__provider"><?= $row['name_provider'] ?></a>
                                <div class="app_type-size">
                                    <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__typeProduct"><?= $type[$row['typeProduct']] ?></a>
                                    <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__size"><?= $row['size'] ?> MB</a>
                                </div>
                                <div class="star-fee">
                                    <div class="stars">
                                        <span class="far fa-star star-1"></span>
                                        <span class="far fa-star star-2"></span>
                                        <span class="far fa-star star-3"></span>
                                        <span class="far fa-star star-4"></span>
                                        <span class="far fa-star star-5"></span>
                                    </div>
                                    <div>
                                        <a href="app-info.php?id=<?= $row['IdProduct']?>"><span class="price"><?= $row['price']/1000?>K VND</span></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $count += 1;
                            if ($count >= 4) {
                                break;
                            }
                        }
                    }
                ?>
            </div>
        </section>

        <!--========== PAID APP ==========-->
        <section class="app section bd-container">
            <div class="section-title">
                <h3 class="title">Ứng dụng có phí</h3>
                <a href="app-list.php?price=1"><h3 class="button" >Xem thêm</h3></a>
            </div>
            <div class="app__container bd-grid">
                <?php
                    $result = list_app(1);
                    $count = 0;
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="app__data" href="">
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>"><img class="app__img" src="<?= $row['image'] ?>"></a>
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>"><h3 class="app__title"><?= $row['name'] ?></h3></a>
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__provider"><?= $row['name_provider'] ?></a>
                                <div class="app_type-size">
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__typeProduct"><?= $type[$row['typeProduct']] ?></a>
                                    <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__size"><?= $row['size'] ?> MB</a>
                                </div>
                                <div class="star-fee">
                                    <div class="stars">
                                        <span class="far fa-star star-1"></span>
                                        <span class="far fa-star star-2"></span>
                                        <span class="far fa-star star-3"></span>
                                        <span class="far fa-star star-4"></span>
                                        <span class="far fa-star star-5"></span>
                                    </div>
                                    <div>
                                        <a href="app-info.php?id=<?= $row['IdProduct']?>"><span class="price"><?= $row['price']/1000?>K VND</span></a>
                                    </div>
                                </div>
                                
                            </div>
                            <?php
                            $count += 1;
                            if ($count >= 4) {
                                break;
                            }
                        }
                    }
                ?>
            </div>

        </section>
        
        <!-- ========== Ứng dụng được mua nhiều ==========-->
        <section class="app section bd-container">
            <div class="section-title">
                <h3 class="title">Ứng dụng được mua nhiều</h3>
                <a href="app-list.php?keyword="><h3 class="button">Xem thêm</h3></a>
            </div>
            <div class="app__container bd-grid">
                <?php
                    $result = searchApps('');
                    $count = 0;
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="app__data" href="">
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>"><img class="app__img" src="<?= $row['image'] ?>"></a>
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>"><h3 class="app__title"><?= $row['name'] ?></h3></a>
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__provider"><?= $row['name_provider'] ?></a>
                                <div class="app_type-size">
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__typeProduct"><?= $type[$row['typeProduct']] ?></a>
                                    <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__size"><?= $row['size'] ?> MB</a>
                                </div>
                                <div class="star-fee">
                                    <div class="stars">
                                        <span class="far fa-star star-1"></span>
                                        <span class="far fa-star star-2"></span>
                                        <span class="far fa-star star-3"></span>
                                        <span class="far fa-star star-4"></span>
                                        <span class="far fa-star star-5"></span>
                                    </div>
                                    <div>
                                        <a href="app-info.php?id=<?= $row['IdProduct']?>"><span class="price"><?= $row['price']/1000?>K VND</span></a>
                                    </div>
                                </div>
                                
                            </div>
                            <?php
                            $count += 1;
                            if ($count >= 4) {
                                break;
                            }
                        }
                    }
                ?>
            </div>
        </section>

        <!-- ========== Ứng dụng được mua nhiều ==========-->
        <section class="app section bd-container">
            <div class="section-title">
                <h3 class="title">Ứng dụng cập nhật gần đây</h3>
                <a href="app-list.php?time="><h3 class="button">Xem thêm</h3></a>
            </div>
            <div class="app__container bd-grid">
                <?php
                    $result = list_app_time('');
                    $count = 0;
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="app__data" href="">
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>"><img class="app__img" src="<?= $row['image'] ?>"></a>
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>"><h3 class="app__title"><?= $row['name'] ?></h3></a>
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__provider"><?= $row['name_provider'] ?></a>
                                <div class="app_type-size">
                                <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__typeProduct"><?= $type[$row['typeProduct']] ?></a>
                                    <a href="app-info.php?id=<?= $row['IdProduct'] ?>" class="app__size"><?= $row['size'] ?> MB</a>
                                </div>
                                <div class="star-fee">
                                    <div class="stars">
                                        <span class="far fa-star star-1"></span>
                                        <span class="far fa-star star-2"></span>
                                        <span class="far fa-star star-3"></span>
                                        <span class="far fa-star star-4"></span>
                                        <span class="far fa-star star-5"></span>
                                    </div>
                                    <div>
                                        <a href="app-info.php?id=<?= $row['IdProduct']?>"><span class="price"><?= $row['price']/1000?>K VND</span></a>
                                    </div>
                                </div>
                                
                            </div>
                            <?php
                            $count += 1;
                            if ($count >= 4) {
                                break;
                            }
                        }
                    }
                ?>
            </div>
        </section>
    </main>

    <?php
        require_once('general/footer.php');
    ?>

</body>
<script src="main.js"></script>
</html>