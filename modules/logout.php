<?php
    ob_start();
    session_start();
    if((isset($_SESSION['fullname']) && $_SESSION['fullname'] != NULL) || (isset($_SESSION['email']) && $_SESSION['email'] != NULL)){
        session_destroy();
        header("Location: http://localhost/WebTinTuc/index.php");
    }else{
        echo'Đăng xuất thất bại';
    }
?>