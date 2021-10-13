<?php
  // 네이버 블로그 Open API 예제 - 글쓰기
  $token = "YOUR_ACCESS_TOKEN"; // 네이버 로그인 로그인 접근 토큰
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $url = "https://openapi.naver.com/blog/writePost.json";
  $title = urlencode("네이버 블로그 api Test php");
  $contents = urlencode("네이버 블로그 api로 글을 블로그에 올려봅니다.");
  $postvars = "title=".$title."&contents=".$contents."&categoryNo=6";
  $is_post = true;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
  $headers[] = "Authorization: ".$header;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?>
