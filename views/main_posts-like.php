<?php
if (isset($_SESSION['url']) && isset($_SESSION['email'])) { ?>
    <?php
    $token = $_GET['f'] = !"" ? mysqli_real_escape_string($conn, $_GET['f']) : '';
    $sql = "SELECT * FROM users WHERE `token` = '$token'";
    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);
    ?>
    <?php if ($rowcount > 0) { ?>
        <main class="default-page-width">
            <section class="hot-list-container">
                <div class="hot-list-left" id="posts-like">
                    <h1>
                        Bài viết yêu thích
                    </h1>
                    <?php
                    $id_users = $_SESSION['id'];
                    $sql = "SELECT * FROM posts_favorite WHERE id_users = $id_users";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <?php if (mysqli_num_rows($result) > 0) { ?>
                        <?php
                        $sql = "SELECT * FROM posts_favorite WHERE id_users = $id_users";
                        $favorite = executeResult($sql);
                        foreach ($favorite as $fa) {
                            $id_posts = $fa['id_posts'];
                            $sql = "SELECT * FROM posts WHERE id_posts = $id_posts";
                            $posts = executeResult($sql);
                        ?>
                            <?php foreach ($posts as $ps) {
                                $users = $ps['id_users'];
                            ?>
                                <article class="card-columns posts">
                                    <div class="card-rows">
                                        <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                                            <h4>
                                                <?php echo '' . $ps['title'] . '' ?>
                                            </h4>
                                            <div class="img-list">
                                                <img src="<?php echo '' . $ps['image_S'] . '' ?>" alt="" />
                                            </div>
                                        </a>
                                        <div class="content-list">
                                            <h6>
                                                <?php echo '' . $ps['summary'] . '' ?>
                                            </h6>
                                            <nav class="nav-users">
                                                <div class="users-info">
                                                    <?php
                                                    $sql = "SELECT fullname, img_user FROM users WHERE id_users = '$users'";
                                                    $users = executeResult($sql);
                                                    ?>
                                                    <?php foreach ($users as $us) { ?>
                                                        <a href="">
                                                            <img src="<?php echo '' . $us['img_user'] . ''; ?>" alt="" />
                                                            <span><?php echo '' . $us['fullname'] . ''; ?></span>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <span class="time">
                                                    <?php echo '' . facebook_time_ago($ps['created_at']) . '' ?>
                                                </span>
                                            </nav>
                                        </div>
                                        <div class="delete-box btn-delete" data-posts="<?php echo''.$id_posts.''?>"
                                        data-users="<?php echo''.$id_users.''?>">
                                            <i class="fad fa-times-circle" ></i>
                                        </div>
                                    </div>
                                </article>
                            <?php } //Kết thúc thằng vòng lặp bài viết
                            ?>
                        <?php } //Kết thúc vòng lặp bài viết yêu thích 
                        ?>
                    <?php } else { ?>
                        <p style="margin: 2em 0em;">Hiện chưa có bài viết nào được lưu</p>
                    <?php } ?>
                </div>
            </section>
        </main>
    <?php } else {
        require_once('error_404.php'); ?>

    <?php } ?>
<?php } else {
    require_once('error_404.php');
} ?>