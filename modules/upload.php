<?php
    ob_start();
    session_start();
    require_once('../includes/config.php');
    require_once('../includes/dbhelper.php');
?>
<?php
     if(isset($_SESSION['fullname']) || isset($_SESSION['email'])){
        /* Nhận tên file */
        $filename = $_FILES['file']['name'];

        /* Nhận kích thước file */
        $filesize = $_FILES['file']['size'];

        /* Thêm tên file bằng timestamp*/
        $timestamp = time();

        /* Gắn timestamp vào tên file*/
        $path = $timestamp.$filename;

        /* Location */
        $uploadPath = "../uploads/img-users/".date('d-m-Y', time());
        if(!is_dir($uploadPath)){
            mkdir($uploadPath,0777,true);
        }

        /* Upload file */
        //Kiểm tra kích thước ảnh trước khi upload
        $size = $_FILES["file"]['tmp_name'];
        list($width, $height) = getimagesize($size);

        if($width > "1000" || $height > "1000") {
            echo json_encode(array(
                'size' => 0,
                'message' => 'Error : Kích thước ảnh nhỏ hơn 1000px x 1000px .'
            ));
            exit();
        }
        //Kiểm tra xem kiểu file có hợp lệ hoặc dung lượng lớn không
        $validTypes = array("jpg","jpeg","png","bmp");
        $fileType = substr($path,strrpos($path,".") + 1);

        if(!in_array($fileType,$validTypes) || $filesize > 2 * 1024 * 1024){
            echo json_encode(array(
                'file' => 0,
                'message' => 'Error : File lớn hơn 2MB hoặc file không phải là ảnh'
            ));
            exit();
        }
        //Check xem ảnh đã tồn tại hay chưa nếu không thì đổi tên
        $num = 1;
        $fileName = substr($path,0,strrpos($path,"."));
        $fileName = md5($fileName);
        while(file_exists($uploadPath . '/' . $fileName . '.' . $fileType)){
            $fileName = $fileName . "(". $num .")";
            $num ++;
        }
        $path = $fileName . '.' . $fileType;

        move_uploaded_file($_FILES['file']['tmp_name'],$uploadPath . '/' .$path);
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            $uploadPath = "uploads/img-users/".date('d-m-Y', time());
            $img_user =  $uploadPath . '/' .$path;
            $sql = "UPDATE `users` SET `img_user` = '$img_user' WHERE `users`.`id_users` = $id";
            $result = mysqli_query($conn,$sql);
            $sql_img = "SELECT img_user FROM `users` WHERE `users`.`id_users` = $id";
            $result_img = mysqli_query($conn,$sql_img);
            $row = mysqli_fetch_array($result_img);
            if($row != 0){
                $_SESSION['img_user'] = $row['img_user'];
            }
            mysqli_close($conn);
            echo json_encode(array(
                'true' => 1
            ));
            exit();
        }
     }else{
        echo json_encode(array(
            'false' => 1,
            'message' => 'error_404.php'
        ));
        exit();
     }
?>