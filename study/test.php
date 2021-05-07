<?php
    session_start();
    require_once('database.php');

    // for ($i = 0; $i < 6; $i++) {
    //     $seri_rand = random_int(100000, 999999);
    //     $pass_rand = random_int(10000000, 99999999);
    //     add_thecao('75117'.$seri_rand, '07322'.$pass_rand);
    // }

    // get_mycourses('bang@gmail.com');
    
    // var_dump(pay('75117990531', '0732275098283'));

    get_teacher();
    
?>

