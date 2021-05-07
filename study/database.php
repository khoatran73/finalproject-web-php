<?php
    define('host', 'localhost');
    define('user', 'root');
    define('pass', '');
    define('db', 'courseonline');
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
            return null; //
        }
        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        $data = $result->fetch_assoc();
        // $data = mysqli_fetch_assoc($result);

        if ($password != $data['password']) {
            return null;
        }
        // return $data;
        // echo $data['email'];
        return $data;
    }

    function is_exists_email($email) {
        $sql = 'select email from account where email = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);

        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();
        if ($result->num_rows == 0) {
            return false;
        }

        return true;

    }

    function register($name, $email, $password, $position, $image) {
        if (is_exists_email($email)) {
            return false;
        }
        $sql = 'insert into account(name, email, password, position, image) values(?, ?, ?, ?, ?)';

        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('sssss', $name, $email, $password, $position, $image);

        if (!$stm->execute()) {
            return false;
        }
        return true;
    }

    function take_img($email) {
        require_once('database.php');
        $sql = 'select image from account where email = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            echo "1";
            return null; //
        }
        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            echo "2";
            return null;
        }

        $data = $result->fetch_assoc();
        return $data['image'];
    }

    function take_pos($email) {
        require_once('database.php');
        $sql = 'select position from account where email = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            echo "1";
            return null; //
        }
        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            echo "2";
            return null;
        }

        $data = $result->fetch_assoc();
        return $data['position'];
    }

    function auto_id_course() {
        $conn = open_database();
        $sql = "select id_course from course order by id_course desc limit 1";

        $stm = $conn->query($sql);
        
        $result = $stm->fetch_assoc(); 

        $id_course = $result['id_course'];
        $id_int = (int) substr($id_course, 1);
        $id_int += 1;
        

        if ($id_int >= 0 && $id_int <= 9) {
            $id = "C00" . (string) $id_int;
        } else if ($id_int >= 10 && $id_int <= 99) {
            $id = "C0" . (string) $id_int;
        } else {
            $id = "C" . (string) $id_int;
        }

        return $id;
    }

    function add_course($name, $content, $image, $email_teacher) {
        $sql = 'insert into course(name, content, image, token, id_course, email_teacher) values (?, ?, ?, ?, ?, ?)';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $token = md5($name.'+'.random_int(0, 1000));
        $id_course = auto_id_course();
        $stm->bind_param('ssssss', $name, $content, $image, $token, $id_course, $email_teacher);

        if (!$stm->execute()) {
            die ('false');
        }
    }

    function get_course($id_course) {
        $sql = 'select * from course where id_course = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);

        $stm->bind_param('s', $id_course);
        if (!$stm->execute()) {
            return null; 
        }
        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        $data = $result->fetch_assoc();
        return $data;
    }

    function add_mycourses($email, $id_course) {
        $conn = open_database();
        $sql = "insert into mycourses (email, id_course) values (?, ?)";

        $stm = $conn->prepare($sql);
        $stm->bind_param('ss', $email, $id_course);

        if (!$stm->execute()) {
            return false;
        }

        return true;
    }

    function get_mycourses($email) {
        $sql = 'select * from mycourses where email = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);

        if (!$stm->execute()) {
            return null; //
        }
        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            return null;
        }
        return $result;
    }

    function pay($soseri, $mathe) {
        $conn = open_database();
        $sql = 'select * from thecao where soseri = ? and mathe = ?';
        $stm = $conn->prepare($sql);

        $stm->bind_param('ss', $soseri, $mathe);
        if (!$stm->execute()) {
            echo "1";
            return false; 
        }

        $result = $stm->get_result();
        if ($result->num_rows == 0) {
            echo "2";
            return false;
        }
    
        delete_thecao($soseri);
        return true;
    }

    function delete_thecao($soseri) {
        $conn = open_database();
        $sql = 'delete from thecao where soseri = ?';
        $stm = $conn->prepare($sql);

        $stm->bind_param('s', $soseri);
    }

    function add_thecao($soseri, $mathe) {
        $conn = open_database();
        $sql = 'insert into thecao(soseri, mathe) values (?, ?)';
        $stm = $conn->prepare($sql);

        $stm->bind_param('ss', $soseri, $mathe);
        if (!$stm->execute()) {
            return null; 
        }

        // echo "success";
    }

    function get_teacher() {
        $teacher = 'teacher';
        $sql = 'select * from account where position = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $teacher);

        if (!$stm->execute()) {
            echo "1";
            return null; //
        }
        $result = $stm->get_result();

        if ($result->num_rows == 0) {
            echo "2";
            return null;
        }
    
        return $result;
    }

    
?>