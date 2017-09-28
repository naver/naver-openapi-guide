using System;
using System.Net;
using System.Text;
using System.IO;

namespace NaverAPI_Guide
{
    public class APIExamBlogPost
    {
        static void Main(string[] args)
        {
            string token = "YOUR_ACCESS_TOKEN";// 네이버 로그인 접근 토큰;
            string header = "Bearer " + token; // Bearer 다음에 공백 추가
            String apiURL = "https://openapi.naver.com/blog/writePost.json";
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(apiURL);
            request.Headers.Add("Authorization", header);
            request.Method = "POST";
            string title = "C# blog api 글제목";
            string contents = "C# blog api 글 내용";
            byte[] byteDataParams = Encoding.UTF8.GetBytes("title=" + title + "&contents=" + contents);
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
