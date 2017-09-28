import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

// 네이버 API 예제 - 카페 가입하기
public class APIExamCafeJoin {

    public static void main(String[] args) {
        String token = "YOUR_ACCESS_TOKEN";// 네아로 접근 토큰 값";
        String header = "Bearer " + token; // Bearer 다음에 공백 추가
        try {
            String clubid = "20334913";// 카페의 고유 ID값
            String apiURL = "https://openapi.naver.com/v1/cafe/"+ clubid+"/members";
            URL url = new URL(apiURL);
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("POST");
            con.setRequestProperty("Authorization", header);
            // post request
            String nickname = URLEncoder.encode(URLEncoder.encode("API개발자", "UTF-8"), "MS949");
            // 카페 api 한글은  UTF8로 인코딩 한 값을 MS949로 한번더 인코딩 해야 함
            String postParams = "nickname="+nickname;
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
/*
카페 가입시 clubid는 없어도 됨
{"message":{"@type":"response","@service":"korea.naverkoreaservice.community.cafe","@version":"1.0.0","status":"200","result":{"msg":"Success"}}}
 */