<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('location: index.php');
        exit();
    }

    require_once('database.php');

    $result = get_product_of_account($_SESSION['email']);

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
        <table class="history__container history_app__container">
            <header class="history__title">Các ứng dụng đã mua</header>
            <tr class="history__header history_app__header">
                <th class="history__item history_app__item">STT</th>
                <th class="history__item history_app__item">Tên ứng dụng</th>
                <th class="history__item history_app__item">Tên nhà cung cấp</th>
                <th class="history__item history_app__item">Thể loại</th>
                <th class="history__item history_app__item">Giá</th>
                <th class="history__item history_app__item">Thời gian mua</th>
                <th class="history__item history_app__item">Tải xuống</th>
            </tr>
            <?php   
            if ($result&& $result->num_rows > 0) {
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    $count += 1;
                    $app_info = app_info($row['IdProduct']);
                    $app_file = $app_info['file'];
                    $app_name = strtolower($app_info['name']);
                    ?>
                    <tr class="history__data history_app__data">
                        <td class="history__item history_app__item"><?= $count ?></td>
                        <td class="history__item history_app__item"><?= $app_info['name'] ?></td>
                        <td class="history__item history_app__item"><?= $app_info['name_provider'] ?></td>
                        <td class="history__item history_app__item"><?= $type[$app_info['typeProduct']] ?></td>
                        <td class="history__item history_app__item"><?= $row['datetime'] ?></td>
                        <td class="history__item history_app__item"><?= $app_info['price'] ?> VND</td>
                        <td class="history__item history_app__item"><?php echo "<a href=\"download.php?file=$app_file&name=$app_name\" class=\"button\" name=\"download\">Tải xuống</a>";?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </main>
</body>
</html>