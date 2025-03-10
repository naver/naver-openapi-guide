# 네이버 로그인 API 명세

네이버 로그인 API는 네이버 로그인 인증 요청 API, 접근 토큰 발급/갱신/삭제 요청API로 구성되어 있습니다. 네이버 로그인 인증 요청 API는 여러분의 웹 또는 앱에 네이버 로그인 화면을 띄우는 API입니다. 이용자가 네이버 회원 인증에 성공하면 API로부터 받은 code 값을 이용해서 접근 토큰 발급 요청 API를 호출합니다. 접근 토큰 발급 요청 API를 통해 받은 접근 토큰(access token) 값은 다음과 같이 회원 프로필 조회를 비롯하여 여러가지 로그인 오픈 API를 호출하는데 사용할 수 있습니다.

로그인 오픈 API : 접근 토큰값을 이용해 호출 가능한 API 들로서 HTTP로 호출할 때 Header에 접근 토큰(access token)과 함께 애플리케이션 등록 시 발급받은 [Client ID와 Client Secret 값을 같이 전송](https://developers.naver.com/docs/common/apicall)해 주시면 활용 가능합니다.

* 회원 프로필 조회하기
* 카페 가입 / 글쓰기
* 캘린더 일정 생성하기
    
    
<div class="buttons2">
    <a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?api=nvlogin">오픈 API 이용 신청하기 &gt;</a>
</div>


## API 호출 예제

예제 실행 전에 아래 *1.준비사항* 항목들을 꼭 체크하시길 바랍니다.

### JavaScript

네이버 로그인 JavaScript 예제는 2개의 파일로 구성되어 있습니다. (naverlogin.html, callback.html)

#### 1. APIExamNaverLogin.html

```html
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
```

#### 2. callback.html

```html
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


### JSP

네이버 로그인 접근토큰 획득 예제는 2개의 프로그램으로 구성되어 있습니다. (naverlogin.jsp, callback.jsp)

#### 1. naverlogin.jsp

```java
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
    String apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code";
    apiURL += "&client_id=" + clientId;
    apiURL += "&redirect_uri=" + redirectURI;
    apiURL += "&state=" + state;
    session.setAttribute("state", state);
 %>
  <a href="<%=apiURL%>"><img height="50" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>
  </body>
</html>
```


#### 2. callback.jsp
```java
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
    String apiURL;
    apiURL = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&";
    apiURL += "client_id=" + clientId;
    apiURL += "&client_secret=" + clientSecret;
    apiURL += "&redirect_uri=" + redirectURI;
    apiURL += "&code=" + code;
    apiURL += "&state=" + state;
    String access_token = "";
    String refresh_token = "";
    System.out.println("apiURL="+apiURL);
    try {
      URL url = new URL(apiURL);
      HttpURLConnection con = (HttpURLConnection)url.openConnection();
      con.setRequestMethod("GET");
      int responseCode = con.getResponseCode();
      BufferedReader br;
      System.out.print("responseCode="+responseCode);
      if(responseCode==200) { // 정상 호출
        br = new BufferedReader(new InputStreamReader(con.getInputStream()));
      } else {  // 에러 발생
        br = new BufferedReader(new InputStreamReader(con.getErrorStream()));
      }
      String inputLine;
      StringBuffer res = new StringBuffer();
      while ((inputLine = br.readLine()) != null) {
        res.append(inputLine);
      }
      br.close();
      if(responseCode==200) {
        out.println(res.toString());
      }
    } catch (Exception e) {
      System.out.println(e);
    }
  %>
  </body>
</html>
```


### PHP

네이버 로그인 접근토큰 획득 예제는 2개의 파일로 구성되어 있습니다. (naverlogin.php, callback.php)

#### 1. naverlogin.php

```php
<?php
  // 네이버 로그인 접근토큰 요청 예제
  $client_id = "YOUR_CLIENT_ID";
  $redirectURI = urlencode("YOUR_CALLBACK_URL");
  $state = "RAMDOM_STATE";
  $apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;
?><a href="<?php echo $apiURL ?>"><img height="50" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>
```

#### 2. callback.php

```php
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
  echo "status_code:".$status_code."
";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?>
```

### Node.js

네이버 로그인 Node.js 예제는 1개의 파일로 로그인요청 및 콜백 처리를 모두합니다.

```javascript
var express = require('express');
var app = express();
var client_id = 'YOUR_CLIENT_ID';
var client_secret = 'YOUR_CLIENT_SECRET';
var state = "RAMDOM_STATE";
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

### ASP.NET

네이버 로그인 접근토큰 획득 예제는 3개의 파일로 구성되어 있습니다. (naverlogin.aspx, callback.aspx, callback.aspx.cs)

#### 1. naverlogin.aspx

```sh
<%@ Page Language="C#" AutoEventWireup="true" %>
<!DOCTYPE html>
<script runat="server">
    String getNaverLoginURL()
    {
        string clientId = "YOUR-CLIENT-ID";
        string redirectURI = "YOUR-CALLBACK-URL";
        string state = "RAMDOM_STATE";
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
```

#### 2. callback.aspx

```sh
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
```

#### 3. callback.aspx.cs

```sh
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


## 1. 준비사항

* 애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 ['Application-애플리케이션 등록'](https://developers.naver.com/apps/#/register?api=nvlogin") 메뉴에서 애플리케이션을 등록하셔야 합니다. <br>[[자세한 방법 보기]](https://developers.naver.com/docs/common/register")
* 클라이언트 ID와 secret 확인: ['내 애플리케이션'](https://developers.naver.com/appinfo")에서 등록한 애플리케이션을 선택하면 Client ID와 Client Secret 값을 확인할 수 있습니다.
* API 권한 설정: ['내 애플리케이션'](https://developers.naver.com/appinfo")의 'API 권한관리' 탭에서 사용하려는 API가 체크되어 있는지 확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.

## 2. API 기본 정보

|메서드|인증|요청 URL|출력 포맷|설명|
|-|-|----|-|--|
|GET / POST|OAuth 2.0|https://nid.naver.com/oauth2.0/authorize|URL 리다이렉트|네이버 로그인 인증 요청|
|GET / POST|OAuth 2.0|https://nid.naver.com/oauth2.0/token|json|접근 토큰 발급/갱신/삭제 요청|



## 3. 요청 변수

### 3.1. 네이버 로그인 인증 요청

|요청 변수명|타입|필수 여부|기본값|설명|
|--|--|-|-|---|
|response_type|string|Y|code|인증 과정에 대한 내부 구분값으로 'code'로 전송해야 함|
|client_id|string|Y|-|애플리케이션 등록 시 발급받은 Client ID 값|
|redirect_uri|string|Y|-|애플리케이션을 등록 시 입력한 Callback URL 값으로 URL 인코딩을 적용한 값|
|state|string|Y|-|사이트 간 요청 위조(cross-site request forgery) 공격을 방지하기 위해 애플리케이션에서 생성한 상태 토큰값으로 URL 인코딩을 적용한 값을 사용|
|scope|string|N|-|접근 허용 범위를 처리하기 위한 내부 구분값으로 전송할 필요 없음|

### 3.2. 접근 토큰 발급/갱신/삭제 요청

***접근 토큰 갱신 / 삭제 요청시 access_token 값은 URL 인코딩하셔야 합니다***

***로그아웃 관련***

네이버 로그아웃에 대한 별도의 api가 없으며 사용자가 직접 네이버 서비스에서 로그아웃 하도록 처리하셔야 합니다.
이유는 이용자 보호를 위해 정책상 네이버 이외의 서비스에서 네이버 로그아웃을 수행하는 것을 허용하지 않고 있는 점 양해 부탁드립니다.

***로그인 연동 해제 관련***

로그인 연동해제를 할 경우 입력한 토큰이 유효한 토큰일 경우 정상적으로 연동해제가 됩니다.
주의 하실 점은 토큰이 유효하지 않을 경우에도 결과가 'success'값으로 리턴되므로 토큰이 유효한지 먼저 검증한 다음 유효한 토큰으로 갱신하여 연동해제 처리를 하시면 됩니다.
연동해제를 확인하려면 delete token 이후, 기존 발급 refresh token을 이용하여 더이상 token refresh를 할 수 없을 경우 정상 연동해지가 되었다고 판단하시는 방법이 있습니다.

|요청 변수명|타입|필수 여부|기본값|설명|
|--|--|-|-|---|
|grant_type|string|Y|code|인증 과정에 대한 구분값 <br>1. 발급:'authorization_code' <br> 2. 갱신:'refresh_token'<br>3. 삭제: 'delete'|
|client_id|string|Y|-|애플리케이션 등록 시 발급받은 Client ID 값|
|client_secret|string|Y|-|애플리케이션 등록 시 발급받은 Client secret 값|
|code|string|발급 때 필수|-|로그인 인증 요청 API 호출에 성공하고 리턴받은 인증코드값 (authorization code)|
|state|string|발급 때 필수|-|사이트 간 요청 위조(cross-site request forgery) 공격을 방지하기 위해 애플리케이션에서 생성한 상태 토큰값으로 URL 인코딩을 적용한 값을 사용|
|refresh_token|string|갱신 때 필수|-|네이버 사용자 인증에 성공하고 발급받은 갱신 토큰(refresh token)|
|access_token|string|삭제 때 필수|-|발급받은 접근 토큰으로 *URL 인코딩*을 적용한 값을 사용|
|service_provider|string|삭제 때 필수|'NAVER'|인증 제공자 이름으로 'NAVER'로 세팅해 전송|

## 4. 출력 결과

### 4.1. 네이버 로그인 인증 요청

네이버 로그인 인증 요청 API를 호출했을 때 사용자가 네이버로 로그인하지 않은 상태이면 네이버 로그인 화면으로 이동하고, 사용자가 네이버에 로그인한 상태이면 기본 정보 제공 동의 확인 화면으로 이동합니다. 네이버 로그인과 정보 제공 동의 과정이 완료되면 콜백 URL에 code값과 state 값이 URL 문자열로 전송됩니다. code 값은 접근 토큰 발급 요청에 사용합니다. API 요청 실패시에는 에러 코드와 에러 메시지가 전송됩니다.

* API 요청 성공시 : `http://콜백URL/redirect?code={code값}&state={state값}`
* API 요청 실패시 : `http://콜백URL/redirect?state={state값}&error={에러코드값}&error_description={에러메시지}`</li>

|필드|타입|설명|
|---|---|---|
|code|string|네이버 로그인 인증에 성공하면 반환받는 인증 코드, 접근 토큰(access token) 발급에 사용|
|state|string|사이트 간 요청 위조 공격을 방지하기 위해 애플리케이션에서 생성한 상태 토큰으로 URL 인코딩을 적용한 값|
|error|string|네이버 로그인 인증에 실패하면 반환받는 에러 코드|
|error_description|string|네이버 로그인 인증에 실패하면 반환받는 에러 메시지|


### 4.2. 접근 토큰 발급 요청

|필드|타입|설명|
|--|----|----|
|access_token|string|접근 토큰, 발급 후 expires_in 파라미터에 설정된 시간(초)이 지나면 만료됨|
|refresh_token|string|갱신 토큰, 접근 토큰이 만료될 경우 접근 토큰을 다시 발급받을 때 사용|
|token_type|string|접근 토큰의 타입으로 Bearer와 MAC의 두 가지를 지원|
|expires_in|integer|접근 토큰의 유효 기간(초 단위)|
|error|string|에러 코드|
|error_description|string|에러 메시지|

### 4.3. 접근 토큰 갱신 요청

|필드|타입|설명|
|--|----|----|
|access_token|string|접근 토큰, 발급 후 expires_in 파라미터에 설정된 시간(초)이 지나면 만료됨|
|token_type|string|접근 토큰의 타입으로 Bearer와 MAC의 두 가지를 지원|
|expires_in|integer|접근 토큰의 유효 기간(초 단위)|
|error|string|에러 코드|
|error_description|string|에러 메시지|

### 4.4. 접근 토큰 삭제 요청

|필드|타입|설명|
|--|----|----|
|access_token|string|삭제 처리된 접근 토큰 값|
|result|string|처리 결과가 성공이면 'success'가 리턴|
|expires_in|integer|접근 토큰의 유효 기간(초 단위)|
|error|string|에러 코드|
|error_description|string|에러 메시지|


 ## 5. 에러 코드
 
공통 에러 코드는 [여기](https://developers.naver.com/docs/common/openapiguide/errorcode.md)를 참조하세요.

|HTTP 코드|에러 코드|에러 메시지|조치 방안|
|-|--|---|---|
|401|024|Authentication failed / 인증에 실패했습니다.||
|401|028|Authentication header not exists / OAuth 인증 헤더(authorization header)가 없습니다.||
|403|403|Forbidden / 호출 권한이 없습니다.|API 요청 헤더에 클라이언트 ID와 Secret 값을 정확히 전송했는지 확인해보시길 바랍니다.|
|404|404|Not Found / 검색 결과가 없습니다.|-|
|500|500|Internal Server Error / 데이터베이스 오류입니다.|서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다.|
|-|invalid_request|파라미터가 잘못되었거나 요청문이 잘못되었습니다.|-|
|-|unauthorized_client|인증받지 않은 인증 코드(authorization code)로 요청했습니다.|-|
|-|unsupported_response_type|정의되지 않은 반환 형식으로 요청했습니다.|-|
|-|server_error|네이버 인증 서버의 오류로 요청을 처리하지 못했습니다.|-|

## 6. 예시

### 6.1. 요청 예시

AccessToken 값은 일부 특수문자가 포함되어 있기 때문에 GET Parameter를 통하여 데이터를 전달하는 경우, AccessToken 값을 반드시 URL Encode 처리한 후에 전송하여야합니다.

#### 6.1.1. 네이버 로그인 인증 요청

```sh
https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=jyvqXeaVOVmV&redirect_uri=http%3A%2F%2Fservice.redirect.url%2Fredirect&state=hLiDdL2uhPtsftcU
```

#### 6.1.2. 접근 토큰 발급 요청

```
https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=jyvqXeaVOVmV&client_secret=527300A0_COq1_XV33cf&code=EIc5bFrl4RibFls1&state=9kgsGTfH4j7IyAkg
```

#### 6.1.3. 접근 토큰 갱신 요청

```
https://nid.naver.com/oauth2.0/token?grant_type=refresh_token&client_id=jyvqXeaVOVmV&client_secret=527300A0_COq1_XV33cf&refresh_token=c8ceMEJisO4Se7uGCEYKK1p52L93bHXLn
```

#### 6.1.4. 접근 토큰 삭제 요청

```
https://nid.naver.com/oauth2.0/token?grant_type=delete&client_id=jyvqXeaVOVmV&client_secret=527300A0_COq1_XV33cf&access_token=c8ceMEJisO4Se7uGCEYKK1p52L93bHXLnaoETis9YzjfnorlQwEisqemfpKHUq2gY&service_provider=NAVER
```

### 6.2 응답 예시

#### 6.2.1. 네이버 로그인 인증 요청

```
http://콜백URL/redirect?code={code값}&state={state값}

```

#### 6.2.2. 접근 토큰 발급 요청

```json
{
    "access_token":"AAAAQosjWDJieBiQZc3to9YQp6HDLvrmyKC+6+iZ3gq7qrkqf50ljZC+Lgoqrg",
    "refresh_token":"c8ceMEJisO4Se7uGisHoX0f5JEii7JnipglQipkOn5Zp3tyP7dHQoP0zNKHUq2gY",
    "token_type":"bearer",
    "expires_in":"3600"
}
```

#### 6.2.3. 접근 토큰 갱신 요청

````json
{
    "access_token":"AAAAQjbRkysCNmMdQ7kmowPrjyRNIRYKG2iGHhbGawP0xfuYwjrE2WTI3p44SNepkFXME/NlxfamcJKPmUU4dSUhz+R2CmUqnN0lGuOcbEw6iexg",
    "token_type":"bearer",
    "expires_in":"3600"
}
````

#### 6.2.4. 접근 토큰 삭제 요청
````json
{
    "access_token":"c8ceMEjfnorlQwEisqemfpM1Wzw7aGp7JnipglQipkOn5Zp3tyP7dHQoP0zNKHUq2gY",
    "result":"success"
}
````

