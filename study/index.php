<?php
    session_start();
    // if(!isset($_SESSION['email'])) {
    //     header('Location: login.php');
    // }
    require_once('database.php');
    if (isset($_SESSION['email'])) {
        $image = take_img($_SESSION['email']);
        $position = take_pos($_SESSION['email']);
    }
?>

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
    <link rel="stylesheet" href="style/index.css">
    <title>EASYSTUDY</title>
</head>

<body>
    <a href="#" class="scrolltop" id="scroll-top">
        <i class='bx bx-up-arrow-alt scrolltop__icon'></i>
    </a>

    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="#" class="nav__logo" style="font-size: 22px;">EASYSTUDY</a>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="#home" class="nav__link">Trang chủ</a></li>
                    <li class="nav__item"><a href="#introduction" class="nav__link">Giới thiệu</a></li>
                    <li class="nav__item"><a href="#course" class="nav__link">Khóa học</a></li>
                    <li class="nav__item"><a href="#contact" class="nav__link">Liên hệ</a></li>
                    <li class="nav__item">
                        <?php
                            if (isset($_SESSION['email'])) {
                                echo "<a href=\"logout.php\" class=\"nav__link login\">Đăng xuất</a>";
                            } else {
                                echo "<a href=\"login.php\" class=\"nav__link login\" style=\"margin-right: 10px;\">Đăng nhập</a>";
                                echo "<a href=\"register.php\" class=\"nav__link login\">Đăng ký</a>";
                            }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="l-main">
        <!--========== HOME ==========-->
        <style>
            :root {
                --dark-cyan: hsl(182, 75%, 29%);
                --dark-gray: hsl(0, 75%, 59%);
                --white: white;
            }
            .profile-container {
                width: 100vw;
                height: 100vh;
                font-size: 18px;
                letter-spacing: 1;
                background-color: var(--dark-cyan);
                
            }

            .profile {
                width: 250px;
                height: 350px;
                background-color: var(--dark-cyan);
                margin: auto;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border-radius: 15px;
            }
            
            .avatar {
                width: 110px;
                height: 110px;
                border-radius: 50%;
                position: relative;
                top: -40px;
                border: 5px solid var(--white);
            }

            .about {
                font-size: 1.1em;
                color: var(--white);
                width: 100%;
                display: flex;
                justify-content: center;
                position: relative;
                top: -30px;
            }
            .hr {
                width: 170px;
                height: 1px;
                background-color: var(--white);
                opacity: 30%;
                position: relative;
                top: -25px;
            }

            .hr2 {
                width: 170px;
                height: 1px;
                background-color: var(--white);
                opacity: 30%;
                position: relative;
                top: -15px;
            }

            .info {
                font-size: 1.1em;
                color: var(--white);
                width: 100%;
                display: flex;
                justify-content: center;
                position: relative;
                top: -20px;
            }          

            .personal-courses {
                position: relative;
                top: 15px;   
            }

            .personal-courses a {
                color: var(--white);
                border: 1px solid var(--white);
                padding: 10px;
                border-radius: 5px;
            }

            .personal-courses a:hover {
                background-color: var(--white);
                color: black;
                border: 1px solid black;
                transition: 1s;
            }
        </style>
    
        <section class="home" id="home">
            <div class="home__container bd-grid bd-container">
                <?php
                    if (isset($_SESSION['email'])) {
                ?>
                    <div class="profile__container" style="position: fixed; top: 80px; left: 10px;">
                        <div class="profile">                   
                            <img class="avatar" 
                                <?php 
                                    if (strlen($image) == 0) {
                                        $image = 'images/non-avt.png';
                                    } 
                                    echo "src=\"$image\"";        
                                ?>>
                            </img>
                            
                            <div class="about">
                                <div class="name"><?= $_SESSION['name'] ?></div>
                            </div>
                            <div class="hr"></div>
                            <div class="info">     
                                <?php 
                                    if($position == 'student') { 
                                        echo "Học viên";
                                    } else if ($position == 'admin') { 
                                        echo "Admin";
                                    } else if ($position == 'teacher') {
                                        echo "Giảng viên";
                                    } else if ($position == 'manager') {
                                        echo "Quản lý";
                                    } else if ($position == 'accountant') {
                                        echo "Kế toán";
                                    } else {
                                        echo $position;
                                    }
                                ?>
                            </div>   
                            <div class="hr2"></div>
                            <div>
                                <?php
                                    if ($position == 'student' || $position == 'teacher') { 
                                        ?>
                                        <div class="personal-courses">
                                            <a href="MyCourse.php">Các khóa học của tôi</a>
                                        </div>
                                        <?php
                                    } else if ($position == 'admin') {
                                        ?>
                                        <div class="personal-courses">
                                            <a href="AccountManagement.php">Quản lí tài khoản</a>
                                        </div>
                                        <?php
                                    } else if ($position == 'manager') {
                                        ?>
                                        <div class="personal-courses">
                                            <a href="ReportManagement.php">Quản lí báo cáo</a>
                                        </div>
                                        <div class="personal-courses" style="position: relative; top: 40px;">
                                            <a href="OpenCourse.php" style="padding: 10px 22px 10px 22px">Mở khóa học</a>
                                        </div>
                                        <?php
                                    } else if ($position == 'accountant') {
                                        ?>
                                        <div class="personal-courses">
                                            <a href="ReportManagement.php">Quản lí báo cáo</a>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php        
                    }
                ?>
            
                <div class="home__img">
                    <img src="images/image.jpg" alt="" style="width: 120%; border-radius: 8px; 
                    box-shadow: 0 0 128px 0 rgba(0,0,0,0.1), 0 32px 64px -48px rgba(0,0,0,0.5);">
                </div>

                <div class="home__data">
                    <h1 class="home__title">Bạn học được những gì trên EasyStudy?</h1>
                    <p class="home__description">EasyStudy là Mạng xã hội học tập trực tuyến, được xây dựng nhằm mục
                        tiêu đồng hành cùng các bạn học sinh trong quá trình học tập, trau dồi kiến thức, kỹ năng.</p>
                    <a href="#introduction" class="button">Xem thêm</a>
                </div>
            </div>
        </section>

        <!--========== INTRODUCTION ==========-->
        <section class="share section bd-container" id="introduction">
            <div class="share__container bd-grid">
                <div class="share__data">
                    <h2 class="section-title-center">Về chúng tôi</h2>
                    <p class="share__description">EasyStudy là Mạng xã hội học tập trực tuyến, được xây dựng nhằm mục
                        tiêu đồng hành cùng các bạn học sinh trong quá trình học tập, trau dồi kiến thức, kỹ năng</p>
                    <a href="introduction.html" class="button">Xem thêm</a>
                </div>

                <div class="share__img">
                    <img src="images/intro.jpg" alt="" style="border-radius: 5px; 
                    box-shadow: 0 0 128px 0 rgba(0,0,0,0.1), 0 32px 64px -48px rgba(0,0,0,0.5);">
                </div>
            </div>
        </section>
        <!--========== Course ==========-->
        <script>
            jQuery(document).ready(function ($) {
                $('.owl-carousel').owlCarousel({
                    // loop: true,
                    margin: 10,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1200: {
                            items: 4
                        }
                    }
                   
                })
            })
        </script>

        <section class="decoration section bd-container" id="course">
            <h2 class="section-title">NHỮNG KHÓA HỌC CỦA CHÚNG TÔI</h2>
            <div class="decoration__container bd-grid owl-carousel owl-theme">
                <?php 
                    $sql = 'select * from course';
                    $conn = open_database();
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            ?>
                                <div>
                                    <div class="decoration__data" style="width: 234px; height: 297px; box-shadow: 12px 15px 11px rgba(68, 68, 68, 0.342);">
                                        <img src="<?= "images/".$row['image']?>">
                                        <h3 class="decoration__title" style="margin-top: 5px;"><?= $row['name']?></h3>
                                        <a href='<?= "course.php?" .$row["id_course"]?>' class="button button-link">Chi tiết</a>
                                    </div>
                                </div>
                            <?php
                        }
                    } 
                ?>
                
            </div>
        </section>

        <!--========== Feed back ==========-->
        <section class="send section">
            <div class="send__container bd-container bd-grid">
                <div class="send__content">
                    <h2 class="section-title-center send__title">Feedback</h2>
                    <p class="send__description">Nếu có vấn đề gì, hãy phản hồi cho chúng tôi. Chúng tôi sẽ giúp bạn
                        giải quyết.</p>
                    <form action="">
                        <div class="send__direction">
                            <input type="text" placeholder="Nội dung phản hồi" class="send__input">
                            <a href="#" class="button">Gửi</a>
                        </div>
                    </form>
                </div>

                <div class="send__img">
                    <img src="assets/img/send.png" alt="">
                </div>
            </div>
        </section>
    </main>


    </div>
    <!--========== FOOTER ==========-->
    <footer class="footer section" id="contact">
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
        <p class="footer__copy">&#169; 2021 EasyStudy - Bản quyền thuộc về EasyStudy</p>
    </footer>
</body>

</html>