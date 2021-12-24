<?php
$keyword = $_GET['keyword'] = !"" ? mysqli_real_escape_string($conn, $_GET['keyword']) : '';
$sql = "SELECT * FROM tag WHERE `url` = '$keyword'";
$result = mysqli_query($conn, $sql);
$rowcount = mysqli_num_rows($result);
?>
<?php if ($rowcount) { ?>
    <main class="default-page-width fix-tag">
        <div class="hot-banner">
            <div class="hot-banner-heading">
                <h1>Tìm Theo Từ Khóa</h1>
            </div>
            <div class="tag-main">
                <div class="tag-main-left" id="load_more_tag">
                    <?php
                    $sql = "SELECT * FROM tag WHERE `url` = '$keyword'";
                    $word = executeResult($sql);
                    $name = $word[0]['name'];
                    $id_tag = $word[0]['id_tag'];
                    ?>
                    <div class="hot-list-name">
                        <span class="list-name"><?php echo '' . $word[0]['name'] . '' ?></span>
                        <h4>
                            <?php echo '' . $word[0]['metaTitle'] . '' ?>
                        </h4>
                    </div>
                    <?php
                    $rowperpage = 5;
                    $sql = "SELECT count(*) AS allcount FROM posts_tag WHERE `id_tag` = '$id_tag'";
                    $fetch = executeResult($sql);
                    $allcount = $fetch[0]['allcount'];

                    $sql = "SELECT * FROM posts_tag WHERE `id_tag` = '$id_tag' ORDER BY id_posts_tag DESC LIMIT 0,$rowperpage";
                    $posts_tag = executeResult($sql);
                    ?>
                    <?php foreach ($posts_tag as $p_t) {
                        $id_posts = $p_t['id_posts'];
                    ?>
                        <?php
                        $sql = "SELECT * FROM posts WHERE `id_posts` = '$id_posts'";
                        $posts = executeResult($sql);
                        ?>
                        <?php foreach ($posts as $ps) {
                            $id_category = $ps['id_category'];
                            $id_category_child = $ps['id_category_child'];
                            $users = $ps['id_users'];
                        ?>
                            <div class="card-columns posts">
                                <div class="card-img">
                                    <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                                        <img src="<?php echo '' . $ps['image_S'] . '' ?>" alt="keyword">
                                    </a>
                                </div>
                                <div class="card-title">
                                    <div class="card-header">
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
                                            <?php
                                            $sql = "SELECT `id_category`,`url` FROM category 
                                                WHERE id_category = '$id_category'";
                                            $ct = executeResult($sql);
                                            $parent = $ct[0]['url'];
                                            ?>
                                            <?php
                                            $sql = "SELECT `id_category_child`,`url`,`name` FROM category_child 
                                                WHERE id_category_child = '$id_category_child'";
                                            $ctc = executeResult($sql);
                                            $child = $ctc[0]['url'];
                                            $name_ctc = $ctc[0]['name'];
                                            ?>
                                            <a href="list-small.php?parent=<?php echo '' . $parent . '' ?>&child=<?php echo '' . $child . '' ?>">
                                                <h5 class="list-name">
                                                    <?php echo '' . $name_ctc . ''; ?>
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
                        <?php } //Kết thúc vòng lặp posts 
                        ?>
                    <?php } //Kết thúc vòng lặp posts tag
                    ?>
                    <?php if ($allcount > $rowperpage) { ?>
                    <button class="viewmore btn-tag">
                        Xem Thêm
                    </button>
                    <input type="hidden" data-row="0" class="row">
                    <input type="hidden" data-name-tag="<?php echo '' . $name . ''; ?>" data-tag="<?php echo '' . $id_tag . '' ?>" data-allcount="<?php echo '' . $allcount . ''; ?>" class="allcount">
                    <?php } ?>
                </div>
                <div class="tag-main-right-ads">
                    <div class="sticky">
                        <?php
                        $sql = "SELECT * FROM posts_tag WHERE `id_tag` = '$id_tag'  ORDER BY RAND() LIMIT 0,1";
                        $posts_tag = executeResult($sql);
                        $id_posts = $posts_tag[0]['id_posts'];
                        ?>
                        <?php
                        $sql = "SELECT * FROM posts WHERE `id_posts` = '$id_posts'";
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
    </main>
<?php } else
    require_once('error_404.php');
?>