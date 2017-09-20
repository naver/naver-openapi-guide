using System;
using System.Net;
using System.Text;
using System.IO;

namespace NaverAPI_Guide
{
    public class APIExamBlogCategory
    {
        static void Main(string[] args)
        {
            string token = "YOUR_ACCESS_TOKEN";// 네이버 로그인 접근 토큰;
            string header = "Bearer " + token; // Bearer 다음에 공백 추가
            String apiURL = "https://openapi.naver.com/blog/listCategory.json";
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(apiURL);
            request.Headers.Add("Authorization", header);
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
}
