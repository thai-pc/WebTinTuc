<main class="default-page-width sticky-stopper">
  <!-------Phần Hot ------->
  <section class="hot-container">
    <div class="hot-heading">
      <a href="hotnews.php?url=tin-hot">
        <img src="uploads/images/svg/hot_main.svg">
        <div class="heading-items">
          <h1>Được Quan Tâm</h1>
          <button type="button">Xem Thêm >></button>
        </div>
      </a>
    </div>
    <div class="hot-main">
      <?php
      $rowperpage = 10;
      $sql = "SELECT count(*) AS allcount FROM posts WHERE viewCount != 0";
      $fetch = executeResult($sql);
      $allcount = $fetch[0]['allcount'];

      $sql = "SELECT * FROM  posts WHERE viewCount != 0 ORDER BY viewCount DESC LIMIT 0, $rowperpage";
      $posts = executeResult($sql);
      $count = count($posts);
      ?>
      <!-- hot main left -->
      <div class="hot-main-left">
        <article class="card-columns">
          <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>">
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
      <div class="hot-main-right">
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
        <?php } //Kết thúc c=vòng lặp 
        ?>
      </div>
      <!-- hot main right -->
    </div>
  </section>
  <section class="hot-list-container">
    <div class="hot-list-left" id="load_data_hot">
      <?php for ($i = 5; $i <= $count - 1; $i++) {
        $users = $posts[$i]['id_users'];
      ?>
        <article class="card-columns posts">
          <div class="card-rows">
            <a href="posts.php?p=<?php echo '' . $posts[$i]['url'] . '' ?>">
              <h4>
                <?php echo '' . $posts[$i]['title'] . '' ?>
              </h4>
              <div class="img-list">
                <img src="<?php echo '' . $posts[$i]['image_S'] . '' ?>" alt="" />
              </div>
            </a>
            <div class="content-list">
              <h6>
                <?php echo '' . $posts[$i]['summary'] . '' ?>
              </h6>
              <nav class="nav-users">
                <div class="users-info">
                  <?php
                  $sql = "SELECT id_users,fullname, img_user FROM users WHERE id_users = '$users'";
                  $users = executeResult($sql);
                  ?>
                  <?php foreach ($users as $us) { ?>
                    <a href="users.php?u=<?php echo '' . $us['id_users'] . ''; ?>">
                      <img src="<?php echo '' . $us['img_user'] . ''; ?>" alt="" />
                      <span><?php echo '' . $us['fullname'] . ''; ?></span>
                    </a>
                  <?php } ?>
                </div>
                <span class="time"><?php echo '' . facebook_time_ago($posts[$i]['created_at']) . ''; ?></span>
              </nav>
            </div>
          </div>
        </article>
      <?php } ?>
      <a class="btn-hot viewmore"> Xem Thêm </a>
      <input type="hidden" data-row="0" class="row">
      <input type="hidden" data-allcount="<?php echo '' . $allcount . ''; ?>" class="allcount">
    </div>
    <div class="hot-list-right">
      <nav class="title-items">
        <div class="heading-title">
          <h3>Đọc Nhiều</h3>
          <div class="tabs-button">
            <button type="button" class="btn btn-prev active-btn">
              <i class="far fa-arrow-circle-left"></i>
            </button>
            <button type="button" class="btn btn-next">
              <i class="far fa-arrow-circle-right"></i>
            </button>
          </div>
        </div>
        <div class="container">
          <?php
          $rowperpage = 14;
          $sql = "SELECT * FROM  posts WHERE viewCount != 0 ORDER BY RAND() LIMIT 0, $rowperpage";
          $posts = executeResult($sql);
          $p = count($posts);
          ?>
          <div class="hot-title-items active">
            <?php for ($i = 0; $i <= $p - 8; $i++) { ?>
              <article class="card-columns">
                <a href="posts.php?p=<?php echo '' . $posts[$i]['url'] . '' ?>">
                  <div class="card-img">
                    <img src="<?php echo '' . $posts[$i]['image_S'] . '' ?>" alt="" />
                  </div>
                  <div class="card-title">
                    <h5>
                      <?php echo '' . $posts[$i]['title'] . '' ?>
                    </h5>
                  </div>
                </a>
              </article>
            <?php } ?>
          </div>
          <div class="hot-title-items">
            <?php for ($i = 7; $i < $p; $i++) { ?>
              <article class="card-columns">
                <a href="posts.php?p=<?php echo '' . $posts[$i]['url'] . '' ?>">
                  <div class="card-img">
                    <img src="<?php echo '' . $posts[$i]['image_S'] . '' ?>" alt="" />
                  </div>
                  <div class="card-title">
                    <h5>
                      <?php echo '' . $posts[$i]['title'] . '' ?>
                    </h5>
                  </div>
                </a>
              </article>
            <?php } ?>
          </div>
        </div>
      </nav>
    </div>
  </section>
  <!------- End Phần Hot ------->

  <!-------Phần Mới Nhất ------->
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
          <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>">
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

  <section class="hot-list-container">
    <div class="hot-list-left" id="load_data_news">

      <?php for ($i = 4; $i <= $count - 1; $i++) {
        $users = $posts[$i]['id_users'];
      ?>
        <article class="card-columns posts">
          <div class="card-rows">
            <a href="posts.php?p=<?php echo '' . $posts[$i]['url'] . '' ?>">
              <h4>
                <?php echo '' . $posts[$i]['title'] . '' ?>
              </h4>
              <div class="img-list">
                <img src="<?php echo '' . $posts[$i]['image_S'] . '' ?>" alt="" />
              </div>
            </a>
            <div class="content-list">
              <h6>
                <?php echo '' . $posts[$i]['summary'] . '' ?>
              </h6>
              <nav class="nav-users">
                <div class="users-info">
                  <?php
                  $sql = "SELECT id_users,fullname, img_user FROM users WHERE id_users = '$users'";
                  $users = executeResult($sql);
                  ?>
                  <?php foreach ($users as $us) { ?>
                    <a href="users.php?u=<?php echo '' . $us['id_users'] . ''; ?>">
                      <img src="<?php echo '' . $us['img_user'] . ''; ?>" alt="" />
                      <span><?php echo '' . $us['fullname'] . ''; ?></span>
                    </a>
                  <?php } ?>
                </div>
                <span class="time"><?php echo '' . facebook_time_ago($posts[$i]['created_at']) . ''; ?></span>
              </nav>
            </div>
          </div>
        </article>
      <?php } ?>
      <a class="btn-news viewmore"> Xem Thêm </a>
      <input type="hidden" data-row="0" class="row">
      <input type="hidden" data-allcount="<?php echo '' . $allcount . ''; ?>" class="allcount">
    </div>

    <div class="hot-list-right">
    </div>
  </section>
  <!-------Kết Thúc Phần Mới Nhất ------->
  <!-------Bắt Đầu Phần Giải Trí ------->

  <section class="hot-container" style="background: rgb(238,129,157);">
    <div class="hot-heading">
      <a href="list.php?parent=giai-tri">
        <img src="uploads/images/svg/virgo.svg">
        <div class="heading-items">
          <h1>Tin Giải Trí</h1>
          <button type="button">Xem Thêm >></button>
        </div>
      </a>
    </div>
    </div>
    <div class="hot-main">
      <?php
      $rowperpage = 9;
      $sql = "SELECT count(*) AS allcount FROM posts WHERE id_category = 5";
      $fetch = executeResult($sql);
      $allcount = $fetch[0]['allcount'];

      $sql = "SELECT * FROM  posts WHERE id_category = 5 ORDER BY created_at DESC LIMIT 0, $rowperpage";
      $posts = executeResult($sql);
      $count = count($posts);
      ?>
      <!-- hot main left -->
      <div class="hot-main-left">
        <article class="card-columns">
          <a href="posts.php?p=<?php echo '' . $posts[0]['url'] . '' ?>">
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
      <div class="hot-main-right girl-right">
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

  <section class="hot-list-container">
    <div class="hot-list-left" id="load_data_girl">
      <?php for ($i = 4; $i <= $count - 1; $i++) {
        $users = $posts[$i]['id_users'];
      ?>
        <article class="card-columns posts">
          <div class="card-rows">
            <a href="posts.php?p=<?php echo '' . $posts[$i]['url'] . '' ?>">
              <h4>
                <?php echo '' . $posts[$i]['title'] . '' ?>
              </h4>
              <div class="img-list">
                <img src="<?php echo '' . $posts[$i]['image_S'] . '' ?>" alt="" />
              </div>
            </a>
            <div class="content-list">
              <h6>
                <?php echo '' . $posts[$i]['summary'] . '' ?>
              </h6>
              <nav class="nav-users">
                <div class="users-info">
                  <?php
                  $sql = "SELECT id_users,fullname, img_user FROM users WHERE id_users = '$users'";
                  $users = executeResult($sql);
                  ?>
                  <?php foreach ($users as $us) { ?>
                    <a href="users.php?u=<?php echo '' . $us['id_users'] . ''; ?>">
                      <img src="<?php echo '' . $us['img_user'] . ''; ?>" alt="" />
                      <span><?php echo '' . $us['fullname'] . ''; ?></span>
                    </a>
                  <?php } ?>
                </div>
                <span class="time"><?php echo '' . facebook_time_ago($posts[$i]['created_at']) . ''; ?></span>
              </nav>
            </div>
          </div>
        </article>
      <?php } ?>
      <a class="btn-girl viewmore"> Xem Thêm </a>
      <input type="hidden" data-row="0" class="row">
      <input type="hidden" data-allcount="<?php echo '' . $allcount . ''; ?>" class="allcount">
    </div>
    <div class="hot-list-right">
      <nav class="title-items">
        <div class="heading-title tabs">
          <h3 class="tab-text-l active">Hot Face</h3>
          <h3 class="tab-text-r">Người Nổi Tiếng</h3>
        </div>
        <div class="container">
          <!-- click text left -->
          <div class="main-items active">
            <?php
            $sql = "SELECT * FROM posts WHERE id_category_child = 15 
                ORDER BY created_at DESC LIMIT 0,7";
            $posts = executeResult($sql);
            ?>
            <?php foreach ($posts as $ps) { ?>
              <article class="card-columns">
                <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                  <div class="card-img">
                    <img src="<?php echo '' . $ps['image_S'] . '' ?>" alt="image" />
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
          <!-- End click text left -->

          <!-- click text right -->
          <div class="main-items">
            <?php
            $sql = "SELECT * FROM posts WHERE id_category_child = 16 
                ORDER BY created_at DESC LIMIT 0,7";
            $posts = executeResult($sql);
            ?>
            <?php foreach ($posts as $ps) { ?>
              <article class="card-columns">
                <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                  <div class="card-img">
                    <img src="<?php echo '' . $ps['image_S'] . '' ?>" alt="" />
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
          <!-- End click text right -->
        </div>
      </nav>
    </div>
  </section>
  <!-------Kết Thúc Phần Giải Trí ------->
</main>