<?php
  // 네이버 음성 캡차 Open API 예제 - 음성 다운로드
  $client_id = "YOUR_CLIENT_ID"; // 네이버 개발자센터에서 발급받은 CLIENT ID
  $client_secret = "YOUR_CLIENT_SECRET";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
  $key = "YOUR_CAPTCHA_KEY";
  $url = "https://openapi.naver.com/v1/captcha/scaptcha?key=".$key;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    //echo $response;
    $fp = fopen("captcha.wav", "w+");
    fwrite($fp, $response);
    fclose($fp);
    echo "<img src='captcha.wav'>";
  } else {
    echo "Error 내용:".$response;
  }
?>
