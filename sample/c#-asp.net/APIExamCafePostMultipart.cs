// Cafe multipart upload - C#
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Web;

namespace NaverAPI_Guide
{
    public class APIExamCafePostMultipart
    {
        private static string CRLF = "\r\n";
        private static string boundary = "----" + DateTime.Now.Ticks.ToString("x") + "----";
        private static Stream DataStream = new MemoryStream();
        private static byte[] formData;

        static void Main(string[] args)
        {
            string token = "YOUR_ACCESS_TOKEN";// 네이버 로그인 접근 토큰;
            string header = "Bearer " + token; // Bearer 다음에 공백 추가
            string url = "https://openapi.naver.com/v1/cafe/28339939/menu/1/articles"; // cafe api url ( 상품 게시판은 글쓰기 불가)
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
            request.Method = "POST";
            request.ContentType = "multipart/form-data; boundary=" + boundary;
            request.Headers.Add("Authorization", header);
            buildParam("subject", "C# api로 올리는 카페 제목"); // 제목
            buildParam("content", "<font color='red'>multi-part</font>로 첨부한 글입니다. <br>  이미지 첨부 <br> <img src='#0' /> <img src='#1' />"); // 본문
            buildFileParam("image[0]", "C:\\test1.jpg"); // 파일 [0]
            buildFileParam("image[1]", "C:\\test2.jpg"); // 파일 [1]
            buildByteParam(); // Byte Array 생성
            Stream stream = request.GetRequestStream();
            stream.Write(formData, 0, formData.Length); // request 전송
            stream.Close();
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            StreamReader reader = new StreamReader(response.GetResponseStream());
            string text = reader.ReadToEnd();
            stream.Close();
            response.Close();
            reader.Close();
            Console.WriteLine(text);
        }

        private static void buildParam(String name, String value)
        {
            string paramName1 = name; // cafe
            string paramValue1 = HttpUtility.UrlEncode(value); // cafe는 인코딩 필요
            string res = "--" + boundary + CRLF + "Content-Disposition: form-data; name=\"" + paramName1 + "\"" + CRLF;
            res += "Content-Type: text/plain; charset=UTF-8" + CRLF + CRLF;
            res += paramValue1 + CRLF;
            DataStream.Write(Encoding.UTF8.GetBytes(res), 0, Encoding.UTF8.GetByteCount(res));
        }

        private static void buildFileParam(String fileParamName, String filePathName)
        {
            FileStream fs = new FileStream(filePathName, FileMode.Open, FileAccess.Read);
            byte[] fileData = new byte[fs.Length];
            fs.Read(fileData, 0, fileData.Length);
            fs.Close();
            string postData = "--" + boundary + CRLF + "Content-Disposition: form-data; name=\"" + fileParamName + "\"; filename=\"";
            postData += Path.GetFileName(filePathName) + "\"" + CRLF + "Content-Type: image/jpeg" + CRLF;
            postData += "Content-Transfer-Encoding: binary" + CRLF + CRLF;
            DataStream.Write(Encoding.UTF8.GetBytes(postData), 0, Encoding.UTF8.GetByteCount(postData));
            DataStream.Write(fileData, 0, fileData.Length);
            DataStream.Write(Encoding.UTF8.GetBytes("\r\n"), 0, 2);
        }

        private static void buildByteParam()
        {
            string footer = "--" + boundary;
            DataStream.Write(Encoding.UTF8.GetBytes(footer), 0, Encoding.UTF8.GetByteCount(footer));
            DataStream.Position = 0;
            formData = new byte[DataStream.Length];
            DataStream.Read(formData, 0, formData.Length); DataStream.Close();
            DataStream.Close();
        }
    }
}
