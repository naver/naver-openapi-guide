<?php
  // 네이버 Cafe Open API 예제 - Multipart 글쓰기
  $token = "YOUR_ACCESS_TOKEN"; // 네아로 접근 토큰
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $clubid = "28339939";// 카페의 고유 ID값  (http://cafe.naver.com/apiexam/83)
  $menuid = "1"; // 카페 게시판 id
  $url = "https://openapi.naver.com/v1/cafe/".$clubid."/menu/".$menuid."/articles";
  $subject = urlencode("cafe php 네이버 multi-part 이미지 첨부 테스트 php");
  $content = urlencode("<font color='red'>multi-part 로 첨부한 글입니다. php 이미지 첨부 <img src='#0' />");

  $postvars_str = array("subject" => $subject, "content" => $content);
  $is_post = true;
  $ch = curl_init();
  // 업로드할 파일 정보
  $cfile1 = new CURLFile('prince0.jpg','image/jpeg');
  $cfile2 = new CURLFile('test.jpg','image/jpeg');

  // blog 포스트 필수 요청 변수 image, title, contents 지정
  $postvars = array("image[0]" => $cfile1, "image[1]" => $cfile2, "subject" => $subject, "content" => $content);
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
