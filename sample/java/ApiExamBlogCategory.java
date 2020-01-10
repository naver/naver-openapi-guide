import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Map;

// 네이버 API 예제 - 블로그 카테고리 조회
public class ApiExamBlogCategory {

    public static void main(String[] args) {
        String token = "YOUR_ACCESS_TOKEN";//애플리케이션 클라이언트 아이디값";
        String header = "Bearer " + token; // Bearer 다음에 공백 추가

        String apiURL = "https://openapi.naver.com/blog/listCategory.json";

        Map<String, String> requestHeaders = new HashMap<>();
        requestHeaders.put("Authorization", header);
        String responseBody = get(apiURL,requestHeaders);

        System.out.println(responseBody);
    }

    private static String get(String apiUrl, Map<String, String> requestHeaders){
        HttpURLConnection con = connect(apiUrl);
        try {
            con.setRequestMethod("GET");
            for(Map.Entry<String, String> header :requestHeaders.entrySet()) {
                con.setRequestProperty(header.getKey(), header.getValue());
            }

            int responseCode = con.getResponseCode();
            if (responseCode == HttpURLConnection.HTTP_OK) { // 정상 호출
                return readBody(con.getInputStream());
            } else { // 에러 발생
                return readBody(con.getErrorStream());
            }
        } catch (IOException e) {
            throw new RuntimeException("API 요청과 응답 실패", e);
        } finally {
            con.disconnect();
        }
    }

    private static HttpURLConnection connect(String apiUrl){
        try {
            URL url = new URL(apiUrl);
            return (HttpURLConnection)url.openConnection();
        } catch (MalformedURLException e) {
            throw new RuntimeException("API URL이 잘못되었습니다. : " + apiUrl, e);
        } catch (IOException e) {
            throw new RuntimeException("연결이 실패했습니다. : " + apiUrl, e);
        }
    }

    private static String readBody(InputStream body){
        InputStreamReader streamReader = new InputStreamReader(body);

        try (BufferedReader lineReader = new BufferedReader(streamReader)) {
            StringBuilder responseBody = new StringBuilder();

            String line;
            while ((line = lineReader.readLine()) != null) {
                responseBody.append(line);
            }

            return responseBody.toString();
        } catch (IOException e) {
            throw new RuntimeException("API 응답을 읽는데 실패했습니다.", e);
        }
    }
}
/*
{"message":{	"@type":"response",	"@service":"korea.naverkoreaservice.community.blog",	"@version":"1.0.0",	"result" : [{"name":"ZDNet UX 컬럼","categoryNo":13,"isOpen":true,"subCategories":[]},{"name":"액션정석강좌","categoryNo":14,"isOpen":true,"subCategories":[]},{"name":"IT 트렌드","categoryNo":2,"isOpen":true,"subCategories":[]},{"name":"낙서장","categoryNo":1,"isOpen":true,"subCategories":[]},{"name":"photolog","categoryNo":3,"isOpen":true,"subCategories":[{"name":"나의 포토이야기","categoryNo":4,"isOpen":true,"subCategories":[]},{"name":"친구들과 한컷","categoryNo":5,"isOpen":true,"subCategories":[]},{"name":"여행 스케치","categoryNo":6,"isOpen":true,"subCategories":[]},{"name":"okgosu","categoryNo":7,"isOpen":true,"subCategories":[]}]}]	}}
 */