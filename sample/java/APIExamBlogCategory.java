import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

// 네이버 API 예제 - 블로그 카테고리 조회
public class APIExamBlogCategory {

    public static void main(String[] args) {
        String token = "YOUR_ACCESS_TOKEN";// 네아로 접근 토큰 값";
        String header = "Bearer " + token; // Bearer 다음에 공백 추가
        try {
            String apiURL = "https://openapi.naver.com/blog/listCategory.json";
            URL url = new URL(apiURL);
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("GET");
            con.setRequestProperty("Authorization", header);
            int responseCode = con.getResponseCode();
            BufferedReader br;
            if(responseCode==200) { // 정상 호출
                br = new BufferedReader(new InputStreamReader(con.getInputStream()));
            } else {  // 에러 발생
                br = new BufferedReader(new InputStreamReader(con.getErrorStream()));
            }
            String inputLine;
            StringBuffer response = new StringBuffer();
            while ((inputLine = br.readLine()) != null) {
                response.append(inputLine);
            }
            br.close();
            System.out.println(response.toString());
        } catch (Exception e) {
            System.out.println(e);
        }
    }
}
/*
{"message":{	"@type":"response",	"@service":"korea.naverkoreaservice.community.blog",	"@version":"1.0.0",	"result" : [{"name":"ZDNet UX 컬럼","categoryNo":13,"isOpen":true,"subCategories":[]},{"name":"액션정석강좌","categoryNo":14,"isOpen":true,"subCategories":[]},{"name":"IT 트렌드","categoryNo":2,"isOpen":true,"subCategories":[]},{"name":"낙서장","categoryNo":1,"isOpen":true,"subCategories":[]},{"name":"photolog","categoryNo":3,"isOpen":true,"subCategories":[{"name":"나의 포토이야기","categoryNo":4,"isOpen":true,"subCategories":[]},{"name":"친구들과 한컷","categoryNo":5,"isOpen":true,"subCategories":[]},{"name":"여행 스케치","categoryNo":6,"isOpen":true,"subCategories":[]},{"name":"okgosu","categoryNo":7,"isOpen":true,"subCategories":[]}]}]	}}
 */