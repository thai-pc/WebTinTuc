<footer class="footer">
    <div class="footer-container">
        <div class="footer-intro">
            <div class="footer-logo">
                <a href="index.php">
                    <?php

                    $sql = "SELECT * FROM `info` WHERE id_info = 'footer'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);

                    ?>
                    <img src="<?php echo '' . $row['logo_info'] . '' ?>" alt="logo-footer">
                </a>
            </div>
            <div class="footer-icons">
                <span>
                    <i class="fab fa-facebook"></i>
                </span>
                <span>
                    <i class="fab fa-youtube"></i>
                </span>
            </div>
        </div>
        <nav class="footer-intro-list">
            <div class="columns-list">
                <a href="">
                    <h5>Công Nghệ</h5>
                </a>
                <a href="">
                    <h6>Tin Công Nghệ</h6>
                </a>
            </div>
            <div class="columns-list">
                <a href="">
                    <h5>Hệ Điều Hành</h5>
                </a>
                <a href="">
                    <h6>Windows</h6>
                </a>
                <a href="">
                    <h6>Mas OS</h6>
                </a>
                <a href="">
                    <h6>Android</h6>
                </a>
                <a href="">
                    <h6>Ios</h6>
                </a>
            </div>
            <div class="columns-list">
                <a href="">
                    <h5>Phần Mềm</h5>
                </a>
                <a href="">
                    <h6>Cài Đăt</h6>
                </a>
                <a href="">
                    <h6>Sử Dụng</h6>
                </a>
            </div>
            <div class="columns-list">
                <a href="">
                    <h5>Thủ Thuật</h5>
                </a>
                <a href="">
                    <h6>Windows</h6>
                </a>
                <a href="">
                    <h6>Mas OS</h6>
                </a>
                <a href="">
                    <h6>Android</h6>
                </a>
                <a href="">
                    <h6>Ios</h6>
                </a>
            </div>
            <div class="columns-list">
                <a href="">
                    <h5>Giải Trí</h5>
                </a>
                <a href="">
                    <h6>Hotgirl</h6>
                </a>
                <a href="">
                    <h6>Người Nổi Tiếng</h6>
                </a>
            </div>
        </nav>
        <div class="line"></div>
        <div class="footer-address">
            <div class="columns-list">
                <h3><?php echo '' . $row['column1_info'] . '' ?></h3>
                <h4><?php echo '' . $row['column2_info'] . '' ?></h4>
            </div>
            <div class="columns-list">
                <h3><?php echo '' . $row['column3_info'] . '' ?></h3>
                <h4><?php echo '' . $row['column4_info'] . '' ?></h4>
            </div>
            <div class="columns-list">
                <h3><?php echo '' . $row['column5_info'] . '' ?></h3>
                <h4><?php echo '' . $row['column6_info'] . '' ?></h4>
                <h4 class="phone"><?php echo '' . $row['column7_info'] . '' ?></h4>
            </div>
        </div>
        <div class="line"></div>
        <div class="footer-copyright">
            <h5><?php echo '' . $row['copyright_info'] . '';
                mysqli_close($conn) ?></h5>
        </div>
    </div>
</footer>
<nav id="dialogbox" style="display: none;">
    <div class="container">
        <iframe id="frameID" src="views/changeavatar.php" frameboder="0" scrolling="no"></iframe>
    </div>
</nav>
<div class="modal-error">
    <div class="error-container">
        <textarea class="text-error" placeholder="Vui lòng viết mô tả lỗi..." name="text-error" cols="30" rows="10"></textarea>
        <label for="" class="send"></label>
        <label for="" class="error"></label>
        <button class="btn btn-close">
            Đóng lại
        </button>
        <button class="btn btn-send" data-posts="<?php echo '' . $id_posts . '' ?>" data-users="<?php echo '' . $_SESSION['id'] . '' ?>">
            Gửi đi
        </button>
    </div>
</div>
<div class="overlay"></div>
<script type="text/javascript">
    /* Sự kiện cố định menu */
    function onScroll() {
        window.addEventListener("scroll", callbackFunc);

        function callbackFunc() {
            let h = $(".category-container");
            var y = window.pageYOffset; //Tính chiều dài của trình duyệt
            if (y > 100) {
                h.addClass('show');
            } else {
                h.removeClass('show');
            }
        }
    }

    window.onload = function() {
        onScroll();
    };
    /*------------ popup image----------*/
    document.querySelectorAll(".posts .post-contents img").forEach((image) => {
        image.onclick = () => {
            document.querySelector(".popup-image").style.display = "block";
            document.querySelector(".popup-image img").src =
                image.getAttribute("src");
        };
        document.querySelector(".popup-image i").onclick = () => {
            document.querySelector(".popup-image").style.display = "none";
        };
    });
    /*------------ popup image----------*/

    /*------------- popup error --------------------*/
    let send = document.querySelector(".modal-send");
    send.onclick = () => {
        document.querySelector(".modal-error").classList.add("active");
    };
    let close = document.querySelector(".error-container .btn-close");
    close.onclick = () => {
        document.querySelector(".modal-error").classList.remove("active");
    };

    /*------------- popup error --------------------*/
</script>
<!------ Jquery Validation -------->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
<!------ End Jquery Validation -------->
<!-- Scroll -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- End Scroll -->
<script type="text/javascript" src="js/profile.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/checkinput.js"></script>
<script type="text/javascript" src="js/loadmore.js"></script>
<script type="text/javascript" src="js/comments.js"></script>
<script src="https://cdn.tiny.cloud/1/rr96r87s7jfhlt1nbi280vkmm4l2uax02l8q99cxxr4gtnd8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
     tinymce.init({
      selector: '#Content',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
</script>
</body>

</html>