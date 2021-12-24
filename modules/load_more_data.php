<?php
require_once('../includes/config.php');
require_once('../includes/dbhelper.php');
require_once('./function.php');

//Load More Data Hot    
if (isset($_POST['hot'])) {
    $row = $_POST['row'];
    $rowperpage = 10;
    $sql = "SELECT * FROM  posts WHERE viewCount != 0 ORDER BY viewCount DESC LIMIT $row, $rowperpage";
    $posts = executeResult($sql);
    foreach ($posts as $ps) {
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
                        <span class="time"><?php echo '' . facebook_time_ago($ps['created_at']) . ''; ?></span>
                    </nav>
                </div>
            </div>
        </article>
    <?php } //Kết thúc foreach
    echo '<a class="btn-hot viewmore"> Xem Thêm </a>';
} //Kết thúc if hot

//Load More Data News
if (isset($_POST['news'])) {
    $row = $_POST['row'];
    $rowperpage = 9;
    $sql = "SELECT * FROM  posts ORDER BY created_at DESC LIMIT $row, $rowperpage";
    $posts = executeResult($sql);
    foreach ($posts as $ps) {
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
                        <span class="time"><?php echo '' . facebook_time_ago($ps['created_at']) . ''; ?></span>
                    </nav>
                </div>
            </div>
        </article>
    <?php } //Kết thúc foreach
    echo '<a class="btn-news viewmore"> Xem Thêm </a>';
} //Kết thúc if news
//Load More Data Girl
if (isset($_POST['girl'])) {
    $row = $_POST['row'];
    $rowperpage = 9;
    $sql = "SELECT * FROM  posts WHERE id_category = 5 ORDER BY created_at DESC LIMIT $row, $rowperpage";
    $posts = executeResult($sql);
    foreach ($posts as $ps) {
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
                        <span class="time"><?php echo '' . facebook_time_ago($ps['created_at']) . ''; ?></span>
                    </nav>
                </div>
            </div>
        </article>
    <?php } //Kết thúc foreach
    echo '<a class="btn-girl viewmore"> Xem Thêm </a>';
} //Kết thúc if girl


if (isset($_POST['list'])) {
    $row = $_POST['row'];
    $id_category = $_POST['category'];
    $parent = $_POST['parent'];
    $id_posts1 = $_POST['p1'];
    $id_posts2 = $_POST['p2'];
    $id_posts3 = $_POST['p3'];
    $id_posts4 = $_POST['p4'];
    $id_posts5 = $_POST['p5'];
    $id_posts6 = $_POST['p6'];
    $id_posts7 = $_POST['p7'];
    $rowperpage = 7;
    $sql = "SELECT * FROM posts WHERE id_category = $id_category 
                        AND id_posts NOT IN ($id_posts1,$id_posts2,$id_posts3,$id_posts4,$id_posts5,$id_posts6,$id_posts7) 
                        ORDER BY created_at DESC LIMIT $row,$rowperpage";
    $posts = executeResult($sql);
    foreach ($posts as $ps) {
        $id_category_child = $ps['id_category_child'];
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
    <?php } //Kết thúc foreach
    echo '<button  class="btn-list btn-parent" ><span>Xem Thêm</span></button>';
} //Kết thúc if list

if (isset($_POST['list_small'])) {
    $row = $_POST['row'];
    $id_category_child = $_POST['category_child'];
    $parent = $_POST['parent'];
    $id_posts1 = $_POST['p1'];
    $id_posts2 = $_POST['p2'];
    $id_posts3 = $_POST['p3'];
    $id_posts4 = $_POST['p4'];
    $id_posts5 = $_POST['p5'];
    $id_posts6 = $_POST['p6'];
    $id_posts7 = $_POST['p7'];
    $rowperpage = 7;
    $sql = "SELECT * FROM posts WHERE id_category_child = $id_category_child
                        AND id_posts NOT IN ($id_posts1,$id_posts2,$id_posts3,$id_posts4,$id_posts5,$id_posts6,$id_posts7) 
                        ORDER BY created_at DESC LIMIT $row,$rowperpage";
    $posts = executeResult($sql);
    foreach ($posts as $ps) {
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
    <?php } //Kết thúc foreach
    echo '<button  class="btn-list btn-child" ><span>Xem Thêm</span></button>';
} //Kết thúc if list_small

//Load More Data Tag   
if (isset($_POST['tag'])) {
    $row = $_POST['row'];
    $id_tag = $_POST['id_tag'];
    $name = $_POST['name_tag'];
    $rowperpage = 5;
    $sql = "SELECT * FROM posts_tag WHERE `id_tag` = '$id_tag' ORDER BY id_posts_tag DESC LIMIT $row,$rowperpage";
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
    echo '<button class="viewmore btn-tag">Xem Thêm</button>';
    ?>
    <?php
} //Kết thúc if tag

//Load More Data Hot News   
if (isset($_POST['hotnews'])) {
    $row = $_POST['row'];
    $rowperpage = 10;
    $sql = "SELECT * FROM  posts WHERE viewCount != 0 ORDER BY viewCount DESC LIMIT $row, $rowperpage";
    $posts = executeResult($sql);
    foreach ($posts as $ps) {
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
<?php } //Kết thúc foreach
    echo '<a class="btn-hotnews viewmore"> Xem Thêm </a>';
} //Kết thúc if tin hot

//Load More Data Hot News   
if (isset($_POST['more_news'])) {
    $row = $_POST['row'];
    $rowperpage = 9;
    $sql = "SELECT * FROM  posts ORDER BY created_at DESC LIMIT $row, $rowperpage";
    $posts = executeResult($sql);
    foreach ($posts as $ps) {
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
<?php } //Kết thúc foreach
    echo '<button class="viewmore btn-more-news">Xem Thêm</button>';
} //Kết thúc if tin mới nhất
?>