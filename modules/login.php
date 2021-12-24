<?php
ob_start();
session_start();
require_once('../includes/config.php');
require_once('../includes/dbhelper.php');

if (isset($_POST['btn-login'])) {

    if (isset($_POST['email_login']) && isset($_POST['password_login'])) {

        //Lấy thông tin
        $email = mysqli_real_escape_string($conn, $_POST['email_login']);
        $password = mysqli_real_escape_string($conn, $_POST['password_login']);
        $password = md5($password);
        
        $sql = "SELECT `id_users`, `email`, `password`, `fullname`, `img_user`, `id_group`,`token` FROM `users` WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        //Kiểm tra email có tồn tại không
        if (mysqli_num_rows($result) == 0) {
            echo json_encode(array(
                'email' => 0,
                'message' => 'Tài khoản không tồn tại. Vui lòng kiểm tra lại'
            ));
            exit();
        }
        //Lấy mật khẩu trong database ra
        $row = mysqli_fetch_array($result);
        //So sánh 2 mật khẩu có trùng khớp không
        if ($password != $row['password']) {
            echo json_encode(array(
                'password' => 0,
                'message' => 'Mật khẩu không đúng. Vui lòng kiểm tra lại'
            ));
            exit();
        }
        
        if (mysqli_num_rows($result) != 0 && $password == $row['password'] && isset($row['id_users']) && isset($row['img_user'])) {
            //Lưu email đăng nhập
            $_SESSION['email'] = $email;
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['id'] = $row['id_users'];
            $_SESSION['img_user'] = $row['img_user'];
            $_SESSION['group'] = $row['id_group'];
            $_SESSION['url'] = $row['token'];
            echo json_encode(array(
                'status' => 1,
                'message' => ''.$_SESSION['url'].''
            ));
        }
    }
    mysqli_close($conn);
}
