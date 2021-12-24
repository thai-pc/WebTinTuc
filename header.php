<?php
ob_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
}
require_once('includes/config.php');
require_once('includes/dbhelper.php');
require_once('modules/function.php');
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>blogtechs</title>
    <link rel="icon" type="image/jpg" href="uploads/images/Logo.png">
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/profile.css" />
    <link rel="stylesheet" type="text/css" href="css/reponsive.css" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" rel="stylesheet">

</head>

<body class="theme-index">
    <header>
        <div class="overlay" id="overlay"></div>
        <div class="navigation-container">
            <div class="top-head">
                <div class="web-name">
                    <a href="index.php">
                        <?php
                        $sql = "SELECT id_info, logo_info FROM `info` WHERE id_info = 'footer'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result);
                        ?>
                        <img src="<?php echo '' . $row['logo_info'] . '' ?>" alt="logo-header">
                    </a>
                </div>
            </div>
            <div class="search-box">
                <input type="text" name="search-text" 
                id="search-text" placeholder="Tìm kiếm" autocomplete="off" />
                <button type="submit" id="btn-search">
                    <i class="far fa-search"></i>
                </button>
                <div class="result-search" id="result-search">
                </div>
            </div>
            <div class="social-icons">
                <?php
                $sql = "SELECT * FROM `menu` WHERE position >= 2 AND position <= 5";
                $menu = executeResult($sql);
                ?>
                <?php foreach ($menu as $mn) { // Bắt đầu vòng lặp foreach
                ?>
                    <?php if ($mn['menu_name'] == 'đăng nhập') { //Kiểm tra vị trí đăng nhập
                    ?>
                        <?php if (isset($_SESSION['fullname']) && isset($_SESSION['email']) && isset($_SESSION['img_user'])) { ?>
                            <div class="social-items hover-profile">
                                <a href="profile.php?users=<?php echo '' . $_SESSION['url'] . ''; ?>" class="notify">
                                    <img src="<?php echo '' . $_SESSION['img_user'] . ''; ?>">
                                    <span><?php echo '' . $_SESSION['fullname'] . ''; ?></span>
                                </a>
                                <nav class="navbar-right fix-color r-50">
                                    <ul>
                                        <li><a href="profile.php?users=<?php echo '' . $_SESSION['url'] . ''; ?>"><i class="fas fa-portrait"></i><?php echo '' . $_SESSION['fullname'] . ''; ?></a></li>
                                        <li><a href="posts-article.php?users=<?php echo '' . $_SESSION['url'] . ''; ?>"><i class="fas fa-edit"></i>Đăng bài viết</a></li>
                                        <li><a href="posts-like.php?f=<?php echo''.$_SESSION['url'].''?>"><i class="fas fa-bookmark"></i>Bài viết đã lưu</a></li>
                                        <li><a href="modules/logout.php"><i class="fas fa-power-off"></i>Đăng xuất</a></li>
                                    </ul>
                                </nav>
                            </div>
                        <?php } else { //Không tồn tại biến session
                        ?>
                            <div class="social-items">
                                <a class="login-click">
                                    <img src="<?php echo '' . $mn['url_image_2'] . '' ?>">
                                    <span><?php echo '' . $mn['menu_name'] . '' ?></span>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } else { //Không phải vị trí đăng nhập
                    ?>
                        <div class="social-items">
                            <a href="<?php echo '' . $mn['url'] . '' ?>" class="page-scroll">
                                <img src="<?php echo '' . $mn['url_image_2'] . '' ?>">
                                <span><?php echo '' . $mn['menu_name'] . '' ?></span>
                            </a>
                        </div>
                    <?php } ?>
                <?php } // Kết thúc forech 
                ?>
            </div>
        </div>
    </header>
    <?php require_once('views/modal_login.php') ?>
    </div>