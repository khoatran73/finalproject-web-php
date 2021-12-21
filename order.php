<?php
    session_start();
    if (!isset($_SESSION['email']) || $_SESSION['typeAccount'] != 'Developer' || !isset($_GET['id'])) {
        header('location: index.php');
        exit();
    }

    require_once('database.php');

    $idproduct = intval($_GET['id']);

    if (!check_provider($_SESSION['email'], $idproduct)) {
        header('location: appManagement.php');
    }

    $result = get_product_of_account_id($idproduct);

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
            <header class="history__title">Chi tiết ứng dụng</header>
            <?php
            if ($result && $result->num_rows > 0) {
            ?>
            <h3 class="history__h3">Có <span class="color"><?= $result->num_rows ?></span> người đã mua ứng dụng của bạn</h3>
            <?php
            } else {
                ?>
                 <h3 class="history__h3">Chưa có ai mua ứng dụng của bạn</h3>
                <?php
            }
            ?>   
            <tr class="history__header history_app__header">
                <th class="history__item history_app__item">STT</th>
                <th class="history__item history_app__item">Tên ứng dụng</th>
                <th class="history__item history_app__item">Giá</th>
                <th class="history__item history_app__item">Tên người mua</th>
                <th class="history__item history_app__item">Email người mua</th>
                <th class="history__item history_app__item">Ảnh người mua</th>      
                <th class="history__item history_app__item">Thời gian mua</th>
            </tr>
            <?php   
            if ($result && $result->num_rows > 0) {
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    $count += 1;
                    ?>
                    <tr class="history__data history_app__data">
                        <td class="history__item history_app__item"><?= $count ?></td>
                        <td class="history__item history_app__item"><<?= $row['product_name'] ?></td>
                        <td class="history__item history_app__item"><?= $row['price'] ?></td>
                        <td class="history__item history_app__item"><?= $row['name'] ?></td>
                        <td class="history__item history_app__item"><?= $row['email'] ?> VND</td>
                        <td class="history__item history_app__item"><img src="<?= $row['image'] ?>" alt=""></td>
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