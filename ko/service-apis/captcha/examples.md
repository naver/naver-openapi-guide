---
title: 이미지 캡차 API 적용 가이드 - 구현 예제
description: 이미지 캡차 API는 자동 입력 방지를 위해 사람의 눈으로 식별 가능한 문자가 포함된 이미지를 전송하고 입력값을 검증하는 RESTful API입니다.
---

# 이미지 캡차 API 구현 예제

다음은 각 언어별 이미지 캡차 API 구현 예제입니다.

* [Java](#java)
* [PHP](#php)
* [Node.js](#node-js)
* [Python](#python)
* [C&num;](#c)

> **참고**  
> - 샘플 코드에서 `YOUR_CLIENT_ID` 또는 `YOUR-CLIENT-ID`에는 애플리케이션을 등록하고 발급받은 클라이언트 아이디 값을 입력합니다.  
> - 샘플 코드에서 `YOUR_CLIENT_SECRET` 또는 `YOUR-CLIENT-SECRET`에는 애플리케이션을 등록하고 발급받은 클라이언트 시크릿 값을 입력합니다.  

## Java

### 캡차 키 발급 요청

```java
{% include 'https://raw.githubusercontent.com/naver/naver-openapi-guide/master/sample/java/ApiExamCaptchaNkey.java' %}
```

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/master/sample/java/ApiExamCaptchaNkey.java)

### 캡차 이미지 요청

```java
import java.io.*;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

// 네이버 캡차 API 예제 - 캡차 이미지 수신
public class ApiExamCaptchaImage {

    public static void main(String[] args) {
        String clientId = "YOUR_CLIENT_ID"; //애플리케이션 클라이언트 아이디값";
        String clientSecret = "YOUR_CLIENT_SECRET"; //애플리케이션 클라이언트 시크릿값";

        String key = "CAPTCHA_KEY"; // https://openapi.naver.com/v1/captcha/nkey 호출로 받은 키값
        String apiURL = "https://openapi.naver.com/v1/captcha/ncaptcha.bin?key=" + key;

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
                return getImage(con.getInputStream());
            } else { // 에러 발생
                return error(con.getErrorStream());
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

    private static String getImage(InputStream is){
        int read;
        byte[] bytes = new byte[1024];
        // 랜덤한 이름으로  파일 생성
        String filename = Long.valueOf(new Date().getTime()).toString();
        File f = new File(filename + ".jpg");
        try(OutputStream outputStream = new FileOutputStream(f)){
            f.createNewFile();
            while ((read = is.read(bytes)) != -1) {
                outputStream.write(bytes, 0, read);
            }
            return "이미지 캡차가 생성되었습니다.";
        } catch (IOException e) {
            throw new RuntimeException("이미지 캡차 파일 생성에 실패 했습니다.",e);
        }
    }

    private static String error(InputStream body) {
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

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/java/APIExamCaptchaImage.java)

### 사용자 입력값 검증 요청

```java
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Map;

// 네이버 캡차 API 예제 - 키발급, 키 비교
public class ApiExamCaptchaNkeyResult {

    public static void main(String[] args) {
        String clientId = "YOUR_CLIENT_ID";//애플리케이션 클라이언트 아이디값";
        String clientSecret = "YOUR_CLIENT_SECRET";//애플리케이션 클라이언트 시크릿값";

        String code = "1"; // 키 발급시 0,  캡차 이미지 비교시 1로 세팅
        String key = "YOUR_CAPTCHA_KEY"; // 캡차 키 발급시 받은 키값
        String value = "YOUR_INPUT"; // 사용자가 입력한 캡차 이미지 글자값
        String apiURL = "https://openapi.naver.com/v1/captcha/nkey?code=" + code + "&key=" + key + "&value=" + value;

        Map<String, String> requestHeaders = new HashMap<>();
        requestHeaders.put("X-Naver-Client-Id", clientId);
        requestHeaders.put("X-Naver-Client-Secret", clientSecret);
        String responseBody = get(apiURL, requestHeaders);

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

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/java/APIExamCaptchaNkeyResult.java)

## PHP

### 캡차 키 발급 요청

```php
<?php
  // 네이버 이미지 캡차 Open API 예제 - 키 발급
  $client_id = "YOUR_CLIENT_ID"; // 네이버 개발자센터에서 발급받은 CLIENT ID
  $client_secret = "YOUR_CLIENT_SECRET";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
  $code = "0";
  $url = "https://openapi.naver.com/v1/captcha/nkey?code=".$code;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
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

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/php/APIExamCaptchaNkey.php)

### 캡차 이미지 요청

```php
<?php
  // 네이버 이미지 캡차 Open API 예제 - 이미지수신
  $client_id = "YOUR_CLIENT_ID"; // 네이버 개발자센터에서 발급받은 CLIENT ID
  $client_secret = "YOUR_CLIENT_SECRET";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
  $key = "YOUR_CAPTCHA_KEY";
  $url = "https://openapi.naver.com/v1/captcha/ncaptcha.bin?key=".$key;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    //echo $response;
    $fp = fopen("captcha.jpg", "w+");
    fwrite($fp, $response);
    fclose($fp);
    echo "<img src='captcha.jpg'>";
  } else {
    echo "Error 내용:".$response;
  }
?>
```

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/php/APIExamCaptchaImage.php)

### 사용자 입력값 검증 요청

```php
<?php
  // 네이버 이미지 캡차 Open API 예제 - 키 발급
  $client_id = "YOUR_CLIENT_ID"; // 네이버 개발자센터에서 발급받은 CLIENT ID
  $client_secret = "YOUR_CLIENT_SECRET";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
  $code = "1";
  $key = "YOUR_CAPTCHA_KEY";
  $value = "YOUR_INPUT";
  $url = "https://openapi.naver.com/v1/captcha/nkey?code=".$code."&key=".$key."&value=".$value;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
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

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/php/APIExamCaptchaNkeyResult.php)

## Node.js

### 캡차 키 발급 요청

```js
var express = require('express');
var app = express();
var client_id = 'YOUR_CLIENT_ID';//개발자센터에서 발급받은 Client ID
var client_secret = 'YOUR_CLIENT_SECRET'; //개발자센터에서 발급받은 Client Secret
var code = "0";
app.get('/captcha/nkey', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/captcha/nkey?code=' + code;
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
   console.log('http://127.0.0.1:3000/captcha/nkey app listening on port 3000!');
 });
```

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/nodejs/APIExamCaptchaNkey.js)

### 캡차 이미지 요청

```js
var express = require('express');
var app = express();
var client_id = 'YOUR_CLIENT_ID';//개발자센터에서 발급받은 Client ID
var client_secret = 'YOUR_CLIENT_SECRET'; //개발자센터에서 발급받은 Client Secret
var fs = require('fs');
app.get('/captcha/image', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/captcha/ncaptcha.bin?key=' + req.query.key;
   var request = require('request');
   var options = {
       url: api_url,
       headers: {'X-Naver-Client-Id':client_id, 'X-Naver-Client-Secret': client_secret}
    };
    var writeStream = fs.createWriteStream('./captcha.jpg');
    var _req = request.get(options).on('response', function(response) {
       console.log(response.statusCode) // 200
       console.log(response.headers['content-type'])
    });
  _req.pipe(writeStream); // file로 출력
  _req.pipe(res); // 브라우저로 출력
 });
 app.listen(3000, function () {
   console.log('http://127.0.0.1:3000/captcha/image?key=캡차키 app listening on port 3000!');
 });
```

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/nodejs/APIExamCaptchaImage.js)

### 사용자 입력값 검증 요청

```js
var express = require('express');
var app = express();
var client_id = 'YOUR_CLIENT_ID';//개발자센터에서 발급받은 Client ID
var client_secret = 'YOUR_CLIENT_SECRET'; //개발자센터에서 발급받은 Client Secret
var code = "1";
app.get('/captcha/result', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/captcha/nkey?code=' + code + '&key=' + req.query.key + '&value=' + req.query.value;
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
   console.log('http://127.0.0.1:3000/captcha/result?key=캡차키&value=캡차밸류 app listening on port 3000!');
 })
```

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/nodejs/APIExamCaptchaNkeyResult.js)

## Python

> **참고**  
> 이 문서의 예제는 Python 3.4 버전으로 구현한 예제입니다.  

### 캡차 키 발급 요청

```python
import os
import sys
import urllib.request
client_id = "YOUR_CLIENT_ID" # 개발자센터에서 발급받은 Client ID 값
client_secret = "YOUR_CLIENT_SECRET" # 개발자센터에서 발급받은 Client Secret 값
code = "0"
url = "https://openapi.naver.com/v1/captcha/nkey?code=" + code
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

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/python/APIExamCaptchaNkey.py)

### 캡차 이미지 요청

```python
import os
import sys
import urllib.request
client_id = "YOUR_CLIENT_ID" # 개발자센터에서 발급받은 Client ID 값
client_secret = "YOUR_CLIENT_SECRET" # 개발자센터에서 발급받은 Client Secret 값
key = "YOUR_CAPTCHA_KEY" # 캡차 Key 값
url = "https://openapi.naver.com/v1/captcha/ncaptcha.bin?key=" + key
request = urllib.request.Request(url)
request.add_header("X-Naver-Client-Id",client_id)
request.add_header("X-Naver-Client-Secret",client_secret)
response = urllib.request.urlopen(request)
rescode = response.getcode()
if(rescode==200):
    print("캡차 이미지 저장")
    response_body = response.read()
    with open('captcha.jpg', 'wb') as f:
        f.write(response_body)
else:
    print("Error Code:" + rescode)
```

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/python/APIExamCaptchaImage.py)

### 사용자 입력값 검증 요청

```python
import os
import sys
import urllib.request
client_id = "YOUR_CLIENT_ID" # 개발자센터에서 발급받은 Client ID 값
client_secret = "YOUR_CLIENT_SECRET" # 개발자센터에서 발급받은 Client Secret 값
code = "1"
key = "YOUR_CAPTCHA_KEY"
value = "YOUR_INPUT"
url = "https://openapi.naver.com/v1/captcha/nkey?code=" + code + "&key=" + key + "&value=" + value
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

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/python/APIExamCaptchaNkeyResult.py)

## C&num;

### 캡차 키 발급 요청

```csharp
using System;
using System.Net;
using System.Text;
using System.IO;

namespace NaverAPI_Guide
{
    public class APIExamCaptchaNkey
    {
        static void Main(string[] args)
        {
            string code = "0"; // 키 발급시 0,  캡차 이미지 비교시 1로 세팅
            string url = "https://openapi.naver.com/v1/captcha/nkey?code=" + code;
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
            request.Headers.Add("X-Naver-Client-Id", "YOUR_CLIENT_ID"); // 개발자센터에서 발급받은 Client ID
            request.Headers.Add("X-Naver-Client-Secret", "YOUR_CLIENT_SECRET"); // 개발자센터에서 발급받은 Client Secret
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

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/c%23-asp.net/APIExamCaptchaNkey.cs)

### 캡차 이미지 요청

```csharp
using System;
using System.Net;
using System.Text;
using System.IO;

namespace NaverAPI_Guide
{
    public class APIExamCaptchaImage
    {
        static void Main(string[] args)
        {
            string key = "YOUR_CAPTCHA_KEY"; // https://openapi.naver.com/v1/captcha/nkey 호출로 받은 키값
            string url = "https://openapi.naver.com/v1/captcha/ncaptcha.bin?key=" + key;
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
            request.Headers.Add("X-Naver-Client-Id", "YOUR_CLIENT_ID"); // 개발자센터에서 발급받은 Client ID
            request.Headers.Add("X-Naver-Client-Secret", "YOUR_CLIENT_SECRET"); // 개발자센터에서 발급받은 Client Secret
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            string status = response.StatusCode.ToString();
            Console.WriteLine("status="+ status);
            using (Stream output = File.OpenWrite("c:/captcha.jpg"))
            using (Stream input = response.GetResponseStream())
            {
                input.CopyTo(output);
            }
            Console.WriteLine("c:/captcha.jpg was created");
        }
    }
}
```

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/c%23-asp.net/APIExamCaptchaImage.cs)

### 사용자 입력값 검증 요청

```csharp
using System;
using System.Net;
using System.Text;
using System.IO;

namespace NaverAPI_Guide
{
    public class APIExamCaptchaNkeyResult
    {
        static void Main(string[] args)
        {
            string code = "1"; // 키 발급시 0,  캡차 이미지 비교시 1로 세팅
            string key = "ALdPbazKgh8EEQk1";  // 캡차 키 발급시 받은 키값
            string value = "93ND";  // 사용자가 입력한 캡차 이미지 글자값
            string url = "https://openapi.naver.com/v1/captcha/nkey?code=" + code + "&key=" + key + "&value=" + value;
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
            request.Headers.Add("X-Naver-Client-Id", "YOUR_CLIENT_ID"); // 개발자센터에서 발급받은 Client ID
            request.Headers.Add("X-Naver-Client-Secret", "YOUR_CLIENT_SECRET"); // 개발자센터에서 발급받은 Client Secret
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

* [GitHub에서 보기](https://github.com/naver/naver-openapi-guide/blob/draft/sample/c%23-asp.net/APIExamCaptchaNkeyResult.cs)
