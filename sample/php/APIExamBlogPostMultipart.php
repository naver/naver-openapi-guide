<?php
  // 네이버 블로그 Open API 예제 - Multipart 글쓰기
  $token = "YOUR_ACCESS_TOKEN"; // 네아로 접근 토큰
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $url = "https://openapi.naver.com/blog/writePost.json";
  $title = "네이버 multi-part 이미지 첨부 테스트 php";
  $contents = "<font color='red'>multi-part</font>로 첨부한 글입니다. <br> php 이미지 1개 첨부 <br> <img src=\"#0\" /> <img src=\"#1\" /> ";
  $postvars_str = array("title" => $title, "contents" => $contents);
  $is_post = true;
  $ch = curl_init();
  // 업로드할 파일 정보
  $cfile1 = new CURLFile('prince0.jpg','image/jpeg');
  $cfile2 = new CURLFile('prince1.jpg','image/jpeg');
  // blog 포스트 필수 요청 변수 image, title, contents 지정
  $postvars = array("image[0]" => $cfile1, "image[1]" => $cfile2,  "title" => $title, "contents" => $contents);
  // 요청헤더 설정
  $headers = array();
  $headers[] = "Authorization: ".$header;
  $headers[] = "Content-Type: multipart/form-data";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  // 헤더 내용 출력
  $headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT );
  echo $headerSent;
  echo "<br>[status_code]:".$status_code."<br>";
  // 결과 출력
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?>
