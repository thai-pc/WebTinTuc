$(document).ready(function () {
  // kiểm tra form đăng nhập
  $("#form-login").validate({
    rules: {
      email_login: {
        required: true,
        email: true,
      },
      password_login: {
        required: true,
        minlength: 8,
      },
    },
    messages: {
      email_login: {
        required: "Vui lòng nhập tên email",
        email: "Vui lòng nhập đúng định dạng email",
      },
      password_login: {
        required: "Vui lòng nhập mật khẩu",
        minlength: "Vui lòng nhập ít nhất 8 ký tự",
      },
    },
    submitHandler: function (form) {
      $.ajax({
        type: "POST",
        url: "modules/login.php",
        data: $(form).serializeArray(),
        success: function (response) {
          response = JSON.parse(response);
          if (response.email == 0) {
            $(".notify-email").html(response.message);
          }
          if (response.password == 0) {
            $(".notify-password").html(response.message);
          }
          if (response.status == 1) {
            window.location.href = "profile.php?users=" + response.message;
          }
        },
      });
    },
  });

  // kiểm tra form đăng ký
  $("#form-register").validate({
    rules: {
      email: {
        required: true,
        email: true,
        remote: "modules/check-email.php",
      },
      password: {
        required: true,
        minlength: 8,
      },
      password_confirm: {
        required: true,
        equalTo: "#password_register",
      },
    },
    messages: {
      email: {
        required: "Bạn chưa nhập tên email",
        email: "Bạn chưa nhập đúng định dạng email",
        remote: $.validator.format("{0} đã được đăng ký"),
      },
      password: {
        required: "Bạn chưa nhập mật khẩu",
        minlength: "Bạn chưa nhập ít nhất 8 ký tự",
      },
      password_confirm: {
        required: "Bạn chưa nhập lại mật khẩu",
        minlength: "Vui lòng nhập ít nhất 8 ký tự",
        equalTo: "Mật khẩu không khớp",
      },
    },
    submitHandler: function (form) {
      $.ajax({
        type: "POST",
        url: "modules/register.php",
        data: $(form).serializeArray(),
        success: function (response) {
          response = JSON.parse(response);
          if (response.status == 0) {
            //Đăng nhập lỗi
            alert(response.message);
          } else {
            //Đăng ký thành công
            $("#notify-register").html(response.message);
          }
        },
      });
    },
  });

  //Kiểm tra form báo lỗi bài viết
  $(document).on("click", ".btn-send", function () {
    $text = $(".text-error").val();
    $id_posts = $(this).data("posts");
    $id_users = $(this).data("users");
    if ($text.replace(/\s/g, "").length <= 0) {
      $(".error-container .error").text(
        "Vui lòng không để rỗng hoặc khoảng trắng"
      );
    } else if ($text.length >= 300) {
      $(".error-container .error").text("Giới hạn không quá 300 ký tự");
    } else {
      $.ajax({
        type: "POST",
        url: "modules/result.php",
        data: {
          msg: $text,
          id_posts: $id_posts,
          id_users: $id_users,
          error: true,
        },
        success: function (data) {
          $(".error-container .send").text(data);
        },
      });
    }
  });
//Phần search thường
$('#search-text').keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if (keycode == '13') {
    $text = $('#search-text').val();
    if($text.replace(/\s/g, "").length <= 0){

    }else{
      $text = $text.replace(/\s/g,'+');
      window.location.href = 'search.php?search_query=' + $text;
    }
  }
  });

  $(document).on("click", "#btn-search", function () {
    $text = $('#search-text').val();
    
    if($text.replace(/\s/g, "").length <= 0){

    }else{
      $text = $text.replace(/\s/g,'+');
      window.location.href = 'search.php?search_query=' + $text;
    }
  });

  //Kết thúc search thường

  //Lưu bài viết yêu thích
  $(document).on("click", ".btn-save", function () {
    $id_posts = $(this).data("posts");
    $id_users = $(this).data("users");
    $this = $(this);
    $.ajax({
      type: "POST",
      url: "modules/result.php",
      data: {
        id_posts: $id_posts,
        id_users: $id_users,
        save: true,
      },
      beforeSend: function () {
        $this.css("background", "#3bdb1b");
        $(".btn-save i").removeClass("fa-save");
        $(".btn-save i").addClass("fa-check-circle");
      },
      success: function (data) {
        if (data == "ok") {
          $this.attr("title", "Đã lưu");
        } else if (data == "isset") {
          $this.attr("title", "Bài viết này đã lưu");
        }
      },
    });
  });

  //Xóa bài viết yêu thích
  $(document).on("click", ".btn-delete", function () {
    $id_posts = $(this).data("posts");
    $id_users = $(this).data("users");
    $this = $(this);
    $.ajax({
      type: "POST",
      url: "modules/result.php",
      data: {
        id_posts: $id_posts,
        id_users: $id_users,
        delete: true,
      },
      success: function (data) {
        if (data === "ok") {
          
        } else if (data == "error") {
          
        }
      },complete : function(){
        location.reload();
      }
    });
  });

//Bài viết người dùng chia sẻ
load_data(1);
  function load_data(page) {
    $this = $('#users-posts');
    $id_users = $this.data('users');
    $fullname = $this.data('name');
    $img = $this.data('img');

    $.ajax({
        type: "POST",
        url: 'modules/result.php',
        data: {
            page: page,
            id_users: $id_users,
            fullname : $fullname,
            img : $img
        },
        success: function(data) {
            $('#users-posts').html(data);
        }
    })
}

$(document).on('click', '.page-link', function(){
  var page = $(this).data('page_number');
  load_data(page);
});
//Load search 
load_search(1);
  function load_search(page) {
    $this = $('#search-posts');
    $search = $this.data('search');
    $.ajax({
        type: "POST",
        url: 'modules/result.php',
        data: {
            page: page,
            search : $search
        },
        success: function(data) {
            $this.html(data);
        }
    })
}

$(document).on('click', '.page-link', function(){
  var page = $(this).data('page_number');
  load_search(page);
});

});
