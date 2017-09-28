using System;
using System.Net;
using System.Text;
using System.IO;

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
            request.Headers.Add("X-Naver-Client-Id", "YOUR_CLIENT_ID"); // 개발자센터에서 발급받은 Client ID
            request.Headers.Add("X-Naver-Client-Secret", "YOUR_CLIENT_SECRET"); // 개발자센터에서 발급받은 Client Secret
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
