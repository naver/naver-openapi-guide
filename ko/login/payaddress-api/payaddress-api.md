# 네이버 페이 배송지 정보 조회 API

<html lang="ko">
<head>
    <title>NAVER Developers - 네이버 페이 배송지 정보 조회 API 개발가이드 </title>
    <meta name="description" content="NAVER Developers - 네이버 페이 배송지 정보 조회 API 개발가이드">
</head>
<body>


네이버 페이에 등록한 배송지 정보를 조회할수 있는 로그인 오픈 API입니다. 기존 REST API처럼 요청 URL과 요청 변수로 호출하는 방법은 동일하나, OAuth 2.0 인증 기반이므로 추가적으로 <a class="color_p2 underline" href="/api/api.md">네이버 로그인 API</a>를 통해 접근 토큰(access token)을 발급받아,
        HTTP로 호출할 때 Header에 접근 토큰을 같이 전송해 주시면 활용 가능합니다.

<a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?api=cafe">오픈 API 이용 신청 &gt;</a>


### API 호출 예제
예제 실행 전에 아래 <em class="color_p3">1.준비사항</em> 항목들을 꼭 체크하시길 바랍니다.

### JAVA
```java
// 네이버 API 예제 - 네이버 페이 배송지 정보 조회
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Map;
public class ApiExamMemberProfile {
    public static void main(String[] args) {
        String token = "YOUR_ACCESS_TOKEN"; // 네이버 로그인 접근 토큰;
        String header = "Bearer " + token; // Bearer 다음에 공백 추가
        String apiURL = "https://openapi.naver.com/v1/nid/payaddress";

        Map<String, String> requestHeaders = new HashMap<>();
        requestHeaders.put("Authorization", header);
        String responseBody = get(apiURL,requestHeaders);
        System.out.println(responseBody);
    }

    private static String get(String apiUrl, Map<String, String> requestHeaders){
        HttpURLConnection con = connect(apiUrl);
        try {
            con.setRequestMethod("GET");
            for(Map.Entry<String, String>; header :requestHeaders.entrySet()) {
                con.setRequestProperty(header.getKey(), header.getValue());
            }

            int responseCode = con.getResponseCode();
            if (responseCode == HttpURLConnection.HTTP_OK) { // 정상 호출
                return readBody(con.getInputStream());
            } else { // 에러 발생
                return readBody(con.getErrorStream());
            }
        } catch (IOException e) {
            throw new RuntimeException("API 요청과 응답 실패", e);
        } finally {
            con.disconnect();
        }
    }

    private static HttpURLConnection connect(String apiUrl){
        try {
            URL url = new URL(apiUrl);
            return (HttpURLConnection)url.openConnection();
        } catch (MalformedURLException e) {
            throw new RuntimeException("API URL이 잘못되었습니다. : " + apiUrl, e);
        } catch (IOException e) {
            throw new RuntimeException("연결이 실패했습니다. : " + apiUrl, e);
        }
    }

    private static String readBody(InputStream body){
        InputStreamReader streamReader = new InputStreamReader(body);
        try (BufferedReader lineReader = new BufferedReader(streamReader)) {
            StringBuilder responseBody = new StringBuilder();
            String line;
            while ((line = lineReader.readLine()) != null) {
                responseBody.append(line);
            }
            return responseBody.toString();
        } catch (IOException e) {
            throw new RuntimeException("API 응답을 읽는데 실패했습니다.", e);
        }
    }
}
```

### PHP 

```
// 네이버 API 예제 - 네이버 페이 배송지 정보 조회
<?php
  $token = "YOUR_ACCESS_TOKEN";
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $url = "https://openapi.naver.com/v1/nid/payaddress";
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
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
```

### Node.js

```
// 네이버 API 예제 - 네이버 페이 배송지 정보 조회
var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN";
var header = "Bearer " + token; // Bearer 다음에 공백 추가
app.get('/member', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/nid/payaddress';
   var request = require('request');
   var options = {
       url: api_url,
       headers: {'Authorization': header}
    };
   request.get(options, function (error, response, body) {
     if (!error && response.statusCode == 200) {
       res.writeHead(200, {'Content-Type': 'text/json;charset=utf-8'});
       res.end(body);
     } else {
       console.log('error');
       if(response != null) {
         res.status(response.statusCode).end();
         console.log('error = ' + response.statusCode);
       }
     }
   });
 });
 app.listen(3000, function () {
   console.log('http://127.0.0.1:3000/member app listening on port 3000!');
 });
```

### Python

```
// 네이버 API 예제 - 네이버 페이 배송지 정보 조회
import os
import sys
import urllib.request
token = "YOUR_ACCESS_TOKEN"
header = "Bearer " + token # Bearer 다음에 공백 추가
url = "https://openapi.naver.com/v1/nid/payaddress"
request = urllib.request.Request(url)
request.add_header("Authorization", header)
response = urllib.request.urlopen(request)
rescode = response.getcode()
if(rescode==200):
    response_body = response.read()
    print(response_body.decode('utf-8'))
else:
    print("Error Code:" + rescode)
```

### C#

```
// 네이버 API 예제 - 네이버 페이 배송지 정보 조회
using System;
using System.Net;
using System.Text;
using System.IO;
<br/>
namespace NaverAPI_Guide
{
    public class APIExamMemberProfile
    {
        static void Main(string[] args)
        {
            string token = "YOUR-ACCESS-TOKEN";// 네이버 로그인 접근 토큰;
            string header = "Bearer " + token; // Bearer 다음에 공백 추가
            string apiURL = "https://openapi.naver.com/v1/nid/payaddress";
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(apiURL);
            request.Headers.Add("X-Naver-Client-Id", "YOUR-CLIENT-ID");
            request.Headers.Add("X-Naver-Client-Secret", "YOUR-CLIENT-SECRET");
            request.Headers.Add("Authorization", header);
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            string status = response.StatusCode.ToString();
            if(status == "OK")
            {
                Stream stream = response.GetResponseStream();
                StreamReader reader = new StreamReader(stream, Encoding.UTF8);
                string text = reader.ReadToEnd();
                Console.WriteLine(text);
            }
            else
            {
                Console.WriteLine("Error 발생=" + status);
            }
        }
    }
}
```

### 1. 준비사항

* 애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 <a href="https://developers.naver.com/apps/#/register?api=nvlogin"  class="color_p2 underline">'Application-애플리케이션 등록'</a> 메뉴에서 애플리케이션을 등록하셔야 합니다. 
<br><a href="https://developers.naver.com/docs/common/register"  class="color_p2 underline">[자세한 방법 보기] &gt;</a>
* 클라이언트 ID와 secret 확인: <a href="https://developers.naver.com/appinfo" class="color_p2 underline">'내 애플리케이션'</a>에서 등록한 애플리케이션을 선택하면 Client ID와 Client Secret 값을 확인할 수 있습니다.
* API 권한 설정: <a href="https://developers.naver.com/appinfo" class="color_p2 underline">'내 애플리케이션'</a>의 'API 권한관리' 탭에서 사용하려는 API가 체크되어 있는지 확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.

### 2. API 기본 정보

|메서드| 인증	| 요청 URL|	출력 포맷|	설명|
|---|---|---|---|---|
|GET|	OAuth 2.0|	https://openapi.naver.com/v1/nid/payaddress|JSON|	네이버 페이 배송지 정보 조회|

### 3. 요청 변수

요청 변수는 별도로 없으며, 요청 URL로 호출할 때 아래와 같이 요청 헤더에 접근 토큰 값을 전달하면 됩니다.

### 4. 요청 헤더

| 요청 헤더명 |	설명|
|---|---|
|Authorization|접근 토큰(access token)을 전달하는 헤더<br> 다음과 같은 형식으로 헤더 값에 접근 토큰(access token)을 포함합니다. <br>토큰 타입은 "Bearer"로 값이 고정돼 있습니다. <br>Authorization: {토큰 타입] {접근 토큰]|

#### 요청 헤더 예

```
Authorization: Bearer AAAAOLtP40eH6P5S4Z4FpFl77n3FD5I+W3ost3oDZq/nbcS+7MAYXwXbT3Y7Ib3dnvcqHkcK0e5/rw6ajF7S/QlJAgUukpp1OGkG0vzi16hcRNYX6RcQ6kPxB0oAvqfUPJiJw==
```


### 5. 출력 결과

네이버 페이 배송지 정보는 "네이버 페이" 회원인 경우에만 조회가 가능합니다. 

|필드	|타입	|필수 여부|	설명|
|---|---|---|---|
| result | String | Y| 결과코드 | 
| data | Object| Y| 네이버페이 배송지 정보 |
| data.receiverName | String | Y| 사용자명 | 
| data.zipCode| String | Y| 우편번호 | 
| data.baseAddress| String | Y| 기본주소 |
| data.detailAddress| String | Y| 상세주소 | 
| data.roadNameYn| String| Y| 도로명 주소 Y/N |
| data.telNo| String| Y| 네이버페이 연락처 |


### 6. 에러 코드

| HTTP 코드|에러 코드|에러 메시지|조치 방안|
|---|---|---|---|
| 401|024|Authentication failed / 인증에 실패했습니다.||
| 401|028|Authentication header not exists / OAuth 인증 헤더(authorization header)가 없습니다.|API 요청 헤더에 클라이언트 ID와 Secret 값을 정확히 전송했는지 확인해보시길 바랍니다.|
| 403|403|Forbidden / 호출 권한이 없습니다.|사용자가 권한 제공에 동의를 하지 않은 경우에 해당합니다.|
| 404|404|Not Found / 검색 결과가 없습니다.|-|
| 500|500|Internal Server Error / 데이터베이스 오류입니다.|서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다.|

### 7. 요청 예시


#### REQUEST

```
> GET /v1/nid/payaddress HTTP/2
> Host: openapi.naver.com
> User-Agent: curl/7.64.1
> Accept: */*
> Authorization: Bearer {ACCESS_TOKEN_STRING}

```

#### RESPONSE

```
{
  "result": "success",
  "data": {
    "receiverName": "홍길동",
    "zipCode": "16825",
    "baseAddress": "경기도 성남시 불정로 7",
    "detailAddress": "그린팩토리",
    "roadNameYn": "Y",
    "telNo": "010-0000-0000"
  }
}
```


