# 캘린더 일정 추가 API 명세

<html lang="ko">
<head>
    <title>NAVER Developers - 캘린더 개발가이드</title>
    <meta name="description" content="NAVER Developers - 캘린더 개발가이드">
</head>
<body>
<div class="con">
    <div class="h_page_area">
        <h2 class="h_page">캘린더 일정 추가 API 명세</h2>
    </div>
    <p class="p_desc">
        네이버 사용자 캘린더에 일정을 추가할 수 있는 로그인 오픈 API입니다. 기존 REST API처럼 요청 URL과 요청 변수로 호출하는 방법은 동일하나, OAuth 2.0 인증 기반이므로 추가적으로 <a href="/docs/login/api" class="color_p2 underline">네이버 로그인 API</a>를 통해 접근 토큰(access token)을 발급받아,
        HTTP로 호출할 때 Header에 접근 토큰을 같이 전송해 주시면 활용 가능합니다.
    </p>
    <div class="buttons2">
        <!-- {{#env.billing}} -->
        <a class="btn_b_hi3" href="/apps/#/register?api=calendar">오픈 API 이용 신청 &gt;</a>
        <!-- {{/env.billing}}
        {{^env.billing}}
        <a class="btn_b_hi3" href="/apps/#/register">오픈 API 이용 신청 &gt;</a>
        {{/env.billing}} -->
    </div>
    <h3 class="h_sub">API 호출 예제</h3>
    <div class="p_desc"> 예제 실행 전에 아래 <em class="color_p3">1.준비사항</em> 항목들을 꼭 체크하시길 바랍니다.</div>
    <ul class="tab_menu menu5">
        <li class="on"><a class="cursor">Java</a></li>
        <li><a class="cursor">PHP</a></li>
        <li><a class="cursor">Node.js</a></li>
        <li><a class="cursor">Python</a></li>
        <li><a class="cursor">C#</a></li>
    </ul>
    <div id="tutorial0">
    <div class="code_area">
       <pre class="prettyprint">// 네이버 API 예제 - 캘린더 일정 추가하기
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.UUID;

public class APIExamCalendar {

    public static void main(String[] args) {
        String token = "YOUR_ACCESS_TOKEN";
        String header = "Bearer " + token; // Bearer 다음에 공백 추가
        try {
            String apiURL = "https://openapi.naver.com/calendar/createSchedule.json";
            URL url = new URL(apiURL);
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("POST");
            con.setRequestProperty("Authorization", header);
            String calSum =  URLEncoder.encode("[제목] 캘린더API로 추가한 일정", "UTF-8");
            String calDes =  URLEncoder.encode("[상세] 회의 합니다", "UTF-8");
            String calLoc =  URLEncoder.encode("[장소] 그린팩토리", "UTF-8");
            String uid = UUID.randomUUID().toString();
            String scheduleIcalString = "BEGIN:VCALENDAR\n" +
                    "VERSION:2.0\n" +
                    "PRODID:Naver Calendar\n" +
                    "CALSCALE:GREGORIAN\n" +
                    "BEGIN:VTIMEZONE\n" +
                    "TZID:Asia/Seoul\n" +
                    "BEGIN:STANDARD\n" +
                    "DTSTART:19700101T000000\n" +
                    "TZNAME:GMT%2B09:00\n" +
                    "TZOFFSETFROM:%2B0900\n" +
                    "TZOFFSETTO:%2B0900\n" +
                    "END:STANDARD\n" +
                    "END:VTIMEZONE\n" +
                    "BEGIN:VEVENT\n" +
                    "SEQUENCE:0\n" +
                    "CLASS:PUBLIC\n" +
                    "TRANSP:OPAQUE\n" +
                    "UID:" + uid + "\n" +                          // 일정 고유 아이디
                    "DTSTART;TZID=Asia/Seoul:20161116T170000\n" +  // 시작 일시
                    "DTEND;TZID=Asia/Seoul:20161116T173000\n" +    // 종료 일시
                    "SUMMARY:"+ calSum +" \n" +                    // 일정 제목
                    "DESCRIPTION:"+ calDes +" \n" +                // 일정 상세 내용
                    "LOCATION:"+ calLoc +" \n" +                   // 장소
                    "RRULE:FREQ=YEARLY;BYDAY=FR;INTERVAL=1;UNTIL=20201231\n" +  // 일정 반복시 설정
                    "ORGANIZER;CN=관리자:mailto:admin@sample.com\n" + // 일정 만든 사람
                    "ATTENDEE;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;CN=admin:mailto:user1@sample.com\n" + // 참석자
                    "CREATED:20161116T160000\n" +         // 일정 생성시각
                    "LAST-MODIFIED:20161116T160000\n" +   // 일정 수정시각
                    "DTSTAMP:20161116T160000\n" +         // 일정 타임스탬프
                    "END:VEVENT\n" +
                    "END:VCALENDAR";
            String postParams = "calendarId=defaultCalendarId&scheduleIcalString=" + scheduleIcalString;
            System.out.println(postParams);
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
}</pre>
    </div>
    </div>
    <div style="display:none" id="tutorial1">
    <div class="code_area">
        <pre class="prettyprint">// 네이버 캘린더 Open API 예제 - 일정추가
&lt;?php
  $token = "YOUR_ACCESS_TOKEN";
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $url = "https://openapi.naver.com/calendar/createSchedule.json";

  $calSum =  urlencode("[제목] 캘린더API로 추가한 일정");
  $calDes =  urlencode("[상세] 회의 합니다");
  $calLoc =  urlencode("[장소] 그린팩토리");
  $uid = substr($token, 0, 15);// UUID 생성 (임시로 일단 토큰값을 잘라서 사용)
  $scheduleIcalString = "BEGIN:VCALENDAR\n" .
                    "VERSION:2.0\n" .
                    "PRODID:Naver Calendar\n" .
                    "CALSCALE:GREGORIAN\n" .
                    "BEGIN:VTIMEZONE\n" .
                    "TZID:Asia/Seoul\n" .
                    "BEGIN:STANDARD\n" .
                    "DTSTART:19700101T000000\n" .
                    "TZNAME:GMT%2B09:00\n" .
                    "TZOFFSETFROM:%2B0900\n" .
                    "TZOFFSETTO:%2B0900\n" .
                    "END:STANDARD\n" .
                    "END:VTIMEZONE\n" .
                    "BEGIN:VEVENT\n" .
                    "SEQUENCE:0\n" .
                    "CLASS:PUBLIC\n" .
                    "TRANSP:OPAQUE\n" .
                    "UID:".$uid."\n" .                         // 일정 고유 아이디
                    "DTSTART;TZID=Asia/Seoul:20161116T180000\n" .  // 시작 일시
                    "DTEND;TZID=Asia/Seoul:20161116T183000\n" .    // 종료 일시
                    "SUMMARY:".$calSum." \n" .                    // 일정 제목
                    "DESCRIPTION:".$calDes." \n" .                // 일정 상세 내용
                    "LOCATION:".$calLoc." \n" .                   // 장소
                    //"RRULE:FREQ=YEARLY;BYDAY=FR;INTERVAL=1;UNTIL=20201231\n" .  // 일정 반복시 설정
                    "ORGANIZER;CN=관리자:mailto:admin@sample.com\n" . // 일정 만든 사람
                    "ATTENDEE;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;CN=admin:mailto:user1@sample.com\n" . // 참석자
                    "CREATED:20161116T160000\n" .         // 일정 생성시각
                    "LAST-MODIFIED:20161116T160000\n" .   // 일정 수정시각
                    "DTSTAMP:20161116T160000\n" .         // 일정 타임스탬프
                    "END:VEVENT\n" .
                    "END:VCALENDAR";
  $postvars = "calendarId=defaultCalendarId&scheduleIcalString=".$scheduleIcalString;
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
    <div  style="display:none" id="tutorial2">
    <div class="code_area">
       <pre class="prettyprint">// 네이버 API 예제 - 캘린더 일정 추가하기
var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN";
var header = "Bearer " + token; // Bearer 다음에 공백 추가
var calSum =  "[제목] 캘린더API로 추가한 일정";
var calDes =  "[상세] 회의 합니다";
var calLoc =  "[장소] 그린팩토리";
var uid = token.substring(0, 15);// UUID 생성 (임시로 일단 토큰값을 잘라서 사용)
var scheduleIcalString = "BEGIN:VCALENDAR\n"
scheduleIcalString += "VERSION:2.0\n"
scheduleIcalString += "PRODID:Naver Calendar\n"
scheduleIcalString += "CALSCALE:GREGORIAN\n"
scheduleIcalString += "BEGIN:VTIMEZONE\n"
scheduleIcalString += "TZID:Asia/Seoul\n"
scheduleIcalString += "BEGIN:STANDARD\n"
scheduleIcalString += "DTSTART:19700101T000000\n"
scheduleIcalString += "TZNAME:GMT+:00\n"
scheduleIcalString += "TZOFFSETFROM:+0900\n"
scheduleIcalString += "TZOFFSETTO:+0900\n"
scheduleIcalString += "END:STANDARD\n"
scheduleIcalString += "END:VTIMEZONE\n"
scheduleIcalString += "BEGIN:VEVENT\n"
scheduleIcalString += "SEQUENCE:0\n"
scheduleIcalString += "CLASS:PUBLIC\n"
scheduleIcalString += "TRANSP:OPAQUE\n"
scheduleIcalString += "UID:" + uid + "\n"                            // 일정 고유 아이디
scheduleIcalString += "DTSTART;TZID=Asia/Seoul:20161116T190000\n"     // 시작 일시
scheduleIcalString += "DTEND;TZID=Asia/Seoul:20161116T193000\n"      // 종료 일시
scheduleIcalString += "SUMMARY:" + calSum + " \n"                     // 일정 제목
scheduleIcalString += "DESCRIPTION:" + calDes + " \n"                 // 일정 상세 내용
scheduleIcalString += "LOCATION:" + calLoc + " \n"                   // 장소
// scheduleIcalString += "RRULE:FREQ=YEARLY;BYDAY=FR;INTERVAL=1;UNTIL=20201231\n" +  // 일정 반복시 설정
scheduleIcalString += "ORGANIZER;CN=관리자:mailto:admin@sample.com\n"  // 일정 만든 사람
scheduleIcalString += "ATTENDEE;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;CN=admin:mailto:user1@sample.com\n"  // 참석자
scheduleIcalString += "CREATED:20161116T160000\n"          // 일정 생성시각
scheduleIcalString += "LAST-MODIFIED:20161122T160000\n"   // 일정 수정시각
scheduleIcalString += "DTSTAMP:20161122T160000\n"          // 일정 타임스탬프
scheduleIcalString += "END:VEVENT\n"
scheduleIcalString += "END:VCALENDAR"
app.get('/calendar', function (req, res) {
   var api_url = 'https://openapi.naver.com/calendar/createSchedule.json';
   var request = require('request');
   var options = {
       url: api_url,
       form: {'calendarId':'defaultCalendarId', 'scheduleIcalString':scheduleIcalString},
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
   console.log('http://127.0.0.1:3000/calendar app listening on port 3000!');
 });</pre>
    </div>
    </div>
    <div style="display:none" id="tutorial3">
    <div class="code_area">
       <pre class="prettyprint"># 네이버 API 예제 - 캘린더 일정 추가하기
import os
import sys
import urllib.request
token = "YOUR_ACCESS_TOKEN"
header = "Bearer " + token # Bearer 다음에 공백 추가
url = "https://openapi.naver.com/calendar/createSchedule.json"

calSum =  urllib.parse.quote("[제목] Py 캘린더API로 추가한 일정")
calDes =  urllib.parse.quote("[상세] 회의 합니다")
calLoc =  urllib.parse.quote("[장소] 그린팩토리")
uid = token[1:15] # UUID 생성 (임시로 일단 토큰값을 잘라서 사용)

scheduleIcalString = "BEGIN:VCALENDAR\n"
scheduleIcalString += "VERSION:2.0\n"
scheduleIcalString += "PRODID:Naver Calendar\n"
scheduleIcalString += "CALSCALE:GREGORIAN\n"
scheduleIcalString += "BEGIN:VTIMEZONE\n"
scheduleIcalString += "TZID:Asia/Seoul\n"
scheduleIcalString += "BEGIN:STANDARD\n"
scheduleIcalString += "DTSTART:19700101T000000\n"
scheduleIcalString += "TZNAME:GMT%2B09:00\n"
scheduleIcalString += "TZOFFSETFROM:%2B0900\n"
scheduleIcalString += "TZOFFSETTO:%2B0900\n"
scheduleIcalString += "END:STANDARD\n"
scheduleIcalString += "END:VTIMEZONE\n"
scheduleIcalString += "BEGIN:VEVENT\n"
scheduleIcalString += "SEQUENCE:0\n"
scheduleIcalString += "CLASS:PUBLIC\n"
scheduleIcalString += "TRANSP:OPAQUE\n"
scheduleIcalString += "UID:" + uid + "\n"                            # 일정 고유 아이디
scheduleIcalString += "DTSTART;TZID=Asia/Seoul:20161116T190000\n"     # 시작 일시
scheduleIcalString += "DTEND;TZID=Asia/Seoul:20161116T193000\n"       # 종료 일시
scheduleIcalString += "SUMMARY:" + calSum + " \n"                     # 일정 제목
scheduleIcalString += "DESCRIPTION:" + calDes + " \n"                 # 일정 상세 내용
scheduleIcalString += "LOCATION:" + calLoc + " \n"                   # 장소
#scheduleIcalString += "RRULE:FREQ=YEARLY;BYDAY=FR;INTERVAL=1;UNTIL=20201231\n" +  # 일정 반복시 설정
scheduleIcalString += "ORGANIZER;CN=관리자:mailto:admin@sample.com\n"  # 일정 만든 사람
scheduleIcalString += "ATTENDEE;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;CN=admin:mailto:user1@sample.com\n"  # 참석자
scheduleIcalString += "CREATED:20161116T160000\n"           # 일정 생성시각
scheduleIcalString += "LAST-MODIFIED:20161116T160000\n"    # 일정 수정시각
scheduleIcalString += "DTSTAMP:20161116T160000\n"          # 일정 타임스탬프
scheduleIcalString += "END:VEVENT\n"
scheduleIcalString += "END:VCALENDAR"

print(scheduleIcalString)

data = "calendarId=defaultCalendarId&scheduleIcalString=" + scheduleIcalString
request = urllib.request.Request(url, data=data.encode("utf-8"))
request.add_header("Authorization", header)
response = urllib.request.urlopen(request)
rescode = response.getcode()
if(rescode==200):
    response_body = response.read()
    print(response_body.decode('utf-8'))
else:
    print("Error Code:" + rescode)</pre>
    </div>
    </div>
    <div style="display:none" id="tutorial4">
    <div class="code_area">
       <pre class="prettyprint">// 네이버 API 예제 - 캘린더 일정 추가하기
using System;
using System.Net;
using System.Text;
using System.IO;
using System.Web;

namespace NaverAPI_Guide
{
    public class APIExamCalendar
    {
        static void Main(string[] args)
        {
            string token = "YOUR-ACCESS-TOKEN";// 네이버 로그인 접근 토큰;
            string header = "Bearer " + token; // Bearer 다음에 공백 추가
            string apiURL = "https://openapi.naver.com/calendar/createSchedule.json";
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(apiURL);
            request.Headers.Add("X-Naver-Client-Id", "YOUR-CLIENT-ID");
            request.Headers.Add("X-Naver-Client-Secret", "YOUR-CLIENT-SECRET");
            request.Headers.Add("Authorization", header);
            request.Method = "POST";
            string calSum = "[제목] 캘린더API로 추가한 일정";
            string calDes = "[상세] 회의 합니다";
            string calLoc = "[장소] 그린팩토리";
            string uid = "RANDOM-UUID";

            string scheduleIcalString = "BEGIN:VCALENDAR\n" +
                  "VERSION:2.0\n" +
                  "PRODID:Naver Calendar\n" +
                  "CALSCALE:GREGORIAN\n" +
                  "BEGIN:VTIMEZONE\n" +
                  "TZID:Asia/Seoul\n" +
                  "BEGIN:STANDARD\n" +
                  "DTSTART:19700101T000000\n" +
                  "TZNAME:GMT%2B09:00\n" +
                  "TZOFFSETFROM:%2B0900\n" +
                  "TZOFFSETTO:%2B0900\n" +
                  "END:STANDARD\n" +
                  "END:VTIMEZONE\n" +
                  "BEGIN:VEVENT\n" +
                  "SEQUENCE:0\n" +
                  "CLASS:PUBLIC\n" +
                  "TRANSP:OPAQUE\n" +
                  "UID:" + uid + "\n" +                          // 일정 고유 아이디
                  "DTSTART;TZID=Asia/Seoul:20161126T170000\n" +  // 시작 일시
                  "DTEND;TZID=Asia/Seoul:20161126T173000\n" +    // 종료 일시
                  "SUMMARY:" + calSum + " \n" +                    // 일정 제목
                  "DESCRIPTION:" + calDes + " \n" +                // 일정 상세 내용
                  "LOCATION:" + calLoc + " \n" +                   // 장소
                  "RRULE:FREQ=YEARLY;BYDAY=FR;INTERVAL=1;UNTIL=20201231\n" +  // 일정 반복시 설정
                  "ORGANIZER;CN=관리자:mailto:admin@sample.com\n" + // 일정 만든 사람
                  "ATTENDEE;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;CN=admin:mailto:user1@sample.com\n" + // 참석자
                  "CREATED:20161116T160000\n" +         // 일정 생성시각
                  "LAST-MODIFIED:20161116T160000\n" +   // 일정 수정시각
                  "DTSTAMP:20161116T160000\n" +         // 일정 타임스탬프
                  "END:VEVENT\n" +
                  "END:VCALENDAR";

            byte[] byteDataParams = Encoding.UTF8.GetBytes("calendarId=defaultCalendarId&scheduleIcalString=" + scheduleIcalString);
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
}</pre>
    </div>
    </div>
    <h3 class="h_sub">1. 준비사항</h3>
    <ul class="list_type1">
        <li>애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 <a href="/apps/#/register"  class="color_p2 underline">'Application-애플리케이션 등록'</a> 메뉴에서 애플리케이션을 등록하셔야 합니다. <br>
            <a href="/docs/common/register"  class="color_p2 underline">[자세한 방법 보기] &gt;</a></li>
        <li>클라이언트 ID와 secret 확인: <a href="/appinfo" class="color_p2 underline">'내 애플리케이션'</a>에서 등록한 애플리케이션을 선택하면 Client ID와 Client Secret 값을 확인할 수 있습니다.</li>
        <li>API 권한 설정: <a href="/appinfo" class="color_p2 underline">'내 애플리케이션'</a>의 'API 권한관리' 탭에서 사용하려는 API가 체크되어 있는지 확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.
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
            <col>
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
            <td class="left">https://openapi.naver.com/calendar/createSchedule.json</td>
            <td class="center">json</td>
            <td class="center">캘린더 일정 추가</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">3. 요청 변수</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">요청 변수 설명 표</span></caption>
        <colgroup>
            <col>
            <col>
            <col><col><col style="width:40%">
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
            <td class="center">calendarId</td>
            <td class="center">string</td>
            <td class="center">Y</td>
            <td class="center">-</td>
            <td class="left">캘린더ID.defaultCalendarId를 입력하면 기본 캘린더에 일정이 생성된다.</td>
        </tr>
        <tr>
            <td class="center">scheduleIcalString</td>
            <td class="center">string</td>
            <td class="center">Y</td>
            <td class="center">-</td>
            <td class="left">iCalendar 데이터</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">4. 출력 결과</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">출력 결과 설명 표</span></caption>
        <colgroup>
            <col>
            <col>
            <col style="width:60%">
        </colgroup>
        <thead>
        <tr>
            <th scope="col">필드 </th>
            <th scope="col">타입</th>
            <th scope="col">설명</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">result</td>
            <td class="center">string</td>
            <td class="center">성공 시 'success' 출력</td>
        </tr>
        <tr>
            <td class="center">returnValue</td>
            <td class="center">string</td>
            <td class="center">processType, 일정이 생성된 캘린더 ID (create, modify)</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">5. 에러 코드 </h3>
    <div class="p_desc"> 공통 에러 코드는 <a href="/docs/common/common_error" class="color_p2 underline">여기</a>를 참조하세요.</div>
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
            <td class="center">1403</td>
            <td class="left">권한이 없습니다. / 해당 캘린더의 마스터, 관리자, 또는 정회원이 아닌 경우</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">404</td>
            <td class="center">1404</td>
            <td class="left">존재하지 않는 캘린더입니다. / 캘린더가 삭제됐거나 캘린더 ID가 잘못된 경우</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="center color_p3">500</td>
            <td class="center">1500</td>
            <td class="left">일시적인 서버 오류입니다. / 서버 오류가 반복되면 담당자에게 문의한다.</td>
            <td class="left">서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다.</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">6. 예시 </h3>
    <h4 class="h_subsub">호출</h4>
    <div class="code_area">
                    <pre class="prettyprint prettyprinted">
curl "https://openapi.naver.com/calendar/createSchedule.json" \
  -H "Authorization: Bearer {접근 토큰}" \
  -d "calendarId=defaultCalendarId&\
scheduleIcalString=\
BEGIN:VCALENDAR%0A\
VERSION:2.0%0A\
PRODID:Naver Calendar%0A\
CALSCALE:GREGORIAN%0A\
BEGIN:VTIMEZONE%0A\
TZID:Asia/Seoul%0A\
BEGIN:STANDARD%0A\
DTSTART:19700101T000000%0A\
TZNAME:GMT%2B09:00%0A\
TZOFFSETFROM:%2B0900%0A\
TZOFFSETTO:%2B0900%0A\
END:STANDARD%0A\
END:VTIMEZONE%0A\
BEGIN:VEVENT%0A\
SEQUENCE:0%0A\
CLASS:PUBLIC%0A\
TRANSP:OPAQUE%0A\
UID:AAANhUwx08hWG3%0A\
DTSTART;TZID=Asia/Seoul:20161116T190000%0A\
DTEND;TZID=Asia/Seoul:20161116T193000%0A\
SUMMARY:%5B%EC%A0%9C%EB%AA%A9%5D+%EC%BA%98%EB%A6%B0%EB%8D%94API%EB%A1%9C+%EC%B6%94%EA%B0%80%ED%95%9C+%EC%9D%BC%EC%A0%95 %0A\
DESCRIPTION:%5B%EC%83%81%EC%84%B8%5D+%ED%9A%8C%EC%9D%98%ED%95%A9%EB%8B%88%EB%8B%A4. %0A\
LOCATION:%5B%EC%9E%A5%EC%86%8C%5D%20%EA%B7%B8%EB%A6%B0%ED%8C%A9%ED%86%A0%EB%A6%AC %0A\
ORGANIZER;CN={요청자 이름}:mailto:{요청자 이메일}%0A\%0A\
ATTENDEE;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;CN={참석자 이름}:mailto:{참석자 이메일}%0A\%0A\
CREATED:20161116T160000%0A\
LAST-MODIFIED:20161116T160000%0A\
DTSTAMP:20161116T160000%0A\
END:VEVENT%0A\
END:VCALENDAR" -v
</pre>
    </div>
    <p class="p_desc">
        위 예제의 데이터 입력 문자열에서 %0A는 쉘 커멘드 창에서 줄바꿈(\n)을 의미하며, \는 쉘 커멘드 창에서 한 줄을 여러 줄로 나누어 입력하기 위해 사용합니다.<br>
        SUMMARY, DESCRIPTION, LOCATION은 UTF-8로 인코딩한 값을 입력합니다. 위의 호출 예제에서 UTF-8로 인코딩한 값은 다음과 같습니다.<br>
        - SUMMARY:[제목] 캘린더API로 추가한 일정<br>
        - DESCRIPTION:[상세] 회의합니다.<br>
        - LOCATION:[장소] 그린팩토리<br>
    </p>
    <h4 class="h_subsub">요청</h4>
    <div class="code_area">
                    <pre class="prettyprint prettyprinted">
> POST /calendar/createSchedule.json HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> Authorization: Bearer {접근 토큰}
> Content-Length: 1039
> Content-Type: application/x-www-form-urlencoded
> Expect: 100-continue
                    </pre>
    </div>
    <h4 class="h_subsub">응답</h4>
    <div class="code_area">
                    <pre class="prettyprint prettyprinted">
< HTTP/1.1 100 Continue
* We are completely uploaded and fine
< HTTP/1.1 200 OK
< Server: nginx
< Date: Tue, 22 Nov 2016 06:18:56 GMT
< Content-Type: text/html;charset=UTF-8
< Content-Length: 108
< Connection: keep-alive
< Keep-Alive: timeout=5
< Vary: Accept-Encoding
<
* Connection #0 to host openapi.naver.com left intact
{"result":"success","returnValue":{"processType":"create","calendarId":"870711","icalUid":"AAANhUwx08hWG3"}}
                    </pre>
    </div>
    <h3 class="h_sub">7. iCalendar 데이터 형식 </h3>
    <h4 class="h_subsub">7.1. 개요</h4>
    <p class="p_desc">
        인터넷 사용자들이 다른 인터넷 사용자들에게 전자 메일을 이용하여 미팅 요청과 할 일을 보내거나 .ics 확장자로 파일들을 공유할 수 있게 해 주는 컴퓨터 파일 형식입니다. iCalendar 데이터 파일을 받은 사람들은 이메일 클라이언트나 캘린더 프로그램 따위를 이용하여 보낸 이에게 쉽게 응답할 수 있고 역으로 다른 미팅 일정을 제안할 수 있습니다.
    </p>
    <h4 class="h_subsub">7.2. 샘플 코드</h4>
    <div class="code_area">
                        <pre class="prettyprint prettyprinted">
BEGIN:VCALENDAR
VERSION:2.0
PRODID:Naver Calendar
CALSCALE:GREGORIAN
BEGIN:VTIMEZONE
TZID:Asia/Seoul
BEGIN:STANDARD
DTSTART:19700101T000000
TZNAME:GMT+09:00
TZOFFSETFROM:+0900
TZOFFSETTO:+0900
END:STANDARD
END:VTIMEZONE
BEGIN:VEVENT
SEQUENCE:0
CLASS:PUBLIC
TRANSP:OPAQUE
UID:<span class="nocode highlight red">6E12DA93-8B43-4576-9A8A-31B4BDC8</span>
DTSTART<span class="nocode highlight red">;TZID=Asia/Seoul:20140905T110000</span>
DTEND<span class="nocode highlight red">;TZID=Asia/Seoul:20140905T120000</span>
SUMMARY:<span class="nocode highlight red">매주반복 샘플</span>
DESCRIPTION:<span class="nocode highlight red">상세 설명영역</span>
LOCATION:<span class="nocode highlight red">여기에서</span>
RRULE:<span class="nocode highlight red">FREQ=WEEKLY;BYDAY=FR;INTERVAL=1;UNTIL=20141030</span>
ORGANIZER<span class="nocode highlight red">;CN=별명:mailto:userid@sample.com</span>
ATTENDEE<span class="nocode highlight red">;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;CN=참석자:mailto:userId2@sample.com</span>
CREATED:<span class="nocode highlight red">20140905T015408Z</span>
LAST-MODIFIED:<span class="nocode highlight red">20140905T015408Z</span>
DTSTAMP:<span class="nocode highlight red">20140905T015409Z</span>
END:VEVENT
END:VCALENDAR</pre>
    </div>
    <h4 class="h_subsub">7.3. 코드 설명</h4>
    <p class="p_desc">
        다음 표를 참고하여 샘플 코드의 <span class="nocode highlight red">빨간색 영역에서 기존 값을 수정하거나 새로운 값을 입력</span>하여 iCalendar를 생성합니다.<br/>
    </p>
    <table border="1" class="tbl_h">
        <caption><span class="blind">iCalendar 데이터 코드 설명 표</span></caption>
        <colgroup>
            <col style="width:20%"><col><col style="width:35%">
        </colgroup>
        <thead>
        <tr>
            <th scope="col">속성</th>
            <th scope="col">설명</th>
            <th scope="col">참고 링크</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="left">UID</td>
            <td class="left">
                일정의 고유한 ID 값<br>
                하나의 캘린더 ID에서는 iCalendar의 UID가 고유해야 한다.<br>
                UID는 일반적으로 iCalendar를 최초 생성할 때 사용자 ID, 타임스탬프, 도메인 등의 정보를 조합해서 만든다.
                이때 특수 기호 % 문자는 이스케이프 문제로 지원되지 않으니 주의한다.
            </td>
            <td class="left"><a href="http://www.kanzaki.com/docs/ical/uid.html" title="새창" target="_blank" class="color_p2 underline">http://www.kanzaki.com/docs/ical/uid.html</a></td>
        </tr>
        <tr>
            <td class="left">DTSTART</td>
            <td class="left">
                일정 시작 시간<br>
                별도의 표준시간대를 사용하지 않는다면 ‘T’ 이하의 시간 값만 수정해서 사용할 수 있다.
            </td>
            <td class="left"><a href="http://www.kanzaki.com/docs/ical/dtstart.html" title="새창" target="_blank" class="color_p2 underline">http://www.kanzaki.com/docs/ical/dtstart.html</a></td>
        </tr>
        <tr>
            <td class="left">DTEND</td>
            <td class="left">
                일정 종료 시간<br>
                별도의 표준시간대를 사용하지 않는다면 ‘T’ 이하의 시간 값만 수정해서 사용할 수 있다.
            </td>
            <td class="left"><a href="http://www.kanzaki.com/docs/ical/dtend.html" title="새창" target="_blank" class="color_p2 underline">http://www.kanzaki.com/docs/ical/dtend.html</a></td>
        </tr>
        <tr>
            <td class="left">SUMMARY</td>
            <td class="left">
                일정 제목
            </td>
            <td class="left"><a href="http://www.kanzaki.com/docs/ical/summary.html" title="새창" target="_blank" class="color_p2 underline">http://www.kanzaki.com/docs/ical/summary.html</a></td>
        </tr>
        <tr>
            <td class="left">DESCRIPTION</td>
            <td class="left">일정의 상세 내용</td>
            <td class="left"><a href="http://www.kanzaki.com/docs/ical/description.html" title="새창" target="_blank" class="color_p2 underline">http://www.kanzaki.com/docs/ical/description.html</a></td>
        </tr>
        <tr>
            <td class="left">LOCATION</td>
            <td class="left">장소 정보</td>
            <td class="left"><a href="http://www.kanzaki.com/docs/ical/location.html" title="새창" target="_blank" class="color_p2 underline">http://www.kanzaki.com/docs/ical/location.html</a></td>
        </tr>
        <tr>
            <td class="left">RRULE</td>
            <td class="left">반복 정보</td>
            <td class="left">
                <a href="http://www.kanzaki.com/docs/ical/rrule.html" title="새창" target="_blank" class="color_p2 underline">http://www.kanzaki.com/docs/ical/rrule.html</a><br>
                파싱용 라이브러리:<br><a href="http://jakubroztocil.github.io/rrule/" title="새창" target="_blank" class="color_p2 underline">http://jakubroztocil.github.io/rrule/</a>
            </td>
        </tr>
        <tr>
            <td class="left">ORGANIZER</td>
            <td class="left">
                약속 일정인 경우 일정의 마스터 정보<br>
                약속 일정이 아니면 ORGANIZER를 빼고 iCalendar를 생성한다.
            </td>
            <td class="left"><a href="http://www.kanzaki.com/docs/ical/organizer.html" title="새창" target="_blank" class="color_p2 underline">http://www.kanzaki.com/docs/ical/organizer.html</a></td>
        </tr>
        <tr>
            <td class="left">ATTENDEE</td>
            <td class="left">
                약속 일정인 경우 참석자 정보<br>
                약속 일정이 아니면 ORGANIZER를 빼고 iCalendar를 생성한다.
            </td>
            <td class="left"><a href="http://www.kanzaki.com/docs/ical/attendee.html" title="새창" target="_blank" class="color_p2 underline">http://www.kanzaki.com/docs/ical/attendee.html</a></td>
        </tr>
        <tr>
            <td class="left">CREATED</td>
            <td class="left">일정이 Client 에서 생성된 시간</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="left">LAST-MODIFIED</td>
            <td class="left">일정 최종 수정 시각</td>
            <td class="left"></td>
        </tr>
        <tr>
            <td class="left">DTSTAMP</td>
            <td class="left">일정이 DB에 저장된 시간으로 일반적으로 CREATED와 동일</td>
            <td class="left"></td>
        </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
</div>
</body>
</html>