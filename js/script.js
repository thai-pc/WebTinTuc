$(document).ready(function () {
  /* Sự kiện modal login */
  $(".btn-register").on("click", function () {
    changeModal("register");
  });
  $(".btn-login").on("click", function () {
    changeModal("login");
  });

  function changeModal(modal) {
    let btn = $(".tabs-button .btn-lr");
    let seclect = modal === "register" ? btn.next() : btn.prev();
    let current = $(".tabs-contents .active-lr");
    let click = modal === "register" ? current.next() : current.prev();

    if (seclect.length) {
      btn.removeClass("btn-lr");
      seclect.addClass("btn-lr");
    }
    if (click.length) {
      current.removeClass("active-lr");
      click.addClass("active-lr");
    }
  }
  /* Kết thúc sự kiện modal login */

  // /*---------   Sự kiện chuyển tab qua lại nav ---------------*/

  /*--------Tạo nút lên đầu trang (back to top) Jquery -----------*/

  $(window).scroll(function () {
    var xyz = $(window).scrollTop();
    if (xyz > 500) {
      $("#btn-top").show();
    } else {
      $("#btn-top").hide();
    }
  });

  $("#btn-top").click(function () {
    $("body,html").animate({
      scrollTop: 0,
    });
  });
  /*--------End Tạo nút lên đầu trang (back to top) Jquery -----------*/

  /*------- Sự kiện Next Prev titles ------*/

  $(".btn-next").on("click", function () {
    changeTitles("next");
  });

  $(".btn-prev").on("click", function () {
    changeTitles("prev");
  });
  function changeTitles(type) {
    let btn = $(".tabs-button .active-btn");
    let seclect = type === "next" ? btn.next() : btn.prev();
    let current = $(".container .active");
    let click = type === "next" ? current.next() : current.prev();

    if (seclect.length) {
      btn.removeClass("active-btn");
      seclect.addClass("active-btn");
    }
    if (click.length) {
      current.removeClass("active");
      click.addClass("active");
    }
  }

  /*------- End Sự kiện Next Prev titles ------*/

  /*------- Sự kiện click text phần giải trí ------*/

  $(".tab-text-r").on("click", function () {
    changeTabtext("text-r");
  });
  $(".tab-text-l").on("click", function () {
    changeTabtext("text-l");
  });

  function changeTabtext(text) {
    let btn = $(".tabs .active");
    let seclect = text === "text-r" ? btn.next() : btn.prev();
    let current = $(".container .active");
    let click = text === "text-r" ? current.next() : current.prev();

    if (seclect.length) {
      btn.removeClass("active");
      seclect.addClass("active");
    }
    if (click.length) {
      current.removeClass("active");
      click.addClass("active");
    }
  }

  /*------- End sự kiện click text phần giải trí ------*/
  $(document).on("click", ".search-img", function () {
    if ($("header #overlay").css("display") == "none") {
      $("body").addClass("showsearch");
    }
    if (
      $("body").hasClass("showsearch") &&
      $("header #overlay").css("display") == "block"
    ) {
      $("header #overlay").click(function () {
        $("body").removeClass("showsearch");
      });
    }
  });

  $(document).on("click", "a.notify", function (e) {
    if ($(".hover-profile .navbar-right").css("display") == "none") {
      $("body").addClass("showuser");
    }
    if ($("body").hasClass("showuser")) {
      $("body").click(function () {
        $(this).removeClass("showuser");
      });
    }
  });

  $(document).on("click", ".o-c-btn", function (e) {
    if ($("#list").css("display") == "none") {
      $("body").addClass("show-list");
      $(".o-c-btn i").addClass("fa-times");
    } else {
      $("body").removeClass("show-list");
      $(".o-c-btn i").removeClass("fa-times");
    }
  });

  $(document).on("click", ".login-click", function (e) {
    if ($(".modal").css("display") == "none") {
      $("#modal-login").addClass("show-login");
      $(".login-click a").css("color", "#ff4500");
    }
    if (
      $(".modal-background").click(function () {
        $("#modal-login").removeClass("show-login");
        $(".login-click a").css("color", "#2c3642");
      })
    );
    if (
      $(".btn-close").click(function () {
        $("#modal-login").removeClass("show-login");
        $(".login-click a").css("color", "#2c3642");
      })
    );
  });

  //Phần live seach box

  $("#search-text").keyup(function () {
    $text = $(this).val();
    $result = $("#result-search");

    if ($text != "") {
      $.ajax({
        type: "POST",
        url: "modules/result.php",
        data: {
          text: $text,
        },
        success: function (data) {
          $result.html(data);
          $result.css("display", "block");
        },
      });
    } else {
      $result.css("display", "none");
    }
  });

  //Phần live seach box

  //Phần xử lý share bài viết
  $(".share").click(function (e) {
    e.preventDefault();
    window.open(
      $(this).attr("href"),
      "fbShareWindow",
      "height=450, width=550, top=" +
        ($(window).height() / 2 - 275) +
        ", left=" +
        ($(window).width() / 2 - 225) +
        ", toolbar=0, location=0, menubar=0,         directories=0, scrollbars=0"
    );
    return false;
  });
  //phẩn xử lý share bài viết

  //Sticky siderbar

  if($('.sticky').length){
    const el = $('.sticky');
    const stickytop = $('.sticky').offset().top;//Lấy tọa độ của sticky
    const stickyHeight = $('.sticky').height();//Lấy độ rộng của sticky

    $(window).scroll(function(){
      let limit = $('.footer').offset().top - stickyHeight - 20;
      let windowTop = $(window).scrollTop();
      if(stickytop < windowTop){
        el.css({position : 'fixed', top : 55});
      }else{
        el.css('position','static');
      }
      if(limit < windowTop){
        let diff = limit - windowTop;
        el.css({top : diff});
      }
    })
  }

  if($('.sticky-index').length){
    const el = $('.sticky-index');
    const stickytop = $('.sticky-index').offset().top;//Lấy tọa độ của sticky
    const stickyHeight = $('.sticky-index').height();//Lấy độ rộng của sticky

    $(window).scroll(function(){
      let limit = $('.sticky-stopper').offset().top - stickyHeight;
      let windowTop = $(window).scrollTop();
      if(stickytop < windowTop){
        el.css({position : 'fixed', top : 0});
      }else{
        el.css('position','static');
      }
      if(limit < windowTop){
        let diff = limit - windowTop;
        el.css({top : diff});
      }
    })
  }
  //Sticky siderbar
});
