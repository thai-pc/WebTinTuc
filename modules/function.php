<?php
//Lấy đường dẫn trang hiện tại
function getCurrentPageURL() {
  $pageURL = 'http';
  if (!empty($_SERVER['HTTPS'])) {
  if ($_SERVER['HTTPS'] == 'on') {
  $pageURL .= "s";
  }
  }
  $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
  } else {
  $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  }
  return $pageURL;
  }
//Token duy nhất khi đăng nhập thành công
function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}

date_default_timezone_set('Asia/Ho_Chi_Minh');
function date_format_vn($date_time)
{
  $date = date_create($date_time);
  $date_format = date_format($date,'d \t\h\g\ m, Y');
  return $date_format;
}

function facebook_time_ago($timestamp)  
    {  
         $time_ago = strtotime($timestamp);  
         $current_time = time();  
         $time_difference = $current_time - $time_ago;  
         $seconds = $time_difference;  
         $minutes      = round($seconds / 60 );           // value 60 is seconds  
         $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
         $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
         $weeks          = round($seconds / 604800);          // 7*24*60*60;  
         $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
         $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
         if($seconds <= 60)  
         {  
        return "Vừa xong";  
      }  
         else if($minutes <=60)  
         {  
        if($minutes==1)  
              {  
          return "một phút trước";  
        }  
        else  
              {  
          return "$minutes phút trước";  
        }  
      }  
         else if($hours <=24)  
         {  
        if($hours==1)  
              {  
          return "một giờ trước";  
        }  
              else  
              {  
          return "$hours giờ trước";  
        }  
      }  
         else if($days <= 7)  
         {  
        if($days==1)  
              {  
          return "hôm qua";  
        }  
              else  
              {  
          return "$days ngày trước";  
        }  
      }  
         else if($weeks <= 4.3) //4.3 == 52/12  
         {  
        if($weeks==1)  
              {  
          return "một tuần trước";  
        }  
              else  
              {  
          return "$weeks tuần trước";  
        }  
      }  
          else if($months <=12)  
         {  
        if($months==1)  
              {  
          return "một tháng trước";  
        }  
              else  
              {  
          return "$months tháng trước";  
        }  
      }  
         else  
         {  
        if($years==1)  
              {  
          return "một năm trước";  
        }  
              else  
              {  
          return "$years năm trước";  
        }  
      }  
    } 
?> 