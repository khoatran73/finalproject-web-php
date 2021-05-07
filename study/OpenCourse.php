<?php
    session_start();
    require_once('database.php');
    if(!isset($_SESSION['email']) || take_pos($_SESSION['email']) != 'manager') {
        header('Location: index.php');
        exit();
    }

    if (isset($_POST['submit'])) {
        $course_name = $_POST['course-name'];
        $content = $_POST['content'];
        $image = $target_dir . basename($_FILES["image"]["name"]);
        $email_teacher = $_POST['teacher'];
        
        if (strlen($course_name) == 0) {
            $error = "Vui lòng nhập Tên khóa học";
        }else if (strlen($content) == 0) {
            $error = "Vui lòng nhập Nội dung khóa học";
        } else {
            add_course($course_name, $content, $image, $email_teacher);
            $conn = open_database();
            $sql = "select id_course from course order by id_course desc limit 1";

            $stm = $conn->query($sql);
            
            $result = $stm->fetch_assoc(); 

            $id_course = $result['id_course'];
            add_mycourses($email, $id_course);
            header('Location: AddCourseSuccess.php');
        }    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="style/styles.css">
    <title>Mở khóa học</title>
</head>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Mở khóa học</header>
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="field input">
                    <label for="course-name">Tên khóa học</label>
                    <input id="course-name" type="text" name="course-name" placeholder="Nhập tên khóa học" <?php if (isset($course_name)) {echo "value=\"$course_name\"";}?>>
                </div>
                <div class="form-group">
                    <label for="content">Nội dung khóa học</label>
                    <textarea class="form-control" id="content" rows="3" name="content" <?php if (isset($content)) {echo "value=\"$content\"";}?>></textarea>
                </div>
      
                <div class="field input">
                    <label>Chọn giảng viên</label>
                    <select class="form-control" name="teacher" aria-label="Default select example">
                    <?php
                        $result = get_teacher();
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['email']?>"><?= $row['name']?></option>
                                <?php
                            }
                        } 
                    ?>
                    </select>
                    <!-- <select class="form-control" name="position" aria-label="Default select example">
                        <option value="student">Học viên</option>
                        <option value="teacher">Giảng viên</option>  
                        <option value="accountant">Kế toán</option>     
                        <option value="manager">Quản lý</option>
                        <option value="admin">Admin</option>   
                    </select> -->
                </div>

                <label for="">Chọn ảnh</label>
                <div class="custom-file">  
                    <input type="file" name="image" class="custom-file-input" id="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                    <label class="custom-file-label" for="image">Choose image...</label>
                    <!-- <div class="invalid-feedback">Example invalid custom file feedback</div> -->
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Mở khóa học">
                </div>
                
            </form>
        </section>
    </div>

</body>
