$(document).ready(function () {
  var load =
    '<div class="loader loader--style3" title="2">\
                    <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"\
                    width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">\
                        <path fill="#000" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">\
                            <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/>\
                        </path>\
                    </svg>\
                </div>';
                
  $(document).on("click", ".btn-hot", function () {
    var row = Number($("#load_data_hot .row").data("row"));
    var allcount = Number($("#load_data_hot .allcount").data("allcount"));
    row = row + 10;
    if (row <= allcount) {
      $("#load_data_hot .row").data("row", row);
      $.ajax({
        type: "POST",
        url: "modules/load_more_data.php",
        data: {
          row: row,
          hot: true,
        },
        beforeSend: function () {
          $(".btn-hot").remove();
          $("#load_data_hot").append(load);
          setTimeout(function () {
            $("#load_data_hot .loader").remove();
          }, 1000);
        },
        success: function (response) {
          setTimeout(function () {
            $("#load_data_hot .posts:last")
              .after(response)
              .show()
              .fadeIn("slow");
            var rowno = row + 10;
            if (rowno > allcount) {
              $(".btn-hot").text('Ẩn Đi');
            } else {
              $(".btn-hot").text('Xem Thêm');
            }
          }, 1000);
        },
      });
    } else {
      $(".btn-hot").hide();
      $("#load_data_hot").append(load);
      setTimeout(function () {
        $("#load_data_hot .loader").remove();
      }, 500);
      setTimeout(function () {
        $("#load_data_hot .posts:nth-child(5)")
          .nextAll("#load_data_hot .posts")
          .remove()
          .fadeIn("slow");
        $("#load_data_hot .row").data("row", "0");
        $(".btn-hot").show().text('Xem Thêm');
        $scrollTo = $("#load_data_hot .posts:last-of-type");
        if ($scrollTo.length) {
          $("html, body").animate({
            scrollTop: $scrollTo.offset().top,
          });
        }
      }, 500);
    }
  });

  //Xem thêm phần tin mới nhất
  $(document).on("click", ".btn-news", function () {
    var row = Number($("#load_data_news .row").data("row"));
    var allcount = Number($("#load_data_news .allcount").data("allcount"));
    row = row + 9;
    if (row <= allcount) {
      $("#load_data_news .row").data("row", row);
      $.ajax({
        type: "POST",
        url: "modules/load_more_data.php",
        data: {
          row: row,
          news: true,
        },
        beforeSend: function () {
          $(".btn-news").remove();
          $("#load_data_news").append(load);
          setTimeout(function () {
            $("#load_data_news .loader").remove();
          }, 1000);
        },
        success: function (response) {
          setTimeout(function () {
            $("#load_data_news .posts:last")
              .after(response)
              .show()
              .fadeIn("slow");
            var rowno = row + 9;
            if (rowno > allcount) {
              $(".btn-news").text('Ẩn Đi');
            } else {
              $(".btn-news").text('Xem Thêm');
            }
          }, 1000);
        },
      });
    } else {
      $(".btn-news").hide();
      $("#load_data_news").append(load);
      setTimeout(function () {
        $("#load_data_news .loader").remove();
      }, 500);
      setTimeout(function () {
        $("#load_data_news .posts:nth-child(5)")
          .nextAll("#load_data_news .posts")
          .remove()
          .fadeIn("slow");
        $("#load_data_news .row").data("row", "0");
        $(".btn-news").show().text('Xem Thêm');
        $scrollTo = $("#load_data_news .posts:last-of-type");
        if ($scrollTo.length) {
          $("html, body").animate({
            scrollTop: $scrollTo.offset().top,
          });
        }
      }, 500);
    }
  });
  //Xem thêm phần tin giải trí
  $(document).on("click", ".btn-girl", function () {
    var row = Number($("#load_data_girl .row").data("row"));
    var allcount = Number($("#load_data_girl .allcount").data("allcount"));
    row = row + 9;
    if (row <= allcount) {
      $("#load_data_girl .row").data("row", row);
      $.ajax({
        type: "POST",
        url: "modules/load_more_data.php",
        data: {
          row: row,
          girl: true,
        },
        beforeSend: function () {
          $(".btn-girl").remove();
          $("#load_data_girl").append(load);
          setTimeout(function () {
            $("#load_data_girl .loader").remove();
          }, 1000);
        },
        success: function (response) {
          setTimeout(function () {
            $("#load_data_girl .posts:last")
              .after(response)
              .show()
              .fadeIn("slow");
            var rowno = row + 9;
            if (rowno > allcount) {
              $(".btn-girl").text('Ẩn Đi');
            } else {
              $(".btn-girl").text('Xem Thêm');
            }
          }, 500);
        },
      });
    } else {
      $(".btn-girl").hide();
      $("#load_data_girl").append(load);
      setTimeout(function () {
        $("#load_data_girl .loader").remove();
      }, 1000);
      setTimeout(function () {
        $("#load_data_girl .posts:nth-child(5)")
          .nextAll("#load_data_girl .posts")
          .remove()
          .fadeIn("slow");
        $("#load_data_girl .row").data("row", "0");
        $(".btn-girl").show().text('Xem Thêm');
        $scrollTo = $("#load_data_girl .posts:last-of-type");
        if ($scrollTo.length) {
          $("html, body").animate({
            scrollTop: $scrollTo.offset().top,
          });
        }
      }, 500);
    }
  });

  //Xem thêm trang thể loại con
  $(document).on("click", ".btn-child", function () {
    var row = Number($("#load_data_list .row").data("row"));
    var allcount = Number($("#load_data_list .allcount").data("allcount"));
    let category_child = Number($("#load_data_list .allcount").data("category-child"));
    let parent = $("#load_data_list .row").data("parent");
    let p1 = Number($("#load_data_list .allcount").data("posts1"));
    let p2 = Number($("#load_data_list .allcount").data("posts2"));
    let p3 = Number($("#load_data_list .allcount").data("posts3"));
    let p4 = Number($("#load_data_list .allcount").data("posts4"));
    let p5 = Number($("#load_data_list .allcount").data("posts5"));
    let p6 = Number($("#load_data_list .allcount").data("posts6"));
    let p7 = Number($("#load_data_list .allcount").data("posts7"));
    row = row + 7;
    if (row <= allcount) {
      $("#load_data_list .row").data("row", row);
      $.ajax({
        type: "POST",
        url: "modules/load_more_data.php",
        data: {
          row: row,
          category_child : category_child,
          parent : parent,
          p1 : p1,
          p2 : p2,
          p3 : p3,
          p4 : p4,
          p5 : p5,
          p6 : p6,
          p7 : p7,
          list_small: true,
        },
        beforeSend: function () {
          $(".btn-child").remove();
          $("#load_data_list").append(load);
          setTimeout(function () {
            $("#load_data_list .loader").remove();
          }, 1000);
        },
        success: function (response) {
          setTimeout(function () {
            $("#load_data_list .posts:last")
              .after(response)
              .show()
              .fadeIn("slow");
            var rowno = row + 7;
            if (rowno > allcount) {
              $(".btn-child span").text('Ẩn Đi');
            } else {
              $(".btn-child span").text('Xem Thêm');
            }
          }, 500);
        },
      });
    } else {
      $(".btn-child").hide();
      $("#load_data_list").append(load);
      setTimeout(function () {
        $("#load_data_list .loader").remove();
      }, 1000);
      setTimeout(function () {
        $("#load_data_list .posts:nth-child(5)")
          .nextAll("#load_data_list .posts")
          .remove()
          .fadeIn("slow");
        $("#load_data_list .row").data("row", "0");
        $(".btn-child").show();
        $(".btn-child span").text('Xem Thêm');
        $scrollTo = $("#load_data_list .posts:last-of-type");
        if ($scrollTo.length) {
          $("html, body").animate({
            scrollTop: $scrollTo.offset().top,
          });
        }
      }, 500);
    }
  });

  //Xem thêm trang thể loại cha
  $(document).on("click", ".btn-parent", function () {
    var row = Number($("#load_data_list .row").data("row"));
    var allcount = Number($("#load_data_list .allcount").data("allcount"));
    let category = Number($("#load_data_list .allcount").data("category"));
    let parent = $("#load_data_list .row").data("parent");
    let p1 = Number($("#load_data_list .allcount").data("posts1"));
    let p2 = Number($("#load_data_list .allcount").data("posts2"));
    let p3 = Number($("#load_data_list .allcount").data("posts3"));
    let p4 = Number($("#load_data_list .allcount").data("posts4"));
    let p5 = Number($("#load_data_list .allcount").data("posts5"));
    let p6 = Number($("#load_data_list .allcount").data("posts6"));
    let p7 = Number($("#load_data_list .allcount").data("posts7"));
    row = row + 7;
    if (row <= allcount) {
      $("#load_data_list .row").data("row", row);
      $.ajax({
        type: "POST",
        url: "modules/load_more_data.php",
        data: {
          row: row,
          category : category,
          parent : parent,
          p1 : p1,
          p2 : p2,
          p3 : p3,
          p4 : p4,
          p5 : p5,
          p6 : p6,
          p7 : p7,
          list: true,
        },
        beforeSend: function () {
          $(".btn-list").remove();
          $("#load_data_list").append(load);
          setTimeout(function () {
            $("#load_data_list .loader").remove();
          }, 1000);
        },
        success: function (response) {
          setTimeout(function () {
            $("#load_data_list .posts:last")
              .after(response)
              .show()
              .fadeIn("slow");
            var rowno = row + 7;
            if (rowno > allcount) {
              $(".btn-list span").text('Ẩn Đi');
            } else {
              $(".btn-list span").text('Xem Thêm');
            }
          }, 500);
        },
      });
    } else {
      $(".btn-list").hide();
      $("#load_data_list").append(load);
      setTimeout(function () {
        $("#load_data_list .loader").remove();
      }, 1000);
      setTimeout(function () {
        $("#load_data_list .posts:nth-child(5)")
          .nextAll("#load_data_list .posts")
          .remove()
          .fadeIn("slow");
        $("#load_data_list .row").data("row", "0");
        $(".btn-list").show();
        $(".btn-list span").text('Xem Thêm');
        $scrollTo = $("#load_data_list .posts:last-of-type");
        if ($scrollTo.length) {
          $("html, body").animate({
            scrollTop: $scrollTo.offset().top,
          });
        }
      }, 500);
    }
  });

//Xem thêm phần tag
$(document).on("click", ".btn-tag", function () {
  var row = Number($("#load_more_tag .row").data("row"));
  var allcount = Number($("#load_more_tag .allcount").data("allcount"));
  var id_tag = Number($("#load_more_tag .allcount").data("tag"));
  var name_tag = $("#load_more_tag .allcount").data("name-tag");
  row = row + 5;
  if (row <= allcount) {
    $("#load_more_tag .row").data("row", row);
    $.ajax({
      type: "POST",
      url: "modules/load_more_data.php",
      data: {
        row: row,
        name_tag : name_tag,
        id_tag : id_tag,
        tag: true,
      },
      beforeSend: function () {
        $(".btn-tag").remove();
        $("#load_more_tag").append(load);
        setTimeout(function () {
          $("#load_more_tag .loader").remove();
        }, 1000);
      },
      success: function (response) {
        setTimeout(function () {
          $("#load_more_tag .posts:last")
            .after(response)
            .show()
            .fadeIn("slow");
          var rowno = row + 5;
          if (rowno > allcount) {
            $(".btn-tag").text('Ẩn Đi');
          } else {
            $(".btn-tag").text('Xem Thêm');
          }
        }, 500);
      },
    });
  } else {
    $(".btn-tag").hide();
    $("#load_more_tag").append(load);
    setTimeout(function () {
      $("#load_more_tag .loader").remove();
    }, 1000);
    setTimeout(function () {
      $("#load_more_tag .posts:nth-child(5)")
        .nextAll("#load_more_tag .posts")
        .remove()
        .fadeIn("slow");
      $("#load_more_tag .row").data("row", "0");
      $(".btn-tag").show().text('Xem Thêm');
      $scrollTo = $("#load_data_tag .posts:last-of-type");
      if ($scrollTo.length) {
        $("html, body").animate({
          scrollTop: $scrollTo.offset().top,
        });
      }
    }, 500);
  }
});
//Xem thêm phần hotnews
$(document).on("click", ".btn-hotnews", function () {
  var row = Number($("#load_data_hotnews .row").data("row"));
  var allcount = Number($("#load_data_hotnews .allcount").data("allcount"));
  row = row + 10;
  if (row <= allcount) {
    $("#load_data_hotnews .row").data("row", row);
    $.ajax({
      type: "POST",
      url: "modules/load_more_data.php",
      data: {
        row: row,
        hotnews: true,
      },
      beforeSend: function () {
        $(".btn-hotnews").remove();
        $("#load_data_hotnews").append(load);
        setTimeout(function () {
          $("#load_data_hotnews .loader").remove();
        }, 1000);
      },
      success: function (response) {
        setTimeout(function () {
          $("#load_data_hotnews .posts:last")
            .after(response)
            .show()
            .fadeIn("slow");
          var rowno = row + 10;
          if (rowno > allcount) {
            $(".btn-hotnews").text('Ẩn Đi');
          } else {
            $(".btn-hotnews").text('Xem Thêm');
          }
        }, 1000);
      },
    });
  } else {
    $(".btn-hotnews").hide();
    $("#load_data_hotnews").append(load);
    setTimeout(function () {
      $("#load_data_hotnews .loader").remove();
    }, 500);
    setTimeout(function () {
      $("#load_data_hotnews .posts:nth-child(5)")
        .nextAll("#load_data_hotnews .posts")
        .remove()
        .fadeIn("slow");
      $("#load_data_hotnews .row").data("row", "0");
      $(".btn-hotnews").show().text('Xem Thêm');
      $scrollTo = $("#load_data_hotnews .posts:last-of-type");
      if ($scrollTo.length) {
        $("html, body").animate({
          scrollTop: $scrollTo.offset().top,
        });
      }
    }, 500);
  }
});
//Xem thêm phần trang mới nhất
$(document).on("click", ".btn-more-news", function () {
  var row = Number($("#load_more_news .row").data("row"));
  var allcount = Number($("#load_more_news .allcount").data("allcount"));
  row = row + 9;
  if (row <= allcount) {
    $("#load_more_news .row").data("row", row);
    $.ajax({
      type: "POST",
      url: "modules/load_more_data.php",
      data: {
        row: row,
        more_news: true,
      },
      beforeSend: function () {
        $(".btn-more-news").remove();
        $("#load_more_news").append(load);
        setTimeout(function () {
          $("#load_more_news .loader").remove();
        }, 1000);
      },
      success: function (response) {
        setTimeout(function () {
          $("#load_more_news .posts:last")
            .after(response)
            .show()
            .fadeIn("slow");
          var rowno = row + 9;
          if (rowno > allcount) {
            $(".btn-more-news").text('Ẩn Đi');
          } else {
            $(".btn-more-news").text('Xem Thêm');
          }
        }, 1000);
      },
    });
  } else {
    $(".btn-more-news").hide();
    $("#load_more_news").append(load);
    setTimeout(function () {
      $("#load_more_news .loader").remove();
    }, 500);
    setTimeout(function () {
      $("#load_more_news .posts:nth-child(5)")
        .nextAll("#load_more_news .posts")
        .remove()
        .fadeIn("slow");
      $("#load_more_news .row").data("row", "0");
      $(".btn-more-news").show().text('Xem Thêm');
      $scrollTo = $("#load_more_news .posts:last-of-type");
      if ($scrollTo.length) {
        $("html, body").animate({
          scrollTop: $scrollTo.offset().top,
        });
      }
    }, 500);
  }
});

});
