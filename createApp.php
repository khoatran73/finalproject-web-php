<?php
    session_start();
    if(!isset($_SESSION['email']) || $_SESSION['typeAccount'] == 'User') {
        header('location: index.php');
        exit();
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<?php
    require_once("general/head.php");
?>

<?php
    require_once('database.php');
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $name_provider = get_name_provider($_SESSION['email']);
        $price = $_POST['price'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $image = $_FILES['image']; 
        $file = $_FILES['file']; 
        
        // test extension image
        $name_image = basename($image["name"]);
        $image_ext = strtolower(pathinfo($name_image, PATHINFO_EXTENSION));
        $allow_extension_image = array("png", "gif", "jpeg", "jpg");

        // test extension file
        $target_file = basename($file["name"]);
        $file_ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allow_extension_file = array("rar", "zip");

        if (strlen($name) == 0) {
            $error = "Vui lòng nhập tên app";
        } else if (strlen($price) == 0) {
            $error = "Vui lòng nhập giá";
        } else if (strlen($description) == 0) {
            $error = "Vui lòng nhập nội dung";
        } else if (!in_array($image_ext, $allow_extension_image)) { 
            $error = "Sai định dạng ảnh";
        } else if ($file['size'] > 1000000000) { //gioi han 1gb
            $error = "File quá lớn";
        } else if (!in_array($file_ext, $allow_extension_file)) {
            $error = "Sai định dạng file"; 
        } else {
            add_app_tmp($name, $name_provider, $price, $_SESSION['email'], $description, $type, $image, $file);
            $_SESSION['success'] = true;
        }    
    }
?>

<body>
    <?php
        require_once "general/header.php";
    ?>
    <main class="l-main">
        <div class="container margin-top">
            <?php
            if (!isset($_SESSION['success'])) {
            ?>
            <div class="wrapper">
                <section class="form signup">
                    <header>Tạo ứng dụng</header>
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="field input">
                            <label for="name">Tên App</label>
                            <input id="name" type="text" name="name" placeholder="Nhập tên app" <?php if (isset($name)) {echo "value=\"$name\"";}?>>
                        </div>
                        <div class="field input">
                            <label for="price">Giá</label>
                            <input id="price" type="number" name="price" placeholder="Nhập giá" <?php if (isset($price)) {echo "value=\"$price\"";}?>>
                        </div>
                        <div class="field input">
                            <label for="description">Nội dung</label>
                            <textarea class="form-control" id="description" type="text" name="description" placeholder="Nhập nội dung" rows="3">
                            </textarea>
                        </div>
                        <div class="field input">
                            <label>Chọn thể loại</label>
                            <select class="form-control" name="type" required>
                                <option value="">Chọn thể loại</option>
                                <option value="riddle">Câu đố</option>
                                <option value="tactic">Chiến thuật</option>  
                                <option value="funny-question">Đố vui</option> 
                                <option value="racing">Đua xe</option> 
                                <option value="education">Giáo dục</option> 
                                <option value="action">Hành động</option> 
                                <option value="simulation">Mô phỏng</option> 
                                <option value="role-playing">Nhập vai</option> 
                                <option value="adventure">Phiêu lưu</option> 
                                <option value="sport">Thể thao</option> 
                                <option value="date">Hẹn hò</option> 
                                <option value="makeup">Làm đẹp</option> 
                                <option value="contact">Liên lạc</option> 
                                <option value="social-media">Mạng xã hội</option> 
                                <option value="photography">Nhiếp ảnh</option> 
                                <option value="map">Bản đồ</option> 
                            </select>
                        </div>
                        <div class="mb"></div>
                        <div class="custom-file">  
                            <input type="file" name="image" class="custom-file-input" id="image" accept="image/*">
                            <div class="custom-file-label" for="image">Chọn ảnh ...</div>
                        </div>
                        <div class="mb"></div>
                        <div class="custom-file">  
                            <input type="file" name="file" class="custom-file-input" id="file" accept="archive/*">
                            <div class="custom-file-label" for="file">File .rar hoặc .zip ...</div>
                        </div>

                        <div class="field submit">
                            <input type="submit" name="submit" value="Tạo App">
                        </div>          
                        <div class="error-message">
                            <?php if (isset($error)) echo $error ?>
                        </div>
                    </form>
                </section>
            </div>
            <?php
            } else {
                unset($_SESSION['success']);
            ?>
            <div class="wrapper">
                <section class="form">
                    <header>Tạo ứng dụng thành công</header>
                    <div class="link">Hãy chờ quản trị viên phê duyệt</div>
                    <div class="link">Nhấn <a href="appManagement.php">vào đây</a> để quay lại</div>
                </section>
            </div>
            <?php
            }
            ?>
        </div>
    </main>
    <?php
        require_once "general/footer.php";
    ?>
</body>
<script src="main.js"></script>

</html>