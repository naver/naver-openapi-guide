<?php
  // 네이버 얼굴인식 Open API 예제
  $client_id = "YOUR_CLIENT_ID"; // 네이버 개발자센터에서 발급받은 CLIENT ID
  $client_secret = "YOUR_CLIENT_SECRET";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
  $url = "https://openapi.naver.com/v1/vision/celebrity";
  $is_post = true;
  $ch = curl_init();

  $filename = "test.jpg";
  $filesize = filesize($filename);
  echo "filesize=".$filesize;
  if($filesize > 2*1024*1024) {
      echo "2MB 이하의 이미지를 올려주세요.";
      exit;
  }
  $file_name = 'YOUR_FILE_NAME'; // 업로드할 파일명
  $cfile = curl_file_create($file_name,'image/jpeg','test_name');
  $postvars = array("filename" => $filename, "image" => $cfile);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  $headers[] = "Content-Type:multipart/form-data";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  // 헤더 내용 출력
  $headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT );
  echo $headerSent;
  echo "<br>[status_code]:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?>
