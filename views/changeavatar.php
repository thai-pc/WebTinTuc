<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay ảnh đại diện</title>
    <style>
        .changeavatar {
            position: relative;
            text-align: center;
            padding: 32px 16px;
            margin: 0;
            border: 1px dashed #eee;
            border-radius: 5px;
            font-size: 16px;
        }

        .changeavatar .av_title {
            font-size: 1.125em;
            line-height: 2em;
        }

        .changeavatar .av_main .btn-av-select {
            text-align: center;
            padding: 8px 16px;
            border-radius: 2px;
            border: 1px solid;
            color: #fff;
            background-color: #0275d8;
            cursor: pointer;
            position: relative;
        }

        .changeavatar .av_main .list-av {
            margin: 1.25px;
        }

        .changeavatar .av_main .list_av h2 {
            font-size: 1em;
            line-height: 1.825em;
        }

        .changeavatar .av_main .list_av h3 {
            font-size: 1em;
            line-height: 0.7em;
            font-weight: normal;
        }

        .changeavatar .av_main .btn-av-close {
            position: fixed;
            top: 0;
            right: 0;
            outline: 0;
            cursor: pointer;
            border: none;
            padding: 8px 16px;
        }

        .changeavatar .av_main .btn-av-close:hover {
            background: red;
            color: #fff;
        }
    </style>
</head>

<body>
    <article id="uploadfile" class="changeavatar upload-area">
        <h1 class="av_title">
            Thay đổi ảnh đại diện
        </h1>
        <div class="av_main">
            <button type="button" class="btn-av-select">
                Chọn ảnh từ máy tính của bạn
                <div id="box-file" style="position: absolute; top: 0px; left: 0px; width: 214.16px; height: 33.33px; overflow: hidden; z-index: 0; cursor: pointer;">
                    <input name="file" id="file" type="file" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;" accept="image/jpeg,.jpg,image/gif,.gif,image/png,.png">
                </div>
            </button>
            <div class="list_av">
                <h2>Bạn có thể kéo ảnh avatar của bạn vào đây</h2>
                <h3>Hoặc chọn tệp từ máy tính của bạn</h3>
                <h3>
                    Chú ý: Tệp ảnh định dạng .jpg, png, gif, bmp.
                </h3>
                <h3>
                    Dung lượng ảnh nhỏ hơn 2MB.
                </h3>
                <h3>
                    Kích thước ảnh nhỏ hơn 1000px x 1000px.
                </h3>
                <div id="notify" style="color: red; font-weight: 700;"></div>
            </div>
            <button type="button" class="btn-av-close">Đóng lại</button>
        </div>
    </article>
    <!------ Jquery Validation -------->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $(function() {

            // Ngăn sự kiện chuyển hướng trang

            $("html").on("drop", function(e) {
                e.preventDefault();
                e.stopPropagation();
            });

            // Drag enter
            $('.upload-area').on('dragenter', function(e) {
                e.stopPropagation();
                e.preventDefault();
                $(this).css('box-shadow', '0px 0px 1px 1px red');
            });

            // Drag over
            $('.upload-area').on('dragover', function(e) {
                e.stopPropagation();
                e.preventDefault();
                $(this).css('box-shadow', '0px 0px 1px 1px #0cadf8');
            });

            // Drop
            $('.upload-area').on('drop', function(e) {
                e.stopPropagation();
                e.preventDefault();

                $(this).css('box-shadow', '0px 0px 1px 1px #3bdb1b');

                var file = e.originalEvent.dataTransfer.files;
                var fd = new FormData();

                fd.append('file', file[0]);

                uploadData(fd);
            });

            // file selected
            $("#file").change(function() {
                var fd = new FormData();

                var files = $('#file')[0].files[0];

                fd.append('file', files);

                uploadData(fd);
            });
        });

        // gửi yêu cầu lên và upload
        function uploadData(formdata) {

            $.ajax({
                url: '../modules/upload.php',
                type: 'post',
                data: formdata,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.file == 0) {
                        $('#notify').html(response.message);
                        $('#uploadfile').css('box-shadow', '0px 0px 1px 1px red');
                    }else if(response.false == 1){
                        window.location.href = response.message;
                    }else if(response.true == 1){
                        window.parent.location.reload();
                    }else if(response.size == 0){
                        $('#notify').html(response.message);
                        $('#uploadfile').css('box-shadow', '0px 0px 1px 1px red');
                    }

                }
            });
        }
    </script>
</body>

</html>