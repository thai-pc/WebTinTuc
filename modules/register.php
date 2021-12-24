<?php
    require_once('../includes/config.php');
    require_once('../includes/dbhelper.php');
    require_once('function.php');

    if(isset($_POST['btn_register'])){

        if(isset($_POST['email']) && isset($_POST['password']) ){

            //Lấy thông tin
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            //Xử lý tên gmail
            $name_gmail = chop($email,'@gmail.com');
            $password = mysqli_real_escape_string($conn,$_POST['password']);
            $password = md5($password);
            $img_user = 'uploads/img-users/user1.jpg';
            $status = 0;
            $id_group = 2;
            $token = getToken(13);

            $sql = "INSERT INTO `users` ( `email` , `password`, `fullname` , `img_user`, `status`, `id_group`,`token` ) 
            VALUES ('$email', '$password' ,'$name_gmail','$img_user' ,$status, $id_group,'$token')";
            $result = mysqli_query($conn,$sql);
            if($result){
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Đăng ký thành công'
                ));
                exit();
            }else{
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Có lỗi khi đăng ký xin vui lòng thử lại'
                ));
                exit();
            }
        }
    }
    mysqli_close($conn);
?>