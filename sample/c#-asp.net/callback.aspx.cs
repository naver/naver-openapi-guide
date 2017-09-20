using System;
using System.Net.Http;
using System.Threading.Tasks;

namespace NaverAPI_Guide
{
    public partial class callback : System.Web.UI.Page
    {
        protected async void Page_Load(object sender, EventArgs e)
        {
            lblResult.Text = await getAccessToken();
        }
        public async Task<string> getAccessToken()
        {
            using (var client = new HttpClient())
            {
                string clientId = "YOUR_CLIENT_ID";
                string clientSecret = "YOUR_CLIENT_SECRET";
                client.DefaultRequestHeaders.Add("X-Naver-Client-Id", clientId);
                client.DefaultRequestHeaders.Add("X-Naver-Client-Secret", clientSecret);
                string code = Request.QueryString["code"];
                string state = Request.QueryString["state"];
                string redirectURI = "http://localhost:49921/callback.aspx"; // 개발자센터 애플리케이션에 등록된 callback url 
                string apiURL = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&";
                apiURL += "client_id=" + clientId;
                apiURL += "&client_secret=" + clientSecret;
                apiURL += "&redirect_uri=" + redirectURI;
                apiURL += "&code=" + code;
                apiURL += "&state=" + state;
                var res = await client.GetAsync(apiURL);
                var responseString = await res.Content.ReadAsStringAsync();
                Console.WriteLine("res.StatusCode = " + res.StatusCode);
                return "res.StatusCode=" + res.StatusCode + "::: responseString" + responseString.ToString();
            }
        }
    }
}
