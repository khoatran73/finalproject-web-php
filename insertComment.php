<?php
    session_start();
    require_once('database.php');
    if(isset($_SESSION['email']) && check_pay($_SESSION['email'], $_GET['id'])) {
        $conn = open_database();
        $email = $_SESSION['email'];
        $id_product = $_GET['id'];
        $idcomment = auto_id_comment();
        $content = $conn->escape_string($_POST['message']);
        if(!empty($content)) {
            $sql = mysqli_query($conn, "insert into comment (email, IdProduct, IdComment, content)
                                            values ('$email', $id_product, $idcomment, '$content')") or die();
        }
    }else{
        header("location: index.php");
    }

    function auto_id_comment() {
        $conn = open_database();
        $sql = "select IdComment from comment order by IdComment desc limit 1";

        $stm = $conn->query($sql);
        
        $result = $stm->fetch_assoc(); 

        if ($result) {
            $id_comment = $result['IdComment'];
        } else {
            $id_comment = 0;
        }
        
        return $id_comment + 1;
    }
?>

