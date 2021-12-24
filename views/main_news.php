<main class="default-page-width">
  <section class="hot-container" style="background:rgb(255,212,78)">
    <div class="hot-heading">
      <a href="news.php?url=moi-nhat">
        <img src="uploads/images/svg/newspaper.svg">
        <div class="heading-items">
          <h1>Tin Mới Nhất</h1>
          <button type="button">Xem Thêm >></button>
        </div>
      </a>
    </div>
    </div>
    <div class="hot-main">
      <?php
      $rowperpage = 9;
      $sql = "SELECT count(*) AS allcount FROM posts";
      $fetch = executeResult($sql);
      $allcount = $fetch[0]['allcount'];

      $sql = "SELECT * FROM  posts ORDER BY created_at DESC LIMIT 0, $rowperpage";
      $posts = executeResult($sql);
      $count = count($posts);
      ?>
      <!-- hot main left -->
      <div class="hot-main-left">
        <article class="card-columns">
          <a href="posts.php?=<?php echo '' . $posts[0]['url'] . '' ?>">
            <div class="card-img">
              <img src="<?php echo '' . $posts[0]['image_S'] . '' ?>" alt="image">
            </div>
            <div class="card-title">
              <h3>
                <?php echo '' . $posts[0]['title'] . '' ?>
              </h3>
            </div>
          </a>
        </article>
      </div>
      <!--hot main left -->
      <!-- hot main right -->
      <div class="hot-main-right news-right">
        <?php for ($i = 1; $i <= $count - 6; $i++) { ?>
          <article class="card-columns">
            <a href="posts.php?p=<?php echo '' . $posts[$i]['url'] . ''; ?>">
              <div class="card-img">
                <img src="<?php echo '' . $posts[$i]['image_S'] . ''; ?>" alt="" />
              </div>
              <div class="card-title">
                <h3>
                  <?php echo '' . $posts[$i]['title'] . ''; ?>
                </h3>
              </div>
            </a>
          </article>
        <?php } //Kết thúc vòng lặp 
        ?>
      </div>
      <!-- hot main right -->
    </div>
  </section>
  <div class="tag-main fix-hotnews">
    <div class="tag-main-left" id="load_more_news">
      <?php for ($i = 4; $i <= $count - 1; $i++) {
        $id_category = $posts[$i]['id_category'];
        $id_category_child = $posts[$i]['id_category_child'];
        $users = $posts[$i]['id_users'];
      ?>
        <div class="card-columns posts">
          <div class="card-img">
            <a href="posts.php?p=<?php echo '' . $posts[$i]['url'] . '' ?>">
              <img src="<?php echo '' . $posts[$i]['image_S'] . '' ?>" alt="keyword">
            </a>
          </div>
          <div class="card-title">
            <div class="card-contents">
              <a href="posts.php?p=<?php echo '' . $posts[$i]['url'] . '' ?>" title="<?php echo '' . $ps['title'] . '' ?>">
                <h3>
                  <?php echo '' . $posts[$i]['title'] . '' ?>
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
                  <?php echo '' . facebook_time_ago($posts[$i]['created_at']) . '' ?>
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
      <button class="viewmore btn-more-news">
        Xem Thêm
      </button>
      <input type="hidden" data-row="0" class="row">
      <input type="hidden" data-allcount="<?php echo '' . $allcount . ''; ?>" class="allcount">
    </div>
    <div class="tag-main-right-ads">
      <div class="sticky">
        <?php
        $sql = "SELECT * FROM posts ORDER BY RAND() LIMIT 0,1";
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
</main>