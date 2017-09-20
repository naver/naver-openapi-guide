using System;
using System.Net;
using System.Text;
using System.IO;

namespace NaverAPI_Guide
{
    public class APIExamTTS
    {
        static void Main(string[] args)
        {
            string text = "좋은 하루 되세요."; // 음성합성할 문자값
            string url = "https://openapi.naver.com/v1/voice/tts.bin";
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
            request.Headers.Add("X-Naver-Client-Id", "YOUR_CLIENT_ID"); // 개발자센터에서 발급받은 Client ID
            request.Headers.Add("X-Naver-Client-Secret", "YOUR_CLIENT_SECRET"); // 개발자센터에서 발급받은 Client Secret
            request.Method = "POST";
            byte[] byteDataParams = Encoding.UTF8.GetBytes("speaker=mijin&speed=0&text=" + text);
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = byteDataParams.Length;
            Stream st = request.GetRequestStream();
            st.Write(byteDataParams, 0, byteDataParams.Length);
            st.Close();
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            string status = response.StatusCode.ToString();
            Console.WriteLine("status="+ status);
            using (Stream output = File.OpenWrite("c:/tts.mp3"))
            using (Stream input = response.GetResponseStream())
            {
                input.CopyTo(output);
            }
            Console.WriteLine("c:/tts.mp3 was created");
        }
    }
}
