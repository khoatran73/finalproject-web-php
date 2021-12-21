<?php
    session_start();
    if (!isset($_SESSION['email']) || $_SESSION['typeAccount'] != 'Developer') {
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
                'map' => 'Bản đồ');

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
                        <td class="history__item history_app__item"><?= $app_info['price'] ?> VND</td>
                        <td class="history__item history_app__item"><?= $row['datetime'] ?></td>
                        <td class="history__item history_app__item"><?php echo "<a href=\"download.php?file=$app_file&name=$app_name\" class=\"button\" name=\"download\">Tải xuống</a>";?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <table class="history__container history_app__container">
            <header class="history__title">
                <div>Các ứng dụng của tôi</div>
                <a href="createApp.php"><i class="fas fa-plus fa-app"></i></a>
            </header>
            <tr class="history__header history_app__header">
                <th class="history__item history_app__item">STT</th>
                <th class="history__item history_app__item">Tên ứng dụng</th>
                <th class="history__item history_app__item">Thể loại</th>
                <th class="history__item history_app__item">Giá</th>
                <th class="history__item history_app__item">Thời gian đăng tải</th>
                <th class="history__item history_app__item">Chỉnh sửa</th>
                <th class="history__item history_app__item">Xóa</th>
            </tr>
            <?php  
            $my_result = get_my_product($_SESSION['email']);
            if ($my_result && $my_result->num_rows > 0) {
                $count = 0;
                while ($row = $my_result->fetch_assoc()) {
                    $count += 1;
                    ?>
                    <tr class="history__data history_app__data">
                        <td class="history__item history_app__item"><?= $count ?></td>
                        <td class="history__item history_app__item"><a class="app__provider" href="order.php?id=<?= $row['IdProduct']?>"><?= $row['name'] ?></td>
                        <td class="history__item history_app__item"><?= $type[$row['typeProduct']] ?></td>
                        <td class="history__item history_app__item"><?= $row['price'] ?> VND</td>
                        <td class="history__item history_app__item"><?= $row['datetime'] ?></td>
                        <td class="history__item history_app__item">
                            <?php echo "<a href=\"\" class=\"button\" name=\"download\">Sửa</a>";?>
                        </td>
                        <td class="history__item history_app__item">
                            <?php echo "<a href=\"\" class=\"button btn__delete\" name=\"download\">Xóa</a>";?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <table class="history__container history_app__container">
            <header class="history__title">Các ứng dụng đang chờ được duyệt</header>
            <tr class="history__header history_app__header">
                <th class="history__item history_app__item">STT</th>
                <th class="history__item history_app__item">Tên ứng dụng</th>
                <th class="history__item history_app__item">Tên nhà cung cấp</th>
                <th class="history__item history_app__item">Thể loại</th>
                <th class="history__item history_app__item">Giá</th>
                <th class="history__item history_app__item">Email Developer</th>
                <th class="history__item history_app__item">Thời gian đăng tải</th>
            </tr>
            <?php           
            $result = get_product_tmp();
            if ($result&& $result->num_rows > 0) {
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    $count += 1;
                    $file = $row['file'];
                    $name = $row['name'];
                    ?>
                    <tr class="history__data history_app__data">
                        <td class="history__item history_app__item"><?= $count ?></td>
                        <td class="history__item history_app__item"><?= $row['name'] ?></td>
                        <td class="history__item history_app__item"><?= $row['name_provider'] ?></td>
                        <td class="history__item history_app__item"><?= $type[$row['typeProduct']] ?></td>
                        <td class="history__item history_app__item"><?= $row['price'] ?> VND</td>
                        <td class="history__item history_app__item"><?= $row['emailDev'] ?></td>
                        <td class="history__item history_app__item"><?= $row['datetime'] ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        
    </main>
</body>
</html>