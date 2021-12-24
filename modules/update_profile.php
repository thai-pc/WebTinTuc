<?php
     ob_start();
     session_start();
     require_once('../includes/config.php');
     require_once('../includes/dbhelper.php');
?>
<?php
    $error = false;
    if(isset($_POST['btn-profile'])){
        if(isset($_SESSION['fullname']) || isset($_SESSION['email'])){
           if(isset($_POST['fullname']) && isset($_POST['BirthdayDay']) && isset($_POST['BirthdayMonth'])
           && isset($_POST['BirthdayYear']) && isset($_POST['Gender'])
           && isset($_POST['address']) && isset($_POST['Phone']) )
           {
               //Lấy thông tin form đăng nhập
               $id_users = mysqli_real_escape_string($conn,$_POST['id_users']);
               $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
               $BirthdayDay = mysqli_real_escape_string($conn,$_POST['BirthdayDay']);
               $BirthdayMonth = mysqli_real_escape_string($conn,$_POST['BirthdayMonth']);
               $BirthdayYear = mysqli_real_escape_string($conn,$_POST['BirthdayYear']);
               $Gender = mysqli_real_escape_string($conn,$_POST['Gender']);
               $address = mysqli_real_escape_string($conn,$_POST['address']);
               $Phone = mysqli_real_escape_string($conn,$_POST['Phone']);

               $sql = "UPDATE `users` SET `fullname` = '$fullname' 
               ,`BirthdayDay` = '$BirthdayDay', `BirthdayMonth` = '$BirthdayMonth',
               `BirthdayYear` = '$BirthdayYear',`Gender` = '$Gender',
               `address` = '$address', `Phone` = '$Phone'
                WHERE md5(`users`.`id_users`) = '$id_users'";

                $result = mysqli_query($conn,$sql);
                
                if( $result === true) {
                    $sql_fullname = "SELECT fullname FROM users WHERE md5(`users`.`id_users`) = '$id_users'";
                    $sql_run = mysqli_query($conn,$sql_fullname);
                    $rows = mysqli_fetch_array($sql_run);
                    if($rows != 0){
                        $_SESSION['fullname'] = $rows['fullname'];
                    }
                    if($error === false){
                        echo json_encode(array(
                            'status' => 1,
                            'message' => 'Cập nhật thông tin thành công'
                        ));
                        exit();
                    }
                }else{
                    $error = true;
                    if($error !== false){
                        echo json_encode(array(
                            'status' => 0,
                            'message' => 'Cập nhật thông tin thất bại'
                        ));
                    }
                    exit();
                }
                mysqli_close($conn);
           }
        }
    }
    
?>