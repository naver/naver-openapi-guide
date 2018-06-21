# 언어 감지 API 구현 예제

다음은 각 언어별 언어 감지 API 구현 예제입니다.

- [Java](#java)
- [PHP](#php)
- [Node.js](#node-js)
- [Python](#python)
- [C#](#c)

<div class="note"><p><strong>참고</strong></p>
<ul>  
<li>샘플 코드에서 <code>YOUR_CLIENT_ID</code> 또는 <code>YOUR-CLIENT-ID</code>에는 애플리케이션을 등록하고 발급받은 클라이언트 아이디 값을 입력합니다.</li>  
<li>샘플 코드에서 <code>YOUR_CLIENT_SECRET</code> 또는 <code>YOUR-CLIENT-SECRET</code>에는 애플리케이션을 등록하고 발급받은 클라이언트 시크릿 값을 입력합니다.</li>  
</ul>  
</div>  

## Java

```java
// 네이버 Papago 언어감지 API 예제
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
public class APIExamDetectLangs {

    public static void main(String[] args) {
        String clientId = "YOUR_CLIENT_ID";//애플리케이션 클라이언트 아이디값";
        String clientSecret = "YOUR_CLIENT_SECRET";//애플리케이션 클라이언트 시크릿값";
        try {
            String query = URLEncoder.encode("만나서 반갑습니다.", "UTF-8");
            String apiURL = "https://openapi.naver.com/v1/papago/detectLangs";
            URL url = new URL(apiURL);
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("POST");
            con.setRequestProperty("X-Naver-Client-Id", clientId);
            con.setRequestProperty("X-Naver-Client-Secret", clientSecret);
            // post request
            String postParams = "query=" + query;
            con.setDoOutput(true);
            DataOutputStream wr = new DataOutputStream(con.getOutputStream());
            wr.writeBytes(postParams);
            wr.flush();
            wr.close();
            int responseCode = con.getResponseCode();
            BufferedReader br;
            if(responseCode==200) { // 정상 호출
                br = new BufferedReader(new InputStreamReader(con.getInputStream()));
            } else {  // 에러 발생
                br = new BufferedReader(new InputStreamReader(con.getErrorStream()));
            }
            String inputLine;
            StringBuffer response = new StringBuffer();
            while ((inputLine = br.readLine()) != null) {
                response.append(inputLine);
            }
            br.close();
            System.out.println(response.toString());
        } catch (Exception e) {
            System.out.println(e);
        }
    }
}
```

## PHP

```php
// 네이버 Papago 언어감지 API 예제
<?php
  $client_id = "YOUR_CLIENT_ID";
  $client_secret = "YOUR_CLIENT_SECRET";
  $encQuery = urlencode("반갑습니다.");
  $postvars = "query=".$encQuery;
  $url = "https://openapi.naver.com/v1/papago/detectLangs";
  $is_post = true;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
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

## Node.js

```js
// 네이버 Papago 언어감지 API 예제
var express = require('express');
var app = express();
var client_id = 'YOUR_CLIENT_ID';
var client_secret = 'YOUR_CLIENT_SECRET';
var query = "언어를 감지할 문장을 입력하세요.";
app.get('/detectLangs', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/papago/detectLangs';
   var request = require('request');
   var options = {
       url: api_url,
       form: {'query': query},
       headers: {'X-Naver-Client-Id':client_id, 'X-Naver-Client-Secret': client_secret}
    };
   request.post(options, function (error, response, body) {
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
   console.log('http://127.0.0.1:3000/detectLangs app listening on port 3000!');
 });
```

## Python

```python
# 네이버 Papago 언어감지 API 예제
import os
import sys
import urllib.request
client_id = "YOUR_CLIENT_ID"
client_secret = "YOUR_CLIENT_SECRET"
encQuery = urllib.parse.quote("언어를 감지할 문장을 입력하세요")
data = "query=" + encQuery
url = "https://openapi.naver.com/v1/papago/detectLangs"
request = urllib.request.Request(url)
request.add_header("X-Naver-Client-Id",client_id)
request.add_header("X-Naver-Client-Secret",client_secret)
response = urllib.request.urlopen(request, data=data.encode("utf-8"))
rescode = response.getcode()
if(rescode==200):
    response_body = response.read()
    print(response_body.decode('utf-8'))
else:
    print("Error Code:" + rescode)
```

## C&num;

```csharp
// 네이버 Papago 언어감지 API 예제
using System;
using System.Net;
using System.Text;
using System.IO;

namespace NaverAPI_Guide
{
    public class APIExamDetectLangs
    {
        static void Main(string[] args)
        {
            string url = "https://openapi.naver.com/v1/papago/detectLangs";
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
            request.Headers.Add("X-Naver-Client-Id", "YOUR-CLIENT-ID");
            request.Headers.Add("X-Naver-Client-Secret", "YOUR-CLIENT-SECRET");
            request.Method = "POST";
            string query = "오늘 날씨는 어떻습니까?";
            byte[] byteDataParams = Encoding.UTF8.GetBytes("query=" + query);
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = byteDataParams.Length;
            Stream st = request.GetRequestStream();
            st.Write(byteDataParams, 0, byteDataParams.Length);
            st.Close();
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            Stream stream = response.GetResponseStream();
            StreamReader reader = new StreamReader(stream, Encoding.UTF8);
            string text = reader.ReadToEnd();
            stream.Close();
            response.Close();
            reader.Close();
            Console.WriteLine(text);
        }
    }
}
```
