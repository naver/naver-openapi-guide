import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class NaverSearchAPI {
    public static void main(String[] args) {
        System.out.println("==== 검색 API 호출====");
        String clientId = "클라이언트아이디";
        String clientSecret = "클라이언트시크릿";
        for(int i=1; i<=400; i++) {
            System.out.println("==== 검색 API 호출 " + i + "====");
            try {
                String text = URLEncoder.encode("설현", "UTF-8");
                String apiURL = "https://openapi.naver.com/v1/search/news.xml?query=" + text + "&start=1&display=100";
                URL url = new URL(apiURL);
                HttpURLConnection con = (HttpURLConnection) url.openConnection();
                con.setRequestMethod("GET");
                con.setRequestProperty("X-Naver-Client-Id", clientId);
                con.setRequestProperty("X-Naver-Client-Secret", clientSecret);
                // response 수신
                int responseCode = con.getResponseCode();
                System.out.println("responseCode=" + responseCode);
                if (responseCode == 200) {
                    BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()));
                    String inputLine;
                    StringBuffer response = new StringBuffer();
                    while ((inputLine = in.readLine()) != null) {
                        response.append(inputLine);
                    }
                    in.close();
                    System.out.println(response.toString());
                } else {
                    System.out.println("API 호출 에러 발생 : 에러코드=" + responseCode);
                    BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()));
                    String inputLine;
                    StringBuffer response = new StringBuffer();
                    while ((inputLine = in.readLine()) != null) {
                        response.append(inputLine);
                    }
                    in.close();
                    System.out.println(response.toString());
                }
            } catch (Exception e) {
                System.out.println(e);
            }
        }
    }
}