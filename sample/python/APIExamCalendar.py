import os
import sys
import urllib.request
token = "YOUR_ACCESS_TOKEN" # 네이버 로그인 접근 토큰
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
scheduleIcalString += "CREATED:20161116T160000Z\n"           # 일정 생성시각
scheduleIcalString += "LAST-MODIFIED:20161116T160000Z\n"    # 일정 수정시각
scheduleIcalString += "DTSTAMP:20161116T160000Z\n"          # 일정 타임스탬프
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
    print("Error Code:" + rescode)
