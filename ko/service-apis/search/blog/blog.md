---
title: 검색 API 블로그 검색 개발가이드
description: 네이버 블로그 검색 결과를 출력해주는 REST API입니다.
---

# 검색 &gt; 블로그

네이버 블로그 검색 결과를 출력해주는 REST API입니다. 비로그인 오픈 API이므로
GET으로 호출할 때 HTTP Header에 애플리케이션 등록 시 발급받은 [Client ID와
Client Secret 값을 같이 전송](https://developers.naver.com/docs/common/apicall)해 주시면 활용 가능합니다.

<div class="buttons2"><a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?defaultScope=search">오픈 API 이용 신청 &gt;</a>

## 0. API 호출 예제

예제 실행 전에 아래 <em class="color_p3">1.준비사항</em> 항목들을 꼭 체크하시길 바랍니다.</div>

#### Java

```java
네이버 검색 API예제는 블로그를 비롯 전문자료까지 호출방법이 동일하므로 blog검색만 대표로 예제를 올렸습니다.
// 네이버 검색 API 예제 - blog 검색
import java.io.*;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.HashMap;
import java.util.Map;


public class ApiExamSearchBlog {


    public static void main(String[] args) {
        String clientId = "YOUR_CLIENT_ID"; //애플리케이션 클라이언트 아이디값"
        String clientSecret = "YOUR_CLIENT_SECRET"; //애플리케이션 클라이언트 시크릿값"


        String text = null;
        try {
            text = URLEncoder.encode("그린팩토리", "UTF-8");
        } catch (UnsupportedEncodingException e) {
            throw new RuntimeException("검색어 인코딩 실패",e);
        }


        String apiURL = "https://openapi.naver.com/v1/search/blog?query=" + text;    // json 결과
        //String apiURL = "https://openapi.naver.com/v1/search/blog.xml?query="+ text; // xml 결과


        Map<String, String> requestHeaders = new HashMap<>();
        requestHeaders.put("X-Naver-Client-Id", clientId);
        requestHeaders.put("X-Naver-Client-Secret", clientSecret);
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
네이버 검색 API예제는 블로그를 비롯 전문자료까지 호출방법이 동일하므로 blog검색만 대표로 예제를 올렸습니다.
// ssl 이슈가 있으면 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 를 추가해보시길 바랍니다.
// 네이버 검색 Open API 예제 - 블로그 검색
<?php
  $client_id = "YOUR_CLIENT_ID";
  $client_secret = "YOUR_CLIENT_SECRET";
  $encText = urlencode("네이버오픈API");
  $url = "https://openapi.naver.com/v1/search/blog.xml?query=".$encText; // json 결과
//  $url = "https://openapi.naver.com/v1/search/blog.xml?query=".$encText; // xml 결과
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
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
#### Node.js

```js
// 네이버 검색 API예제는 블로그를 비롯 전문자료까지 호출방법이 동일하므로 blog검색만 대표로 예제를 올렸습니다.
// 네이버 검색 Open API 예제 - 블로그 검색
var express = require('express');
var app = express();
var client_id = 'YOUR_CLIENT_ID';
var client_secret = 'YOUR_CLIENT_SECRET';
app.get('/search/blog', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/search/blog?query=' + encodeURI(req.query.query); // json 결과
//   var api_url = 'https://openapi.naver.com/v1/search/blog.xml?query=' + encodeURI(req.query.query); // xml 결과
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
   console.log('http://127.0.0.1:3000/search/blog?query=검색어 app listening on port 3000!');
 });
```
#### Python

```python
# 네이버 검색 API예제는 블로그를 비롯 전문자료까지 호출방법이 동일하므로 blog검색만 대표로 예제를 올렸습니다.
# 네이버 검색 Open API 예제 - 블로그 검색
import os
import sys
import urllib.request
client_id = "YOUR_CLIENT_ID"
client_secret = "YOUR_CLIENT_SECRET"
encText = urllib.parse.quote("검색할 단어")
url = "https://openapi.naver.com/v1/search/blog?query=" + encText # json 결과
# url = "https://openapi.naver.com/v1/search/blog.xml?query=" + encText # xml 결과
request = urllib.request.Request(url)
request.add_header("X-Naver-Client-Id",client_id)
request.add_header("X-Naver-Client-Secret",client_secret)
response = urllib.request.urlopen(request)
rescode = response.getcode()
if(rescode==200):
    response_body = response.read()
    print(response_body.decode('utf-8'))
else:
    print("Error Code:" + rescode)
```

### C#

```cpp
using System;
using System.Net;
using System.Text;
using System.IO;


namespace NaverAPI_Guide
{
    public class APIExamSearchBlog
    {
        static void Main(string[] args)
        {
            string query = "네이버 Open API"; // 검색할 문자열
            string url = "https://openapi.naver.com/v1/search/blog?query=" + query; // 결과가 JSON 포맷
            // string url = "https://openapi.naver.com/v1/search/blog.xml?query=" + query;  // 결과가 XML 포맷
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
            request.Headers.Add("X-Naver-Client-Id", "YOUR-CLIENT-ID"); // 클라이언트 아이디
            request.Headers.Add("X-Naver-Client-Secret", "YOUR-CLIENT-SECRET");       // 클라이언트 시크릿
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

- 애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 **[Application-애플리케이션
등록](https://developers.naver.com/apps/#/register?defaultScope=search)** 메뉴에서 애플리케이션을 등록하셔야 합니다. <br>**[\[자세한 방법 보기\] &gt;](https://developers.naver.com/docs/common/register)**
- 클라이언트 ID와 secret 확인: [**내 애플리케이션**](https://developers.naver.com/appinfo)에서 등록한 애플리케이션을 선택하면 Client ID와 Client Secret 값을 확인할 수 있습니다.
- API 권한 설정: [**내 애플리케이션**](https://developers.naver.com/appinfo)의 **API 권한관리** 탭에서 사용하려는 API가 체크되어 있는지
확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.

## 2. API 기본 정보

|메서드|인증|요청 URL|출력 포맷|
|---|---|---|---|
|GET|-|https://openapi.naver.com/v1/search/blog.xml|XML|
|GET|-|https://openapi.naver.com/v1/search/blog.json|<em class="color_p3">JSON</em>|

## 3. 요청 변수

|요청 변수|타입|필수 여부|기본값|설명|
|---|---|---|---|---|
|query|string|Y|-|검색을 원하는 문자열로서 UTF-8로 인코딩한다.|
|display|integer|N|10(기본값),100(최대)|검색 결과 출력 건수 지정|
|start|integer|N|1(기본값), 1000(최대)|검색 시작 위치로 최대 1000까지 가능|
|sort|string|N|sim(기본값), date|정렬 옵션: sim (유사도순), date (날짜순)|

## 4. 출력 결과

|필드|타입|설명|
|---|---|---|
|rss|-|디버그를 쉽게 하고 RSS 리더기만으로 이용할 수 있게 하기 위해 만든 RSS 포맷의 컨테이너이며 그 외의 특별한 의미는 없다.|
|channel|-|색 결과를 포함하는 컨테이너이다. 이 안에 있는 title, link, description 등의 항목은 참고용으로 무시해도 무방하다.|
|lastBuildDate|datetime|검색 결과를 생성한 시간이다.|
|postdate|datetime|블로그 포스트를 작성한 날짜이다.|
|total|integer|검색 결과 문서의 총 개수를 의미한다.|
|start|integer|검색 결과 문서 중, 문서의 시작점을 의미한다.|
|display|integer|검색된 검색 결과의 개수이다.|
|item/items|-|XML 포멧에서는 item 태그로, JSON 포멧에서는 items 속성으로 표현된다. 개별 검색 결과이며 title, link, description, bloggername, bloggerlink을 포함한다.|
|title|string|검색 결과 문서의 제목을 나타낸다. 제목에서 검색어와 일치하는 부분은 <strong>태그로 감싸져 있다.</strong>|
|link|string|검색 결과 문서의 하이퍼텍스트 link를 나타낸다.|
|description|string|검색 결과 문서의 내용을 요약한 패시지 정보이다. 문서 전체의 내용은 link를 따라가면 읽을 수 있다. 패시지에서 검색어와 일치하는 부분은 <strong>태그로 감싸져 있다.</strong>|
|bloggername|string|검색 결과 블로그 포스트를 작성한 블로거의 이름이다.|
|bloggerlink|string|검색 결과 블로그 포스트를 작성한 블로거의 하이퍼텍스트 link이다.|

## 5. 에러 코드 

공통 에러 코드는 [여기](https://developers.naver.com/docs/common/openapiguide/errorcode.md)를 참조하세요.

|HTTP 코드|에러 코드|에러 메시지|조치 방안|
|---|---|---|---|
|400|SE01|Incorrect query request (잘못된 쿼리요청입니다.)|검색 API 요청에 오류가 있습니다. 요청 URL, 필수 요청 변수가 정확한지 확인 바랍니다.|
|400|SE02|Invalid display value (부적절한 display 값입니다.)|display 요청 변수값이 허용 범위(1~100)인지 확인해 보세요.|
|400|SE03|Invalid start value (부적절한 start 값입니다.)|start 요청 변수값이 허용 범위(1~1000)인지 확인해 보세요.|
|400|SE04|Invalid sort value (부적절한 sort 값입니다.)|sort 요청 변수 값에 오타가 없는지 확인해 보세요.|
|400|SE06|Malformed encoding (잘못된 형식의 인코딩입니다.)|검색어를 UTF-8로 인코딩하세요.|
|404|SE05|Invalid search api (존재하지 않는 검색 api 입니다.)|검색 API 대상에 오타가 없는지 확인해 보세요.|
|500|SE99|System Error (시스템 에러)|서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다.|

## 6. 예시 
### 호출

```sh
curl  "https://openapi.naver.com/v1/search/blog.xml?query=%EB%A6%AC%EB%B7%B0&display=10&start=1&sort=sim" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}" -v
```

### 요청

```sh
> GET /v1/search/blog.xml?query=%EB%A6%AC%EB%B7%B0&display=10&start=1&sort=sim HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}
>
```

### 응답

```xml
< HTTP/1.1 200 OK
< Server: nginx
< Date: Mon, 26 Sep 2016 01:39:37 GMT
< Content-Type: text/xml;charset=utf-8
< Transfer-Encoding: chunked
< Connection: keep-alive
< Keep-Alive: timeout=5
< Vary: Accept-Encoding
< X-Powered-By: Naver
< Cache-Control: no-cache, no-store, must-revalidate
< Pragma: no-cache
<
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Naver Open API - blog ::'리뷰'</title>
        <link>http://search.naver.com</link>
        <description>Naver Search Result</description>
        <lastBuildDate>Mon, 26 Sep 2016 10:39:37 +0900</lastBuildDate>
        <total>8714891</total>
        <start>1</start><display>10</display>
        <item>
            <title>명예훼손 없이 <b>리뷰</b>쓰기</title>
            <link>http://openapi.naver.com/l?AAABWLyw6CMBREv+ayNJe2UrrogvJwg8aYKGvACiSUalNR/t6azGLO5Mzrrd0moVSQJZDl/6I4KIxGpx9y9P4JNANShXSzHXZLu2q3660Jw2bt0k1+aF1rgFYXfZ+c7j3QorYDkCT4JxuIEEyRUYGcxpGXMeMs3VPBOUEWGXntynUW03k7ohBYfG+mOdRqbPL6E84/apnqgaEAAAA=</link>
            <description>명예훼손 없이 <b>리뷰</b>쓰기 우리 블로그하시는 분들께는 꽤 중요한 내용일 수도 있습니다 그것도 주로 <b>리뷰</b> 위주로 블로그를 진행하신 분이라면 더욱 더 말이죠
                오늘 포스팅은, 어떻게 하면 객관적이고 좋은 <b>리뷰</b>를... </description>
            <bloggername>건짱의 Best Drawing World2</bloggername>
            <bloggerlink>http://blog.naver.com/yoonbitgaram</bloggerlink>
            <postdate>20161208</postdate>
        </item>
        ...
    </channel>
</rss>
```