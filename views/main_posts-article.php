
<?php 
if (isset($_SESSION['url']) && isset($_SESSION['email'])) { ?>
        <main class="default-page-width">
            <section class="hot-list-container">
                <div class="hot-list-left" id="posts-article">
                    <h1>
                        Bài viết
                    </h1>
                    <div class="toolbar">
                        <a class="btn btn-primary" href="post-article.php?users=<?php echo '' . $_SESSION['url'] . '' ?>">Viết bài mới</a>
                    </div>
                    <div class="article" id="article">
                        <div class="textinfo">
                            Bạn chưa đăng bài viết nào cả. <br>
                            Bắt đầu chia sẻ niềm đam mê của bạn về học tập, công nghệ, khoa học và đời sống...<br>
                            Nhấp vào nút đăng bài mới để bắt đầu. <br>
                            Hãy chắc chắn rằng bạn đã chuẩn bị hình ảnh, nội dung cho bài viết hoàn chỉnh.<br>
                            Tất nhiên, xin vui lòng không đăng nội dung bất hợp pháp hoặc vi phạm bản quyền.
                        </div>
                    </div>
                </div>
            </section>
        </main>
    <?php } else {
    require_once('error_404.php');
} ?>