# 샘플 코드

## 로그인 방식 오픈 API 호출 예

다음은 네이버 회원 프로필을 조회하는 API를 호출하는 코드를 Java로 작성한 예입니다.

네이버 아이디로 로그인해서 획득한 접근 토큰을 요청 헤더에 추가해 프로필 조회 API를 RESTful API 방식으로 호출합니다. 반환받은 결괏값은 JSON 형식으로 출력합니다.

```java
// 네이버 API 예 - 회원 프로필 조회
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class APIExamMemberProfile {

    public static void main(String[] args) {
        String token = "YOUR_ACCESS_TOKEN";// 네이버 로그인 접근 토큰;
        String header = "Bearer " + token; // Bearer 다음에 공백 추가
        try {
            String apiURL = "https://openapi.naver.com/v1/nid/me";
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
```

## 비로그인 방식 오픈 API 호출 예

다음은 Papago 번역 API를 호출하는 코드를 Java로 작성한 예입니다.

클라이언트 아이디와 클라이언트 시크릿을 요청 헤더에 추가해 Papago API를 RESTful API 방식으로 호출합니다. 반환받은 결괏값은 JSON 형태로 출력합니다.

```java
// 네이버 Papago 번역 API 예
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
public class APIExamTranslate {

    public static void main(String[] args) {
        String clientId = "YOUR_CLIENT_ID";// 클라이언트 아이디";
        String clientSecret = "YOUR_CLIENT_SECRET";// 클라이언트 시크릿";
        try {
            String text = URLEncoder.encode("만나서 반갑습니다.", "UTF-8");
            String apiURL = "https://openapi.naver.com/v1/language/translate";
            URL url = new URL(apiURL);
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("POST");
            con.setRequestProperty("X-Naver-Client-Id", clientId);
            con.setRequestProperty("X-Naver-Client-Secret", clientSecret);
            // post request
            String postParams = "source=ko&target=en&text=" + text;
            con.setDoOutput(true);
            DataOutputStream wr = new DataOutputStream(con.getOutputStream());
            wr.writeBytes(postParams);
            wr.flush();
            wr.close();
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
```
