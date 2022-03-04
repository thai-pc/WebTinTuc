<section class="section-comments">
    <div class="comments-box">
        <div class="comments-box-with-common">
            <div class="heading-cm">
                <h3>
                    <i class="fad fa-comments"></i>
                    Bình luận
                </h3>
                ( <label>
                    0
                </label> )
            </div>
            <div class="input-cm main-ip">
                <form class="form-cm-post">
                    <article class="avatar-user ">
                        <?php if (isset($_SESSION['img_user'])) { ?>
                            <img src="<?php echo '' . $_SESSION['img_user'] . ''; ?>" alt="avatar" class="get_images">
                        <?php } else { ?>
                            <img src="uploads/img-users/user1.jpg" alt="avatar" class="get_images">
                        <?php } ?>
                        <?php if (isset($_SESSION['id']) && isset($_SESSION['group']) && isset($_SESSION['fullname'])) { ?>
                            <input type="hidden" value="<?php echo '' . $_SESSION['id'] . ''; ?>" data-group="<?php echo '' . $_SESSION['group'] . ''; ?>" data-fullname="<?php echo '' . $_SESSION['fullname'] . '' ?>" class="get_login">
                        <?php } ?>

                    </article>
                    <div class="content-user">

                        <textarea value="" name="comment_textbox" class="input comment_textbox" id="comments-ip" placeholder="Nhập bình luận ở đây"></textarea>
                        <label id="error_status" class="error_code_all"></label>
                        <label id="notify_comment" class="notify_code_all"></label>
                        <div class="button_cm" id="button_cm">
                            <button class="clear btn-clear" type="button">
                                Xóa
                            </button>
                            <?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])) { ?>
                                <button type="button" class="send add_comment_btn">
                                    Gửi
                                </button>
                            <?php } else { ?>
                                <button type="button" class="send login-click">
                                    Đăng nhập
                                </button>
                            <?php } ?>
                        </div>
                        <div class="emotion">
                            <button type="button" class="emotion-Icon btn">
                                <i class="fad fa-smile-beam"></i>
                            </button>
                            <div class="emotion-area" id="scrollbar">
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                                <button type="button" class="emoji">
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="items-comments">
                <div class="filters_comment">
                    <a class="active" href="javascript:;" rel="like">Quan tâm nhất</a>
                    <a href="javascript:;" rel="time">Mới nhất</a>
                </div>
                <ul class="list-comments">
                    <li class="main-comments">
                        <div class="box-content">
                            <div class="users-img"><img src="uploads/img-users/user1.jpg" alt="avatar"></div>
                            <div class="main-content">
                                <p class="full-name">Võ Đông Thái</p>
                                <p class="content">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                            </div>
                        </div>
                        <div class="list-info-cm">
                            <button class="btn btn-like"><i class="fas fa-thumbs-up"></i><span>17</span></button>
                            <button class="btn btn-reply">
                                Phản hồi
                            </button>
                            <span class="times-cm">7h trước</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>