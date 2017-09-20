<%@ Page Language="C#" AutoEventWireup="true" %>
<!DOCTYPE html>
<script runat="server">
    String getNaverLoginURL()
    {
        string clientId = "YOUR_CLIENT_ID";
        string redirectURI = "http://localhost:49921/callback.aspx";
        string state = "RANDOM_STRING";
        string apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id="
            + clientId + "&redirect_uri=" + redirectURI + "&state=" + state;
        return apiURL;
    }
</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Naver Login Exam</title>
</head>
<body>
    <a href="<% Response.Write(getNaverLoginURL()); %>"><img height="50" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>
</body>
</html>
