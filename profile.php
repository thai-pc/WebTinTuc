<?php
ob_start();
session_start();
require_once('includes/config.php');
require_once('includes/dbhelper.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <title>Hồ sơ</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/reponsive.css" />
    <link rel="stylesheet" type="text/css" href="css/profile.css" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- font awesome -->
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" rel="stylesheet">
</head>
<?php
if (isset($_SESSION['fullname']) || isset($_SESSION['email'])) {
    //Đã kiểm tra có biến đăng nhập
    $users = isset($_GET['users']) ? mysqli_real_escape_string($conn, $_GET['users']) : '';
    $sql = "SELECT * FROM `users` WHERE token = '$users'";
    $users = executeResult($sql);

    if (!empty($users)) {
        //Kiểm tra mảng đã khác null,0 và có biến đăng nhập
        foreach ($users as $us) {
?>

            <body class="theme-profile">
                <header class="hd-profile">
                    <div class="container">
                        <div class="hd-main">
                            <div class="hd-main-left">
                                <div class="hd-main-logo">
                                    <div class="logo-img">
                                        <a href="index.php">
                                            <img src="uploads/images/Logo.png" alt="logo">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="toggle menu">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="hd-main-right">
                                <div class="info-profile hover-profile">
                                    <div class="social-items">
                                        <a class="user-info notify">
                                            <img src="<?php echo '' . $us['img_user'] . '' ?>" alt="img-profile">
                                        </a>
                                        <nav class="navbar-right">
                                            <ul>
                                                <li><a href="profile.php?users=<?php echo '' . $_SESSION['url'] . ''; ?>"><i class="fas fa-portrait"></i><?php echo '' . $us['fullname'] . '' ?></a></li>
                                                <li><a href="posts-article.php?users=<?php echo '' . $_SESSION['url'] . ''; ?>"><i class="fas fa-edit"></i>Đăng bài viết</a></li>
                                                <li><a href="posts-like.php?f=<?php echo '' . $_SESSION['url'] . '' ?>"><i class="fas fa-bookmark"></i>Bài viết đã lưu</a></li>
                                                <li><a href="modules/logout.php"><i class="fas fa-power-off"></i>Đăng xuất</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <nav class="sidebar-nav">
                    <ul>
                        <li class="home-sidebar"><a href="index.php"><i class="fas fa-home"></i>Trang chủ</a></li>
                        <li><a href="profile.php?users=<?php echo '' . $_SESSION['url'] . ''; ?>"><i class="fas fa-user-circle"></i><?php echo '' . $us['fullname'] . '' ?></a></li>
                        <li><a href="posts-article.php?users=<?php echo '' . $_SESSION['url'] . ''; ?>"><i class="fas fa-edit"></i>Đăng bài viết</a></li>
                        <li><a href="posts-like.php?f=<?php echo '' . $_SESSION['url'] . '' ?>"><i class="fas fa-bookmark"></i>Bài viết đã lưu</a></li>
                        <li><a href="modules/logout.php"><i class="fas fa-power-off"></i>Đăng xuất</a></li>
                    </ul>
                </nav>
                <?php require_once('navbar.php')?>
                <main id="profile">
                    <section class="mainprofile">
                        <div class="container">
                            <h1 class="name"><?php echo '' . $us['fullname'] . '' ?></h1>
                            <div class="message">
                                <h5>Để có trải nghiệm tốt hơn xin vui lòng cập nhật thông tài khoản:</h5>
                                <ul>
                                    <li>&#128221; Bên dưới là thông tin cần cập nhật</li>
                                </ul>
                            </div>
                            <form action="update_profile.php" id="form-profile" method="POST">
                                <input type="hidden" name="id_users" value="<?php echo '' . md5('' . $us['id_users'] . '') . '' ?>">
                                <ul class="profile clearfix">
                                    <li class="avatar">
                                        <a>
                                            <img id="avatar" src="<?php echo '' . $us['img_user'] . '' ?>" alt="avatar">
                                            <span class="editavatar edit-click">Thay đổi hình đại điện</span>
                                        </a>
                                    </li>
                                    <li>
                                        <label class="title">Họ và tên</label>
                                        <input name="fullname" class="textfiled" type="text" placeholder="Nhập họ và tên của bạn" maxlength="73" value="<?php echo '' . $us['fullname'] . '' ?>">
                                    </li>
                                    <li>
                                        <label class="title">&#128198; Ngày sinh</label>
                                        <select class="selectfield" id="BirthdayDay" name="BirthdayDay">
                                            <?php if (!empty($us['BirthdayDay'])) { ?>
                                                <option value="<?php echo '' . $us['BirthdayDay'] . '' ?>"><?php echo '' . $us['BirthdayDay'] . '' ?></option>
                                            <?php } else { ?>
                                                <option value="">Ngày</option>
                                            <?php } ?>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                        <select class="selectfield" id="BirthdayMonth" name="BirthdayMonth">
                                            <?php if (!empty($us['BirthdayMonth'])) { ?>
                                                <option value="<?php echo '' . $us['BirthdayMonth'] . '' ?>"><?php echo '' . $us['BirthdayMonth'] . '' ?></option>
                                            <?php } else { ?>
                                                <option value="">Tháng</option>
                                            <?php } ?>
                                            <option value="01">Tháng 01</option>
                                            <option value="02">Tháng 02</option>
                                            <option value="03">Tháng 03</option>
                                            <option value="04">Tháng 04</option>
                                            <option value="05">Tháng 05</option>
                                            <option value="06">Tháng 06</option>
                                            <option value="07">Tháng 07</option>
                                            <option value="08">Tháng 08</option>
                                            <option value="09">Tháng 09</option>
                                            <option value="10">Tháng 10</option>
                                            <option value="11">Tháng 11</option>
                                            <option value="12">Tháng 12</option>
                                        </select>

                                        <select class="selectfield" id="BirthdayYear" name="BirthdayYear">
                                            <?php if (!empty($us['BirthdayYear'])) { ?>
                                                <option value="<?php echo '' . $us['BirthdayYear'] . '' ?>"><?php echo '' . $us['BirthdayYear'] . '' ?></option>
                                            <?php } else { ?>
                                                <option value="">Năm</option>
                                            <?php } ?>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                            <option value="2011">2011</option>
                                            <option value="2010">2010</option>
                                            <option value="2009">2009</option>
                                            <option value="2008">2008</option>
                                            <option value="2007">2007</option>
                                            <option value="2006">2006</option>
                                            <option value="2005">2005</option>
                                            <option value="2004">2004</option>
                                            <option value="2003">2003</option>
                                            <option value="2002">2002</option>
                                            <option value="2001">2001</option>
                                            <option value="2000">2000</option>
                                            <option value="1999">1999</option>
                                            <option value="1998">1998</option>
                                            <option value="1997">1997</option>
                                            <option value="1996">1996</option>
                                            <option value="1995">1995</option>
                                            <option value="1994">1994</option>
                                            <option value="1993">1993</option>
                                            <option value="1992">1992</option>
                                            <option value="1991">1991</option>
                                            <option value="1990">1990</option>
                                            <option value="1989">1989</option>
                                            <option value="1988">1988</option>
                                            <option value="1987">1987</option>
                                            <option value="1986">1986</option>
                                            <option value="1985">1985</option>
                                            <option value="1984">1984</option>
                                            <option value="1983">1983</option>
                                            <option value="1982">1982</option>
                                            <option value="1981">1981</option>
                                            <option value="1980">1980</option>
                                            <option value="1979">1979</option>
                                            <option value="1978">1978</option>
                                            <option value="1977">1977</option>
                                            <option value="1976">1976</option>
                                            <option value="1975">1975</option>
                                            <option value="1974">1974</option>
                                            <option value="1973">1973</option>
                                            <option value="1972">1972</option>
                                            <option value="1971">1971</option>
                                            <option value="1970">1970</option>
                                            <option value="1969">1969</option>
                                            <option value="1968">1968</option>
                                            <option value="1967">1967</option>
                                            <option value="1966">1966</option>
                                            <option value="1965">1965</option>
                                            <option value="1964">1964</option>
                                            <option value="1963">1963</option>
                                            <option value="1962">1962</option>
                                            <option value="1961">1961</option>
                                            <option value="1960">1960</option>
                                            <option value="1959">1959</option>
                                            <option value="1958">1958</option>
                                            <option value="1957">1957</option>
                                            <option value="1956">1956</option>
                                            <option value="1955">1955</option>
                                            <option value="1954">1954</option>
                                            <option value="1953">1953</option>
                                            <option value="1952">1952</option>
                                            <option value="1951">1951</option>
                                            <option value="1950">1950</option>
                                            <option value="1949">1949</option>
                                            <option value="1948">1948</option>
                                            <option value="1947">1947</option>
                                            <option value="1946">1946</option>
                                            <option value="1945">1945</option>
                                            <option value="1944">1944</option>
                                            <option value="1943">1943</option>
                                            <option value="1942">1942</option>
                                            <option value="1941">1941</option>
                                            <option value="1940">1940</option>
                                            <option value="1939">1939</option>
                                            <option value="1938">1938</option>
                                            <option value="1937">1937</option>
                                            <option value="1936">1936</option>
                                            <option value="1935">1935</option>
                                            <option value="1934">1934</option>
                                            <option value="1933">1933</option>
                                            <option value="1932">1932</option>
                                            <option value="1931">1931</option>
                                            <option value="1930">1930</option>
                                            <option value="1929">1929</option>
                                            <option value="1928">1928</option>
                                            <option value="1927">1927</option>
                                            <option value="1926">1926</option>
                                            <option value="1925">1925</option>
                                            <option value="1924">1924</option>
                                            <option value="1923">1923</option>
                                            <option value="1922">1922</option>
                                            <option value="1921">1921</option>
                                        </select>
                                    </li>
                                    <li>
                                        <label class="title">Giới tính</label>
                                        <?php if ($us['Gender'] == 'Nữ') { ?>
                                            <span>
                                                <input checked="checked" class="radiofield" name="Gender" type="radio" value="Nữ">
                                                Nữ
                                            </span>
                                            <span>
                                                <input name="Gender" type="radio" value="Nam">
                                                Nam
                                            </span>
                                        <?php } elseif ($us['Gender'] == 'Nam') { ?>
                                            <span>
                                                <input name="Gender" type="radio" value="Nữ">
                                                Nữ
                                            </span>
                                            <span>
                                                <input checked="checked" class="radiofield" name="Gender" type="radio" value="Nam">
                                                Nam
                                            </span>
                                        <?php } else { ?>
                                            <span>
                                                <input class="radiofield" name="Gender" type="radio" value="Nữ">
                                                Nữ
                                            </span>
                                            <span>
                                                <input class="radiofield" checked="checked" name="Gender" type="radio" value="Nam">
                                                Nam
                                            </span>
                                        <?php } ?>
                                    </li>
                                    <li>
                                        <label class="title">Địa chỉ</label>
                                        <input class="textfiled" maxlength="257" id="address" name="address" placeholder="Nhập địa chỉ liên lạc" type="text" value="<?php echo '' . $us['address'] . '' ?>">
                                    </li>
                                </ul>
                                <div class="more">
                                    <ul class="profile">
                                        <li>
                                            <label class="title">Số điện thoại</label>
                                            <input class="textfiled" maxlength="10" id="Phone" name="Phone" placeholder="Nhập số điện thoại" type="text" value="<?php echo '' . $us['Phone'] . '' ?>">
                                        </li>
                                    </ul>
                                    <a class="moreinfo">
                                        <span>Thông tin thêm</span>
                                    </a>
                                </div>
                                <div class="function">
                                    <p style="color: #3bdb1b;" id="notify-profile"></p>
                                    <button type="submit" class="btn btn-primary btn-profile" name="btn-profile" disabled="disabled">Lưu thông tin</button>
                                </div>
                            </form>
                        </div>
                    </section>
                    <section class="accounts">
                        <div class="container">
                            <ul class="profile">
                                <li>
                                    <h3 class="title">Đăng nhập</h3>
                                </li>
                                <li>
                                    <label class="title">Email đăng nhập</label>
                                    <b class="textlabel"><?php echo '' . $us['email'] . '' ?></b>
                                    <a href="#" class="btn-verify" target="_blank">&#128231; Thay đổi email</a>
                                </li>
                                <li>
                                    <label class="title">Mật khẩu</label>
                                    <a href="#" target="_blank" class="btn-verify">🔑 Đổi mật khẩu</a>
                                </li>
                            </ul>
                        </div>
                    </section>
                </main>
        <?php
        }
    } else { //Mảng bằng 0 hoặc Null và có biến đăng nhập
        require_once('header.php');
        require_once('error_404.php');
    }
        ?>
    <?php } else { //Đã kiểm tra chưa có biến đăng nhập
    require_once('header.php');
    require_once('error_404.php');
}
require_once('footer.php');
    ?>