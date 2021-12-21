<?php
    session_start();
    if (!isset($_SESSION['email']) || $_SESSION['typeAccount'] != 'Admin') {
        header('location: index.php');
        exit();
    }

    require_once('database.php');

    $result = get_thecao();
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
            <header class="history__title">Tất cả thẻ cào</header>
            <a href="createCard.php"><i class="fas fa-plus fa-card fa-lg"></i></a>
            <tr class="history__header">
                <th class="history_ _item">STT</th>
                <th class="history_ _item">Số seri</th>
                <th class="history__item">Mã thẻ</th>
                <th class="history__item">Mệnh giá</th>           
            </tr>
            <?php   
            if ($result && $result->num_rows > 0) {
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    $count += 1;
                    ?>
                    <tr class="history__data">
                        <td class="history__item"><?= $count ?></td>
                        <td class="history__item"><?= $row['seri'] ?></td>
                        <td class="history__item"><?= $row['mathe'] ?></td>
                        <td class="history__item"><?= $row['menhgia'] ?> VND</td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </main>
</body>
</html>