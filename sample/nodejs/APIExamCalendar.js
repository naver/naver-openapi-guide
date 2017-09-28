var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN" // 네아로 접근 토큰
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
 });
