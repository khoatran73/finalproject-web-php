<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('location: index.php');
        exit();
    }

    require_once('database.php');

    $result = get_history_money($_SESSION['email']);
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
        <table class="history_money__container">
            <header class="history__title">Lịch sử nạp tiền</header>
            <tr class="history__header">
                <th class="history_ _item">Số seri</th>
                <th class="history__item">Mệnh giá</th>
                <th class="history__item">Thời gian</th>
            </tr>
            <?php   
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr class="history__data">
                        <td class="history__item"><?= $row['seri'] ?></td>
                        <td class="history__item"><?= $row['menhgia'] ?> VND</td>
                        <td class="history__item"><?= $row['datetime'] ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </main>
</body>
</html>