<?php
  // 네이버 로그인 접근토큰 요청 예제
  $client_id = "YOUR_CLIENT_ID";
  $redirectURI = urlencode("http://127.0.0.1/callback.php");
  function generate_state() {
      $mt = microtime();
      $rand = mt_rand();
      return md5($mt . $rand);
  }
  // 상태 토큰으로 사용할 랜덤 문자열을 생성
  $state = generate_state();
  $apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;
?>
<a href="<?php echo $apiURL ?>"><img height="50" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>
