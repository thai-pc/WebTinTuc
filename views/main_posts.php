<?php
$posts = $_GET['p'] = !"" ? mysqli_real_escape_string($conn, $_GET['p']) : '';
$sql = "SELECT * FROM posts WHERE `url` = '$posts'";
$result = mysqli_query($conn, $sql);
$rowcount = mysqli_num_rows($result);
?>
<?php if ($rowcount != 0) { // Kiểm tra có bài viết này không 
?>
    <main class="default-page-width">
        <section class="list-justify-content">
            <div class="tag-main posts-block">
                <div class="tag-main-left w-355">
                    <div class="posts-main">
                        <div class="posts-top">
                            <div class="posts-list">
                                <?php
                                $sql = "SELECT * FROM posts WHERE `url` = '$posts'";
                                $posts = executeResult($sql);
                                $id_posts = $posts[0]['id_posts'];
                                $id_category = $posts[0]['id_category'];
                                $id_category_child = $posts[0]['id_category_child'];
                                $id_users = $posts[0]['id_users'];
                                $title = $posts[0]['title'];
                                $image_S = $posts[0]['image_S'];
                                $summary = $posts[0]['summary'];
                                $content = $posts[0]['content'];
                                $created_at = $posts[0]['created_at'];
                                $viewconut = $posts[0]['viewCount'];
                                ?>
                                <h5>
                                    <?php
                                    $sql = "SELECT `name`,`url`,`id_category` FROM category WHERE `id_category` = '$id_category'";
                                    $category = executeResult($sql);
                                    $url_category = $category[0]['url'];
                                    $name_category = $category[0]['name'];
                                    ?>

                                    <a href="list.php?parent=<?php echo '' . $url_category . '' ?>">
                                        <?php echo '' . $name_category . '' ?>
                                    </a>
                                    <i class="fas fa-caret-right"></i>
                                    <?php
                                    $sql = "SELECT `name`,`url`,`id_category_child` FROM category_child WHERE `id_category_child` = '$id_category_child'";
                                    $category = executeResult($sql);
                                    $url_category_child = $category[0]['url'];
                                    $name_category_child = $category[0]['name'];
                                    ?>
                                    <a href="list.php?parent=<?php echo '' . $url_category . '' ?>&child=<?php echo '' . $url_category_child . '' ?>">
                                        <?php echo '' . $name_category_child . '' ?>
                                    </a>
                                </h5>
                            </div>
                            <div class="posts-heading">
                                <h1>
                                    <?php echo '' . $title . '' ?>
                                </h1>
                            </div>
                            <div class="posts-user">
                                <div class="user-info">
                                    <?php
                                    $sql = "SELECT id_users,fullname, img_user FROM users WHERE id_users = '$id_users'";
                                    $users = executeResult($sql);
                                    ?>
                                    <a href="users.php?u=<?php echo''.$users[0]['id_users'].''?>">
                                        <div class="card-img">
                                            <img class="users" src="<?php echo '' . $users[0]['img_user'] . '' ?>" alt="Tác giả">
                                        </div>
                                        <div class="card-title">
                                            <h6>Chia sẻ bởi</h6>
                                            <h3><?php echo '' . $users[0]['fullname'] . '' ?></h3>
                                        </div>
                                    </a>
                                </div>

                                <div class="users-time">
                                    <h5>
                                        Đăng lúc<span>
                                            <?php
                                            $date = date_create($created_at);
                                            $date_format = date_format($date, 'H:i d-m-Y');
                                            echo '' . $date_format . '' ?>
                                        </span>
                                    </h5>
                                    <span class="view">
                                        <i class="far fa-eye"></i>
                                        <?php echo '' . $viewconut . '' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="posts">
                            <div class="posts-intro">
                                <?php echo '' . $summary . '' ?>
                            </div>
                            <div class="post-contents">
                                <?php echo '' . $content . '' ?>
                            </div>
                        </div>
                        <div class="popup-image">
                            <i class="fas fa-times-square"></i>
                            <img src="" alt="popup">
                        </div>
                        <div class="space-between">
                            <?php if (isset($_SESSION['email'])) { ?>
                                <button class="users-notify modal-send">
                                    <span>Báo lỗi</span>
                                    <i class="fas fa-bug"></i>
                                </button>
                            <?php } else { ?>
                                <button title="báo lỗi" class="users-notify login-click">
                                    <span>Báo lỗi</span>
                                    <i class="fas fa-bug"></i>
                                </button>
                            <?php } ?>
                            <div class="list-icons">
                                <a title="Chia sẻ qua facebok" class="share facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo getCurrentPageURL() ?>" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a title="Chia sẻ qua twitter" class="share twitter" href="https://twitter.com/share?text=&url=<?php echo getCurrentPageURL() ?>" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a title="Chia sẻ qua pinterest" class="share pinterest" href="https://www.pinterest.com/pin/create/button/?url=<?php echo getCurrentPageURL() ?>&media=<?php echo '' . $image_S . '' ?>&description=<?php echo '' . $summary . '' ?>" target="_blank">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                                <?php if (isset($_SESSION['email'])) { ?>
                                    <a data-users="<?php echo '' . $_SESSION['id'] . '' ?>" data-posts="<?php echo '' . $id_posts . '' ?>" class="save btn-save" title="Lưu bài viết yêu thích">
                                        <i class="fas fa-save"></i>
                                    </a>
                                <?php } else { ?>
                                    <a class="save login-click" title="Lưu bài viết yêu thích">
                                        <i class="fas fa-save"></i>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tag-box">
                            <ul class="banner-tag">
                                <li class="name-tag">
                                    <img src="uploads/images/svg/tag-svgrepo-com.svg">
                                    <span>Chủ đề :</span>
                                </li>
                                <?php
                                $sql = "SELECT * FROM posts_tag WHERE `id_posts` = '$id_posts'";
                                $posts_tag = executeResult($sql);
                                ?>
                                <?php foreach ($posts_tag as $pt) {
                                    $id_tag = $pt['id_tag'];
                                    $sql = "SELECT * FROM tag WHERE `id_tag` = '$id_tag'";
                                    $tag = executeResult($sql);
                                ?>
                                    <?php foreach ($tag as $tg) { ?>
                                        <li class="tag-items">
                                            <a href="tag.php?keyword=<?php echo '' . $tg['url'] . '' ?>">
                                                <?php echo '' . $tg['name'] . '' ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- Phần bình luận bài viết -->
                    <?php
                    require_once('comments.php');
                    ?>
                    <!-- Kết thúc phần bình luận bài viết -->
                    <!-- Phần tin khác -->
                    <div class="other-news-box">
                        <nav class="title-items">
                            <div class="heading-title">
                                <h3>Tin Cùng thể loại</h3>
                            </div>
                        </nav>
                        <div class="wrapper">
                            <?php
                            $row = 6;
                            $sql = "SELECT * FROM posts WHERE `id_category` = '$id_category'
                                 ORDER BY created_at DESC LIMIT 0,$row ";
                            $posts = executeResult($sql);
                            ?>
                            <?php foreach ($posts as $ps) {
                                $users = $ps['id_users'];
                            ?>
                                <div class="card-columns posts">
                                    <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                                        <div class="card-img">
                                            <img src="<?php echo '' . $ps['image_S'] . '' ?>">
                                        </div>
                                        <div class="card-title">
                                            <h4>
                                                <?php echo '' . $ps['title'] . '' ?>
                                            </h4>
                                        </div>
                    
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Kết thúc phần tin khác -->
                </div>
                <div class="tag-main-right-ads w-336">
                    <nav class="title-items">
                        <div class="heading-title">
                            <h3>Có thể bạn quan tâm</h3>
                        </div>
                        <div class="container">
                            <div class="hot-title-items active">
                                <?php
                                $row = 11;
                                $sql = "SELECT * FROM posts
                                 ORDER BY RAND() LIMIT 0,$row ";
                                $posts = executeResult($sql);
                                ?>
                                <?php foreach ($posts as $ps) { ?>
                                    <article class="card-columns">
                                        <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                                            <div class="card-img">
                                                <img src="<?php echo '' . $ps['image_S'] . '' ?>">
                                            </div>
                                            <div class="card-title">
                                                <h5>
                                                    <?php echo '' . $ps['title'] . '' ?>
                                                </h5>
                                            </div>
                                        </a>
                                    </article>
                                <?php } ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </section>
    </main>
<?php } else {
    require_once('error_404.php');
} ?>