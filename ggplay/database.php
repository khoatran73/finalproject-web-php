<?php
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

    function login($email, $password) {
        $sql = "select * from account where email = ?";
        $conn = open_database();
        // echo $conn;
        $stm = $conn->prepare($sql);
        // $result = mysqli_query($conn, $sql);
        // echo $stm;
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

    // code = 0: Lỗi liên quan tới truy vấn 
    // code = 1: Lỗi lq tới email 
    // code = 2: Lỗi liên quan tới mật khẩu  
    // code = 3: thành công

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

    function register($name, $email, $password, $typeAccount) {
        if (is_exists_email($email)) {
            return array('code' => 1, 'error' => 'Email đã tồn tại');
        }
        $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
        $sql = 'insert into account(name, email, password, typeAccount) values(?, ?, ?, ?)';

        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssss', $name, $email, $hashed_pass, $typeAccount);

        if (!$stm->execute()) {
            return array('code' => 0, 'error' => 'Lỗi truy vấn');
        }

        return array('code' => 3, 'error' => 'Tạo tài khoản thành công');
    }
?>