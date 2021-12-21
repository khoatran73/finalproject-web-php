<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;  

    require 'vendor/autoload.php';

    define('host', 'localhost');
    define('user', 'root');
    define('pass', '');
    define('db', 'ggplay');
    function open_database() {
        $conn = new mysqli(host, user, pass, db);
        if ($conn->connect_error) {
            die('Loi: ' . $conn->connect_error);
        }
        return $conn;
    }

    function sendMail($email, $name, $status) {
        error_reporting(0);
        define("SMTP_HOST", "smtp.gmail.com"); 
        define("SMTP_PORT", "465"); 
        define("SMTP_UNAME", "ggplay732@gmail.com"); 
        define("SMTP_PWORD", "nqkhayadvknptvmc"); 
        // $email = 'email muon gui toi';
        // $name = "ten"; 
        $mail = new PHPMailer(true);                             
        try {
            //Server settings
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;                                 
            $mail->isSMTP();                                      
            $mail->Host = SMTP_HOST;  
            $mail->SMTPAuth = true;                               
            $mail->Username = SMTP_UNAME;                 
            $mail->Password = SMTP_PWORD;                          
            $mail->SMTPSecure = 'ssl';                         
            $mail->Port = SMTP_PORT;    
    
            //Recipients
            $mail->setFrom(SMTP_UNAME, "GG Play");
            $mail->addAddress($email, $name);     
            $mail->addReplyTo(SMTP_UNAME, 'GG Play'); 
            $mail->isHTML(true);                                 
            

            if ($status == 'reset password') {
                $mail->Subject = 'Khôi phục mật khẩu';
                $token = uniqid();
                $url = 'http://' . $_SERVER['SERVER_NAME'] . '/resetPass.php?email=' . $email . '&token=' . $token;
                $mail->Body = "Click vào link: " . $url . " để khôi phục mật khẩu của bạn";
        
                if (!$mail->send()) {
                    return false;
                } else {
                    updateTokenAccount($token, $email);
                }
            } else if ($status == 'Xác minh danh tính') {
                $mail->Subject = 'Mã xác minh';
                $code = random_int(100000, 999999);
                $mail->Body = "$code là mã xác minh email của bạn";
        
                if (!$mail->send()) {
                    return false;
                } else {
                    return $code;
                }
            } else if ($status == 'Đồng ý nâng cấp') {
                $mail->Subject = 'Nâng cấp Developer thành công';
                $mail->Body = "Chúc mừng bạn đã được nâng cấp thành Developer";
                $mail->send();
            } else if ($status == 'Từ chối nâng cấp') {
                $mail->Subject = 'Nâng cấp thành Developer không thành công';
                $mail->Body = "Tài khoản của bạn đã được hoàn trả. Hãy thử nâng cấp lại sau nhé!";
                $mail->send();
            } else if ($status == "Duyệt app") {
                $mail->Subject = 'Duyệt ứng dụng';
                $mail->Body = "Ứng dụng của bạn đã được duyệt thành công";
                $mail->send();
            } else if ($status == "Không duyệt app") {
                $mail->Subject = 'Không duyệt ứng dụng';
                $mail->Body = "Ứng dụng của bạn đã bị xóa. Hãy thử lại";
                $mail->send();
            }

            
            
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getInfo($email) {
        $sql = "select * from account where email = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();
        $data = $result->fetch_assoc();

        return $data;
    }

    function get_name_provider($email) {
        $sql = "select * from developer where email = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();
        $data = $result->fetch_assoc();

        return $data['name_provider'];
    }

    function updateTokenAccount($token, $email) {
        $sql = 'update account set token = ? where email = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $hashed_token = password_hash($token, PASSWORD_BCRYPT);
        $stm->bind_param('ss', $hashed_token, $email);
        if (!$stm->execute()) {
            return null; 
        }

        return true;
    }

    function getPassword($email) {
        $sql = "select password from account where email = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();
        $data = $result->fetch_assoc();

        return $data['password'];
    }

    function getTokenAccount($email) {
        $sql = "select token from account where email = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();
        $data = $result->fetch_assoc();

        return $data['token'];
    }

    function deleteTokenAccount($email) {
        $conn = open_database();
        $sql = 'update account set token = "" where email = ?';
        $stm = $conn->prepare($sql);

        $stm->bind_param('s', $email);

        if (!$stm->execute()) {
            return null;
        }

        return true;
    }
    

    function login($email, $password) {
        $sql = "select * from account where email = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        
        if (!$stm->execute()) {
            return null;
        }
        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return false;
        }

        $data = $result->fetch_assoc();

        if (!password_verify($password, $data['password'])) {
            return false;
        }

        return $data;
    }

    function is_exists_email($email) {
        $sql = 'select email from account where email = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);

        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();
        if ($result->num_rows == 0) {
            return false;
        }

        return true;

    }

    function register($name, $email, $password, $typeAccount, $image, $status) {
        $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
        $sql = 'insert into account(name, email, password, typeAccount, image, status) values(?, ?, ?, ?, ?, ?)';

        $conn = open_database();
        $stm = $conn->prepare($sql);

        $img_dir =  uploadImage($image);
        $stm->bind_param('ssssss', $name, $email, $hashed_pass, $typeAccount, $img_dir, $status);

        if (!$stm->execute()) {
            return null;
        }

        return true;
    }    

    function uploadImage($image) {
        $imageName = $image['name'];
        $imageTmp_Name = $image['tmp_name'];

        $imageExt = explode('.', $imageName);
        $imageExt = strtolower(end($imageExt));
 
        $random = random_int(1, 99999999);
        $newFileName = md5($random) . '.' . $imageExt;
        $imageDestination = 'image/avatar/' . $newFileName;

        move_uploaded_file($imageTmp_Name, $imageDestination);  

        return $imageDestination;
    }
    
    function updateName($email, $name) {
        $sql = 'update account set name = ? where email = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);

        $stm->bind_param('ss', $name, $email);
        if (!$stm->execute()) {
            return null; 
        }

        return $name;
    }

    

    function deleteImage($email) {
        $sql = 'select image from account where email = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return null; 
        }
        $result = $stm->get_result();
        $data = $result->fetch_assoc();
        $image = $data['image'];

        unlink($image);
    }

    function updateImage($email, $newImage) {
        // Xóa ảnh củ ra khỏi database
        deleteImage($email);
        
        // Sau đó thêm ảnh mới
        $sql = 'update account set image = ? where email = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $newImageDes = uploadImage($newImage);
        $stm->bind_param('ss', $newImageDes, $email);
        if (!$stm->execute()) {
            return null; 
        }

        return $newImageDes;
    }

    function input_money($email, $seri, $mathe) {
        $conn = open_database();
        $sql = 'select * from card where seri = ? and mathe = ?';
        $stm = $conn->prepare($sql);

        $stm->bind_param('ss', $seri, $mathe);
        if (!$stm->execute()) {
            return false; 
        }

        $result = $stm->get_result();
        if ($result->num_rows == 0) {
            return false;
        }
        $data = $result->fetch_assoc();

        $menhgia = $data['menhgia'];

        delete_thecao($seri);
        update_history_money($email, $seri, $menhgia);
        updateTien($email, 1, $menhgia);
        return $menhgia;
    }

    function update_history_money($email, $seri, $menhgia) {
        $conn = open_database();
        $sql = 'insert into history_money(email, seri, menhgia) values (?, ?, ?)';
        $stm = $conn->prepare($sql);

        $stm->bind_param('ssi', $email, $seri, $menhgia);
        $stm->execute();
    }

    function delete_thecao($seri) {
        $conn = open_database();
        $sql = 'delete from card where seri = ?';
        $stm = $conn->prepare($sql);

        $stm->bind_param('s', $seri);

        $stm->execute();
    }

    function add_thecao($seri, $mathe, $menhgia) {
        $conn = open_database();
        $sql = 'insert into card(seri, mathe, menhgia) values (?, ?, ?)';
        $stm = $conn->prepare($sql);

        $stm->bind_param('ssi', $seri, $mathe, $menhgia);
        if (!$stm->execute()) {
            return null; 
        }

        return true;

    }

    function get_thecao() {
        $conn = open_database();
        $sql = "select * from card order by menhgia asc";
        $result = $conn->query($sql);
        return $result;
    }

    function checkTien($email, $menhgia) {
        $sql = 'select tien from account where email = ?';    
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);

        if (!$stm->execute()) {
            return null; //
        }

        $result = $stm->get_result();

        $data = $result->fetch_assoc();

        $tien = $data['tien'];

        if ($tien < $menhgia) {
            return false;
        } else {
            return true;
        }
    }

    function updateTien($email, $trangthai, $menhgia) {
        // 0: mua 
        // 1: nạp
        if ($trangthai == 0) {
            $sql = 'update account set tien = tien - ? where email = ?';
        } else {
            $sql = 'update account set tien = tien + ? where email = ?';
        }
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('is', $menhgia, $email);
        if (!$stm->execute()) {
            die('loi truy van');
            // return null; 
        }

        return getTien($email);
    }

    function getTien($email) {
        $sql = "select tien from account where email = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();
        $data = $result->fetch_assoc();

        return $data['tien'];
    }

    function update_status($email) {
        // 0: mua 
        // 1: nạp
        $sql = "update account set status = 'verified' where email = ?";
    
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            die('loi truy van');
            // return null; 
        }

        return 'verified';
    }

    function update_devStatus($email) {
        $sql = "update developer set status = 'verified' where email = ?";
    
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return null; 
        }

        return 'verified';
    }

    function deleteDeveloper($email) {
        $conn = open_database();
        $sql = 'delete from developer where email = ?';
        $stm = $conn->prepare($sql);

        $stm->bind_param('s', $email);

        $stm->execute();
    }

    function deleteApp($idproduct) {
        $conn = open_database();
        $sql = 'delete from product where IdProduct = ?';
        $stm = $conn->prepare($sql);

        $stm->bind_param('i', $idproduct);

        $stm->execute();
    }

    function add_product_of_account($email, $id_product) {
        $sql = "insert into productofaccount(email, idProduct) values (?, ?)";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('si', $email, $id_product);

        if (!$stm->execute()) {
            return null;
        }

        return true;
    }

    function get_product_of_account($email) {
        $sql = "select * from productofaccount where email = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return false;
        }

        return $result;
    }

    function get_my_product($email) {
        $sql = "select * from product where emailDev = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return false;
        }

        return $result;
    }

    function check_pay($email, $idproduct) {
        $sql = "select * from productofaccount where email = ? and IdProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('si', $email, $idproduct);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return false;
        }

        return true;
    }

    function searchApps($key) {
        $sql = "select * from product where name like '%$key%' order by num_of_purchases desc";//name '%$key%' ?";
        $conn = open_database();
        $result = $conn->query($sql);

        return $result;    
    }

    function update_num_of_purchases($id_product) {
        $sql = "update product set num_of_purchases = num_of_purchases + 1 where IdProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('i', $id_product);
        if (!$stm->execute()) {
            return null;
        }

        return true;
    }

    function list_app($p) {
        // $p = 0: freeapp 
        // $p = 1: paidapp
        if ($p == 0) {
            $sql = "select * from product where price = 0 and status != 'not verified' order by num_of_purchases desc";
        } else {
            $sql = "select * from product where price > 0 and status != 'not verified' order by num_of_purchases desc";
        }
        
        $conn = open_database();
        $result = $conn->query($sql);

        return $result;
    }

    function list_app_time () {
        $sql = "select * from product order by datetime desc";
        
        $conn = open_database();
        $result = $conn->query($sql);

        return $result;
    }

    function app_info($id) {
        $sql = "select * from product where IdProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('i', $id);
        if (!$stm->execute()) {
            return null;
        }
        $result = $stm->get_result();
        $data = $result->fetch_assoc();
        return $data;
    }

    function auto_id_product() {
        $conn = open_database();
        $sql = "select IdProduct from product order by IdProduct desc limit 1";

        $stm = $conn->query($sql);
        
        $result = $stm->fetch_assoc(); 

        if ($result) {
            $id_product = $result['IdProduct'];
        } else {
            $id_product = 0;
        }
        
        return $id_product + 1;
    }

    function create_app($name, $name_provider, $price, $emailDev, $description, $typeProduct, $image, $file) {
        $sql = 'insert into product(IdProduct, name, name_provider, price, emailDev, description, 
        typeProduct, rating, num_of_purchases, image, file, size) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $conn = open_database();
        $stm = $conn->prepare($sql);

        $id_product = auto_id_product();
        $rating = 0;
        $num_of_purchases = 0;

        $img_dir = uploadImageProduct($image);
        $file_dir = uploadFile($file);
        $size = $file['size'] / 1024;
 
        $stm->bind_param('ississsiissd', $id_product, $name, $name_provider, 
        $price, $emailDev, $description, $typeProduct, $rating, $num_of_purchases, $img_dir, $file_dir, $size);

        if (!$stm->execute()) {
            return null;
        }

        return true;       
    }

    function add_app_tmp($name, $name_provider, $price, $emailDev, $description, $typeProduct, $image, $file) {
        $sql = 'insert into product(IdProduct, name, name_provider, price, emailDev, description, 
        typeProduct, rating, num_of_purchases, image, file, size, status) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $conn = open_database();
        $stm = $conn->prepare($sql);

        $id_product = auto_id_product();
        $rating = 0;
        $num_of_purchases = 0;
        $status = 'not verified';

        $img_dir = uploadImageProduct($image);
        $file_dir = uploadFile($file);
        $size = $file['size'] / 1024;
 
        $stm->bind_param('ississsiissds', $id_product, $name, $name_provider, $price, $emailDev, $description, $typeProduct, $rating, $num_of_purchases, $img_dir, $file_dir, $size, $status);

        if (!$stm->execute()) {
            return null;
        }

        return true;       
    }

    function get_product_tmp() {
        $sql = "select * from product where status = 'not verified'";
        $conn = open_database();

        $result = $conn->query($sql);

        return $result;
    }

    function uploadFile($file) {
        $fileName = $file['name'];
        $fileTmp_Name = $file['tmp_name'];

        $fileExt = explode('.', $fileName);
        $fileExt = strtolower(end($fileExt));
 
        $random = random_int(1, 99999999);
        $newFileName = uniqid($random) . '.' . $fileExt;
        $file_destination = 'file/' . $newFileName;

        move_uploaded_file($fileTmp_Name, $file_destination);  

        return $newFileName;
    }

    function uploadImageProduct($image) {
        $imageName = $image['name'];
        $imageTmp_Name = $image['tmp_name'];

        $imageExt = explode('.', $imageName);
        $imageExt = strtolower(end($imageExt));
 
        $random = random_int(1, 99999999);
        $newFileName = md5($random) . '.' . $imageExt;
        $imageDestination = 'image/product/' . $newFileName;

        move_uploaded_file($imageTmp_Name, $imageDestination);  

        return $imageDestination;
    }

    function check_exist_product($email, $id_product) {
        $sql = "select * from productofaccount where email = ? and idProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('si', $email, $id_product);
        
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();
        
        if ($result->num_rows == 0) {
            return false;
        }

        return true;
    }

    function get_product_of_account_id($idproduct) {
        $sql = "select account.image, account.name, account.email, product.name as product_name, price, productofaccount.datetime 
                from productofaccount left join account on productofaccount.email = account.email 
                left join product on productofaccount.IdProduct = product.IdProduct where productofaccount.IdProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('i', $idproduct);
        
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();
        
        if ($result->num_rows == 0) {
            return false;
        }

        return $result;
    }

    function check_provider($email, $idproduct) {
        $sql = "select * from product where emailDev = ? and IdProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('si', $email, $idproduct);
        
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();
        
        if ($result->num_rows == 0) {
            return false;
        }

        return true;
    }

    function check_product_of_account($email, $idproduct) {
        $sql = "select * from productofaccount where email = ? and IdProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('si', $email, $idproduct);
        
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();
        
        if ($result->num_rows == 0) {
            return false;
        }

        return true;
    }

    function updatePassword($email, $pass) {
        $sql = "update account set password = ? where email = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
        $stm->bind_param('ss', $hashed_pass, $email);
        if (!$stm->execute()) {
            return null;
        }

        return true;
    }

    function update_product_status($idproduct) {
        $sql = "update product set status = ? where IdProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $status = "";

        $stm->bind_param('ss', $status, $idproduct);
        if (!$stm->execute()) {
            return null;
        }

        return true;
    }

    function updateTypeAccount($email) {
        $dev = "Developer";
        $sql = "update account set typeAccount = ? where email = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ss', $dev, $email);
        if (!$stm->execute()) {
            return null;
        }

        return true;
    }

    function addDeveloper($email, $name_provider, $cmnd_front, $cmnd_behind) {
        $sql = 'insert into developer(email, name_provider, cmnd_front, cmnd_behind, status) values(?, ?, ?, ?, ?)';
        $conn = open_database();
        $stm = $conn->prepare($sql);

        $cmnd_front_dir = uploadImage($cmnd_front);
        $cmnd_behind_dir = uploadImage($cmnd_behind);
        $status = 'not verified';
        $stm->bind_param('sssss', $email, $name_provider, $cmnd_front_dir, $cmnd_behind_dir, $status);

        if (!$stm->execute()) {
            return null;
        }

        return true;
    }

    function checkDeveloper($email) {
        $sql = 'select * from developer where email = ?';    
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);

        if (!$stm->execute()) {
            return null; //
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return false;
        }

        return true;
    }

    function get_history_money($email) {
        $sql = "select * from history_money where email = ? order by datetime desc";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();

        return $result;
    }


    function getComment($idproduct) {
        $conn = open_database();
        $sql = 'select * from comment where IdProduct = ? order by IdComment desc';
        $stm = $conn->prepare($sql);
        $stm->bind_param('i', $idproduct);
        $stm->execute();
        $result = $stm->get_result();
        
        return $result;
    }

    function updateRating($email, $idproduct, $rating) {
        $sql = 'update productofaccount set rating = ? where email = ? and IdProduct = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);

        $stm->bind_param('sii', $rating, $email, $idproduct);
        if (!$stm->execute()) {
            return null; 
        }

        return true;
    }

    function updateRatingProduct($idproduct) {
        $sql = "update product set rating = ? where IdProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);

        $rating = get_all_rating_productofaccount($idproduct);
        $stm->bind_param('ii', $rating, $idproduct);
        if (!$stm->execute()) {
            return null; 
        }

        return $rating;
    }

    function get_all_rating_productofaccount($idproduct) {
        $sql = "select * from productofaccount where IdProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('i', $idproduct);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();

        $rating = 0;
        $count = 0;
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['rating'] > 0) { // = 0 thi ngta chua danh gia
                    $rating += $row['rating'];
                    $count += 1;
                }
                
            }
        }
        
        $count > 0 ? $rating_result = $rating / $count : $rating_result = $rating;
        return $rating_result;
    }   

    function get_product_same_type($typeProduct, $id_product) {
        $sql = "select * from product where typeProduct = ? and IdProduct != ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('si', $typeProduct, $id_product);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();

        return $result;
    }

    function get_product_allsame_type($typeProduct) {
        $sql = "select * from product where typeProduct = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $typeProduct);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();

        return $result;
    }

    function get_product_same_name_provider($name_provider, $id_product) {
        $sql = "select * from product where name_provider = ? and IdProduct != ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('si', $name_provider, $id_product);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();

        return $result;
    }

    function get_product_same_allname_provider($name_provider) {
        $sql = "select * from product where name_provider = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $name_provider);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();

        return $result;
    }

    function check_download($file) {
        $sql = "select product.* from productofaccount, product WHERE file = ? 
        and productofaccount.IdProduct = product.IdProduct";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $file);
        if (!$stm->execute()) {
            return null;
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return false;
        }

        $data = $result->fetch_assoc();
        return $data;
    }

    function get_account() {
        $sql = "select * from account order by typeAccount asc";
        $conn = open_database();
        $query = $conn->query($sql);
        return $query;
    }

    function get_developer() {
        $sql = "select image, name, name_provider, developer.email, cmnd_front, cmnd_behind, 
        developer.datetime from developer right join account on account.email = developer.email 
        where developer.status = 'not verified'";
        $conn = open_database();
        $query = $conn->query($sql);
        return $query;
    }

    function check_developer($email) {
        $sql = 'select * from developer where email = ?';    
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);

        if (!$stm->execute()) {
            return null; //
        }

        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return false;
        } 

        return true;
    }

?>