$(document).ready(function(){
    $(document).on('click', '.moreinfo', function (e) {
        if ($('.more > ul').css('display') == 'none') {
            $('.more').addClass('showmore');
        } else {
            $('.more').removeClass('showmore');
        }
    });
    
    $(document).on('click', '.toggle.menu', function (e) {
        if ($('body .overlay').css('display') == 'none') {
            $('body').addClass('showmenu');
        } else {
            $('body').removeClass('showmenu');
        }
        $('.showmenu .overlay').click(function () {
            $('body').removeClass('showmenu');
        });
    });
    
    $(document).on('click', '.edit-click', function (e) {
        console.log(1);
        if ($('body .overlay').css('display') == 'none') {
            $('body').addClass('changeavatar');
        }
        $('.changeavatar #dialogbox').click(function () {
            $('body').removeClass('changeavatar');
        });
        $("#frameID").contents().find(".btn-av-close").click(function () {
            $('body').removeClass('changeavatar');
        });
    });
    
    $(document).on('click', 'a.notify', function (e) {
        if ($('.info-profile .navbar-right').css('display') == 'none') {
        $('body').addClass('showuser');
    }
    if ($('body').hasClass('showuser')) {
        $('body').click(function() {
            $(this).removeClass('showuser');
        })
    }
    });
    
    var lastScrollTop = 0;
    $(document).ready(function(){
        $(window).on('scroll', function(){
            var st = $(this).scrollTop();
            if(st == 0){
                $('body').removeClass('scrolldown');
                $('body').removeClass('scrollup');
            }else if(st > lastScrollTop){
                $('body').addClass('scrolldown');
                $('body').removeClass('scrollup');
            }else{
                $('body').addClass('scrollup');
                $('body').removeClass('scrolldown');
            }
            lastScrollTop = st;
        })
    });
    $(document).on('click', '.login-click', function(e) {
        if ($('.modal').css('display') == 'none') {
            $('#modal-login').addClass('show-login');
            $('.login-click a').css('color','#ff4500');
        }
        if($('.modal-background').click(function(){
            $('#modal-login').removeClass('show-login');
            $('.login-click a').css('color','#2c3642');
        }));
        if($('.btn-close').click(function(){
            $('#modal-login').removeClass('show-login');
            $('.login-click a').css('color','#2c3642');
        }));
    });
    
    $(document).on('keyup', '.textfiled', function(e){
        event.preventDefault();
       $('.btn-profile').prop("disabled", false);
    });
    
    for(var i = 0; i < $('.radiofield').length; i++){
        $('.radiofield')[i].click(function(){
            for (var i = 0; i < moveTab.length; i++) {
                $(('.radiofield')[i]).prop('checked',false);
            }
            $(this).prop('checked', true);
        });
        
    }
    $(document).on('change', '.radiofield', function(e){
        event.preventDefault();
       $('.btn-profile').prop("disabled", false);
    });
    
    $(document).on('change', '.selectfield', function(e){
        event.preventDefault();
       $('.btn-profile').prop("disabled", false);
    });
});

//Check form profile
$(document).ready(function(){
    $.validator.addMethod( "phoneVN", function( value, element ) {
        return this.optional( element ) || /((09|03|07|08|05)+([0-9]{8})\b)/g.test( value );
    }, "Vui lòng nhập đúng định dạng điện thoại" );
    
    $('#form-profile').validate({
        rules: {
            fullname: {
                required: true,
                maxlength : 15
            },
            BirthdayDay: {
                required: true
            },
            BirthdayMonth: {
                required: true
            },
            BirthdayYear: {
                required: true
            },
            Gender: {
                required: true
            },
            address: {
                required: true
            },
            Phone: {
                required: true,
                nowhitespace: true, 
                minlength: 10,
                phoneVN: true
            }
        },
        messages: {
            fullname: {
                required: "Bạn chưa nhập họ và tên",
                maxlength: 'Tên không quá 15 ký tự'
            },
            BirthdayDay: {
                required: "Bạn chưa nhập ngày sinh"
            },
            BirthdayMonth: {
                required: "Bạn chưa nhập tháng sinh"
            },
            BirthdayYear: {
                required: "Bạn chưa nhập năm sinh"
            },
            Gender: {
                required: "Bạn chưa chọn giới tính"
            },
            address: {
                required: "Bạn chưa nhập địa chỉ"
            },
            Phone: {
                required: "Bạn chưa nhập số điện thoại",
                minlength: "Bạn chưa nhập ít nhất 10 ký tự",
                nowhitespace : "Vui lòng không nhập khoảng trắng"
            }
        },
        submitHandler: function (form) {
            //$(form).ajaxSubmit();
            $.ajax({
				type: "POST",
				url: 'modules/update_profile.php',
				data: $(form).serializeArray(),
				success: function (response) {
					response = JSON.parse(response);
					if (response.status == 0) { //Cập nhật thất bại
						alert(response.message);
					} else { //Cập nhật thành công
						$('#notify-profile').html(response.message);
                        setTimeout(function(){
                            window.location.reload();
                        },1000);
					}
				}
			});
        }
    });
});
//Check form posts
$(document).ready(function(){
    $('#form-posts').validate({
        rules: {
            title: {
                required: true,
                maxlength: 130
            },
            Content: {
                required: true
            },
            fileToUpload: {
                required: true
            },
            Description: {
                required: true,
                maxlength : 300
            },
            checkbox: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Bạn chưa nhập tiêu đề bài viết",
                maxlength : "Vui lòng nhập dưới 130 ký tự"
            },
            Content: {
                required: "Bạn chưa nhập nội dung bài viết"
            },
            fileToUpload: {
                required: "Bạn chưa nhập ảnh bìa bài viết"
            },
            Description: {
                required: "Bạn chưa nhập mô tả ngắn",
                maxlength : "Vui lòng nhập dưới 300 ký tự"
            },
            checkbox: {
                required: "Bạn chưa đồng ý điều khoản"
            }
        },
        submitHandler: function (form) {
            //$(form).ajaxSubmit();
            $.ajax({
				type: "POST",
				url: 'modules/update_profile.php',
				data: $(form).serializeArray(),
				success: function (response) {
					response = JSON.parse(response);
					if (response.status == 0) { //Cập nhật thất bại
						alert(response.message);
					} else { //Cập nhật thành công
						$('#notify-profile').html(response.message);
                        setTimeout(function(){
                            window.location.reload();
                        },1000);
					}
				}
			});
        }
    });
});
