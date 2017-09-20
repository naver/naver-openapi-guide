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
            string token = "AAAANk9YrWtntGsPuLxPjtegMAWo7r7v53QfZjEZTC5gpKhKqpLxazaaSdKiCwBiNws3AsK586n67FfWn4GbPFrT/wU=";// 네이버 로그인 접근 토큰;
            string header = "Bearer " + token; // Bearer 다음에 공백 추가
            string apiURL = "https://openapi.naver.com/calendar/createSchedule.json";
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(apiURL);
            request.Headers.Add("Authorization", header);
            request.Method = "POST";
            string calSum = "[제목] 캘린더API로 추가한 일정";
            string calDes = "[상세] 회의 합니다";
            string calLoc = "[장소] 그린팩토리";
            string uid = "asdfasdfasdfadsfadsfasf";

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
}
