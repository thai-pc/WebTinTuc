<?php
if (isset($_SESSION['fullname']) || isset($_SESSION['email'])) {
    //Đã kiểm tra có biến đăng nhập
    $users = isset($_GET['users']) ? mysqli_real_escape_string($conn, $_GET['users']) : '';
    $sql = "SELECT * FROM `users` WHERE token = '$users'";
    $users = executeResult($sql);

    if (!empty($users)) {
        //Kiểm tra mảng đã khác null,0 và có biến đăng nhập
        foreach ($users as $us) {
?>
            <main class="default-page-width">
                <section class="section postpage">
                    <div class="container">
                        <h1 class="name">Đăng bài viết</h1>
                        <form action="" id="form-posts" method="POST">
                            <ul class="fields form clearfix">
                                <li>
                                    <label class="title">Tiêu đề bài đăng</label>
                                    <input name="title" class="textfield full" placeholder="Nhập tiêu đề của bài viết này" type="text" value="">
                                </li>
                                <li>
                                    <label class="title">Nội dung bài đăng</label>
                                    <textarea class="textfield full" id="Content" name="Content" placeholder="Nội dung bài viết"></textarea>
                                </li>
                                <li>
                                    <label class="title">Ảnh bìa bài đăng</label>
                                    <p>
                                        Tải ảnh đại diện cho bài nên có kích thước tối thiểu rộng 640px x cao 345px
                                    </p>
                                    <input type="file" name="fileToUpload" id="fileToUpload">

                                </li>
                                <li>
                                    <label class="title">Nội dung vắn tắt</label>
                                    <textarea class="textfield full" cols="20" id="Description" name="Description" placeholder="Nội dung tóm tắt ngắn gọn của bài viết." rows="3"></textarea>
                                </li>
                                <li>
                                    <input type="checkbox" name="checkbox">Tôi đồng ý với
                                    <a>
                                        Chính sách và Điều khoản</a> sử dụng.
                                </li>
                            </ul>
                            <div class="toolbar">
                                <a class="btn" href="posts-article.php?users='<?php echo '' . $_SESSION['url'] . '' ?>'">Quay trở lại</a>
                                <button type="submit" class="btn btn-primary">Lưu bài viết</button>
                            </div>
                        </form>
                    </div>
                </section>
            </main>
    <?php
        }
    } else { //Mảng bằng 0 hoặc Null và có biến đăng nhập
        require_once('header.php');
        require_once('error_404.php');
    }
    ?>
<?php } else { //Đã kiểm tra chưa có biến đăng nhập
    require_once('header.php');
    require_once('error_404.php');
}
require_once('footer.php');
?>