<?php
    require_once('../includes/config.php');
    require_once('../includes/dbhelper.php');

    $sql = "SELECT * FROM `users` WHERE `email` LIKE '".$_GET['email']."'";
    $result = mysqli_query($conn,$sql);
    
    if($result !== false && $result -> num_rows > 0){//Tồn tại email
        echo json_encode(false);
    }else{//Không tồn tại email
        echo json_encode(true);
    }
?>