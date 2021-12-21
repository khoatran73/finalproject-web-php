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
            if (!isset($_GET['keyword']) && !isset($_GET['type']) && !isset($_GET['name_provider']) 
            && !isset($_GET['price']) && !isset($_GET['time'])) {
                header('location: index.php');
                exit();
            }
            
            if (isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $result = searchApps($keyword);
            } else if (isset($_GET['type'])) {
                $type_product = $_GET['type'];
                $result = get_product_allsame_type($type_product);
            } else if (isset($_GET['name_provider'])) {
                $name_provider = $_GET['name_provider'];
                $result = get_product_same_allname_provider($name_provider);
            } else if (isset($_GET['price'])) {
                $price = intval($_GET['price']);
                $result = list_app($price);
            } else {
                $result = list_app_time();
            }
            
        ?>
        <section class="app section bd-container">
            <div class="section-title">
                <?php 
                if (isset($keyword)) {
                    if (strlen($keyword) > 0) {
                        echo "<h3 class=\"title\">Tìm thấy <span class=\"color\">$result->num_rows</span> 
                        ứng dụng liên quan đến từ khóa <span class=\"color\">$keyword</span></h3>";
                    } else {
                        echo "<h3 class=\"title\">Tất cả ứng dụng</h3>";
                    }
                    
                } else if (isset($type_product)) {
                    echo "<h3 class=\"title\">Tìm thấy <span class=\"color\">$result->num_rows</span> 
                    ứng dụng thuộc thể loại <span class=\"color\">$type[$type_product]</span></h3>";
                } else if (isset($name_provider)) {
                    echo "<h3 class=\"title\">Tìm thấy <span class=\"color\">$result->num_rows</span> 
                    ứng dụng có cùng nhà cung cấp <span class=\"color\">$name_provider</span></h3>";
                } else if (isset($price)) {
                    if ($price == 0) {
                        echo "<h3 class=\"title\">Ứng dụng miễn phí</h3>";
                    } else {
                        echo "<h3 class=\"title\">Ứng dụng trả phí</h3>";
                    }
                } else {
                    echo "<h3 class=\"title\">Ứng dụng cập nhật gần đây</h3>";
                }

                ?>
               
            </div>
            <div class="app__container bd-grid">
                <?php
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