<?php
  // 네이버 카페 Open API 예제 - 글쓰기
  $token = "YOUR_ACCESS_TOKEN"; // 네아로 접근 토큰
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $clubid = "13400261";// 카페의 고유 ID값 (http://cafe.naver.com/apiexam/83)
  $menuid = "3"; // 카페 게시판 id
  $url = "https://openapi.naver.com/v1/cafe/".$clubid."/menu/".$menuid."/articles";
  $str = "카페API로 글쓰기";
  $encoding = mb_detect_encoding($str, 'euc-kr,euc-jp');
  echo "encoding=".$encoding;
  echo "<br>";
  $subject = "카페API로 글쓰기";
  echo "<br>111111subject=".$subject;
  $subject = urlencode("카페API로 글쓰기");
  echo "<br>222222subject=".$subject;
  $subject = iconv("EUC-KR", "UTF-8//IGNORE", $subject);
  echo "<br>333333subject=".$subject;


  if($encoding !== false) {
//    $subject = iconv($encoding, "UTF-8//IGNORE", $str);
    $content = iconv($encoding, "UTF-8//IGNORE", $str);
  } else {
//    $subject = urlencode(iconv("EUC-JP", "UTF-8//IGNORE", "네이버 카페 api 글쓰기 Test php"));
    $content = urlencode(iconv("EUC-JP", "UTF-8//IGNORE", "네이버 카페 api로 글을 올려봅니다."));
  }

//  $subject =  "%EB%B0%98%EA%B0%91%EC%8A%B5%EB%8B%88%EB%8B%A4.";
  $subject = "%25EC%25B9%25B4%25ED%258E%2598%2B%25EA%25B0%2580%25EC%259E%2585%2B%25EC%259D%25B8%25EC%2582%25AC";
  $postvars = "subject=".$subject."&content=".$content;
  $is_post = true;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
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
