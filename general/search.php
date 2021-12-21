<?php
    if (isset($_POST['search'])) {
        $keyword = $_POST['keyword'];
        header('location: app-list.php?keyword=' . $keyword);
        // header('location: index.php');
    }
?>

<section class="search section">    
    <div class="search__container">
        <div class="search__content">
            <form action="" method="POST">
                <div class="search__direction">
                    <input type="text" placeholder="Tìm kiếm ứng dụng..." class="search__input" name="keyword">
                    <input type="submit" id="search__btn" class="button" name="search" value="Tìm">
                </div>
                <div class="field input">
                    <label>Chọn thể loại</label>
                    <select class="form-control select-search" name="type">
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
            </form>
        </div>
    </div>
</section>