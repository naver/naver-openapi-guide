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
          string key = "KEY-INPUT"; // https://openapi.naver.com/v1/captcha/skey 호출로 받은 키값
          string url = "https://openapi.naver.com/v1/captcha/scaptcha?key=" + key;
          HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
          request.Headers.Add("X-Naver-Client-Id", "YOUR-CLIENT-ID");
          request.Headers.Add("X-Naver-Client-Secret", "YOUR-CLIENT-SECRET");
          HttpWebResponse response = (HttpWebResponse)request.GetResponse();
          string status = response.StatusCode.ToString();
          Console.WriteLine("status="+ status);
          using (Stream output = File.OpenWrite("c:/captcha.wav"))
          using (Stream input = response.GetResponseStream())
          {
              input.CopyTo(output);
          }
          Console.WriteLine("c:/captcha.wav was created");
        }
    }
}
