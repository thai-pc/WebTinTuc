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
    }, "Vui l??ng nh???p ????ng ?????nh d???ng ??i???n tho???i" );
    
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
                required: "B???n ch??a nh???p h??? v?? t??n",
                maxlength: 'T??n kh??ng qu?? 15 k?? t???'
            },
            BirthdayDay: {
                required: "B???n ch??a nh???p ng??y sinh"
            },
            BirthdayMonth: {
                required: "B???n ch??a nh???p th??ng sinh"
            },
            BirthdayYear: {
                required: "B???n ch??a nh???p n??m sinh"
            },
            Gender: {
                required: "B???n ch??a ch???n gi???i t??nh"
            },
            address: {
                required: "B???n ch??a nh???p ?????a ch???"
            },
            Phone: {
                required: "B???n ch??a nh???p s??? ??i???n tho???i",
                minlength: "B???n ch??a nh???p ??t nh???t 10 k?? t???",
                nowhitespace : "Vui l??ng kh??ng nh???p kho???ng tr???ng"
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
					if (response.status == 0) { //C???p nh???t th???t b???i
						alert(response.message);
					} else { //C???p nh???t th??nh c??ng
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
                required: "B???n ch??a nh???p ti??u ????? b??i vi???t",
                maxlength : "Vui l??ng nh???p d?????i 130 k?? t???"
            },
            Content: {
                required: "B???n ch??a nh???p n???i dung b??i vi???t"
            },
            fileToUpload: {
                required: "B???n ch??a nh???p ???nh b??a b??i vi???t"
            },
            Description: {
                required: "B???n ch??a nh???p m?? t??? ng???n",
                maxlength : "Vui l??ng nh???p d?????i 300 k?? t???"
            },
            checkbox: {
                required: "B???n ch??a ?????ng ?? ??i???u kho???n"
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
					if (response.status == 0) { //C???p nh???t th???t b???i
						alert(response.message);
					} else { //C???p nh???t th??nh c??ng
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
