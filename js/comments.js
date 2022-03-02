/*--- Phần comments trên ---*/
//Nút Xóa bình luận
$(document).ready(function () {
  $('.btn-clear').click(function () {
    $('.comment_textbox').val('');
    $('.button_cm').removeClass('active-bt-cm');
  });

  function whitespace() {
    $text = $('.comment_textbox').val();
    if ($text.replace(/\s/g, '').length <= 0) {
      $('.button_cm').removeClass('active-bt-cm');
    } else {
      $('.button_cm').addClass('active-bt-cm');
    }
  }
  //Kiểm tra dữ liệu nhập vào
  $(document).on('keyup', '.comment_textbox', function () {
    whitespace();
  });
  $(document).on('click', '.emotion-Icon', function () {
    if ($('.emotion-area').css('display') == 'none') {
      $('.emotion-area').show();
    } else {
      $('.emotion-area').hide();
    }
  });

  //Phần icons emoji
  function addEmoji() {
    const place = document.getElementsByClassName('emoji');
    const emojis = [
      0x1f600, 0x1f601, 0x1f60a, 0x1f62d, 0x1f637, 0x1f634, 0x1f61c, 0x1f602,
      0x1f603, 0x1f604, 0x1f605, 0x1f606, 0x1f607, 0x1f608, 0x1f60d, 0x1f344,
      0x1f37f, 0x1f363, 0x1f370,
    ];
    for (let i = 0; i < place.length; i++) {
      place[i].append(String.fromCodePoint(emojis[i]));
    }
  }
  addEmoji();

  function addInput() {
    const click = document.getElementsByClassName('emoji');

    for (let index = 0; index < click.length; index++) {
      click[index].onclick = function () {
        let text = click[index].innerText;
        let value = document.querySelector('.comment_textbox').value;
        value = value + text;
        document.querySelector('.comment_textbox').value = value;
        whitespace();
        $('.emotion-area').hide();
      };
    }
  }
  addInput();

  //Phần thêm comment
  function AddComment() {
    $('.add_comment_btn').click(function () {
      $cm_text = $('#comments-ip').val();
      $.ajax({
        type: 'POST',
        url: 'modules/comment.php',
        data: { $cm_text: $cm_text },
        success: function (response) {
          response = JSON.parse(response);
        },
      });
    });
  }
  AddComment();

  //Phần chuyển tabs fillter
});
