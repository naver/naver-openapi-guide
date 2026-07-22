---
title: 네이버 로그인 Web 애플리케이션 개발가이드
description: PHP, Java 등 서버 사이드 언어와 JavaScript로 개발한 웹 애플리케이션에 네이버 로그인을 적용하는 방법과 호출 예제를 안내합니다.
---

# Web 애플리케이션

네이버 로그인은 서버 사이드 언어인 PHP나 Java로 개발한 웹 애플리케이션에도 적용할 수 있습니다.
또한 프런트엔드에서 사용하는 JavaScript를 사용해도 적용할 수 있습니다.

<div class="ndc-cta">
<a href="/myapps/new">오픈 API 이용 신청 &gt;</a>
</div>

## API 호출 예제

예제 실행 전에 아래 <span class="ndc-color">1.준비사항</span> 항목들을 꼭 체크하시길 바랍니다.

#### JavaScript

```html
네이버 로그인 JavaScript 예제는 2개의 파일로 구성되어 있습니다. (naverlogin.html, callback.html)
1. APIExamNaverLogin.html
<!doctype html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title>네이버 로그인</title>
  <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
  <!-- 네이버 로그인 버튼 노출 영역 -->
  <div id="naver_id_login"></div>
  <!-- //네이버 로그인 버튼 노출 영역 -->
  <script type="text/javascript">
  	var naver_id_login = new naver_id_login("YOUR_CLIENT_ID", "YOUR_CALLBACK_URL");
  	var state = naver_id_login.getUniqState();
  	naver_id_login.setButton("white", 2,40);
  	naver_id_login.setDomain("YOUR_SERVICE_URL");
  	naver_id_login.setState(state);
  	naver_id_login.setPopup();
  	naver_id_login.init_naver_id_login();
  </script>
</html>

2. callback.html
<!doctype html>
<html lang="ko">
<head>
<script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
<script type="text/javascript">
  var naver_id_login = new naver_id_login("YOUR_CLIENT_ID", "YOUR_CALLBACK_URL");
  // 접근 토큰 값 출력
  alert(naver_id_login.oauthParams.access_token);
  // 네이버 사용자 프로필 조회
  naver_id_login.get_naver_userprofile("naverSignInCallback()");
  // 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
  function naverSignInCallback() {
    alert(naver_id_login.getProfileData('email'));
    alert(naver_id_login.getProfileData('nickname'));
    alert(naver_id_login.getProfileData('age'));
  }
</script>
</body>
</html>
```

#### JSP

```jsp
네이버 로그인 접근토큰 획득 예제는 2개의 프로그램으로 구성되어 있습니다. (naverlogin.jsp, callback.jsp)
1. naverlogin.jsp
<%@ page import="java.net.URLEncoder" %>
<%@ page import="java.security.SecureRandom" %>
<%@ page import="java.math.BigInteger" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
  <head>
    <title>네이버로그인</title>
  </head>
  <body>
  <%
    String clientId = "YOUR_CLIENT_ID";//애플리케이션 클라이언트 아이디값";
    String redirectURI = URLEncoder.encode("YOUR_CALLBACK_URL", "UTF-8");
    SecureRandom random = new SecureRandom();
    String state = new BigInteger(130, random).toString();
    String apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code"
         + "&client_id=" + clientId
         + "&redirect_uri=" + redirectURI
         + "&state=" + state;
    session.setAttribute("state", state);
 %>
  <a href="<%=apiURL%>"><img height="50" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>
  </body>
</html>

2. callback.jsp
<%@ page import="java.net.URLEncoder" %>
<%@ page import="java.net.URL" %>
<%@ page import="java.net.HttpURLConnection" %>
<%@ page import="java.io.BufferedReader" %>
<%@ page import="java.io.InputStreamReader" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
  <head>
    <title>네이버로그인</title>
  </head>
  <body>
  <%
    String clientId = "YOUR_CLIENT_ID";//애플리케이션 클라이언트 아이디값";
    String clientSecret = "YOUR_CLIENT_SECRET";//애플리케이션 클라이언트 시크릿값";
    String code = request.getParameter("code");
    String state = request.getParameter("state");
    String redirectURI = URLEncoder.encode("YOUR_CALLBACK_URL", "UTF-8");
    String apiURL = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code"
        + "&client_id=" + clientId
        + "&client_secret=" + clientSecret
        + "&redirect_uri=" + redirectURI
        + "&code=" + code
        + "&state=" + state;
    String accessToken = "";
    String refresh_token = "";
    try {
      URL url = new URL(apiURL);
      HttpURLConnection con = (HttpURLConnection)url.openConnection();
      con.setRequestMethod("GET");
      int responseCode = con.getResponseCode();
      BufferedReader br;
      if (responseCode == 200) { // 정상 호출
        br = new BufferedReader(new InputStreamReader(con.getInputStream()));
      } else {  // 에러 발생
        br = new BufferedReader(new InputStreamReader(con.getErrorStream()));
      }
      String inputLine;
      StringBuilder res = new StringBuilder();
      while ((inputLine = br.readLine()) != null) {
        res.append(inputLine);
      }
      br.close();
      if (responseCode == 200) {
        out.println(res.toString());
      }
    } catch (Exception e) {
      // Exception 로깅
    }
  %>
  </body>
</html>
```

#### PHP

```php
네이버 로그인 접근토큰 획득 예제는 2개의 파일로 구성되어 있습니다. (naverlogin.php, callback.php)
1. naverlogin.php
<?php
  // 네이버 로그인 접근토큰 요청 예제
  $client_id = "YOUR_CLIENT_ID";
  $redirectURI = urlencode("YOUR_CALLBACK_URL");
  $state = "RAMDOM_STATE";
  $apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;
?><a href="<?php echo $apiURL ?>"><img height="50" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>

2. callback.php
<?php
  // 네이버 로그인 콜백 예제
  $client_id = "YOUR_CLIENT_ID";
  $client_secret = "YOUR_CLIENT_SECRET";
  $code = $_GET["code"];;
  $state = $_GET["state"];;
  $redirectURI = urlencode("YOUR_CALLBACK_URL");
  $url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
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
```

#### Node.js

```
네이버 로그인 Node.js 예제는 1개의 파일로 로그인요청 및 콜백 처리를 모두합니다.
var express = require('express');
var app = express();
var client_id = 'YOUR_CLIENT_ID';
var client_secret = 'YOUR_CLIENT_SECRET';
var state = "RANDOM_STATE";
var redirectURI = encodeURI("YOUR_CALLBACK_URL");
var api_url = "";
app.get('/naverlogin', function (req, res) {
  api_url = 'https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=' + client_id + '&redirect_uri=' + redirectURI + '&state=' + state;
   res.writeHead(200, {'Content-Type': 'text/html;charset=utf-8'});
   res.end("<a href='"+ api_url + "'><img height='50' src='http://static.nid.naver.com/oauth/small_g_in.PNG'/></a>");
 });
 app.get('/callback', function (req, res) {
    code = req.query.code;
    state = req.query.state;
    api_url = 'https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id='
     + client_id + '&client_secret=' + client_secret + '&redirect_uri=' + redirectURI + '&code=' + code + '&state=' + state;
    var request = require('request');
    var options = {
        url: api_url,
        headers: {'X-Naver-Client-Id':client_id, 'X-Naver-Client-Secret': client_secret}
     };
    request.get(options, function (error, response, body) {
      if (!error && response.statusCode == 200) {
        res.writeHead(200, {'Content-Type': 'text/json;charset=utf-8'});
        res.end(body);
      } else {
        res.status(response.statusCode).end();
        console.log('error = ' + response.statusCode);
      }
    });
  });
 app.listen(3000, function () {
   console.log('http://127.0.0.1:3000/naverlogin app listening on port 3000!');
 });
```

#### ASP.Net

```jsp
네이버 로그인 접근토큰 획득 예제는 3개의 파일로 구성되어 있습니다. (naverlogin.aspx, callback.aspx, callback.aspx.cs)
1. naverlogin.aspx
<%@ Page Language="C#" AutoEventWireup="true" %>
<!DOCTYPE html>
<script runat="server">
    String getNaverLoginURL()
    {
        string clientId = "YOUR-CLIENT-ID";
        string redirectURI = "YOUR-CALLBACK-URL";
        string state = "RANDOM_STATE";
        string apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id="
            + clientId + "&redirect_uri=" + redirectURI + "&state=" + state;
        return apiURL;
    }
</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Naver Login Exam</title>
</head>
<body>
    <a href="<% Response.Write(getNaverLoginURL()); %>"><img height="50" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>
</body>
</html>

2. callback.aspx
<%@ Page Language="C#" Async="true" AutoEventWireup="true" CodeBehind="callback.aspx.cs" Inherits="NaverAPI_Guide.callback" %>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Naver Login Callback</title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
        <p> token 값: <asp:label id="lblResult" runat="server" /></p>
    </div>
    </form>
</body>
</html>

3. callback.aspx.cs
using System;
using System.Net.Http;
using System.Threading.Tasks;

namespace NaverAPI_Guide
{
    public partial class callback : System.Web.UI.Page
    {
        protected async void Page_Load(object sender, EventArgs e)
        {
            lblResult.Text = await getAccessToken();
        }
        public async Task<string> getAccessToken()
        {
            using (var client = new HttpClient())
            {
                string clientId = "YOUR-CLIENT-ID";
                string clientSecret = "YOUR-CLIENT-SECRET";
                client.DefaultRequestHeaders.Add("X-Naver-Client-Id", clientId);
                client.DefaultRequestHeaders.Add("X-Naver-Client-Secret", clientSecret);
                string code = Request.QueryString["code"];
                string state = Request.QueryString["state"];
                string redirectURI = "YOUR-CALLBACK-URL";
                string apiURL = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&";
                apiURL += "client_id=" + clientId;
                apiURL += "&client_secret=" + clientSecret;
                apiURL += "&redirect_uri=" + redirectURI;
                apiURL += "&code=" + code;
                apiURL += "&state=" + state;
                var res = await client.GetAsync(apiURL);
                var responseString = await res.Content.ReadAsStringAsync();
                Console.WriteLine("res.StatusCode = " + res.StatusCode);
                return "res.StatusCode=" + res.StatusCode + "::: responseString" + responseString.ToString();
            }
        }
    }
}
```

## 1. PHP와 Java로 네이버 로그인 적용하기

웹 애플리케이션에서는 API 형식에 맞게 접근 토큰을 요청하는 API를 호출하고 응답을 받아 네이버 로그인 기능을 이용할 수 있습니다. 여기서는 대표적인 서버 사이드 언어인 PHP와 Java로 "네이버 로그인"을 웹 애플리케이션에 구현하는 방법을 설명합니다.

- [네이버 로그인 API 명세 >](/docs/login/api)

### 1.1. 세션 유지 및 위조 방지용 상태 토큰 생성

웹 애플리케이션은 브라우저를 기반으로 작동하기 때문에 사이트 간 요청 위조(cross-site request forgery, 이하 CSRF) 공격 위험이 있습니다. CSRF 공격을 방지하기 위해 애플리케이션과 사용자 간의 상태를 보유하는 고유한 세션 토큰을 만들어야 합니다. 나중에 인증 과정의 결괏값으로 전달하는 세션 토큰과 일치하는지 확인해 사용자가 요청하지 않은 '비정상적인 요청'인지 확인할 수 있습니다. 이 세션 토큰을 '상태 토큰'(state token) 이라 하며, 상태 토큰의 값은 사용자가 네이버 로그인을 진행하는 동안 유지되어야 하며 고유한 값이어야 합니다. 다음은 상태 토큰을 생성하는 코드를 PHP와 Java로 구현한 예입니다. 생성한 상태 토큰은 세션이나 별도의 저장 공간에 저장하도록 합니다.

1.1.1. PHP로 구현한 상태 토큰 생성 코드 예

```php
// CSRF 방지를 위한 상태 토큰 생성 코드
// 상태 토큰은 추후 검증을 위해 세션에 저장되어야 한다.

function generate_state() {
    $mt = microtime();
    $rand = mt_rand();
    return md5($mt . $rand);
}

// 상태 토큰으로 사용할 랜덤 문자열을 생성
$state = generate_state();
// 세션 또는 별도의 저장 공간에 상태 토큰을 저장
$session->set_state($state);
return $state;
```

Java로 구현한 상태 토큰 생성 코드 예

```java
// CSRF 방지를 위한 상태 토큰 생성 코드
// 상태 토큰은 추후 검증을 위해 세션에 저장되어야 한다.

public String generateState()
{
    SecureRandom random = new SecureRandom();
    return new BigInteger(130, random).toString(32);
}

// 상태 토큰으로 사용할 랜덤 문자열 생성
String state = generateState();
// 세션 또는 별도의 저장 공간에 상태 토큰을 저장
request.session().attribute("state", state);
return state;
```

### 1.2. 네이버 로그인 인증 요청문 생성

상태 토큰을 정상적으로 생성했다면 네이버 로그인 페이지를 호출하는 인증 요청문(authentication request)을 생성하도록 합니다. 인증 요청문은 URL 형식으로 되어 있으며 네이버가 제공하는 인증 URL과 클라이언트 아이디, 상태 토큰으로 이루어져 있습니다. 인증 과정은 모두 HTTPS 통신으로 이루어지며 인증 요청문 형식은 다음과 같습니다.

1.2.1. 인증 요청문 형식

```
https://nid.naver.com/oauth2.0/authorize?client_id={클라이언트 아이디}&response_type=code&redirect_uri={개발자 센터에 등록한 콜백 URL(URL 인코딩)}&state={상태 토큰}
```

인증 요청문을 구성하는 파라미터는 다음과 같습니다.

- client_id: 애플리케이션 등록 후 발급받은 클라이언트 아이디
- response_type: 인증 과정에 대한 구분값. code로 값이 고정돼 있습니다.
- redirect_uri: 네이버 로그인 인증의 결과를 전달받을 콜백 URL(URL 인코딩).
- 애플리케이션을 등록할 때 Callback URL에 설정한 정보입니다.
- state: 애플리케이션이 생성한 상태 토큰

### 1.3. 네이버 로그인 인증

브라우저에서 페이지를 이동하거나 새로운 창을 열어 URL 형태의 인증 요청문을 보내면 네이버 로그인 페이지로 이동합니다. 사용자가 네이버 로그인 페이지에서 네이버 아이디와 비밀번호를 입력해 로그인하면 사용자 인증이 완료됩니다.

![PC 웹에서의 네이버 로그인 페이지(왼쪽)와 모바일 웹에서의 네이버 로그인 페이지(오른쪽)](./images/img_naverid03.gif)

로그인에 성공해 사용자 인증이 완료된 후에는 기본 정보 제공에 동의할 것인지 확인하는 페이지로 이동합니다. 사용자가 기본 정보 제공에 동의하면 redirect_uri 파라미터에 설정한 콜백 URL로 인증 정보가 전송됩니다.

![PC 웹에서의 정보 제공 동의 페이지(왼쪽)와 모바일 웹에서의 정보 제공 동의 페이지(오른쪽)](./images/img_naverid04.gif)

### 1.4. 상태 토큰 검증

사용자가 정상적으로 로그인 과정을 거쳐 인증을 마치면 미리 설정한 콜백 URL로 인증 정보가 전송됩니다. 전송 받은 응답은 다음과 같은 쿼리스트링 형식입니다.

1.4.1. 인증 정보 응답문 형식

```
{개발자 센터에 등록한 콜백 URL}?state={상태 토큰}&code={인증 코드}
```

인증 정보의 내용은 다음과 같습니다.

- state: 콜백으로 전달받은 상태 토큰. 애플리케이션이 생성한 상태 토큰과 일치해야 합니다.
- code: 콜백으로 전달받은 인증 코드(authentication code). 접근 토큰(access token) 발급에 사용합니다.

응답받은 콜백 요청이 정상적인 요청인지 확인해야 합니다. 정상적인 요청인지 확인하는 방법은 전달받은 state 파라미터의 값과 처음에 생성한 상태 토큰이 일치하는지 확인하는 것입니다. 만약 상태 토큰과 일치하지 않다면 해당 세션은 유효하지 않다고 판단할 수 있습니다.

다음은 상태 코드를 비교하는 코드를 PHP와 Java로 구현한 예입니다.

1.4.2. PHP로 구현한 상태 코드 검증 예

```php
// CSRF 방지를 위한 상태 토큰 검증
// 세션 또는 별도의 저장 공간에 저장된 상태 토큰과 콜백으로 전달받은 state 파라미터의 값이 일치해야 함

// 콜백 응답에서 state 파라미터의 값을 가져옴
$state = $request->get_parameter(“state”);
// 세션 또는 별도의 저장 공간에서 상태 토큰을 가져옴
$stored_state = $session->get_state();

if( $state != $stored_state ) {
    return RESPONSE_UNAUTHORIZED; //401 unauthorized
} else {
    return RESPONSE_SUCCESS; //200 success
}
```

1.4.3. Java로 구현한 상태 코드 검증 예

```java
// CSRF 방지를 위한 상태 토큰 검증 검증
// 세션 또는 별도의 저장 공간에 저장된 상태 토큰과 콜백으로 전달받은 state 파라미터의 값이 일치해야 함

// 콜백 응답에서 state 파라미터의 값을 가져옴
String state = request.queryParams(“state”);

// 세션 또는 별도의 저장 공간에서 상태 토큰을 가져옴
String storedState = request.session().attribute(“state”);

if( !state.euals( storedState ) ) {
    return RESPONSE_UNAUTHORIZED; //401 unauthorized
} else {
    Return RESPONSE_SUCCESS; //200 success
}
```

### 1.5. 접근 토큰 요청

상태 토큰에 대한 검증이 성공적으로 끝났다면 응답으로 전달받은 인증 코드를 이용해 최종 인증 값인 접근 토큰을 발급받습니다. 인증 코드는 "IpoXcXsQxoYNseP3"와 같이 랜덤으로 생성된 값입니다. 인증 코드는 접근 토큰을 발급할 때 1번만 사용하며 이미 사용한 인증 코드는 더 이상 사용할 수 없습니다. 접근 토큰 요청 과정은 모두 서버 간 HTTPS 통신으로 이루어지며 완성된 요청문은 다음과 같은 URL 형식입니다.

1.5.1. 접근 토큰 발급 요청문 형식

```
https://nid.naver.com/oauth2.0/token?client_id={클라이언트 아이디}&client_secret={클라이언트 시크릿}&grant_type=authorization_code&state={상태 토큰}&code={인증 코드}
```

접근 토큰 발급에 필요한 정보는 다음과 같습니다.

- client_id: 애플리케이션 등록 후 발급받은 클라이언트 아이디
- client_secret: 애플리케이션 등록 후 발급받은 클라이언트 시크릿
- grant_type: 인증 타입에 대한 구분값. authorization_code로 값이 고정돼 있습니다.
- state: 애플리케이션이 생성한 상태 토큰
- code: 콜백으로 전달받은 인증 코드

접근 토큰 요청에 성공하면 다음과 같이 접근 토큰과 갱신 토큰이 포함된 JSON 형식의 결괏값을 반환받습니다. 접근 토큰은 expires_in 속성에 설정된 시간 동안 유효합니다. 유효 기간이 지난 뒤에는 갱신 토큰을 사용해 접근 토큰을 다시 발급받아야 합니다.

```
{
    "access_token": "AAAAQosjWDJieBiQZc3to9YQp6HDLvrmyKC+6+iZ3gq7qrkqf50ljZC+Lgoqrg",
    "refresh_token": "c8ceMEJisO4Se7uGisHoX0f5JEii7JnipglQipkOn5Zp3tyP7dHQoP0zNKHUq2gY",
    "token_type": "bearer",
    "expires_in": "3600"
}
```

### 1.6. 네이버 사용자 프로필 정보 조회

접근 토큰을 성공적으로 발급받았다면 접근 토큰을 이용해 네이버 사용자의 프로필 정보를 조회할 수 있습니다.
사용자 프로필 정보는 사용자를 구분할 수 있는 식별값인 아이디와 별명, 메일 주소와 같은 사용자 정보를 포함하고 있습니다.

1.6.1. 사용자 프로필 정보 조회 요청 URL

```
https://openapi.naver.com/v1/nid/me
```

요청할 때는 다음과 같은 형식으로 접근 토큰을 포함하는 요청 헤더를 보냅니다.
요청 헤더에 포함하는 토큰 타입은 Bearer입니다.

```
Authorization: {토큰 타입] {접근 토큰]
```

다음은 사용자 프로필 정보를 요청하는 요청 헤더의 예입니다.

```
User-Agent: curl/7.12.1 (i686-redhat-linux-gnu) libcurl/7.12.1 OpenSSL/0.9.7a zlib/1.2.1.2 libidn/0.5.6
Host: openapi.naver.com
Pragma: no-cache
Accept: */*
Authorization: Bearer AAAAOLtP40eH6P5S4Z4FpFl77n3FD5I+W3ost3oDZq/nbcS+7MAYXwX
bT3Y7Ib3dnvcqHkcK0e5/rw6ajF7S/QlJAgUukpp1OGkG0vzi16hcRNYX6RcQ6kPxB0oAvqfUPJiJw==
```

사용자 프로필 조회 요청에 성공하면 다음과 같이 JSON 형식으로 된 결괏값을 반환받습니다.

```
{
  "resultcode": "00",
  "message": "success",
  "response": {
    "email": "openapi@naver.com",
    "nickname": "OpenAPI",
    "profile_image": "https://ssl.pstatic.net/static/pwe/address/nodata_33x33.gif",
    "age": "40-49",
    "gender": "F",
    "id": "32742776",
    "name": "오픈 API",
    "birthday": "10-01"
  }
}
```

그 외에도 발급받은 접근 토큰으로 네이버에서 제공하는 다양한 오픈 API를 호출해 결과를 얻을 수 있습니다.

### 1.7. 접근 토큰 갱신

발급받은 접근 토큰은 사용자의 인증을 대신하며 오픈 API를 사용하기 위한 인증값으로 사용됩니다.
OAuth 접근 토큰은 영구적으로 존재하는 값은 아니며 유효 기간이 있습니다. 유효 기간은 접근 토큰을 발급받을 때 같이 전달받는 정보 중 expires_in의 값에 설정돼 있습니다. 유효 기간이 지난 토큰은 더 이상 인증 용도로 사용할 수 없으며 인증 토큰을 새로 발급받거나 갱신 토큰을 이용해 접근 토큰을 갱신해야 합니다.

1.7.1. 접근 토큰 갱신 요청문 형식

```
https://nid.naver.com/oauth2.0/token?grant_type=refresh_token&client_id={클라이언트 아이디}&client_secret={클라이언트 시크릿}&refresh_token={갱신 토큰}
```

- grant_type: 인증 과정에 대한 구분값. refresh_token으로 값이 고정돼 있습니다.
- client_id: 애플리케이션 등록 후 발급받은 클라이언트 아이디
- client_secret: 애플리케이션 등록 후 발급받은 클라이언트 시크릿
- refresh_token: 네이버 사용자 인증에 성공하고 발급받은 갱신 토큰

접근 토큰 갱신 요청에 성공하면 다음과 같은 JSON 형식의 결괏값을 반환받습니다.

```
{
    "access_token": "AAAAQjbRkysCNmMdQ7kmowPrjyRNIRYKG2iGHhbGawP0xfuYwjrE2WTI3p44SNepkFXME/NlxfamcJKPmUU4dSUhz+R2CmUqnN0lGuOcbEw6iexg",
    "token_type": "bearer",
    "expires_in": "3600"
}
```

### 1.8. 토큰 폐기

발급받은 접근 토큰을 더 이상 사용하지 않거나 사용자가 애플리케이션과의 연동을 해제할 때에는 토큰 폐기 API를 호출합니다. 접근 토큰(access_token) 또는 갱신 토큰(refresh_token)을 폐기할 수 있으며, 한 토큰이 폐기되면 연결된 쌍의 토큰도 함께 폐기됩니다.

1.8.1. 토큰 폐기 요청문 형식

```
curl -X POST "https://nid.naver.com/oauth2.0/revoke" \
     -d "client_id={클라이언트 아이디}" \
     -d "client_secret={클라이언트 시크릿}" \
     -d "token={폐기 대상 토큰}" \
     -d "token_type_hint=access_token"
```

- client_id: 애플리케이션 등록 후 발급받은 클라이언트 아이디
- client_secret: 애플리케이션 등록 후 발급받은 클라이언트 시크릿
- token: 폐기 대상 토큰 (access_token 또는 refresh_token)
- token_type_hint: 폐기 대상 토큰의 타입 힌트. access_token 또는 refresh_token. 미지정 시 access_token으로 간주합니다.

토큰 폐기 요청이 정상 처리되면 본문 없이 HTTP 200을 반환합니다. 클라이언트는 응답 본문이 아닌 HTTP 상태 코드를 기준으로 결과를 판단해야 합니다.

## 2. JavaScript로 네이버 로그인 적용하기

네이버 로그인은 손쉽게 웹 애플리케이션에 네이버 로그인을 적용할 수 있게 JavaScript용 네이버 로그인 라이브러리를 제공합니다. JavaScript용 라이브러리를 사용하면 HTML 페이지 내부에 JavaScript 코드를 삽입하는 것만으로도 네이버 로그인을 적용할 수 있습니다.

- [JavaScript용 네이버 로그인 라이브러리 다운로드 >](/docs/login/sdks)

### 2.1. 요구 사항

네이버 로그인 라이브러리는 jQuery 프레임워크와 jQuery Cookie 플러그인을 사용합니다.
네이버 로그인 라이브러리를 사용하려면 다음과 같은 환경이 필요합니다.

- jQuery 1.10.0 이상

jQuery와 네이버 로그인 라이브러리를 로그인 버튼이 있는 페이지는 물론 콜백을 처리하는페이지 등 네이버 로그인을 사용하는 페이지에 모두 적용합니다.
네이버 로그인 라이브러리는 URL을 웹 페이지에 추가하거나.js 파일을 다운로드해 웹 페이지에 추가할 수 있습니다.

다음은 URL로 웹 페이지에 네이버 로그인 라이브러리를 적용한 코드 예입니다.

2.1.1. 네이버 로그인 라이브러리 적용 샘플코드

```html
<html lang="ko">
<head>
<script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
</head>
<body>
<!-- 네이버 로그인 버튼 노출 영역 -->
<div id="naver_id_login"></div>
<!-- //네이버 로그인 버튼 노출 영역 -->

<!-- 네이버아디디로로그인 초기화 Script -->
<script type="text/javascript">
	var naver_id_login = new naver_id_login("등록한 ClientID 값", "등록한 Callback URL 값");
	var state = naver_id_login.getUniqState();
	naver_id_login.setButton("white", 2,40);
	naver_id_login.setDomain(".service.com");
	naver_id_login.setState(state);
	naver_id_login.setPopup();
	naver_id_login.init_naver_id_login();
</script>
<!-- // 네이버 로그인 초기화 Script -->
</body>
</html>
```

### 2.2. 기본 설정

JavaScript용 라이브러리를 적용하면 단순히 로그인 함수를 호출하는 것만으로 네이버 로그인 연동을 수행할 수 있습니다. 로그인 버튼을 추가하고 로그인 버튼에 대한 이벤트를 등록하면 사용자가 버튼을 클릭할 때 로그인 페이지로 자동으로 이동합니다.
로그인 버튼 이미지는 "네이버 로그인 버튼 사용 가이드" 페이지에서 다운로드할 수 있습니다.
로그인 버튼을 수정해서 사용할 때는 사용 가이드에 제시된 디자인을 최대한 유지하는 것을 권장합니다.

- [네이버 로그인 버튼 이미지 다운로드 >](/docs/login/bi)

다음은 웹 페이지에 로그인 버튼을 추가하고 로그인 함수를 호출하는 코드 예입니다. {YOUR_CLIENT_ID}는 애플리케이션을 등록하고 발급받은 클라이언트 아이디입니다. {YOUR_REDIRECT_URL}는 애플리케이션을 등록할 때 Callback URL에 설정한 URL입니다.사이트 간 요청 위조를 방지하기 위해 상태 토큰을 생성하는 코드도 추가됐습니다.

2.2.1. client_id 와 redirect_uri 등록

JavaScript용 라이브러리 동작에 필요한 기본정보를 설정하는 코드를 추가합니다. 이 작업을 위해서는 "내 애플리케이션 등록(Client 등록)" 과정이 선행되어야 합니다.

```
var naver_id_login = new naver_id_login("등록한 ClientID 값", "등록한 Callback URL 값");
naver_id_login.init_naver_id_login();
```

2.2.2. 네이버 로그인 버튼 생성

JavaScript용 라이브러리는 네이버 로그인 버튼을 자동으로 생성해주는 스크립트 기능이 포함되어있습니다. 사용 가능한 로그인 버튼은 크기별 3가지 색상별 2가지씩 총 6가지가 제공되며 각각 스크립트 내에 아래와 같은 설정으로 세팅이 가능합니다.

```
<div id="naver_id_login"></div>  <!-- 버튼이 들어갈 위치 선언-->

<script type="text/javascript">
	var naver_id_login = new naver_id_login("등록한 ClientID 값", "등록한 Callback URL 값");
	naver_id_login.setButton("white", 1,40); //네이버 로그인 버튼 설정
	naver_id_login.init_naver_id_login();
</script>
```

사용 가능한 Option

버튼 색상 : white, green

크기 : 1(버튼형), 2(작은 배너), 3(큰 배너)

배너 및 버튼 높이 : 사용자 지정값

2.2.3. 네이버 로그인 Popup 설정

네이버 로그인 인증 창을 Popup 형태로 노출하기 위해서 아래와 같이 코드를 추가합니다.

```
<script type="text/javascript">
	var naver_id_login = new naver_id_login("등록한 ClientID 값", "등록한 Callback URL 값");
	naver_id_login.setPopup(); //Popup형태의 인증 진행
	naver_id_login.init_naver_id_login();
</script>
```

2.2.4. 상태 토큰 비교를 위한 Subdomain 설정

callback url과 로그인 버튼이 있는 url의 subdomain이 다르다면 상태 토큰 비교 시 문제가 발생할 수 있습니다.

예)

sub1.service.com/login.html 페이지에 네이버 로그인 버튼이 존재하고

sub2.service.com/callback.html 페이지에 네이버 로그인 CallBack 이 존재 하는 경우

상태 토큰은 cookie로 전달 하므로 cookie를 양쪽 domain에서 참조하기 위해서는 아래와 같이 코드를 추가합니다.

```
<script type="text/javascript">
	var naver_id_login = new naver_id_login("등록한 ClientID 값", "등록한 Callback URL 값");
	naver_id_login.setDomain(".service.com"); //상태 토큰 비교를 위한 domain 설정
	naver_id_login.init_naver_id_login();
</script>
```

### 2.3. 인증 시작하기

JavaScript용 라이브러리는 단순히 로그인 함수를 호출하는 것만으로 '네이버 로그인' 연동을 수행할 수 있습니다. 생성된 로그인 버튼을 사용자가 클릭할 경우 자동으로 로그인 페이지로 이동됩니다.
로그인 인증 과정을 거치면 기본설정에서 설정한 콜백 URL (RedirectURL)로 인증 정보가 전송이 됩니다.
JavaScript용 라이브러리는 콜백 URL을 통해 전달된 인증정보를 받아 자동으로 다음 단계를 처리할 수 있습니다.

다음은 콜백 처리를 위해 콜백 페이지에 설정하는 코드의 예입니다.

```html
<html lang="ko">
<head>
<script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
<!-- 네이버 로그인 버튼 노출 영역 -->
<div id="naver_id_login"></div>
<!-- //네이버 로그인 버튼 노출 영역 -->

<!-- 네이버아디디로로그인 초기화 Script -->
<script type="text/javascript">
	var naver_id_login = new naver_id_login("등록한 ClientID 값", "등록한 Callback URL 값");
	var state = naver_id_login.getUniqState();
	naver_id_login.setButton("white", 2,40);
	naver_id_login.setDomain(".service.com");
	naver_id_login.setState(state);
	naver_id_login.setPopup();
	naver_id_login.init_naver_id_login();
</script>
<!-- //네이버아디디로로그인 초기화 Script -->

<!-- 네이버아디디로로그인 Callback페이지 처리 Script -->
<script type="text/javascript">
	// 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
	function naverSignInCallback() {
		// naver_id_login.getProfileData('프로필항목명');
		// 프로필 항목은 개발가이드를 참고하시기 바랍니다.
		alert(naver_id_login.getProfileData('email'));
		alert(naver_id_login.getProfileData('nickname'));
		alert(naver_id_login.getProfileData('age'));
	}

	// 네이버 사용자 프로필 조회
	naver_id_login.get_naver_userprofile("naverSignInCallback()");
</script>
<!-- //네이버아디디로로그인 Callback페이지 처리 Script -->
</body>
</html>
```

### 2.4. 네이버 로그인 인증 과정

앞서 과정을 모두 적용하면 로그인 버튼을 클릭하여 사용자 인증을 수행하고 최종적으로 사용자 인증 토큰을 발급받는 과정까지 수행할 수 있는 설정이 완료 됩니다.
사용자 인증 과정은 사용자의 브라우저에서 수행되는 과정으로 네이버 로그인 인증 과정이 포함됩니다.
로그인 인증 과정은 1.3 네이버 로그인 인증에서와 같이 페이지 이동 또는 팝업과 같은 형태로 제공이 됩니다.

### 2.5. 접근 토큰 요청

사용자가 정상적으로 로그인 인증을 수행하면 콜백 URL로 인증 정보가 전달되며 콜백 페이지의 코드가 동작하여 접근 토큰 정보를 자동으로 획득하게 됩니다. SDK의 naver_id_login.getAccessToken() 함수를 통해 AccessToken 정보를 발급받을 수 있으며 발급받은 정보는 별도로 저장하여 이후 오픈 API호출 시 사용하도록 합니다.

> 
> 주의
> 콜백 URL과 네이버 로그인 로그인 버튼이 붙은 페이지의 도메인이 서로 다른 경우, 자동으로 처리하는 상태 토큰 비교가 오동작할 수 있습니다. 이 경우 추가 처리가 필요합니다.
> 
> 로그인 버튼이 붙은 페이지의 domain 은 wwww.service.com 이고,
> 
> 콜백 URL로 설정된 페이지는 callback.service.com 인 경우
> 
> 2.2 기본 설정 및 2.3 인증 시작하기에서 아래 구문을 추가하면 문제가 해결됩니다.
> naver_id_login.setDomain(".service.com");
> 

### 2.6. 오픈 API 실행

발급받은 접근 토큰을 이용하여 네이버에서 제공하는 다양한 오픈 API를 호출해 결과를 얻을 수 있습니다.
다음은 사용자 기본 정보(메일 주소, 별명, 프로필 사진, 생일, 연령대)를 조회하는 API 호출의 예입니다.

2.6.1오픈 API 호출 코드 예

```
<script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- 네이버아디디로로그인 초기화 Script는 2.1.1.을 참고 -->
<!-- 네이버아디디로로그인 Callback 페이지 처리 Script -->
<script type="text/javascript">
	// 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
	function naverSignInCallback() {
		// naver_id_login.getProfileData('프로파일항목명');
		// 프로필 항목은 개발가이드를 참고하시기 바랍니다.
		alert(naver_id_login.getProfileData('email'));
		alert(naver_id_login.getProfileData('nickname'));
		alert(naver_id_login.getProfileData('age'));
	}

	// 네이버 사용자 프로필 조회
	naver_id_login.get_naver_userprofile("naverSignInCallback()");
</script>
<!-- //네이버아디디로로그인 Callback 페이지 처리 Script -->
```

## 3. Java / Spring Boot, OAuth2으로 OIDC 적용시

OIDC를 구현하고 하고 있는 client framework중 spring security의 OAuth2를 사용하는 경우 적용 예 입니다.

### 3.1. 요구 사항 및 의존성 추가

Java 17 이상, Spring boot 3.x 이상

#### gradle 의존성

```
implementation 'org.springframework.boot:spring-boot-starter-security'
implementation 'org.springframework.boot:spring-boot-starter-oauth2-client'
```

### 3.2. Spring Boot 설정

application.yml 또는 application.properties 설정
Spring Security는 설정 파일에서 OIDC 제공자 정보를 읽어 자동으로 연동합니다.

application.yml 또는 application.properties 설정
Spring Security는 설정 파일에서 OIDC 제공자 정보를 읽어 자동으로 연동합니다.

```
spring:
  security:
    oauth2:
      client:
        registration:
          naver:  # 제공자 이름 (임의로 지정 가능)
            provider: naver
            client-id: your-naver-client-id
            client-secret: your-naver-client-secret
            scope: openid,profile
            client-authentication-method: client_secret_post
            authorization-grant-type: authorization_code
            redirect-uri: https://example.com/login/oauth2/code/{registrationId} # 개발자센터에 해당 URL 등록 https://example.com/login/oauth2/code/naver
            scope: openid, profile
        provider:
          naver:
            issuer-uri: https://nid.naver.com  # Naver의 Issuer URI
```

기본 설정
Spring Boot는 최소 설정으로 OIDC를 자동 구성합니다. 기본 동작:
/login 경로로 접근 시 OIDC 제공자의 로그인 페이지로 리디렉션.
인증 후 기본 리디렉션 경로는 /.
사용자 정의 설정

Spring Boot 3.x (SecurityFilterChain 사용)
Spring Boot 3.x에서는 WebSecurityConfigurerAdapter가 제거되었으므로, SecurityFilterChain을 사용합니다:

```java
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.web.SecurityFilterChain;

@Configuration
public class SecurityConfig {
    @Bean
    public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {
        http
            .authorizeHttpRequests(authorize -> authorize
                .requestMatchers("/public/**").permitAll()
                .anyRequest().authenticated()
            )
            .oauth2Login(oauth2 -> oauth2
                .loginPage("/login")
                .defaultSuccessUrl("/home", true)
            )
            .logout(logout -> logout
                .logoutSuccessUrl("/login?logout")
            );
        return http.build();
    }
    @Bean
	OAuth2UserService<OidcUserRequest, OidcUser> oAuth2UserService() {
		OidcUserService oidcUserService = new OidcUserService();
		oidcUserService.setOauth2UserService(new NaverOAuth2UserService());
		return oidcUserService;
	}
}
```

access token으로 사용자 정보 요청처리를 하는 NaverOAuth2UserService 클래스를 추가합니다.

```java
public class NaverOAuth2UserService extends DefaultOAuth2UserService {
	private final RestClient restClient = RestClient.create();
	public NaverOAuth2UserService() {
		super();
	}
	@Override
	public OAuth2User loadUser(OAuth2UserRequest userRequest) throws OAuth2AuthenticationException {
		if (userRequest.getClientRegistration().getRegistrationId().equals("naver")) {
			String userInfoUri = userRequest.getClientRegistration()
				.getProviderDetails()
				.getUserInfoEndpoint()
				.getUri();
			String tokenValue = userRequest.getAccessToken()
				.getTokenValue();
			ResponseEntity<NaverUserInfoDto> response = restClient.get()
				.uri(userInfoUri)
				.headers(httpHeaders -> httpHeaders.setBearerAuth(tokenValue))
				.retrieve()
				.toEntity(NaverUserInfoDto.class);
			if (response.hasBody()) {
				NaverUserInfoDto oauthResponse = response.getBody();
                if (oauthResponse != null && oauthResponse.response() instanceof Map userAttributes) {
					userAttributes.computeIfAbsent(StandardClaimNames.SUB, key -> userAttributes.get("id"));
					userAttributes.remove("id");
					Set<GrantedAuthority> authorities = new LinkedHashSet<>();
					authorities.add(new OAuth2UserAuthority(userAttributes));
					OAuth2AccessToken token = userRequest.getAccessToken();
					for (String authority : token.getScopes()) {
						authorities.add(new SimpleGrantedAuthority("SCOPE_" + authority));
					}
					return new DefaultOAuth2User(authorities, userAttributes, "name");
				}
			}
		}
		return super.loadUser(userRequest);
	}
	private record NaverUserInfoDto(
		String resultcode,
		String message,
		Map response) {
	}
}
```

### 3.3. 동작 확인

애플리케이션을 실행합니다.
브라우저에서 http://localhost:8080에 접속하면 /login으로 리디렉션되고, 네이버 로그인 페이지로 이동합니다.
로그인 후 /home으로 리디렉션되며, 인증된 사용자 정보는 SecurityContextHolder에서 확인 가능합니다.
사용자 정보 확인 예시

```java
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.security.oauth2.core.oidc.user.OidcUser;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class HomeController {
    @GetMapping("/home")
    public String home(@AuthenticationPrincipal OidcUser user) {
        return "Welcome, " + user.getSubject() + ", profile : " + user.getProfile();
    }
}
```
