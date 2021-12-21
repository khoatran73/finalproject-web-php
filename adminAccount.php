<?php
    session_start();
    if (!isset($_SESSION['email']) || $_SESSION['typeAccount'] != 'Admin') {
        header('location: index.php');
        exit();
    }

    require_once('database.php');

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
            <header class="history__title">
                <div>Danh sách Developer đang chờ duyệt</div>
            </header>
            <tr class="history__header history_app__header">
                <th class="history__item history_app__item">STT</th>
                <th class="history__item history_app__item">Ảnh đại diện</th>
                <th class="history__item history_app__item">Tên người dùng</th>
                <th class="history__item history_app__item">Tên Nhà cung cấp</th>
                <th class="history__item history_app__item">Email</th>
                <th class="history__item history_app__item">CMND mặt trước</th>   
                <th class="history__item history_app__item">CMND mặt sau</th>   
                <th class="history__item history_app__item">Thời gian tạo</th>
                <th class="history__item history_app__item">Phê duyệt</th>
                <th class="history__item history_app__item">Xóa</th>
            </tr>
            <?php  
            $result = get_developer();
            $count = 0;
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $count += 1;
                    ?>
                    <tr class="history__data history_app__data">
                        <td class="history__item history_app__item"><?= $count ?></td>
                        <td class="history__item history_app__item"><img src="<?= $row['image'] ?>" alt=""></td>
                        <td class="history__item history_app__item"><?= $row['name'] ?></td>
                        <td class="history__item history_app__item"><?= $row['name_provider'] ?></td>
                        <td class="history__item history_app__item"><?= $row['email'] ?></td>
                        <td class="history__item history_app__item"><img src="<?= $row['cmnd_front'] ?>" alt=""></td>
                        <td class="history__item history_app__item"><img src="<?= $row['cmnd_behind'] ?>" alt=""></td>
                        <td class="history__item history_app__item"><?= $row['datetime'] ?></td>
                        <td class="history__item history_app__item">
                            <?php $email = $row['email']; echo "<a href='acceptDeveloper.php?email=$email'  class=\"button\" name=\"download\">Duyệt</a>";?>
                        </td>
                        <td class="history__item history_app__item">
                            <?php echo "<a href='deleteDeveloper.php?email=$email' class=\"button btn__delete\" name=\"download\">Xóa</a>";?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <table class="history__container history_app__container">
            <header class="history__title">
                <div>Danh sách tài khoản</div>
            </header>
            
            <tr class="history__header history_app__header">
                <th class="history__item history_app__item">STT</th>
                <th class="history__item history_app__item">Ảnh đại diện</th>
                <th class="history__item history_app__item">Tên người dùng</th>
                <th class="history__item history_app__item">Email</th>
                <th class="history__item history_app__item">Đối tượng</th>   
                <th class="history__item history_app__item">Thời gian tạo</th>
                <th class="history__item history_app__item">Xóa</th>
            </tr>
            <?php  
            $result = get_account();
            $count = 0;
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $count += 1;
                    ?>
                    <tr class="history__data history_app__data">
                        <td class="history__item history_app__item"><?= $count ?></td>
                        <td class="history__item history_app__item"><img src="<?= $row['image'] ?>" alt=""></td>
                        <td class="history__item history_app__item"><?= $row['name'] ?></td>
                        <td class="history__item history_app__item"><?= $row['email'] ?></td>
                        <td class="history__item history_app__item"><?= $row['typeAccount'] ?></td>
                        <td class="history__item history_app__item"><?= $row['datetime'] ?></td>
                        <td class="history__item history_app__item">
                            <?php echo "<a href=\"deleteApp.php\" class=\"button btn__delete\" name=\"download\">Xóa</a>";?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </main>
</body>
</html>