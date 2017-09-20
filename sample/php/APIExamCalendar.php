<?php
  // 네이버 캘린더 Open API 예제 - 일정추가
  $token = "YOUR_ACCESS_TOKEN"; // 네아로 접근 토큰
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
?>
