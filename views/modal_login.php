<div class="modal modal-login" id="modal-login">
    <div class="modal-background">
    </div>
    <div class="modal-content">
        <span class="top-caption">
            Dù ai đi ngược về xuôi,
            <br>
            nhớ vào blogtechs đọc tin đây nè
        </span>
        <div class="btn-close">
            <i class="fas fa-times"></i>
        </div>
        <article>
            <div class="tabs-button">
                <button class="btn-login btn-lr">
                    Đăng nhập
                </button>
                <button class="btn-register">
                    Đăng ký
                </button>
            </div>
            <div class="tabs-contents">
                <div class="login-section active-lr" id="login-section">
                    <div class="form-login">
                        <form id="form-login" method="POST" action="login.php">
                            <div class="form-group">
                                <input type="email" placeholder="Email" name="email_login" id="email" autocomplete="off">
                                <label class="notify-email" style="color: red;"></label>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Mật khẩu" name="password_login" id="password">
                                <label class="notify-password" style="color: red;"></label>
                            </div>
                            <button type="submit" id="bt_login" name="btn-login">Đăng nhập</button>
                            <a href="" class="forget-password-link">Quên mật khẩu</a>
                        </form>
                    </div>
                    <div class="social-login">
                        <span>Hoặc đăng nhập bằng:</span>
                        <a href="" class="google">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="" class="facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
                <div class="register-section" id="register-section">
                    <div class="form-login">
                        <form id="form-register">
                            <div class="form-group">
                                <input type="email" placeholder="Email" name="email" id="email-login" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Mật khẩu" name="password" id="password_register">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Nhập lại mật khẩu" name="password_confirm" id="password_confirm">
                            </div>
                            <button type="submit" class="btn_register" name="btn_register">Đăng ký</button>
                            <p id="notify-register" style="color: #3bdb1b;"></p>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>