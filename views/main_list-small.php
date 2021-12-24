<!-- Bắt đầu phần chính -->
<?php
$parent = $_GET['parent'] = !"" ? mysqli_real_escape_string($conn, $_GET['parent']) : '';
$child = $_GET['child'] = !"" ? mysqli_real_escape_string($conn, $_GET['child']) : '';
$sql_parent = "SELECT `url` FROM category WHERE `url` = '$parent'";
$result_parent = mysqli_query($conn, $sql_parent);
$row_parent = mysqli_num_rows($result_parent);
$sql_child = "SELECT `url` FROM category_child WHERE `url` = '$child'";
$result_child = mysqli_query($conn, $sql_child);
$row_child = mysqli_num_rows($result_child);
?>
<?php if ($row_parent != 0 && $row_child != 0) { //Biến thể loại cha và con có kết quả khác 0 
?>
    <main class="default-page-width">
        <section class="hot-banner">
            <div class="hot-banner-heading justify-content">
                <?php
                $sql = "SELECT * FROM category_child WHERE `url` = '$child' LIMIT 0,1";
                $dm = executeResult($sql);
                $id_category_child = $dm[0]['id_category_child'];
                ?>
                <h1>
                    <a href="list.php?child=<?php echo '' . $dm[0]['url'] . '' ?>" title="<?php echo '' . $dm[0]['metaTitle'] . '' ?>">
                        Tin <?php echo '' . $dm[0]['name'] . '' ?>
                    </a>
                </h1>
            </div>
            <!-- Phần trên -->

            <div class="hot-banner-main">
                <div class="hot-banner-main-x">
                    <div class="hot-banner-main-left">
                        <?php
                        $sql = "SELECT * FROM posts WHERE id_category_child = $id_category_child ORDER BY created_at DESC LIMIT 0,1";
                        $posts = executeResult($sql);
                        $id_posts1 = $posts[0]['id_posts'];
                        ?>

                        <div class="card-img">
                            <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>">
                                <img src="<?php echo '' . $posts[0]['image_S'] . '' ?>" alt="<?php echo '' . $posts[0]['title'] . '' ?>">
                            </a>
                        </div>
                        <div class="card-title">
                            <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>" title="<?php echo '' . $posts[0]['title'] . '' ?>">
                                <h3>
                                    <?php echo '' . $posts[0]['title'] . '' ?>
                                </h3>
                            </a>
                        </div>
                        <h5>
                            <?php echo '' . $posts[0]['summary'] . '' ?>
                        </h5>
                        <?php

                        ?>
                        <div class="card-time">
                            <span>
                                <?php
                                echo '' . date_format_vn($posts[0]['created_at']) . '';
                                ?>
                            </span>
                        </div>
                        <?php
                        $sql = "SELECT * FROM posts WHERE id_category_child = $id_category_child AND id_posts != $id_posts1 ORDER BY RAND() LIMIT 0,3";
                        $posts = executeResult($sql);
                        $id_posts2 = $posts[0]['id_posts'];
                        $id_posts3 = $posts[1]['id_posts'];
                        $id_posts4 = $posts[2]['id_posts'];
                        ?>
                        <?php foreach ($posts as $ps) { ?>
                            <div class="card-heading">
                                <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>" title="<?php echo '' . $ps['title'] . '' ?>">
                                    <h4>
                                        <?php echo '' . $ps['title'] . '' ?>
                                    </h4>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="hot-banner-main-right">
                        <div class="main-right-top">
                            <?php
                            $sql = "SELECT * FROM posts WHERE id_category_child = $id_category_child 
                                AND id_posts NOT IN ($id_posts1,$id_posts2,$id_posts3,$id_posts4) ORDER BY created_at DESC LIMIT 0,1";
                            $posts = executeResult($sql);
                            $id_posts5 = $posts[0]['id_posts'];
                            ?>
                            <div class="card-img">
                                <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>">
                                    <img src="<?php echo '' . $posts[0]['image_S'] . '' ?>" alt="<?php echo '' . $posts[0]['title'] . '' ?>">
                                </a>
                            </div>
                            <div class="card-title">
                                <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>" title="<?php echo '' . $posts[0]['title'] . '' ?>">
                                    <h3>
                                        <?php echo '' . $posts[0]['title'] . '' ?>
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <div class="main-right-bottom">
                            <?php
                            $sql = "SELECT * FROM posts WHERE id_category = $id_category 
                            AND id_posts NOT IN ($id_posts1,$id_posts2,$id_posts3,$id_posts4,$id_posts5) 
                            ORDER BY created_at DESC LIMIT 0,2";
                            $posts = executeResult($sql);
                            $id_posts6 = $posts[0]['id_posts'];
                            $id_posts7 = $posts[1]['id_posts'];
                            ?>
                            <?php foreach ($posts as $ps) { ?>
                                <div class="bottom-items-left">
                                    <div class="card-img">
                                        <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                                            <img src="<?php echo '' . $ps['image_S'] . '' ?>" alt="<?php echo '' . $posts[0]['title'] . '' ?>">
                                        </a>
                                    </div>
                                    <div class="card-title">
                                        <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>" title="<?php echo '' . $ps['title'] . '' ?>">
                                            <h3>
                                                <?php echo '' . $ps['title'] . '' ?>
                                            </h3>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="hot-banner-main-ads">
                </div>
            </div>
            <!-- End phần trên -->
        </section>
        <!-- Hot banner dạng mobile -->

        <section class="hot-sub">
            <div class="hot-sub-heading after-h">
                <?php
                $sql = "SELECT * FROM category_child WHERE `url` = '$child' LIMIT 0,1";
                $dm = executeResult($sql);
                $id_category_child = $dm[0]['id_category_child'];
                ?>
                <h1>
                    <a href="list-small.php?child=<?php echo '' . $url . '' ?>" title="<?php echo '' . $dm[0]['metaTitle'] . '' ?>">
                        Tin <?php echo '' . $dm[0]['name'] . '' ?>
                    </a>
                </h1>
            </div>
            <div class="hot-sub-banner">
                <?php
                $sql = "SELECT * FROM posts WHERE id_category_child = $id_category_child ORDER BY created_at DESC LIMIT 0,1";
                $posts = executeResult($sql);
                $id_posts1 = $posts[0]['id_posts'];
                ?>
                <div class="card-img">
                    <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>">
                        <img src="<?php echo '' . $posts[0]['image_S'] . '' ?>" alt="<?php echo '' . $posts[0]['title'] . '' ?>">
                    </a>
                </div>

                <?php
                $sql = "SELECT id_posts,id_tag FROM posts_tag WHERE id_posts = $id_posts1";
                $posts_tag = executeResult($sql);
                ?>
                <div class="tag-link">
                    <?php foreach ($posts_tag as $ptg) {
                        $id_tag = $ptg['id_tag'];
                        $sql = "SELECT * FROM tag WHERE id_tag = $id_tag";
                        $tag = executeResult($sql);
                        foreach ($tag as $tg) {
                    ?>
                            <a href="tag.php?keyword=<?php echo '' . $tg['url'] . '' ?>">
                                <?php echo '' . $tg['name'] . '' ?>
                            </a>

                        <?php } ?>
                </div>
            <?php } ?>
            <div class="card-title">
                <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>">
                    <h2>
                        <?php echo '' . $posts[0]['title'] . '' ?>
                    </h2>
                </a>
                <h5 class="summary">
                    <?php echo '' . $posts[0]['summary'] . '' ?>
                </h5>
            </div>
            <div class="card-time">
                <span>
                    <?php echo '' . date_format_vn($posts[0]['created_at']) . '' ?>
                </span>
            </div>
            </div>
            <?php
            $sql = "SELECT * FROM posts WHERE id_category_child = $id_category_child 
                AND id_posts NOT IN ($id_posts1,$id_posts2,$id_posts3,$id_posts4) ORDER BY created_at DESC LIMIT 0,3";
            $posts = executeResult($sql);
            $id_posts5 = $posts[0]['id_posts'];
            $id_posts6 = $posts[1]['id_posts'];
            $id_posts7 = $posts[2]['id_posts'];
            ?>
            <?php foreach ($posts as $ps) {
                $users = $ps['id_users'];
            ?>
                <article class="hot-sub-main">
                    <nav class="nav-users">
                        <span class="time">
                            <?php echo '' . facebook_time_ago($ps['created_at']) . '' ?>
                        </span>
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
                    </nav>
                    <div class="card-content">
                        <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>" title="<?php echo '' . $ps['title'] . '' ?>">
                            <h3>
                                <?php echo '' . $ps['title'] . '' ?>
                            </h3>
                        </a>
                    </div>
                    <div class="card-columns">
                        <div class="card-img">
                            <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                                <img src="<?php echo '' . $ps['image_S'] . '' ?>">
                            </a>
                        </div>
                        <div class="card-title">
                            <h6 class="summary">
                                <?php echo '' . $ps['summary'] . '' ?>
                            </h6>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </section>

        <!-- End Hot banner dạng mobile -->

        <!-- Phần dưới -->
        <section class="list-justify-content">
            <div class="tag-main">
                <div class="tag-main-left" id="load_data_list">
                    <?php
                    $rowperpage = 7;
                    $sql = "SELECT count(*) AS allcount FROM posts WHERE position = 0 AND id_category_child = $id_category_child 
                        AND id_posts NOT IN ($id_posts1,$id_posts2,$id_posts3,$id_posts4,$id_posts5,$id_posts6,$id_posts7)";
                    $fetch = executeResult($sql);
                    $allcount = $fetch[0]['allcount'];

                    $sql = "SELECT * FROM posts WHERE id_category_child = $id_category_child AND position = 0
                        AND id_posts NOT IN ($id_posts1,$id_posts2,$id_posts3,$id_posts4,$id_posts5,$id_posts6,$id_posts7) 
                        ORDER BY created_at DESC LIMIT 0,$rowperpage";
                    $posts = executeResult($sql);
                    ?>
                    <?php foreach ($posts as $ps) {
                        $users = $ps['id_users'];
                    ?>
                        <div class="card-columns posts">
                            <div class="card-img">
                                <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                                    <img src="<?php echo '' . $ps['image_S'] . '' ?>">
                                </a>
                            </div>
                            <div class="card-title">
                                <div class="card-header">
                                    <?php
                                    $sql = "SELECT id_category_child,`name`,`url` FROM category_child WHERE id_category_child = $id_category_child";
                                    $category_child = executeResult($sql);
                                    $name = $category_child[0]['name'];
                                    $url = $category_child[0]['url'];
                                    ?>
                                    <span>
                                        <?php echo '' . $name . ''; ?>
                                    </span>
                                </div>
                                <div class="card-contents">
                                    <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>" title="<?php echo '' . $ps['title'] . '' ?>">
                                        <h3>
                                            <?php echo '' . $ps['title'] . '' ?>
                                        </h3>
                                    </a>
                                </div>
                                <div class="card-footer">
                                    <nav class="card-footer-left">
                                        <a href="list-small.php?parent=<?php echo '' . $parent . '' ?>&child=<?php echo '' . $url . '' ?>">
                                            <h5 class="list-name">
                                                <?php echo '' . $name . ''; ?>
                                            </h5>
                                        </a>
                                        <span class="time">
                                            <?php echo '' . facebook_time_ago($ps['created_at']) . '' ?>
                                        </span>
                                    </nav>
                                    <nav class="card-footer-right">
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
                                    </nav>
                                </div>
                            </div>
                        </div>
                    <?php } //Kết thúc vòng lặp
                    ?>
                    <!-- Xem thêm bài viết -->
                    <?php if ($allcount > $rowperpage) { ?>
                        <button class="btn-list btn-child">
                            <span>Xem Thêm</span>
                        </button>
                        <input type="hidden" data-row="0" class="row" data-parent="<?php echo '' . $parent . '' ?>">
                        <input type="hidden" data-allcount="<?php echo '' . $allcount . ''; ?>" class="allcount" data-category-child="<?php echo '' . $id_category_child . '' ?>" data-posts1="<?php echo '' . $id_posts1 . '' ?>" data-posts2="<?php echo '' . $id_posts2 . '' ?>" data-posts3="<?php echo '' . $id_posts3 . '' ?>" data-posts4="<?php echo '' . $id_posts4 . '' ?>" data-posts5="<?php echo '' . $id_posts5 . '' ?>" data-posts6="<?php echo '' . $id_posts6 . '' ?>" data-posts7="<?php echo '' . $id_posts7 . '' ?>">
                    <?php } ?>
                </div>
                <div class="tag-main-right-ads">
                    <div class="sticky">
                        <?php
                        $sql = "SELECT * FROM posts WHERE id_category_child = $id_category_child  ORDER BY RAND() LIMIT 0,1";
                        $posts = executeResult($sql);
                        ?>
                        <article class="card-colums">
                            <div class="card-img">
                                <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>">
                                    <img src="<?php echo '' . $posts[0]['image_S'] . '' ?>" alt="image">
                                </a>
                            </div>
                            <div class="card-title">
                                <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>" title="<?php echo '' . $posts[0]['title'] . '' ?>">
                                    <h4>
                                        <?php echo '' . $posts[0]['title'] . '' ?>
                                    </h4>
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
    <!-- Kết thúc phần chính -->
<?php } else { //Biến $url bằng 0 
    require_once('./error_404.php');
} ?>