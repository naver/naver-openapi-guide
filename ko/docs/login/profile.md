---
title: 네이버 회원 프로필 조회 API 명세
description: 네이버 로그인으로 인증받고 정보 제공에 동의한 회원의 메일 주소, 별명, 프로필 사진, 생일, 연령대 등을 조회할 수 있는 로그인 오픈 API의 명세와 호출 예제를 안내합니다.
---

# 네이버 회원 프로필 조회 API 명세

네이버 로그인을 통해 인증받은 받고 정보 제공에 동의한 회원에 대해 회원 메일 주소, 별명, 프로필 사진, 생일, 연령대 값을 조회할 수 있는 로그인 오픈 API입니다. API 호출 결과로 네이버 아이디값은 제공하지 않으며, 대신 'id'라는 애플리케이션당 유니크한 일련번호값을 이용해서 자체적으로 회원정보를 구성하셔야 합니다. 기존 REST API처럼 요청 URL과 요청 변수로 호출하는 방법은 동일하나, OAuth 2.0 인증 기반이므로 추가적으로 [네이버 로그인 API](/docs/login/api)를 통해 접근 토큰(access token)을 발급받아, HTTP로 호출할 때 Header에 접근 토큰 값을 전송해 주시면 활용 가능합니다.

<div class="ndc-cta">
<a href="/myapps/new">오픈 API 이용 신청 &gt;</a>
</div>

## API 호출 예제

예제 실행 전에 아래 <span class="ndc-color">1.준비사항</span> 항목들을 꼭 체크하시길 바랍니다.

#### Java

```java
// 네이버 API 예제 - 회원프로필 조회
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Map;

public class ApiExamMemberProfile {

    public static void main(String[] args) {
        String token = "YOUR_ACCESS_TOKEN"; // 네이버 로그인 접근 토큰;
        String header = "Bearer " + token; // Bearer 다음에 공백 추가

        String apiURL = "https://openapi.naver.com/v1/nid/me";

        Map<String, String> requestHeaders = new HashMap<>();
        requestHeaders.put("Authorization", header);
        String responseBody = get(apiURL,requestHeaders);

        System.out.println(responseBody);
    }

    private static String get(String apiUrl, Map<String, String> requestHeaders){
        HttpURLConnection con = connect(apiUrl);
        try {
            con.setRequestMethod("GET");
            for(Map.Entry<String, String> header :requestHeaders.entrySet()) {
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

#### PHP

```php
// 네이버 API 예제 - 회원프로필 조회
<?php
  $token = "YOUR_ACCESS_TOKEN";
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $url = "https://openapi.naver.com/v1/nid/me";
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

#### Node.js

```
// 네이버 API 예제 - 회원프로필 조회
var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN";
var header = "Bearer " + token; // Bearer 다음에 공백 추가
app.get('/member', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/nid/me';
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

#### Python

```
// 네이버 API 예제 - 회원프로필 조회
import os
import sys
import urllib.request
token = "YOUR_ACCESS_TOKEN"
header = "Bearer " + token # Bearer 다음에 공백 추가
url = "https://openapi.naver.com/v1/nid/me"
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

#### C#

```java
using System;
using System.Net;
using System.Text;
using System.IO;

namespace NaverAPI_Guide
{
    public class APIExamMemberProfile
    {
        static void Main(string[] args)
        {
            string token = "YOUR-ACCESS-TOKEN";// 네이버 로그인 접근 토큰;
            string header = "Bearer " + token; // Bearer 다음에 공백 추가
            string apiURL = "https://openapi.naver.com/v1/nid/me";
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

## 1. 준비사항

- 애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 ['Application-애플리케이션 등록'](/myapps/new) 메뉴에서 애플리케이션을 등록하셔야 합니다.
  [[자세한 방법 보기] >](/docs/openapiguide/appregister)
- 클라이언트 ID와 secret 확인: ['내 애플리케이션'](/myapps)에서 등록한 애플리케이션을 선택하면 Client ID와 Client Secret 값을 확인할 수 있습니다.
- API 권한 설정: ['내 애플리케이션'](/myapps)의 'API 권한관리' 탭에서 사용하려는 API가 체크되어 있는지 확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.

## 2. API 기본 정보

| 메서드 | 인증 | 요청 URL | 출력 포맷 | 설명 |
| :---: | :---: | :--- | :---: | :--- |
| GET | OAuth 2.0 | https://openapi.naver.com/v1/nid/me | JSON | 네이버 회원 프로필 조회 |

## 3. 요청 변수

요청 변수는 별도로 없으며, 요청 URL로 호출할 때 아래와 같이 요청 헤더에 접근 토큰 값을 전달하면 됩니다.

## 4. 요청 헤더

| 요청 헤더명 | 설명 |
| :---: | :--- |
| Authorization | 접근 토큰(access token)을 전달하는 헤더<br> 다음과 같은 형식으로 헤더 값에 접근 토큰(access token)을 포함합니다. 토큰 타입은 "Bearer"로 값이 고정돼 있습니다. Authorization: {토큰 타입] {접근 토큰] |

### 요청 헤더 예

```
Authorization: Bearer AAAAOLtP40eH6P5S4Z4FpFl77n3FD5I+W3ost3oDZq/nbcS+7MAYXwXbT3Y7Ib3dnvcqHkcK0e5/rw6ajF7S/QlJAgUukpp1OGkG0vzi16hcRNYX6RcQ6kPxB0oAvqfUPJiJw==
```

## 5. 출력 결과

회원의 네이버아이디는 출력결과에 포함되지 않습니다. 대신 프로필조회 api 호출 결과에 포함되는 'id'라는 값을 이용해서 회원을 구분하시길 바랍니다. 'id'값은 각 애플리케이션마다 회원 별로 유니크한 값으로,
같은 네이버 회원이라도 네이버 로그인을 적용한 애플리케이션이 다르면 id값이 다른 점 유념하시길 바랍니다. 또한 가이드상에는 명시안되어 있지만 출력결과에 포함된 'enc_id'라는 값은 내부적으로 쓰는 값이므로 애플리케이션 개발에서 사용할 일이 없다고 보면되겠습니다.

| 필드 | 타입 | 필수 여부 | 설명 |
| :--- | :---: | :---: | :--- |
| resultcode | String | Y | API 호출 결과 코드 |
| message | String | Y | 호출 결과 메시지 |
| response/id | String | Y | 동일인 식별 정보 <br> 네이버 아이디마다 고유하게 발급되는 유니크한 일련번호 값<br> (API 호출 결과로 네이버 아이디값은 제공하지 않으며, 대신 'id'라는 애플리케이션당 유니크한 일련번호값을 이용해서 자체적으로 회원정보를 구성하셔야 합니다.) |
| response/nickname | String | Y | 사용자 별명<br> (별명이 설정되어 있지 않으면 id*** 형태로 리턴됩니다.) |
| response/name | String | Y | 사용자 이름 |
| response/email | String | Y | 사용자 메일 주소<br> 기본적으로 네이버 내정보에 등록되어 있는 '기본 이메일' 즉 네이버ID@naver.com 값이나, 사용자가 다른 외부메일로 변경했을 경우는 변경된 이메일 주소로 됩니다. |
| response/gender | String | Y | 성별 <br>- F: 여성 <br>- M: 남성 <br>- U: 확인불가 |
| response/age | String | Y | 사용자 연령대 |
| response/birthday | String | Y | 사용자 생일(MM-DD 형식) |
| response/profile_image | String | Y | 사용자 프로필 사진 URL |
| response/birthyear | String | Y | 출생연도 |
| response/mobile | String | Y | 휴대전화번호 |

## 6. 에러 코드

공통 에러 코드는 [여기](/docs/openapiguide/errorcode)를 참조하세요.

| HTTP 코드 | 에러 코드 | 에러 메시지 | 조치 방안 |
| :---: | :---: | :--- | :--- |
| <span class="ndc-color">401</span> | 024 | Authentication failed / 인증에 실패했습니다. |  |
| <span class="ndc-color">401</span> | 028 | Authentication header not exists / OAuth 인증 헤더(authorization header)가 없습니다. |  |
| <span class="ndc-color">403</span> | 403 | Forbidden / 호출 권한이 없습니다. | API 요청 헤더에 클라이언트 ID와 Secret 값을 정확히 전송했는지 확인해보시길 바랍니다. |
| <span class="ndc-color">404</span> | 404 | Not Found / 검색 결과가 없습니다. | - |
| <span class="ndc-color">500</span> | 500 | Internal Server Error / 데이터베이스 오류입니다. | 서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다. |

## 7. 예시

### 요청 예시

```
GET v1/nid/me HTTP/1.1
Host: openapi.naver.com
User-Agent: curl/7.43.0
Accept: */*
Content-Type: application/xml
Authorization: Bearer {네이버 로그인 인증 후 받은 접근 토큰 값}
```

### 응답 예시

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
    "birthday": "10-01",
    "birthyear": "1900",
    "mobile": "010-0000-0000"
  }
}
```
