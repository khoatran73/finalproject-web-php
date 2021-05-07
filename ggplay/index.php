<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" />
    <link rel="stylesheet" href="style.css">
    <title>Google Play</title>
</head>

<body>
    <!--========== SCROLL TOP ==========-->
    <a href="#" class="scrolltop" id="scroll-top">
        <i class='bx bx-up-arrow-alt scrolltop__icon'></i>
    </a>

    <!--========== HEADER ==========-->
    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="index.php" class="nav__logo">
                <img src="image/logo.png" alt="">
            </a>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="#home" class="nav__link">Trang chủ</a></li>
                    <li class="nav__item"><a href="#share" class="nav__link">Chia sẻ</a></li>
                    <li class="nav__item"><a href="#decoration" class="nav__link">Danh mục</a></li>
                    <li class="nav__item"><a href="#accessory" class="nav__link">Phụ kiện</a></li>
                    <li class="nav__item">
                        <?php
                            if (isset($_SESSION['email'])) {
                                echo "<a href=\"logout.php\" class=\"nav__link logout__btn\">Đăng xuất</a>";
                            } else {
                                echo "<a href=\"login.php\" class=\"nav__link login__btn mr\">Đăng nhập</a>";
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

    <main class="l-main">
        <!--========== HOME ==========-->
        <section class="home" id="home">
            <div class="home__container bd-container bd-grid">
                <div class="home__img">
                    <img src="assets/img/home.png" alt="">
                </div>

                <div class="home__data">
                    <h1 class="home__title">Merry Chrismas.</h1>
                    <p class="home__description">Sharing these holidays is the best gift you can give, give a present or
                        share your love with the people you love the most and celebrate with great happiness.</p>
                    <a href="#" class="button">Get started</a>
                </div>
            </div>
        </section>

        <!--========== SHARE ==========-->
        <section class="share section bd-container" id="share">
            <div class="share__container bd-grid">
                <div class="share__data">
                    <h2 class="section-title-center">Share with us</h2>
                    <p class="share__description">Sharing these holidays is the best gift you can give, give a present
                        or share your love with the people you love the most and celebrate with great happiness.</p>
                    <a href="#" class="button">Send</a>
                </div>

                <div class="share__img">
                    <img src="assets/img/shared.png" alt="">
                </div>
            </div>
        </section>

        <!--========== DECORATION ==========-->
        <section class="decoration section bd-container" id="decoration">
            <h2 class="section-title">Give Christmas Decorations <br> For Your Home</h2>
            <div class="decoration__container bd-grid">
                <div class="decoration__data">
                    <img src="assets/img/decoration1.png" alt="" class="decoration__img">
                    <h3 class="decoration__title">Christmas Bells</h3>
                    <a href="#" class="button button-link">Go Shopping</a>
                </div>

                <div class="decoration__data">
                    <img src="assets/img/decoration2.png" alt="" class="decoration__img">
                    <h3 class="decoration__title">Christmas Candies</h3>
                    <a href="#" class="button button-link">Go Shopping</a>
                </div>

                <div class="decoration__data">
                    <img src="assets/img/decoration3.png" alt="" class="decoration__img">
                    <h3 class="decoration__title">Christmas Trees</h3>
                    <a href="#" class="button button-link">Go Shopping</a>
                </div>
            </div>
        </section>

        <!--========== ACCESSORIES ==========-->
        <section class="accessory section bd-container" id="accessory">
            <h2 class="section-title">New Christmas <br> Accessories</h2>

            <div class="accessory__container bd-grid">
                <div class="accessory__content">
                    <img src="assets/img/accessory1.png" alt="" class="accessory__img">
                    <h3 class="accessory__title">Snow Globe</h3>
                    <span class="accessory__category">Accessory</span>
                    <span class="accessory__preci">$9.45</span>
                    <a href="#" class="button accessory__button"><i class='bx bx-heart'></i></a>
                </div>

                <div class="accessory__content">
                    <img src="assets/img/accessory2.png" alt="" class="accessory__img">
                    <h3 class="accessory__title">Candy</h3>
                    <span class="accessory__category">Accessory</span>
                    <span class="accessory__preci">$2.52</span>
                    <a href="#" class="button accessory__button"><i class='bx bx-heart'></i></a>
                </div>

                <div class="accessory__content">
                    <img src="assets/img/accessory3.png" alt="" class="accessory__img">
                    <h3 class="accessory__title">Angel</h3>
                    <span class="accessory__category">Accessory</span>
                    <span class="accessory__preci">$13.15</span>
                    <a href="#" class="button accessory__button"><i class='bx bx-heart'></i></a>
                </div>

                <div class="accessory__content">
                    <img src="assets/img/accessory4.png" alt="" class="accessory__img">
                    <h3 class="accessory__title">Sphere</h3>
                    <span class="accessory__category">Accessory</span>
                    <span class="accessory__preci">$4.25</span>
                    <a href="#" class="button accessory__button"><i class='bx bx-heart'></i></a>
                </div>

                <div class="accessory__content">
                    <img src="assets/img/accessory5.png" alt="" class="accessory__img">
                    <h3 class="accessory__title">Surprise gift</h3>
                    <span class="accessory__category">Accessory</span>
                    <span class="accessory__preci">$7.99</span>
                    <a href="#" class="button accessory__button"><i class='bx bx-heart'></i></a>
                </div>
            </div>
        </section>

        <!--========== SEND GIFT ==========-->
        <section class="send section">
            <div class="send__container bd-container bd-grid">
                <div class="send__content">
                    <h2 class="section-title-center send__title">Send Gift Now</h2>
                    <p class="send__description">Start giving away before the holidays are over. Write the home address
                        of the person who will send the gift.</p>
                    <form action="">
                        <div class="send__direction">
                            <input type="text" placeholder="House address" class="send__input">
                            <a href="#" class="button">Send</a>
                        </div>
                    </form>
                </div>

                <div class="send__img">
                    <img src="assets/img/send.png" alt="">
                </div>
            </div>
        </section>
    </main>

    <!--========== FOOTER ==========-->
    <footer class="footer section">
        <div class="footer__container bd-container bd-grid">
            <div class="footer__content">
                <h3 class="footer__title">Chăm sóc khách hàng</h3>
                <ul>
                    <li><a href="#" class="footer__link">Trung tâm trợ giúp </a></li>
                    <li><a href="#" class="footer__link">Mail</a></li>

                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Giới thiệu</h3>
                <ul>
                    <li><a href="#" class="footer__link">Giới thiệu </a></li>
                    <li><a href="#" class="footer__link">Tuyển dụng</a></li>
                    <li><a href="#" class="footer__link">Điều khoản</a></li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Danh mục</h3>
                <ul>
                    <li><a href="#" class="footer__link">Blog</a></li>
                    <li><a href="#" class="footer__link">Liên hệ</a></li>
                    <li><a href="#" class="footer__link">Number Phone</a></li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Theo dõi</h3>
                <a href="#" class="footer__social"><i class='bx bxl-facebook-circle '></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-instagram-alt'></i></a>
            </div>
        </div>
        <p class="footer__copy">&#169; 2021 Bao Vy - Bản quyền thuộc về Bao Vy</p>
    </footer>

    <!--========== SCROLL REVEAL ==========-->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!--<script src="assets/js/main.js"></script>-->
</body>

</html>