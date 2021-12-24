<?php
$id_users = $_GET['u'] = !"" ? mysqli_real_escape_string($conn, $_GET['u']) : '';
$sql = "SELECT * FROM users WHERE id_users = $id_users";
$result = mysqli_query($conn, $sql);
$rowcount = mysqli_num_rows($result);
?>
<?php if ($rowcount > 0) { ?>
    <main class="default-page-width">
        <section class="hot-list-container">
            <div class="hot-list-left" id="users">
                <?php
                $sql = "SELECT id_users,img_user,fullname FROM users WHERE id_users = $id_users";
                $users = executeResult($sql);
                $fullname = $users[0]['fullname'];
                $img_user = $users[0]['img_user'];
                ?>
                <ul class="main-profile clearfix">
                    <li class="img-profile">
                        <img src="<?php echo '' . $img_user . '' ?>">
                    </li>
                    <li class="name-profile">
                        <h1><?php echo '' . $fullname . '' ?></h1>
                    </li>
                    <li class="date-profile">
                        <span>Tham gia từ <?php
                                            $date = date_create($date_time);
                                            $date_format = date_format($date, 'H:i d-m-Y');
                                            echo '' . $date_format . '' ?>
                        </span>
                    </li>
                </ul>
                <h1>
                    Bài viết đã chia sẻ
                </h1>
                <div data-users="<?php echo '' . $id_users . '' ?>" 
                class="users-posts" id="users-posts">

                </div>
            </div>
        </section>
    </main>
<?php } else {
    require_once('error_404.php');
} ?>