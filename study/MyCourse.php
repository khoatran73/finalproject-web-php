<?php
    session_start();
    if(!isset($_SESSION['email'])) {
        header('Location: index.php');
    }
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
    <title>Khóa học</title>
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
                    <li class="nav__item"><a href="index.php" class="nav__link">Trang chủ</a></li>
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
                                            <a href="AccountManagement.php">Quản lí báo cáo</a>
                                        </div>
                                        <div class="personal-courses" style="position: relative; top: 40px; left: 13px">
                                            <a href="AccountManagement.php">Mở khóa học</a>
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

        </section>

        <!--========== Course ==========-->
        <!-- <script>
            jQuery(document).ready(function ($) {
                $('.owl-carousel').owlCarousel({
                    loop: false,
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
        </script> -->

        <section class="decoration section bd-container" id="course">
            
                <?php 
                    $result = get_mycourses($_SESSION['email']);
                    
                    if ($result == null) {
                        ?>
                            <h2 class="section-title" style="margin-top: -90px; color: rgb(181, 34, 34);">
                            <?php 
                                if ($position == 'student') {
                                    echo "BẠN CHƯA ĐĂNG KÝ KHÓA HỌC NÀO";
                                } else {
                                    echo "CHƯA CÓ KHÓA HỌC NÀO DO BẠN PHỤ TRÁCH";
                                }
                            ?>
                            </h2>
                        <?php 
                    } else {
                        if ($result->num_rows > 0) {
                            ?>
                            <h2 class="section-title" style="margin-top: -120px;">NHỮNG KHÓA HỌC CỦA BẠN</h2>
                            <div style="display: flex;">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                $data = get_course($row['id_course']);
                                ?>
                                    <div class="decoration__data" style="width: 234px; height: 297px; margin: 10px 10px 10px 10px">
                                        <img src="<?= "images/".$data['image']?>">
                                        <h3 class="decoration__title" style="margin-top: 5px;"><?= $data['name']?></h3>
                                        <a href='<?= "course.php?" .$data["id_course"]?>' class="button button-link">Chi tiết</a>
                                    </div>            
                                <?php
                            }
                        }     
                    }
                ?>
                </div>
        </section>

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