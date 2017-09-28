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
