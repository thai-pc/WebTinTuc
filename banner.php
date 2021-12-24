<!------- Banner ------>
<section class="banner">
  <ul class="banner-tag">
    <li class="name-tag">
      <img src="uploads/images/svg/graph-bar.svg">
    </li>
    <?php

    $sql = "SELECT * FROM tag LIMIT 3";
    $tag = executeResult($sql);

    ?>
    <?php foreach ($tag as $tg) { ?>

      <li class="tag-items">
        <a href="tag.php?keyword=<?php echo '' . $tg['url'] . '' ?>">
          <?php echo '' . $tg['name'] . '' ?>
        </a>
      </li>

    <?php } ?>
  </ul>
  <div class="banner-main">
    <div class="banner-main-left">
      <div class="banner-main-left-top">
        <div class="card-columns w-70">
          <?php

          $sql = "SELECT * FROM posts WHERE position = 1 ORDER BY created_at DESC LIMIT 1";
          $posts = executeResult($sql);

          ?>
          <?php foreach ($posts as $ps) { ?>
            <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
              <div class="card-img">
                <img src="<?php echo '' . $ps['image_S'] . '' ?>" title="<?php echo '' . $ps['title'] . '' ?>">
              </div>
              <div class="card-title">
                <h3>
                  <?php echo '' . $ps['title'] . '' ?>
                </h3>
              </div>
            </a>
            <?php
            $id_posts = $ps['id_posts'];
            $sql = "SELECT * FROM posts_tag WHERE id_posts = $id_posts LIMIT 1";
            $p_tag = executeResult($sql);
            ?>
            <?php foreach ($p_tag as $p_tg) { // Bắt đầu bài viết tag
            ?>
              <?php
              $id_tag = $p_tg['id_tag'];
              $sql = "SELECT * FROM tag WHERE id_tag = $id_tag LIMIT 1";
              $tag = executeResult($sql);
              ?>
              <?php foreach ($tag as $tg) { //Bắt đầu vòng lặp tag
              ?>
                <div class="main-tag">
                  <a href="tag.php?keyword=<?php echo '' . $tg['url'] . '' ?>" class="tag">
                    <span><?php echo '' . $tg['name'] . '' ?></span>
                  </a>
                </div>
              <?php } //Kết thúc vòng lặp tag
              ?>
            <?php } //Kết thúc vòng lặp bài viết tag
            ?>
            <h6>
              <?php echo '' . $ps['summary'] . '' ?>
            </h6>
            <div class="time">
              <span>
                <?php echo '' . facebook_time_ago($ps['created_at']) . ''; ?>
              </span>
            </div>
          <?php } ?>
        </div>
        <div class="card-columns w-30">
          <?php

          $sql = "SELECT * FROM posts WHERE position = 2 ORDER BY created_at DESC LIMIT 1";
          $posts = executeResult($sql);

          ?>
          <?php foreach ($posts as $ps) { ?>
            <div class="rows">
              <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                <div class="card-img">
                  <img src="<?php echo '' . $ps['image_S'] . '' ?>" title="<?php echo '' . $ps['title'] . '' ?>">
                </div>
                <div class="card-title">
                  <h3>
                    <?php echo '' . $ps['title'] . '' ?>
                  </h3>
                </div>
              </a>
              <div class="info-posts">
                <h6>
                  <?php echo '' . $ps['summary'] . '' ?>
                </h6>
                <nav class="nav-users">
                  <?php
                  $users = '' . $ps['id_users'] . '';
                  $sql = "SELECT id_users,fullname, img_user FROM users WHERE id_users = '$users' LIMIT 0,1";
                  $users = executeResult($sql);
                  ?>

                  <div class="users-info">
                    <a href="users.php?u=<?php echo''.$users[0]['id_users'].''?>">
                      <img src="<?php echo '' . $users[0]['img_user'] . '' ?>" alt="author">
                      <span>
                        <?php echo '' . $users[0]['fullname'] . '' ?>
                      </span>
                    </a>
                  </div>
                  <span class="time">
                  <?php echo '' . facebook_time_ago($ps['created_at']) . ''; ?>
                  </span>
                </nav>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="banner-main-left-bottom">
        <?php

        $sql = "SELECT * FROM posts WHERE position = 3 ORDER BY created_at DESC LIMIT 3";
        $posts = executeResult($sql);

        ?>
        <?php foreach ($posts as $ps) { ?>
          <div class="card-columns">
            <div class="rows">
              <a href="posts.php?p=<?php echo '' . $ps['url'] . '' ?>">
                <div class="card-img">
                  <img src="<?php echo '' . $ps['image_S'] . '' ?>" title="<?php echo '' . $ps['title'] . '' ?>">
                </div>
                <div class="card-title">
                  <h3>
                    <?php echo '' . $ps['title'] . '' ?>
                  </h3>
                </div>
              </a>
              <div class="info-posts">
                <h6>
                  <?php echo '' . $ps['summary'] . '' ?>
                </h6>
                <?php
                $users = '' . $ps['id_users'] . '';
                $sql = "SELECT id_users, fullname, img_user FROM users WHERE id_users = $users";
                $users = executeResult($sql);
                ?>
                  <nav class="nav-users">
                  <?php foreach ($users as $us) { ?>
                    <div class="users-info">
                      <a href="users.php?u=<?php echo ''.$us['id_users'].''?>">
                        <img src="<?php echo''.$us['img_user'].''?>" alt="">
                        <span>
                        <?php echo''.$us['fullname'].''?>
                      </span>
                      </a>
                    </div>
                    <?php } ?>
                    <span class="time">
                    <?php echo '' . facebook_time_ago($ps['created_at']) . ''; ?>
                  </span>
                  </nav>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="banner-main-right">
      <div class="banner-main-right-ads sticky-index">
        <div class="card-img">
          <?php
          $sql = "SELECT `image_adv`,`url` FROM adv WHERE id_page = 1 AND id_position = 11 LIMIT 1";
          $adv = executeResult($sql);
          ?>
          <a href="<?php echo '' . $adv[0]['url'] . '' ?>">
            <img src="<?php echo '' . $adv[0]['image_adv'] . '' ?>" alt="quảng cáo 300*600">
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-------End Banner ------>