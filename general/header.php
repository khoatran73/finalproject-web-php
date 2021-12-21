    <!--========== HEADER ==========-->
    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="index.php" class="nav__logo">
                <img src="image/logo.png" alt="">
            </a>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="index.php" class="nav__link">Trang chủ</a></li>
                    <li class="nav__item"><a href="app-list.php?keyword=" class="nav__link">Ứng dụng</a></li>
                    <li class="nav__item"><a href="#footer" class="nav__link">Liên hệ</a></li>
                    <li class="nav__item name__avatar">
                        <?php
                            if (isset($_SESSION['email'])) {
                                ?>
                                <a href="profile.php"><img class="sm__avatar" src="<?= $_SESSION['image']?>" alt="avatar"></a>
                                <a href="profile.php"><span class="sm__name nav__link"><?= $_SESSION['name']?></span></a>
                                <?php
                            }
                        ?>
                    </li>
                    <li class="nav__item">
                        <?php
                            if (isset($_SESSION['email'])) {
                                echo "<a href=\"logout.php\" class=\"nav__link logout__btn mr-10\">Đăng xuất</a>";
                                echo "<a href=\"changePass.php\" class=\"nav__link logout__btn\">Đổi mật khẩu</a>";
                            } else {
                                echo "<a href=\"login.php\" class=\"nav__link login__btn mr-10\">Đăng nhập</a>";
                                echo "<a href=\"register.php\" class=\"nav__link register__btn\">Đăng ký</a>";
                            }
                        ?> 
                    </li>
                    <!--theme chuyển đổi chế độ sáng tối-->
                    <!-- <li><i class='bx bx-toggle-left change-theme' id="theme-button"></i></li>-->
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-grid-alt'></i>
            </div>
            <div>

            </div>
        </nav>
    </header>