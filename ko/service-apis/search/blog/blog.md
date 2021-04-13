# 블로그

<html lang="ko">
<head>
    <title>NAVER Developers - 검색 API 블로그 검색 개발가이드</title>
    <meta name="description" content="NAVER Developers - 검색 API 블로그 검색 개발가이드">
</head>
<body>
<div class="con">
    <div class="h_page_area">
        <h2 class="h_page">검색 &gt; 블로그</h2>
    </div>
    <p class="p_desc">
        네이버 블로그 검색 결과를 출력해주는 REST API입니다. 비로그인 오픈 API이므로
        GET으로 호출할 때 HTTP Header에 애플리케이션 등록 시 발급받은 <a href="https://developers.naver.com/docs/common/apicall" class="color_p2 underline ">Client ID와
        Client Secret 값을 같이 전송</a>해 주시면 활용 가능합니다.
    </p>
    <div class="buttons2">
        <a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?defaultScope=search">오픈 API 이용 신청 &gt;</a>
    </div>
    <h3 class="h_sub">0.API 호출 예제</h3>
    <div class="p_desc"> 예제 실행 전에 아래 <em class="color_p3">1.준비사항</em> 항목들을 꼭 체크하시길 바랍니다.</div>
    <!-- <ul class="tab_menu menu5">
        <li class="on"><a class="cursor">Java</a></li>
        <li><a class="cursor">PHP</a></li>
        <li><a class="cursor">Node.js</a></li>
        <li><a class="cursor">Python</a></li>
        <li><a class="cursor">C#</a></li>
    </ul> -->
    <div id="tutorial0">
    <div class="code_area">
        <h5>Java</h5>
       <pre class="prettyprint">네이버 검색 API예제는 블로그를 비롯 전문자료까지 호출방법이 동일하므로 blog검색만 대표로 예제를 올렸습니다.
// 네이버 검색 API 예제 - blog 검색
import java.io.*;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.HashMap;
import java.util.Map;
<br />
public class ApiExamSearchBlog {
<br />
    public static void main(String[] args) {
        String clientId = "YOUR_CLIENT_ID"; //애플리케이션 클라이언트 아이디값"
        String clientSecret = "YOUR_CLIENT_SECRET"; //애플리케이션 클라이언트 시크릿값"
<br />
        String text = null;
        try {
            text = URLEncoder.encode("그린팩토리", "UTF-8");
        } catch (UnsupportedEncodingException e) {
            throw new RuntimeException("검색어 인코딩 실패",e);
        }
<br />
        String apiURL = "https://openapi.naver.com/v1/search/blog?query=" + text;    // json 결과
        //String apiURL = "https://openapi.naver.com/v1/search/blog.xml?query="+ text; // xml 결과
<br />
        Map&lt;String, String&gt; requestHeaders = new HashMap<>();
        requestHeaders.put("X-Naver-Client-Id", clientId);
        requestHeaders.put("X-Naver-Client-Secret", clientSecret);
        String responseBody = get(apiURL,requestHeaders);
<br />
        System.out.println(responseBody);
    }
<br />
    private static String get(String apiUrl, Map&lt;String, String&gt; requestHeaders){
        HttpURLConnection con = connect(apiUrl);
        try {
            con.setRequestMethod("GET");
            for(Map.Entry&lt;String, String&gt; header :requestHeaders.entrySet()) {
                con.setRequestProperty(header.getKey(), header.getValue());
            }
<br />
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
<br />
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
<br />
    private static String readBody(InputStream body){
        InputStreamReader streamReader = new InputStreamReader(body);
<br />
        try (BufferedReader lineReader = new BufferedReader(streamReader)) {
            StringBuilder responseBody = new StringBuilder();
<br />
            String line;
            while ((line = lineReader.readLine()) != null) {
                responseBody.append(line);
            }
<br />
            return responseBody.toString();
        } catch (IOException e) {
            throw new RuntimeException("API 응답을 읽는데 실패했습니다.", e);
        }
    }
}</pre>
    </div>
    </div>
    <div id="tutorial1">
    <div class="code_area">
    <h5>PHP</h5>
        <pre class="prettyprint">네이버 검색 API예제는 블로그를 비롯 전문자료까지 호출방법이 동일하므로 blog검색만 대표로 예제를 올렸습니다.
// ssl 이슈가 있으면 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 를 추가해보시길 바랍니다.
// 네이버 검색 Open API 예제 - 블로그 검색
&lt;?php
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
  echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?&gt;</pre>
    </div>
    </div>
<br />
    <div id="tutorial2">
    <div class="code_area">
    <h5>Node.js</h5>
        <pre class="prettyprint">// 네이버 검색 API예제는 블로그를 비롯 전문자료까지 호출방법이 동일하므로 blog검색만 대표로 예제를 올렸습니다.
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
 });</pre>
    </div>
    </div>
    <div id="tutorial3">
    <div class="code_area">
    <h5>Python</h5>
        <pre class="prettyprint"># 네이버 검색 API예제는 블로그를 비롯 전문자료까지 호출방법이 동일하므로 blog검색만 대표로 예제를 올렸습니다.
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
    print("Error Code:" + rescode)</pre>
    </div>
    </div>
    <div id="tutorial4">
    <div class="code_area">
        <h5>C#</h5>
        <pre class="prettyprint">using System;
using System.Net;
using System.Text;
using System.IO;
<br />
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
}</pre>
    </div>
    </div>
    <h3 class="h_sub">1. 준비사항</h3>
    <ul class="list_type1">
        <li>애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 <a href="https://developers.naver.com/apps/#/register?defaultScope=search" class="color_p2 underline">'Application-애플리케이션
            등록'</a> 메뉴에서 애플리케이션을 등록하셔야 합니다. <br>
            <a href="https://developers.naver.com/docs/common/register" class="color_p2 underline">[자세한 방법 보기] &gt;</a></li>
        <li>클라이언트 ID와 secret 확인: <a href="https://developers.naver.com/appinfo" class="color_p2 underline">'내 애플리케이션'</a>에서 등록한 애플리케이션을 선택하면 Client
            ID와 Client Secret 값을 확인할 수 있습니다.
        </li>
        <li>API 권한 설정: <a href="https://developers.naver.com/appinfo" class="color_p2 underline">'내 애플리케이션'</a>의 'API 권한관리' 탭에서 사용하려는 API가 체크되어 있는지
            확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.
        </li>
    </ul>
<br />
    <h3 class="h_sub">2. API 기본 정보</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">API 기본 정보 설명 표</span></caption>
        <colgroup>
            <col>
            <col>
            <col style="width:40%">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">메서드</th>
            <th scope="col">인증</th>
            <th scope="col">요청 URL</th>
            <th scope="col">출력 포맷</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">GET</td>
            <td class="center">-</td>
            <td class="left">https://openapi.naver.com/v1/search/blog.xml</td>
            <td class="center">XML</td>
        </tr>
        <tr>
            <td class="center">GET</td>
            <td class="center">-</td>
            <td class="left">https://openapi.naver.com/v1/search/blog.json</td>
            <td class="center"><em class="color_p3">JSON</em></td>
        </tr>
        </tbody>
    </table>
<br />
    <h3 class="h_sub">3. 요청 변수</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">요청 변수 설명 표</span></caption>
        <colgroup>
            <col>
            <col>
            <col>
            <col style="width:20%">
            <col style="width:30%">
        </colgroup>
        <thead>
        <tr>
            <th scope="col">요청 변수</th>
            <th scope="col">타입</th>
            <th scope="col">필수 여부</th>
            <th scope="col">기본값</th>
            <th scope="col">설명</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">query</td>
            <td class="center">string</td>
            <td class="center">Y</td>
            <td>-</td>
            <td class="left">검색을 원하는 문자열로서 UTF-8로 인코딩한다.</td>
        </tr>
        <tr>
            <td class="center">display</td>
            <td class="center">integer</td>
            <td class="center">N</td>
            <td>10(기본값),100(최대)</td>
            <td class="left">검색 결과 출력 건수 지정</td>
        </tr>
        <tr>
            <td class="center">start</td>
            <td class="center">integer</td>
            <td class="center">N</td>
            <td>1(기본값), 1000(최대)</td>
            <td class="left">검색 시작 위치로 최대 1000까지 가능</td>
        </tr>
        <tr>
            <td class="center">sort</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td> sim(기본값), date</td>
            <td class="left">정렬 옵션: sim (유사도순), date (날짜순)</td>
        </tr>
        </tbody>
    </table>
<br />
    <h3 class="h_sub">4. 출력 결과</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">출력 결과 설명 표</span></caption>
        <colgroup>
            <col style="width:15%">
            <col style="width:10%">
            <col>
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
            <td class="center">rss</td>
            <td class="center">-</td>
            <td class="left">디버그를 쉽게 하고 RSS 리더기만으로 이용할 수 있게 하기 위해 만든 RSS 포맷의 컨테이너이며 그 외의 특별한 의미는 없다.</td>
        </tr>
        <tr>
            <td class="center">channel</td>
            <td class="center">-</td>
            <td class="left">색 결과를 포함하는 컨테이너이다. 이 안에 있는 title, link, description 등의 항목은 참고용으로 무시해도 무방하다.</td>
        </tr>
        <tr>
            <td class="center">lastBuildDate</td>
            <td class="center">datetime</td>
            <td class="left">검색 결과를 생성한 시간이다.</td>
        </tr>
        <tr>
            <td class="center">postdate</td>
            <td class="center">datetime</td>
            <td class="left">블로그 포스트를 작성한 날짜이다.</td>
        </tr>
        <tr>
            <td class="center">total</td>
            <td class="center">integer</td>
            <td class="left">검색 결과 문서의 총 개수를 의미한다.</td>
        </tr>
        <tr>
            <td class="center">start</td>
            <td class="center">integer</td>
            <td class="left">검색 결과 문서 중, 문서의 시작점을 의미한다.</td>
        </tr>
        <tr>
            <td class="center">display</td>
            <td class="center">integer</td>
            <td class="left">검색된 검색 결과의 개수이다.</td>
        </tr>
        <tr>
            <td class="center">item/items</td>
            <td class="center">-</td>
            <td class="left">XML 포멧에서는 item 태그로, JSON 포멧에서는 items 속성으로 표현된다. 개별 검색 결과이며 title, link, description, bloggername, bloggerlink을 포함한다.</td>
        </tr>
        <tr>
            <td class="center">title</td>
            <td class="center">string</td>
            <td class="left">검색 결과 문서의 제목을 나타낸다. 제목에서 검색어와 일치하는 부분은 <strong>태그로 감싸져 있다.</strong></td>
        </tr>
        <tr>
            <td class="center">link</td>
            <td class="center">string</td>
            <td class="left">검색 결과 문서의 하이퍼텍스트 link를 나타낸다.</td>
        </tr>
        <tr>
            <td class="center">description</td>
            <td class="center">string</td>
            <td class="left">검색 결과 문서의 내용을 요약한 패시지 정보이다. 문서 전체의 내용은 link를 따라가면 읽을 수 있다. 패시지에서 검색어와 일치하는 부분은 <strong>태그로
                감싸져 있다.</strong></td>
        </tr>
        <tr>
            <td class="center">bloggername</td>
            <td class="center">string</td>
            <td class="left">검색 결과 블로그 포스트를 작성한 블로거의 이름이다.</td>
        </tr>
        <tr>
            <td class="center">bloggerlink</td>
            <td class="center">string</td>
            <td class="left">검색 결과 블로그 포스트를 작성한 블로거의 하이퍼텍스트 link이다.</td>
        </tr>
        </tbody>
    </table>
<br />
<br />
    <h3 class="h_sub">5. 에러 코드 </h3>
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
            <td class="center color_p3">400</td>
            <td class="center">SE01</td>
            <td class="left">Incorrect query request (잘못된 쿼리요청입니다.)</td>
            <td class="left">검색 API 요청에 오류가 있습니다. 요청 URL, 필수 요청 변수가 정확한지 확인 바랍니다.</td>
        </tr>
        <tr>
            <td class="center color_p3">400</td>
            <td class="center">SE02</td>
            <td class="left">Invalid display value (부적절한 display 값입니다.)</td>
            <td class="left">display 요청 변수값이 허용 범위(1~100)인지 확인해 보세요.</td>
        </tr>
        <tr>
            <td class="center color_p3">400</td>
            <td class="center">SE03</td>
            <td class="left">Invalid start value (부적절한 start 값입니다.)</td>
            <td class="left">start 요청 변수값이 허용 범위(1~1000)인지 확인해 보세요.</td>
        </tr>
        <tr>
            <td class="center color_p3">400</td>
            <td class="center">SE04</td>
            <td class="left">Invalid sort value (부적절한 sort 값입니다.)</td>
            <td class="left">sort 요청 변수 값에 오타가 없는지 확인해 보세요.</td>
        </tr>
        <tr>
            <td class="center color_p3">400</td>
            <td class="center">SE06</td>
            <td class="left">Malformed encoding (잘못된 형식의 인코딩입니다.)</td>
            <td class="left">검색어를 UTF-8로 인코딩하세요.</td>
        </tr>
        <tr>
            <td class="center color_p3">404</td>
            <td class="center">SE05</td>
            <td class="left">Invalid search api (존재하지 않는 검색 api 입니다.)</td>
            <td class="left">검색 API 대상에 오타가 없는지 확인해 보세요.</td>
        </tr>
        <tr>
            <td class="center color_p3">500</td>
            <td class="center">SE99</td>
            <td class="left">System Error (시스템 에러)</td>
            <td class="left">서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다.</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">6. 예시 </h3>
    <h4 class="h_subsub">호출</h4>
    <div class="code_area">
<pre class="prettyprint prettyprinted">
curl  "https://openapi.naver.com/v1/search/blog.xml?query=%EB%A6%AC%EB%B7%B0&display=10&start=1&sort=sim" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}" -v
</pre>
    </div>
    <h4 class="h_subsub">요청</h4>
    <div class="code_area">
<pre class="prettyprint prettyprinted">
> GET /v1/search/blog.xml?query=%EB%A6%AC%EB%B7%B0&display=10&start=1&sort=sim HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}
>
</pre>
<br />
    </div>
    <h4 class="h_subsub">응답</h4>
    <div class="code_area">
<br />
<pre class="prettyprint prettyprinted">
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
&lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;
&lt;rss version=&quot;2.0&quot;&gt;
    &lt;channel&gt;
        &lt;title&gt;Naver Open API - blog ::'&#xb9ac;&#xbdf0;'&lt;/title&gt;
        &lt;link&gt;http://search.naver.com&lt;/link&gt;
        &lt;description&gt;Naver Search Result&lt;/description&gt;
        &lt;lastBuildDate&gt;Mon, 26 Sep 2016 10:39:37 +0900&lt;/lastBuildDate&gt;
        &lt;total&gt;8714891&lt;/total&gt;
        &lt;start&gt;1&lt;/start&gt;&lt;display&gt;10&lt;/display&gt;
        &lt;item&gt;
            &lt;title&gt;&#xba85;&#xc608;&#xd6fc;&#xc190; &#xc5c6;&#xc774; &lt;b&gt;&#xb9ac;&#xbdf0;&lt;/b&gt;&#xc4f0;&#xae30;&lt;/title&gt;
            &lt;link&gt;http://openapi.naver.com/l?AAABWLyw6CMBREv+ayNJe2UrrogvJwg8aYKGvACiSUalNR/t6azGLO5Mzrrd0moVSQJZDl/6I4KIxGpx9y9P4JNANShXSzHXZLu2q3660Jw2bt0k1+aF1rgFYXfZ+c7j3QorYDkCT4JxuIEEyRUYGcxpGXMeMs3VPBOUEWGXntynUW03k7ohBYfG+mOdRqbPL6E84/apnqgaEAAAA=&lt;/link&gt;
            &lt;description&gt;&#xba85;&#xc608;&#xd6fc;&#xc190; &#xc5c6;&#xc774; &lt;b&gt;&#xb9ac;&#xbdf0;&lt;/b&gt;&#xc4f0;&#xae30; &#xc6b0;&#xb9ac; &#xbe14;&#xb85c;&#xadf8;&#xd558;&#xc2dc;&#xb294; &#xbd84;&#xb4e4;&#xaed8;&#xb294; &#xaf64; &#xc911;&#xc694;&#xd55c; &#xb0b4;&#xc6a9;&#xc77c; &#xc218;&#xb3c4; &#xc788;&#xc2b5;&#xb2c8;&#xb2e4; &#xadf8;&#xac83;&#xb3c4; &#xc8fc;&#xb85c; &lt;b&gt;&#xb9ac;&#xbdf0;&lt;/b&gt; &#xc704;&#xc8fc;&#xb85c; &#xbe14;&#xb85c;&#xadf8;&#xb97c; &#xc9c4;&#xd589;&#xd558;&#xc2e0; &#xbd84;&#xc774;&#xb77c;&#xba74; &#xb354;&#xc6b1; &#xb354; &#xb9d0;&#xc774;&#xc8e0;
                &#xc624;&#xb298; &#xd3ec;&#xc2a4;&#xd305;&#xc740;, &#xc5b4;&#xb5bb;&#xac8c; &#xd558;&#xba74; &#xac1d;&#xad00;&#xc801;&#xc774;&#xace0; &#xc88b;&#xc740; &lt;b&gt;&#xb9ac;&#xbdf0;&lt;/b&gt;&#xb97c;... &lt;/description&gt;
            &lt;bloggername&gt;&#xac74;&#xc9f1;&#xc758; Best Drawing World2&lt;/bloggername&gt;
            &lt;bloggerlink&gt;http://blog.naver.com/yoonbitgaram&lt;/bloggerlink&gt;
            &lt;postdate&gt;20161208&lt;/postdate&gt;
        &lt;/item&gt;
        ...
    &lt;/channel&gt;
&lt;/rss&gt;
</pre>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>
</body>
</html>