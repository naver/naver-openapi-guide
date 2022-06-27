# 카페 가입 · 글쓰기 API 명세

<html lang="ko">
<head>
    <title>NAVER Developers - 카페 가입/글쓰기 개발가이드 </title>
    <meta name="description" content="NAVER Developers - 카페 가입/글쓰기 개발가이드">
</head>
<body>
<div class="con">
    <p class="p_desc">
        네이버 카페에 가입 또는 카페 게시판에 글을 올릴 수 있는 로그인 오픈 API입니다. 기존 REST API처럼 요청 URL과 요청 변수로 호출하는 방법은 동일하나, OAuth 2.0 인증 기반이므로 추가적으로 <a class="color_p2 underline" href="/api/api.md">네이버 로그인 API</a>를 통해 접근 토큰(access token)을 발급받아,
        HTTP로 호출할 때 Header에 접근 토큰을 같이 전송해 주시면 활용 가능합니다.
    </p>
    <div class="buttons2">
        <a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?api=cafe">오픈 API 이용 신청 &gt;</a>
    </div>
    <h3 class="h_sub">0.API 호출 예제</h3>
    <div class="p_desc"> 예제 실행 전에 아래 <em class="color_p3">1.준비사항</em> 항목들을 꼭 체크하시길 바랍니다.</div>
    <div id="tutorial0">
    <div class="code_area">
    <h5>Java</h5>
<pre class="prettyprint">네이버 카페 API예제는 카페 가입과 카페 글쓰기 및 multipart 이미지 첨부 예제로 구성되어 있습니다.
// 네이버 API 예제 - 카페 가입하기
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
<br/>
public class APIExamCafeJoin {
<br/>
    public static void main(String[] args) {
        String token = "YOUR_ACCESS_TOKEN";// 네이버 로그인 접근 토큰;
        String header = "Bearer " + token; // Bearer 다음에 공백 추가
        try {
            String clubid = "CAFE_ID";// 카페의 고유 ID값
            String apiURL = "https://openapi.naver.com/v1/cafe/"+ clubid+"/members";
            URL url = new URL(apiURL);
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("POST");
            con.setRequestProperty("Authorization", header);
            // post request
            // 해당 string은 UTF-8로 encode 후 MS949로 재 encode를 수행한 값
            String nickname = URLEncoder.encode(URLEncoder.encode("API개발자", "UTF-8"), "MS949");
            String postParams = "nickname="+nickname;
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
<br/>
// 네이버 API 예제 - 카페 글쓰기
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
<br/>
public class APIExamCafePost {
<br/>
    public static void main(String[] args) {
        String token = "YOUR_ACCESS_TOKEN";// 네이버 로그인 접근 토큰;
        String header = "Bearer " + token; // Bearer 다음에 공백 추가
        try {
            String clubid = "CAFE_ID";// 카페의 고유 ID값
            String menuid = "MENU_ID"; // 카페 게시판 id (상품게시판은 입력 불가)
            String apiURL = "https://openapi.naver.com/v1/cafe/"+ clubid+"/menu/" + menuid + "/articles";
            URL url = new URL(apiURL);
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("POST");
            con.setRequestProperty("Authorization", header);
            // post request
            // 해당 string은 UTF-8로 encode 후 MS949로 재 encode를 수행한 값
            String subject = URLEncoder.encode(URLEncoder.encode("카페 가입 인사", "UTF-8"), "MS949");;
            String content = URLEncoder.encode(URLEncoder.encode("카페 가입 인사 드립니다 by Cafe API", "UTF-8"), "MS949");
            String postParams = "subject="+subject + "&content="+ content;
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
// 네이버 카페 Open API multipart 이미지 첨부 예제 (APIExamCafePostMultipart.java, MultipartUtil.java)
import java.io.*;
import java.net.URLEncoder;
import java.util.List;
<br/>
public class APIExamCafePostMultipart {
<br/>
    public static void main(String[] args) {
<br/>
        String token = "AAAANjARrFheyb3+6rEc5X6AebqUAGt6+r0Hz036PFCe8PxnOz63WSp+haYsyEizr7QBHyfp789V4tGtrrPC+L/kAv8=";//애플리케이션 클라이언트 아이디값";
        String header = "Bearer " + token; // Bearer 다음에 공백 추가
        try {
            // api url 설정
            String clubid = "28339939";// 카페의 고유 ID값 https://cafe.naver.com/apiexam
            String menuid = "1"; // 카페 게시판 id
            String apiURL = "https://openapi.naver.com/v1/cafe/"+ clubid+"/menu/" + menuid + "/articles";
            MultipartUtil mu = new MultipartUtil(apiURL);
            // 접큰 토큰 헤더 추가
            mu.addHeaderField("Authorization", header);
            mu.readyToConnect();
            // cafe 글쓰기 필수 요청변수 subject 추가
            String subject = URLEncoder.encode("네이버 multi-part 이미지 첨부 테스트", "UTF-8");
            mu.addFormField("subject", subject);
            // cafe 글쓰기 필수 요청변수 content 추가
            String content = URLEncoder.encode("&lt;font color='red'&gt;multi-part&lt;/font&gt;로 첨부한 글입니다. &lt;br&gt; 이미지 첨부 &lt;br&gt;", "UTF-8");
            mu.addFormField("content", content);
<br>
            // [시작] image 첨부 로직 - 필요시 이미지수 만큼 반복
            File uploadFile1 = new File("prince1.jpg");
            mu.addFilePart("0", uploadFile1);
            File uploadFile2 = new File("prince2.jpg");
            mu.addFilePart("0", uploadFile2);
            // [종료] 이미지 첨부 로직 - 필요시 이미지수 만큼 반복
<br>
            // HTTP 호출 결과 수신
            List<String> response = mu.finish();
            System.out.println("SERVER REPLIED:");
<br>
            for (String line : response) {
                System.out.println(line);
            }
<br>
        } catch (Exception e) {
            System.out.println(e);
        }
    }
}
<br/>
// MultipartUtil : 아래 소스를 참조하여 일부 로직을 수정하였습니다.
// http://www.codejava.net/java-se/networking/upload-files-by-sending-multipart-request-programmatically
<br/>
import java.io.*;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;
import java.util.List;
<br/>
public class MultipartUtil {
<br/>
    private String boundary;
    private String LINE_FEED = "\r\n";
    private HttpURLConnection con;
    private OutputStream outputStream;
    private PrintWriter writer;
<br/>
    public MultipartUtil (String apiURL) throws IOException  {
        boundary = "---" + System.currentTimeMillis() + "---";// multipart request 구분자
        System.out.println("MultipartUtil boundary = " + boundary);
        URL url = new URL(apiURL);
        con = (HttpURLConnection)url.openConnection();
        con.setUseCaches(false);
        con.setDoOutput(true);
        con.setDoInput(true);
        con.setRequestProperty("Content-Type", "multipart/form-data; boundary=" + boundary);
    }
<br/>
    public void readyToConnect() throws IOException {
        outputStream = con.getOutputStream();
        writer = new PrintWriter(new OutputStreamWriter(outputStream, "UTF-8"), true);
    }
<br/>
    public void addFilePart(String fieldName, File uploadFile) throws IOException {
        String fileName = uploadFile.getName();
        writer.append("--" + boundary).append(LINE_FEED);
        writer.append("Content-Disposition: form-data; name=\"" + fieldName + "\"; filename=\"" + fileName + "\"").append(LINE_FEED);
        writer.append("Content-Type: " + URLConnection.guessContentTypeFromName(fileName)).append(LINE_FEED);
        writer.append("Content-Transfer-Encoding: binary").append(LINE_FEED);
        writer.append(LINE_FEED);
        writer.flush();
<br/>
        FileInputStream inputStream = new FileInputStream(uploadFile);
        byte[] buffer = new byte[4096];
        int bytesRead = -1;
        while ((bytesRead = inputStream.read(buffer)) != -1) {
            outputStream.write(buffer, 0, bytesRead);
        }
        outputStream.flush();
        inputStream.close();
<br/>
        writer.append(LINE_FEED);
        writer.flush();
    }
<br/>
    public void addFormField(String name, String value) {
        writer.append("--" + boundary).append(LINE_FEED);
        writer.append("Content-Disposition: form-data; name=\"" + name + "\"").append(LINE_FEED);
        writer.append("Content-Type: text/plain; charset=UTF-8").append(LINE_FEED);
        writer.append(LINE_FEED);
        writer.append(value).append(LINE_FEED);
        writer.flush();
    }
<br/>
    public void addHeaderField(String name, String value) {
        con.setRequestProperty(name, value);
    }
<br/>
    public List<String> finish() throws IOException {
        List<String> response = new ArrayList<String>();
<br/>
        writer.append(LINE_FEED).flush();
        writer.append("--" + boundary + "--").append(LINE_FEED);
        writer.close();
<br/>
        int status = con.getResponseCode();
        if (status == HttpURLConnection.HTTP_OK) {
            BufferedReader reader = new BufferedReader(new InputStreamReader(con.getInputStream()));
            String line = null;
            while ((line = reader.readLine()) != null) {
                response.add(line);
            }
            reader.close();
            con.disconnect();
        } else {
            throw new IOException("Server returned non-OK status: " + status);
        }
        return response;
    }
}
<br>
       </pre>
    </div>
    </div>
    <div id="tutorial1">
    <div class="code_area">
    <h5>PHP</h5>
<pre class="prettyprint">네이버 카페 API예제는 카페 가입과 카페 글쓰기 및 multipart 이미지 첨부 예제로 구성되어 있습니다.
// 네이버 카페 Open API 예제 - 카페가입
&lt;?php
  $token = "YOUR_ACCESS_TOKEN";
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $clubid = "CAFE_ID";// 카페의 고유 ID값
  $url = "https://openapi.naver.com/v1/cafe/".$clubid."/members";
  $nickname = urlencode("open api");
  $postvars = array(
    'nickname' => $nickname
  );
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
  echo "status_code:".$status_code."&lt;br&gt;";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?&gt;
<br/>
// 네이버 카페 Open API 예제 - 글쓰기
&lt;?php
  header("Content-Type: text/html; charset=UTF-8");
  $token = "YOUR_ACCESS_TOKEN";
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $clubid = "CAFE_ID";// 카페의 고유 ID값
  $menuid = "MENU_ID"; // 카페 게시판 id (상품게시판은 입력 불가)
  $url = "https://openapi.naver.com/v1/cafe/".$clubid."/menu/".$menuid."/articles";
  $subject =  urlencode("네이버 카페 api 글쓰기 Test php");
  $content =  urlencode("네이버 카페 api로 글을 올려봅니다.");
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
  echo "status_code:".$status_code."&lt;br&gt;";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?&gt;
<br/>
// 네이버 Cafe Open API 예제 - Multipart 글쓰기
&lt;?php
  $token = "YOUR_ACCESS_TOKEN";
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $clubid = "YOUR_CAFE_ID";// 카페의 고유 ID값
  $menuid = "YOUR_CAFE_BBS_ID"; // 카페 게시판 id (상품게시판은 입력 불가)
  $url = "https://openapi.naver.com/v1/cafe/".$clubid."/menu/".$menuid."/articles";
  $subject = urlencode("cafe php 네이버 multi-part 이미지 첨부 테스트 php");
  $content = urlencode("&lt;font color='red'&gt;multi-part 로 첨부한 글입니다. php 이미지 첨부");
<br/>
  $postvars_str = array("subject" =&gt; $subject, "content" =&gt; $content);
  $is_post = true;
  $ch = curl_init();
  // 업로드할 파일 정보
  $cfile1 = new CURLFile('YOUR_FILE_1','image/jpeg');
  $cfile2 = new CURLFile('YOUR_FILE_2','image/jpeg');
<br/>
  // blog 포스트 필수 요청 변수 image, title, contents 지정
  $postvars = array("image[0]" =&gt; $cfile1, "image[1]" =&gt; $cfile2, "subject" =&gt; $subject, "content" =&gt; $content);
  // 요청헤더 설정
  $headers = array();
  $headers[] = "Authorization: ".$header;
  $headers[] = "Content-Type: multipart/form-data";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
<br/>
  // 헤더 내용 출력
  $headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT );
  echo $headerSent;
  echo "&lt;br&gt;[status_code]:".$status_code."&lt;br&gt;";
  // 결과 출력
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?&gt;
<br>
</pre>
    </div>
    </div>
    <div id="tutorial2">
    <div class="code_area">
    <h5>Node.js</h5>
<pre class="prettyprint">네이버 카페 API예제는 카페 가입과 카페 글쓰기 및 multipart 이미지 첨부 예제로 구성되어 있습니다.
// 네이버 API 예제 - 카페 가입하기
var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN";
var header = "Bearer " + token; // Bearer 다음에 공백 추가
var clubid = "CAFE_ID";// 카페의 고유 ID값
var nickname = "NICK_NAME";
app.get('/cafe/join', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/cafe/' + clubid + '/members';
   var request = require('request');
   var options = {
       url: api_url,
       form: {'nickname': nickname},
       headers: {'Authorization': header}
    };
   request.post(options, function (error, response, body) {
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
   console.log('http://127.0.0.1:3000/cafe/join app listening on port 3000!');
 });
<br/>
// 네이버 카페 Open API 예제 - 글쓰기
var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN";
var header = "Bearer " + token; // Bearer 다음에 공백 추가
var clubid = "CLUB_ID";// 카페의 고유 ID값
var menuid = "MENU_ID"; // 카페 게시판 id (상품게시판은 입력 불가)
var subject = encodeURI("네이버 카페 api Test node js");
var content = encodeURI("네이버 카페 api로 글을 카페에 글을 올려봅니다.");
app.get('/cafe/post', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/cafe/' + clubid + '/menu/' + menuid + '/articles';
   var request = require('request');
   var options = {
       url: api_url,
       form: {'subject':subject, 'content':content},
       headers: {'Authorization': header}
    };
   request.post(options, function (error, response, body) {
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
   console.log('http://127.0.0.1:3000/cafe/post app listening on port 3000!');
 });
<br/>
// Cafe Multipart upload 예제 - Node.js
var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN";
var header = "Bearer " + token; // Bearer 다음에 공백 추가
var clubid = "YOUR_CAFE_ID";// 카페의 고유 ID값
var menuid = "YOUR_CAFE_BBS_ID"; // 카페 게시판 id (상품게시판은 입력 불가)
var subject = encodeURI("네이버 카페 api Test node js");
var content = encodeURI("node js multi-part 네이버 카페 api로 글을 카페에 글을 올려봅니다.");
var fs = require('fs');
app.get('/cafe/post/multipart', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/cafe/' + clubid + '/menu/' + menuid + '/articles';
   var request = require('request');
   var _formData = {
     subject:subject,
     content:content,
     image: [
        {
          value: fs.createReadStream(__dirname + '/YOUR_FILE_1'),
          options: { filename: 'test.jpg',  contentType: 'image/jpeg'}
        },
        {
          value: fs.createReadStream(__dirname + '/YOUR_FILE_1'),
          options: {filename: 'captcha.jpg', contentType: 'image/jpeg'}
        }
     ]
   };
    var _req = request.post({url:api_url, formData:_formData,
       headers: {'Authorization': header}}).on('response', function(response) {
       console.log(response.statusCode) // 200
       console.log(response.headers['content-type'])
    });
    console.log( request.head  );
    _req.pipe(res); // 브라우저로 출력
 });
 app.listen(3001, function () {
   console.log('http://127.0.0.1:3001/cafe/post/multipart app listening on port 3001!');
 });
<br>
<br>
       </pre>
    </div>
    </div>
    <div id="tutorial3">
    <div class="code_area">
    <h5>Python</h5>
<pre class="prettyprint"># 네이버 카페 API예제는 카페 가입과 카페 글쓰기 및 multipart 이미지 첨부 예제로 구성되어 있습니다.
# 네이버 API 예제 - 카페 가입하기
import os
import sys
import urllib.request
token = "YOUR_ACCESS_TOKEN"
header = "Bearer " + token # Bearer 다음에 공백 추가
clubid = "CLUB_ID" # 카페의 고유 ID값
url = "https://openapi.naver.com/v1/cafe/" + clubid + "/members"
nickname = urllib.parse.quote("Python")
data = "nickname=" + nickname
request = urllib.request.Request(url, data=data.encode("utf-8"))
request.add_header("Authorization", header)
response = urllib.request.urlopen(request)
rescode = response.getcode()
if(rescode==200):
    response_body = response.read()
    print(response_body.decode('utf-8'))
else:
    print("Error Code:" + rescode)
<br/>
# 네이버 카페 Open API 예제 - 글쓰기
import os
import sys
import urllib.request
token = "YOUR_ACCESS_TOKEN"
header = "Bearer " + token # Bearer 다음에 공백 추가
clubid = "CLUB_ID" # 카페의 고유 ID값
menuid = "MENU_ID" # (상품게시판은 입력 불가)
url = "https://openapi.naver.com/v1/cafe/" + clubid + "/menu/" + menuid + "/articles"
subject = urllib.parse.quote("[subject] 네이버 Cafe api Test Python")
content = urllib.parse.quote("[content] 네이버 Cafe api Test Python")
data = "subject=" + subject + "&content=" + content
request = urllib.request.Request(url, data=data.encode("utf-8"))
request.add_header("Authorization", header)
response = urllib.request.urlopen(request)
rescode = response.getcode()
if(rescode==200):
    response_body = response.read()
    print(response_body.decode('utf-8'))
else:
    print("Error Code:" + rescode)
<br/>
# cafe mulipart upload - python
import os
import sys
import requests
import urllib.request
<br/>
token = "YOUR_ACCESS_TOKEN"
header = "Bearer " + token # Bearer 다음에 공백 추가
clubid = "YOUR_CAFE_ID" # 카페의 고유 ID값
menuid = "YOUR_CAFE_BBS_ID"  # (상품게시판은 입력 불가)
url = "https://openapi.naver.com/v1/cafe/" + clubid + "/menu/" + menuid + "/articles"
<br/>
subject = urllib.parse.quote("네이버 Cafe api Test Python")
content = urllib.parse.quote("&lt;font color='red'&gt;python multi-part&lt;/font&gt;로 첨부한 글입니다. &lt;br&gt; python 이미지 첨부 &lt;br&gt;")
data = {'subject': subject, 'content': content}
files = [
    ('image', ('YOUR_FILE_1', open('YOUR_FILE_1', 'rb'), 'image/jpeg', {'Expires': '0'})),
    ('image', ('YOUR_FILE_2', open('YOUR_FILE_2', 'rb'), 'image/jpeg', {'Expires': '0'}))
    ]
<br/>
headers = {'Authorization': header }
response = requests.post(url, headers=headers, data=data, files=files)
<br/>
rescode = response.status_code
if(rescode==200):
    print (response.text)
else:
    print(rescode)
       </pre>
    </div>
    </div>
    <div id="tutorial4">
    <div class="code_area">
    <h5>C#</h5>
<pre class="prettyprint">네이버 카페 API예제는 카페 가입과 카페 글쓰기 및 multipart 이미지 첨부 예제로 구성되어 있습니다.
// 네이버 API 예제 - 카페 가입하기
using System;
using System.Net;
using System.Text;
using System.IO;
using System.Web;
<br/>
namespace NaverAPI_Guide
{
    public class APIExamCafeJoin
    {
        static void Main(string[] args)
        {
            string token = "YOUR-ACCESS-TOKEN";// 네이버 로그인 접근 토큰;
            string header = "Bearer " + token; // Bearer 다음에 공백 추가
            string clubid = "CAFE-CLUB-ID";// 카페의 고유 ID값
            string nickname = HttpUtility.UrlEncode("api 개발자");
            nickname =  HttpUtility.UrlEncode(nickname, Encoding.GetEncoding("EUC-KR"));
            string apiURL = "https://openapi.naver.com/v1/cafe/" + clubid + "/members";
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(apiURL);
            request.Headers.Add("X-Naver-Client-Id", "YOUR-CLIENT-ID");
            request.Headers.Add("X-Naver-Client-Secret", "YOUR-CLIENT-SECRET");
            request.Headers.Add("Authorization", header);
            request.Method = "POST";
            byte[] byteDataParams = Encoding.UTF8.GetBytes("nickname=" + nickname);
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = byteDataParams.Length;
            Stream st = request.GetRequestStream();
            st.Write(byteDataParams, 0, byteDataParams.Length);
            st.Close();
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            string status = response.StatusCode.ToString();
            if (status == "OK")
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
            st.Close();
            response.Close();
        }
    }
}
// 네이버 카페 Open API 예제 - 글쓰기
using System;
using System.Net;
using System.Text;
using System.IO;
using System.Web;
<br/>
namespace NaverAPI_Guide
{
    public class APIExamCafePost
    {
        static void Main(string[] args)
        {
            string token = "YOUR-ACCESS-TOKEN";// 네이버 로그인 접근 토큰;
            string header = "Bearer " + token; // Bearer 다음에 공백 추가
            string clubid = "CAFE-CLUB-ID";// 카페의 고유 ID값
            string menuid = "CAFE-MENU-ID"; // (상품게시판은 입력 불가)
            string subject = HttpUtility.UrlEncode("[제목] api 개발자");
            subject =  HttpUtility.UrlEncode(subject, Encoding.GetEncoding("EUC-KR"));
            string content = HttpUtility.UrlEncode("api 개발자 내용");
            content = HttpUtility.UrlEncode(content, Encoding.GetEncoding("EUC-KR"));
<br>
            string apiURL = "https://openapi.naver.com/v1/cafe/"+ clubid+"/menu/" + menuid + "/articles";
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(apiURL);
            request.Headers.Add("X-Naver-Client-Id", "YOUR-CLIENT-ID");
            request.Headers.Add("X-Naver-Client-Secret", "YOUR-CLIENT-SECRET");
            request.Headers.Add("Authorization", header);
            request.Method = "POST";
            byte[] byteDataParams = Encoding.UTF8.GetBytes("subject=" + subject + "&content="+ content);
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = byteDataParams.Length;
            Stream st = request.GetRequestStream();
            st.Write(byteDataParams, 0, byteDataParams.Length);
            st.Close();
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            string status = response.StatusCode.ToString();
            if (status == "OK")
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
            st.Close();
            response.Close();
        }
    }
}
<br/>
// Cafe multipart upload - C#
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Web;
<br/>
namespace NaverAPI_Guide
{
    public class APIExamCafePostMultipart
    {
        private static string CRLF = "\r\n";
        private static string boundary = "----" + DateTime.Now.Ticks.ToString("x") + "----";
        private static Stream DataStream = new MemoryStream();
        private static byte[] formData;
<br/>
        static void Main(string[] args)
        {
            string token = "YOUR_ACCESS_TOKEN";// 네이버 로그인 접근 토큰;
            string header = "Bearer " + token; // Bearer 다음에 공백 추가
            string url = "https://openapi.naver.com/v1/cafe/28339939/menu/1/articles"; // cafe api url ( 상품 게시판은 글쓰기 불가)
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
            request.Method = "POST";
            request.ContentType = "multipart/form-data; boundary=" + boundary;
            request.Headers.Add("Authorization", header);
            buildParam("subject", "C# api로 올리는 카페 제목"); // 제목
            buildParam("content", "&lt;font color='red'&gt;multi-part&lt;/font&gt;로 첨부한 글입니다. &lt;br&gt;  이미지 첨부 &lt;br&gt;"); // 본문
            buildFileParam("image[0]", "C:\\test1.jpg"); // 파일 [0]
            buildFileParam("image[1]", "C:\\test2.jpg"); // 파일 [1]
            buildByteParam(); // Byte Array 생성
            Stream stream = request.GetRequestStream();
            stream.Write(formData, 0, formData.Length); // request 전송
            stream.Close();
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            StreamReader reader = new StreamReader(response.GetResponseStream());
            string text = reader.ReadToEnd();
            stream.Close();
            response.Close();
            reader.Close();
            Console.WriteLine(text);
        }
<br/>
        private static void buildParam(String name, String value)
        {
            string paramName1 = name; // cafe
            string paramValue1 = HttpUtility.UrlEncode(value); // cafe는 인코딩 필요
            string res = "--" + boundary + CRLF + "Content-Disposition: form-data; name=\"" + paramName1 + "\"" + CRLF;
            res += "Content-Type: text/plain; charset=UTF-8" + CRLF + CRLF;
            res += paramValue1 + CRLF;
            DataStream.Write(Encoding.UTF8.GetBytes(res), 0, Encoding.UTF8.GetByteCount(res));
        }
<br/>
        private static void buildFileParam(String fileParamName, String filePathName)
        {
            FileStream fs = new FileStream(filePathName, FileMode.Open, FileAccess.Read);
            byte[] fileData = new byte[fs.Length];
            fs.Read(fileData, 0, fileData.Length);
            fs.Close();
            string postData = "--" + boundary + CRLF + "Content-Disposition: form-data; name=\"" + fileParamName + "\"; filename=\"";
            postData += Path.GetFileName(filePathName) + "\"" + CRLF + "Content-Type: image/jpeg" + CRLF;
            postData += "Content-Transfer-Encoding: binary" + CRLF + CRLF;
            DataStream.Write(Encoding.UTF8.GetBytes(postData), 0, Encoding.UTF8.GetByteCount(postData));
            DataStream.Write(fileData, 0, fileData.Length);
            DataStream.Write(Encoding.UTF8.GetBytes("\r\n"), 0, 2);
        }
<br/>
        private static void buildByteParam()
        {
            string footer = "--" + boundary;
            DataStream.Write(Encoding.UTF8.GetBytes(footer), 0, Encoding.UTF8.GetByteCount(footer));
            DataStream.Position = 0;
            formData = new byte[DataStream.Length];
            DataStream.Read(formData, 0, formData.Length); DataStream.Close();
            DataStream.Close();
        }
    }
}
</pre>
</div>
    </div>
    <h3 class="h_sub">1. 준비사항</h3>
    <ul class="list_type1">
        <li>애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저
            <a href="https://developers.naver.com/apps/#/register?api=cafe" class="color_p2 underline">'Application-애플리케이션 등록'</a>메뉴에서 애플리케이션을 등록하셔야 합니다. <br>
            <a href="https://developers.naver.com/docs/common/register"  class="color_p2 underline">[자세한 방법 보기] &gt;</a></li>
        <li>클라이언트 ID와 secret 확인: <a href="https://developers.naver.com/appinfo" class="color_p2 underline">'내 애플리케이션'</a>에서 등록한 애플리케이션을 선택하면 Client ID와 Client Secret 값을 확인할 수 있습니다.</li>
        <li>API 권한 설정: <a href="https://developers.naver.com/appinfo" class="color_p2 underline">'내 애플리케이션'</a>의 'API 권한관리' 탭에서 사용하려는 API가 체크되어 있는지 확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.
        </li>
    </ul>
    <h3 class="h_sub">2. API 기본 정보</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">API 기본 정보 설명 표</span></caption>
        <colgroup>
            <col>
            <col>
            <col style="width:40%">
            <col>
            <col style="width:20%">
        </colgroup>
        <thead>
        <tr>
            <th scope="col">메서드</th>
            <th scope="col">인증</th>
            <th scope="col">요청 URL</th>
            <th scope="col">출력 포맷</th>
            <th scope="col">설명</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">POST</td>
            <td class="center">OAuth 2.0</td>
            <td class="left">https://openapi.naver.com/v1/cafe/{clubid}/members</td>
            <td class="center">json</td>
            <td class="left">특정 카페 가입하기</td>
        </tr>
        <tr>
            <td class="center">POST</td>
            <td class="center">OAuth 2.0</td>
            <td class="left">https://openapi.naver.com/v1/cafe/{clubid}/menu/{menuid}/articles</td>
            <td class="center">json</td>
            <td class="left">카페 게시판에 글 쓰기<br>(상품게시판은 입력 불가)</td>
        </tr>
        </tbody>
    </table>
    <p class="p_desc">
        clubid 값은 특정 카페 고유 숫자값으로 카페 주소에 포함되어 있는 clubid라는 이름으로 포함되어 있습니다. 이를테면  "https://cafe.naver.com/ManageHome.nhn?clubid=14447337"에서는 '14447337' 값이 clubid입니다.
    </p>
    <h3 class="h_sub">3. 요청 변수</h3>
    <h4 class="h_subsub">3.1. 카페 가입하기</h4>
    <table border="1" class="tbl_h">
        <caption><span class="blind">카페 가입하기 요청 변수 설명 표</span></caption>
        <colgroup>
            <col style="width:15%"><col style="width:20%"><col style="width:10%"><col style="width:15%"><col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">요청 변수명</th>
            <th scope="col">타입</th>
            <th scope="col">필수 여부</th>
            <th scope="col">기본값</th>
            <th scope="col">설명</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">nickname</td>
            <td class="center">string</td>
            <td class="center">Y</td>
            <td class="center"></td>
            <td class="left">
                카페에 가입할 때 지정할 별명<br>
                - URL 인코딩하여 요청함<br>
                - 해당 string은 UTF-8로 encode 후 MS949로 재 encode를 수행한 값
            </td>
        </tr>
        <tr>
            <td class="center">clubid</td>
            <td class="center">int</td>
            <td class="center">Y</td>
            <td class="center"></td>
            <td class="left">
                카페 아이디<br>
                카페 관리 페이지와 같이 카페 내 이동 시 clubid로 표현되는 파라미터는 카페의 고유 아이디입니다.
                (https://cafe.naver.com/ManageHome.nhn?clubid=14447337 의 14447337값이 clubid입니다.)
            </td>
        </tr>
        </tbody>
    </table>
    <h4 class="h_subsub">3.2. 카페 글쓰기</h4>
    <table border="1" class="tbl_h">
        <caption><span class="blind">카페 글쓰기 요청 변수 설명 표</span></caption>
        <colgroup>
            <col style="width:15%"><col style="width:20%"><col style="width:10%"><col style="width:15%"><col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">요청 변수명</th>
            <th scope="col">타입</th>
            <th scope="col">필수 여부</th>
            <th scope="col">기본값</th>
            <th scope="col">설명</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">clubid</td>
            <td class="center">int</td>
            <td class="center">Y</td>
            <td class="center"></td>
            <td class="left">
                카페 아이디<br>
                카페 관리 페이지와 같이 카페 내 이동 시 clubid로 표현되는 파라미터는 카페의 고유 아이디이다.
                (https://cafe.naver.com/ManageHome.nhn?clubid=14447337 의 14447337값이 clubid입니다.)
            </td>
        </tr>
        <tr>
            <td class="center">menuid</td>
            <td class="center">int</td>
            <td class="center">Y</td>
            <td class="center"></td>
            <td class="left">게시판 아이디</td>
        </tr>
        <tr>
            <td class="center">subject</td>
            <td class="center">String</td>
            <td class="center">Y</td>
            <td class="center">1</td>
            <td class="left">
                게시글 제목<br>
                - URL 인코딩하여 요청함<br>
                - 해당 string은 UTF-8로 encode 후 MS949로 재 encode를 수행한 값
            </td>
        </tr>
        <tr>
            <td class="center">content</td>
            <td class="center">String</td>
            <td class="center">Y</td>
            <td class="center"></td>
            <td class="left">
                게시글 내용<br>
                - html태그 사용 가능 (예: 줄바꿈은 &lt;br&gt; 사용)
                - 아래 태그는 사용 불가 <br>
                - &lt;iframe&gt; 태그나 &lt;embed&gt; 태그는 신뢰할 수 있는 사이트에만 허용된다.<br>
                - &lt;script&gt; 태그는 사용할 수 없다.<br>
                - URL 인코딩하여 요청함<br>
                - 해당 string은 UTF-8로 encode 후 MS949로 재 encode를 수행한 값
            </td>
        </tr>
        <tr>
            <td class="center">image</td>
            <td class="center">File</td>
            <td class="center">N</td>
            <td class="center"></td>
            <td class="left">
                이미지 첨부 파일(복수의 이미지 등록 가능)<br>
                - image 파라미터를 사용할 때는 데이터를 multipart 형식으로 전송해야 한다.<br>
                - 이미지 파일을 2개 이상 첨부할 때는 파라미터를 중복해서 사용한다.
            </td>
        </tr>
        <tr>
            <td class="center">openyn</td>
            <td class="center">boolean</td>
            <td class="center">N</td>
            <td class="center">false</td>
            <td class="left">
                게시글 공개 설정<br>
                - true: 전체 공개<br>
                - false: 멤버 공개
            </td>
        </tr>
        <tr>
            <td class="center">searchopen</td>
            <td class="center">boolean</td>
            <td class="center">N</td>
            <td class="center">true</td>
            <td class="left">
                게시글 검색 설정<br>
                - true: 네이버에서 검색 허용<br>
                - false: 네이버에서 검색 허용 안 함<br>
                openyn 파라미터를 true로 설정하면 searchopen 파라미터는 true로 설정된다.
            </td>
        </tr>
        <tr>
            <td class="center">replyyn </td>
            <td class="center">boolean</td>
            <td class="center">N</td>
            <td class="center">true</td>
            <td class="left">
                게시글 덧글 설정<br>
                - true: 덧글 허용<br>
                - false: 덧글 허용 안 함
            </td>
        </tr>
        <tr>
            <td class="center">scrapyn </td>
            <td class="center">boolean</td>
            <td class="center">N</td>
            <td class="center">true</td>
            <td class="left">
                게시글 스크랩 설정<br>
                - true: 스크랩 허용<br>
                - false: 스크랩 허용 안 함
            </td>
        </tr>
        <tr>
            <td class="center">metoo</td>
            <td class="center">boolean</td>
            <td class="center">N</td>
            <td class="center">true</td>
            <td class="left">
                블로그, 카페 보내기 설정<br>
                - true: 보내기 허용<br>
                - false: 보내기 허용 안 함
            </td>
        </tr>
        <tr>
            <td class="center">autosourcing</td>
            <td class="center">boolean</td>
            <td class="center">N</td>
            <td class="center">true</td>
            <td class="left">
                게시글 자동 출처 설정<br>
                - true: 자동 출처 사용<br>
                - false: 자동 출처 사용 안 함
            </td>
        </tr>
        <tr>
            <td class="center">rclick</td>
            <td class="center">boolean</td>
            <td class="center">N</td>
            <td class="center">true</td>
            <td class="left">
                마우스 오른쪽 버튼 사용 설정<br>
                - true: 마우스 오른쪽 버튼 사용 허용<br>
                - false: 마우스 오른쪽 버튼 사용 허용 안 함
            </td>
        </tr>
        <tr>
            <td class="center">ccl</td>
            <td class="center">boolean</td>
            <td class="center">N</td>
            <td class="center">true</td>
            <td class="left">
                CCL 사용 설정<br>
                - true: CCL 사용<br>
                - false: CCL 사용 안 함
            </td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">4. 출력 결과</h3>
    <h4 class="h_subsub">4.1. 카페 가입하기</h4>
    <table border="1" class="tbl_h">
        <caption><span class="blind">카페 가입하기 출력 결과 설명 표</span></caption>
        <colgroup>
            <col style="width:20%"><col style="width:20%"><col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">필드</th>
            <th scope="col">타입</th>
            <th scope="col">설명</th>
        </tr>
        <tr>
            <td class="center">status</td>
            <td class="center">int</td>
            <td class="left">200: 가입 성공, 500: 가입 실패</td>
        </tr>
        </tbody>
    </table>
    <h4 class="h_subsub">4.2. 카페 게시판 글쓰기</h4>
    <table border="1" class="tbl_h">
        <caption><span class="blind">카페 게시판 글쓰기 출력 결과 설명 표</span></caption>
        <colgroup>
            <col style="width:20%"><col style="width:20%"><col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">필드</th>
            <th scope="col">타입</th>
            <th scope="col">설명</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">status</td>
            <td class="center">int</td>
            <td class="left">
                200: 게시글 글쓰기 성공, 500: 게시글 쓰기 실패
            </td>
        </tr>
        <tr>
            <td class="center">cafeUrl</td>
            <td class="center">String</td>
            <td class="left">
                카페 URL.<br>
                카페 주소에서 https://cafe.naver.com/을 제외한 부분이다(예: 'https://cafe.naver.com/ndevcenter'에서 ' ndevcenter').
            </td>
        </tr>
        <tr>
            <td class="center">articleId</td>
            <td class="center">int</td>
            <td class="left">게시글 아이디</td>
        </tr>
        <tr>
            <td class="center">articleUrl</td>
            <td class="center">String</td>
            <td class="left">작성된 게시글의 링크 주소</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">5. 에러 코드</h3>
    <div class="p_desc"> 공통 에러 코드는 <a href="https://developers.naver.com/docs/common/openapiguide/errorcode.md" class="color_p2 underline">여기</a>를 참조하세요.</div>
    <table border="1" class="tbl_h">
        <caption><span class="blind">에러 코드 설명 표</span></caption>
        <colgroup>
            <col style="width:10%">
            <col style="width:10%">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">HTTP 코드</th>
            <th scope="col">에러 코드</th>
            <th scope="col">에러 메시지</th>
            <th scope="col">조치 방안</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">0005</td>
            <td class="left">접속하신 카페는 카페 멤버만 들어가실 수 있습니다. (비공개 카페 접근시)</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">CA001</td>
            <td class="left">이미 가입을 신청했으며, 현재 가입 승인 절차가 진행 중입니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">CA002</td>
            <td class="left">아이디가 이용 정지 상태입니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">CA003</td>
            <td class="left">공개 및 바로 가입 가능한 카페만, 가입이 가능합니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">CA004</td>
            <td class="left">이미 회원입니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">NN001</td>
            <td class="left">빈칸으로만 이루어진 별명은 사용할 수 없습니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">NN002	</td>
            <td class="left">별명은 2바이트 이상 입력해야 합니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">NN003</td>
            <td class="left">별명은 20바이트까지 입력할 수 있습니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">NN004</td>
            <td class="left">별명은 한글, 영문, 숫자만 사용할 수 있습니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">NN005</td>
            <td class="left">별명에 금칙어를 포함할 수 없습니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">NN006</td>
            <td class="left">카페에 동일한 별명이 있습니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">AP001</td>
            <td class="left">요청한 파라미터가 유효하지 않습니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">AP002</td>
            <td class="left">접근 제한 중인 게시판입니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">AP003</td>
            <td class="left">카페에서 특정한 등급의 멤버만 쓸 수 있는 게시판입니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">AP004</td>
            <td class="left">비정상적인 접근입니다(글쓰기 허용 불가 메뉴)</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">AP005</td>
            <td class="left">카페 운영진이 설정한 금칙어 및 스팸글 자동차단 기능에 의해 해당 게시글은 스팸 보관함으로 이동했습니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">AP006</td>
            <td class="left">카페가 존재하지 않습니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">AP007</td>
            <td class="left">현재 활동 정지 상태입니다. 활동 정지가 해제되기 전까지 해당 카페에 게시글을 쓸 수 없습니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">403</td>
            <td class="center">AP008</td>
            <td class="left">아이디가 이용 정지 상태입니다.</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">500</td>
            <td class="center">999</td>
            <td class="left">그 외 가입 시 오류 사항에 대한 에러 메시지 반환</td>
            <td class="left">서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다.</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">6. 예시</h3>
    <h4 class="h_subsub">6.1. 카페 가입</h4>
    <h5 class="h_subsub">- 호출</h5>
    <div class="code_area">
<pre class="prettyprint prettyprinted">
curl "https://openapi.naver.com/v1/cafe/{CAFE_ID}/members" \
-H "Authorization: Bearer {접근 토큰}" -v \
-d "nickname={별명}"
</pre>
    </div>
    <p class="p_desc">
        {CAFE_ID}는 카페의 어떤 메뉴 URL에 있는 clubid 값입니다. 예를 들어, 어떤 카페의 타이틀에 마우스를 올려 놓았을 때 cafe.naver.com/MyCafeintro.nhn?clubid=12345678"이 URL로 나타나는 경우, 12345678이 {CAFE_ID}에 해당됩니다.
    </p>
    <h5 class="h_subsub">- 요청</h5>
    <div class="code_area">
<pre class="prettyprint prettyprinted">
> POST /v1/cafe/{CAFE_ID}/members HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> Authorization: Bearer {접근 토큰}
> Content-Length: 15
> Content-Type: application/x-www-form-urlencoded
</pre>
    </div>
    <h5 class="h_subsub">- 응답</h5>
    <div class="code_area">
        <pre class="prettyprint prettyprinted">
< HTTP/1.1 403 Forbidden
< Server: nginx
< Date: Wed, 16 Nov 2016 12:25:21 GMT
< Content-Type: application/json;charset=utf-8
< Content-Length: 224
< Connection: keep-alive
< Keep-Alive: timeout=5
< Vary: Accept-Encoding
< Cache-Control: no-cache
< Expires: Thu, 01 Jan 1970 00:00:00 GMT
< Set-Cookie: ncu=""; Domain=.cafe.naver.com; Expires=Thu, 01-Jan-1970 00:00:10 GMT; Path=/
< Set-Cookie: ncu=8faa56716d3b45e1cd1976617aac1131b19964f3d6ec56; Domain=.cafe.naver.com; Path=/
< P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"
<
* Connection #0 to host openapi.naver.com left intact
{"message":
	{"@type":"response","@service":"korea.naverkoreaservice.community.cafe","@version":"1.0.0","status":"500","error":
		{"code":"CA003","msg":"공개 및 바로 가입 가능한 카페만, 가입이 가능합니다."}
	}
}
</pre>
    </div>
    <p class="p_desc">
        비공개 카페에 가입하려는 경우 위와 같은 에러 메시지를 출력합니다.
        처음 카페 생성 시 기본 카페 성격은 "비공개"이며, "공개"로 전환한 카페에 한해 API 호출로 가입이 가능합니다.
        카페를 "공개"로 전환하려면 카페 관리자가 "카페 관리 > 카페 운영 > 카페 성격"을 "공개"로 요청한 이후, 승인이 완료되어야 합니다.
    </p>
    <h4 class="h_subsub">6.2. 카페 글쓰기</h4>
    <h5 class="h_subsub">- 호출</h5>
    <div class="code_area">
<pre class="prettyprint prettyprinted">
curl "https://openapi.naver.com/v1/cafe/{CAFE_ID}/menu/1/articles" \
  -H "Authorization: Bearer {접근 토큰}" \
-d "subject=cafe writing test&content=This is cafe writing API test." -v
</pre>
    </div>
    <p class="p_desc">
        subject와 content의 data 전달 시, UTF-8로 encode 후 MS949로 재 encode를 수행한 값을 전달해야합니다.
    </p>
    <h5 class="h_subsub">- 요청</h5>
    <div class="code_area">
<pre class="prettyprint prettyprinted">
> POST /v1/cafe/{CAFE_ID}/menu/1/articles HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> Authorization: Bearer AAAAOu4iYfvBjm/owAAIXR2d0XiDHzgOIJv3iAbTHDdBWQPzU+2D1MybX6IbzjUtRenvezRum42qUb5v+mBRwrzBDgs=
> Content-Length: 194
> Content-Type: application/x-www-form-urlencoded
</pre>
    </div>
    <h5 class="h_subsub">- 응답</h5>
    <div class="code_area">
        <pre class="prettyprint prettyprinted">
< HTTP/1.1 200 OK
< Server: nginx
< Date: Tue, 22 Nov 2016 06:37:12 GMT
< Content-Type: application/json;charset=utf-8
< Content-Length: 230
< Connection: keep-alive
< Keep-Alive: timeout=5
< Vary: Accept-Encoding
< Cache-Control: no-cache
< Expires: Thu, 01 Jan 1970 00:00:00 GMT
< Set-Cookie: ncu=""; Domain=.cafe.naver.com; Expires=Thu, 01-Jan-1970 00:00:10 GMT; Path=/
< Set-Cookie: ncu=8faa56716d3b45e1cd1976617aac1131b19964f3d6ec56; Domain=.cafe.naver.com; Path=/
< P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"
<
* Connection #0 to host openapi.naver.com left intact
{"message":
	{"@type":"response","@service":"korea.naverkoreaservice.community.cafe","@version":"1.0.0","status":"200","result":
		{"msg":"Success","cafeUrl":"{카페 URL}","articleId":4,"articleUrl":"https://cafe.naver.com/{카페 URL}/4"}
	}
}
</pre>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>
</body>
</html>
