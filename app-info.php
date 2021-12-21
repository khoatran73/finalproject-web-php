<?php
    session_start();
    require_once('database.php');
    if (!isset($_GET['id'])) {
        header('location: index.php');
        exit();
    }

    if (!isset($_SESSION['email'])) {
        $email = false;
    }

    $id_product = $_GET['id'];
    $rating_real = updateRatingProduct($id_product);

    $app_info = app_info($id_product);

    if (isset($_POST['submit'])) {
        if (!isset($_SESSION['email'])) {
            $error = "Vui lòng đăng nhập để đánh giá";
        } else {
            $rating = intval($_POST['rating']);
            updateRating($_SESSION['email'], $id_product, $rating);
            $_SESSION['success'] = "Cảm ơn bạn đã đánh giá ứng dụng này";
        }
    }

    $comment = false;
    
    if (isset($_SESSION['comment']) && get_product_of_account($_SESSION['email'])) { // da mua thi duoc phep comment
        $comment = true;
    }

    $type_product = $app_info['typeProduct'];
    $name_provider = $app_info['name_provider'];

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
    require_once("general/head.php");
?>
<body>
    <?php
        require_once("general/header.php");
    ?>
    <main class="l-main">
        <section class="app_info" id="app_info">
            <div class="app_info__container bd-container">
                <div class="app_info__data app_info_img__container">
                    <img class="app_info__img" src="<?= $app_info['image']?>">
                    <?php 
                    if (!isset($_SESSION['success']) && isset($comment)) {
                    ?>
                    <div class="rating">
                        <form action="" method="POST" enctype="multipart/form">
                            <label for="1">1 sao</label>
                            <input type="radio" name="rating" value="1" id="1">
                            <label for="2">2 sao</label>
                            <input type="radio" name="rating" value="2" id="2">
                            <label for="3">3 sao</label>
                            <input type="radio" name="rating" value="3" id="3">
                            <label for="4">4 sao</label>
                            <input type="radio" name="rating" value="4" id="4">
                            <label for="5">5 sao</label>
                            <input type="radio" name="rating" value="5" id="5">
                            <button type="submit" name="submit">OK</button>
                        </form>
                        <div class="error-rating">
                            <?php if (isset($error)) echo $error ?>
                        </div>
                    </div>
                    <div id="id-product" hidden><?= $id_product ?></div>
                    <div id="price" hidden><?= $app_info['price'] ?></div>
                    <?php if(isset($email)) {echo "<div id=\"email\" hidden> $email </div>";} ?>
                    <?php
                    } else if (isset($success)) {
                        unset($_SESSION['success']);
                    ?>
                    <div class="rating ml-10">
                        <?= $success ?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="app_info__data">
                    <div class="app_info_description__data">
                        <h1 class="app_info__title"><?= $app_info['name']?></h1>
                        <div><span class="text-bold">Cung cấp bởi: </span><?= $app_info['name_provider']?></div>
                        <div><span class="text-bold">Giá: </span><?= $app_info['price']?> VND</div>
                        <div><span class="text-bold">Thể loại: </span><?= $type[$app_info['typeProduct']]?></div>
                        <div><span class="text-bold">Size: </span><?= $app_info['size']?> MB</div>
                        <div><span class="text-bold">Số người đã mua: </span><?= $app_info['num_of_purchases']?></div>
                        <div><span class="text-bold">
                            <?= $rating_real ?></span> <span class="far fa-star"></span>
                        </div>
                        <h2>Nội dung</h2>
                        <p class="app_info__description"><?= $app_info['description'] ?></p> 
                    </div>
                    <div class="description__btn">
                        <?php 
                            if (isset($_SESSION['email']) && (check_exist_product($_SESSION['email'], $id_product) ||
                            check_provider($_SESSION['email'], $id_product))) {
                                $app_file = $app_info['file'];
                                $app_name = strtolower($app_info['name']);
                                echo "<a href=\"download.php?file=$app_file&name=$app_name\" class=\"button\" name=\"download\">Tải xuống</a>";
                            } else {
                                $price = $app_info['price'];
                                echo "<a class=\"button\" name=\"pay\" id=\"pay\">Mua ứng dụng</a>";
                            }
                        ?>
                    </div>
                </div> 
            </div>
            <div class="comment_area__container bd-container">
                <div class="bonus__img">
                    <img src="<?= $app_info['image']?>" alt="">
                    <img src="<?= $app_info['image']?>" alt="">
                    <img src="<?= $app_info['image']?>" alt="">
                    <img src="<?= $app_info['image']?>" alt="">
                </div> 
                <div class="comment">
                    <form action="" class="comment-input" method="POST" enctype="multipart/form-data" autocomplete="off"> 
                        <input type="text" class="id_product" name="id_product" value="<?= $id_product ?>" hidden>            
                        <input type="text" name="message" class="input-field field input" placeholder="Viết comment" autocomplete="off">
                        <button class="send"><i class="fas fa-paper-plane fa-lg"></i></button>
                    </form>
                    <div class="comment-area"></div>
                </div>                       
            </div>
        </section>                        
    </main>
    <section class="app section bd-container">
            <div class="section-title">
                <h3 class="title">Ứng dụng cùng thể loại</h3>
                <a href=<?php echo "app-list.php?type=$type_product"?>><h3 class="button" >Xem thêm</h3></a>
            </div>
            <div class="app__container bd-grid">
                <?php
                    $result = get_product_same_type($app_info['typeProduct'], $id_product);
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
    <section class="app section bd-container">
            <div class="section-title">
                <h3 class="title">Ứng dụng cùng nhà phát triển</h3>
                <a href=<?php echo "app-list.php?name_provider=$name_provider"?>><h3 class="button" >Xem thêm</h3></a>
            </div>
            <div class="app__container bd-grid">
                <?php
                    $provider_result = get_product_same_name_provider($app_info['name_provider'], $id_product);
                    $count = 0;
                    if ($provider_result && $provider_result->num_rows > 0) {
                        while ($row = $provider_result->fetch_assoc()) {
                            $count += 1;
                            if ($count > 4) {
                                break;
                            }
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
                        }
                    }
                ?>
            </div>
    </section>
    <?php
        require_once("general/footer.php")
    ?>

    <script src="main.js"></script>
</body>
</html>