import java.io.*;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.util.Map;

// 네이버 얼굴인식 API 예제
public class ApiExamFace {

    public static void main(String[] args) {

        String clientId = "YOUR_CLIENT_ID";//애플리케이션 클라이언트 아이디값";
        String clientSecret = "YOUR_CLIENT_SECRET";//애플리케이션 클라이언트 시크릿값";

        String apiURL = "https://openapi.naver.com/v1/vision/celebrity"; // 유명인 얼굴 인식
        //String apiURL = "https://openapi.naver.com/v1/vision/face"; // 얼굴 감지
        String imgFile = "이미지 파일 경로 ";
        File uploadFile = new File(imgFile);

        Map<String, String> requestHeaders = new HashMap<>();
        requestHeaders.put("X-Naver-Client-Id", clientId);
        requestHeaders.put("X-Naver-Client-Secret", clientSecret);
        String responseBody = get(apiURL,requestHeaders,uploadFile);

        System.out.println(responseBody);
    }

    private static String get(String apiUrl, Map<String, String> requestHeaders,File uploadFile){
        String boundary = "---" + System.currentTimeMillis() + "---";
        requestHeaders.put("Content-Type", "multipart/form-data; boundary=" + boundary);

        HttpURLConnection con = connect(apiUrl);
        con.setUseCaches(false);
        con.setDoOutput(true);
        con.setDoInput(true);

        try {
            con.setRequestMethod("POST");
            for(Map.Entry<String, String> header :requestHeaders.entrySet()) {
                con.setRequestProperty(header.getKey(), header.getValue());
            }

            upload(con.getOutputStream(), uploadFile, boundary);

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

    private static void upload(OutputStream outputStream, File uploadFile, String boundary){
        try(PrintWriter writer = new PrintWriter(new OutputStreamWriter(outputStream, StandardCharsets.UTF_8), true);
            FileInputStream inputStream = new FileInputStream(uploadFile)){
            String LINE_FEED = "\r\n";

            String fileName = uploadFile.getName();
            String paramName = "image"; // 파라미터명은 image로 지정
            writer.append("--").append(boundary).append(LINE_FEED);
            writer.append("Content-Disposition: form-data; name=\"").append(paramName).append("\"; filename=\"").append(fileName).append("\"").append(LINE_FEED);
            writer.append("Content-Type: ").append(URLConnection.guessContentTypeFromName(fileName)).append(LINE_FEED);
            writer.append(LINE_FEED);
            writer.flush();

            byte[] buffer = new byte[4096];
            int bytesRead;
            while ((bytesRead = inputStream.read(buffer)) != -1) {
                outputStream.write(buffer, 0, bytesRead);
            }
            outputStream.flush();
            writer.append(LINE_FEED).flush();
            writer.append("--").append(boundary).append("--").append(LINE_FEED);
        } catch (IOException e){
            throw new RuntimeException("파일 업로드 실패", e);
        }
    }
}
