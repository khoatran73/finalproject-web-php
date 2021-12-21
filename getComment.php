<?php
    require_once ('database.php');
    session_start();

    $conn = open_database();
    $id_product = $_GET['id'];
    $output = "";
    $result = getComment($id_product);
    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data = getInfo($row['email']);
            $output .= '<div class="comment__container">
                            <div class="comment__name-image">
                                <img class="comment__img" src='. $data['image']. '>
                                <div class="time">
                                    <div class="comment__name">'.$data['name'].'</div>
                                    <div id="time">' . $row['time'] . '</div>
                                </div>
                            </div>
                            <div class="comment-text">
                                <div class="comment__content">
                                    <p>'. $row['content'] .'</p>
                                </div>
                            </div>
                        </div>';
        }
    }else{
        $output .= '';
    }
    echo $output;
?>