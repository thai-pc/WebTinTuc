<nav class="nav-bar">
    <?php
    $sql = "SELECT * FROM `menu` ";
    $navbar = executeResult($sql);
    ?>
    <?php foreach ($navbar as $nb) { ?>
        <?php if ($nb['menu_name'] == 'đăng nhập') { // Kiểm tra vị trí 
        ?>
            <?php if (isset($_SESSION['fullname']) && isset($_SESSION['email']) && isset($_SESSION['img_user'])) { ?>
                <div class="nav-bar-items">
                    <a href="profile.php?users=<?php echo '' . $_SESSION['url'] . ''; ?>" class="link-items">
                        <span class="icons-items">
                            <img src="<?php echo '' . $_SESSION['img_user'] . ''; ?>">
                        </span>
                        <p class="title-items"><?php echo '' . $_SESSION['fullname'] . ''; ?></p>
                    </a>
                </div>
            <?php } else { ?>
                <div class="nav-bar-items login-click">
                    <a class="link-items">
                        <span class="icons-items">
                            <?php echo '' . $nb['url_image'] . '' ?>
                        </span>
                        <p class="title-items"><?php echo '' . $nb['menu_name'] . '' ?></p>
                    </a>
                </div>
            <?php } ?>
        <?php } elseif ($nb['menu_name'] == 'chuyên mục') { //Kiểm tra vị trí chuyên mục
        ?>
            <div class="nav-bar-items o-c-btn">
                <a class="link-items">
                    <span class="icons-items">
                        <?php echo '' . $nb['url_image'] . '' ?>
                    </span>
                    <p class="title-items"><?php echo '' . $nb['menu_name'] . '' ?></p>
                </a>
            </div>
        <?php } else { //Các vị trí còn lại
        ?>
            <div class="nav-bar-items">
                <a href="<?php echo '' . $nb['url'] . '' ?>" class="link-items link">
                    <span class="icons-items">
                        <?php echo '' . $nb['url_image'] . '' ?>
                    </span>
                    <p class="title-items">
                        <?php echo '' . $nb['menu_name'] . '' ?>
                    </p>
                </a>
            </div>
        <?php } ?>
    <?php } //Kết thúc foreach
    ?>
</nav>
<!---------------End Navbar ------------->
<!---------------- Show List Chuyên Mục ---------------------->

<div class="list" id="list">
    <nav class="list-main">
        <?php
        $sql = "SELECT * FROM `category` ";
        $danhmuc = executeResult($sql);
        ?>
        <?php foreach ($danhmuc as $dm) { ?>
            <div class="list-items">
                <a href="list.php?parent=<?php echo '' . $dm['url'] . ''; ?>" class="icons-items" title="<?php echo '' . $dm['metaTitle'] . ''; ?>">
                    <div class="card-img">
                        <img src="<?php echo '' . $dm['image_svg'] . ''; ?>" alt="<?php echo '' . $dm['name'] . ''; ?>">
                    </div>
                    <h3 class="title-items"><?php echo '' . $dm['name'] . ''; ?></h3>
                </a>
            </div>
        <?php } ?>
        <div class="list-items-footer">
            <p>Copyright &copy; 2021 All rights reserved Vo Dong Thai</p>
        </div>
    </nav>
</div>
<!----------------End Show List Chuyên Mục ---------------------->
<!--Back To Top (Nút lên đầu trang)-->
<div class="btn-top" id="btn-top">
    <i class="fas fa-level-up-alt"></i>
</div>
<!--End Back To Top (Nút lên đầu trang)-->

<!---------- Bắt đầu Menu con -------->
<header style="height: 50px ; background-image: linear-gradient(0, #fe6433, #f53e2d)" class="category-container">
    <!-- category-menu -->
    <div class="category-menu" id="category-menu">
        <a href="index.php" class="category-items">
            <i class="fas fa-home"></i>
        </a>
        <?php

        $sql = "SELECT * FROM category WHERE `name` != 'quảng cáo'";
        $menuSmall = executeResult($sql);

        ?>
        <?php foreach ($menuSmall as $mns) { // Duyệt các phần tử thể loại 
        ?>
            <div class="category-items">
                <a href="list.php?parent=<?php echo '' . $mns['url'] . '' ?>" class="items">
                    <?php echo '' . $mns['name'] . '' ?>
                    <i class="fas fa-chevron-right rotate"></i>
                </a>
                <div class="sub-menu">
                    <div class="sub-menu-items-list">
                        <div class="items-small">
                            <a href="list.php?parent=<?php echo '' . $mns['url'] . '' ?>">
                                <h4><?php echo '' . $mns['name'] . '' ?></h4>
                            </a>
                            <?php

                            $id_category = $mns['id_category'];
                            $sql = "SELECT * FROM category_child WHERE parentID = '$id_category' ";
                            $list = executeResult($sql);

                            ?>
                            <?php foreach ($list as $ls) { //Duyệt các phần tử thể loại con 
                            ?>
                                <div>
                                    <a href="list-small.php?parent=<?php echo '' . $mns['url'] . '' ?>&child=<?php echo '' . $ls['url'] . '' ?>" class="list-small">
                                        <?php echo '' . $ls['name'] . '' ?>
                                    </a>
                                </div>
                            <?php } //Kết thúc vòng lặp thể loại con
                            ?>
                        </div>
                    </div>
                    <?php

                    $id_category = $mns['id_category'];
                    $sql = "SELECT * FROM posts WHERE id_category  = '$id_category' AND position = 0 ORDER BY created_at DESC LIMIT 5";
                    $posts = executeResult($sql);

                    ?>
                    <div class="sub-menu-items-all">
                        <?php foreach ($posts as $ps) { //Duyệt cái bài viết theo thể loại cha
                        ?>
                            <div class="sub-menu-items-rows">
                                <div class="sub-menu-items-small">
                                    <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>" alt="" title="">
                                        <div class="card-img">
                                            <img src="<?php echo '' . $ps['image_S'] . '' ?>" title="<?php echo '' . $ps['title'] . '' ?>" />
                                        </div>
                                        <div class="content-img">
                                            <h5>
                                                <?php echo '' . $ps['title'] . '' ?>
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } //Kết thúc vòng lặp bài viết 
                        ?>
                    </div>
                </div>
            </div>
        <?php } // Kết thúc vòng lặp thể loại 
        ?>
    </div>
</header>
<!---------- Kết thúc menu con -------->