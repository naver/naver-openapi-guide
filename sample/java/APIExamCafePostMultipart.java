import java.io.File;
import java.net.URLEncoder;
import java.util.List;

// 네이버 API 예제 - 카페 글쓰기
public class APIExamCafePostMultipart {

    public static void main(String[] args) {

        String token = "YOUR_ACCESS_TOKEN";// 네이버 로그인 접근 토큰 값";
        String header = "Bearer " + token; // Bearer 다음에 공백 추가
        try {
            // api url 설정
            String clubid = "28339939";// 카페의 고유 ID값 http://cafe.naver.com/apiexam
            String menuid = "1"; // 카페 게시판 id
            String apiURL = "https://openapi.naver.com/v1/cafe/"+ clubid+"/menu/" + menuid + "/articles";
            MultipartUtil mu = new MultipartUtil(apiURL);
            // 접큰 토큰 헤더 추가
            mu.addHeaderField("Authorization", header);
            mu.readyToConnect();
            // cafe 글쓰기 필수 요청변수 subject 추가
            String subject = URLEncoder.encode("네이버 multi-part 이미지 첨부 테스트", "UTF-8");
            mu.addFormField("subject", subject);
            // cafe 글쓰기 필수 요청변수 content 추가
            String content = URLEncoder.encode("<font color='red'>multi-part</font>로 첨부한 글입니다. <br> 이미지 첨부 <br> <img src='#0' /><img src='#1' />", "UTF-8");
            mu.addFormField("content", content);

            // [시작] image 첨부 로직 - 필요시 이미지수 만큼 반복
            File uploadFile1 = new File("prince1.jpg");
            mu.addFilePart("0", uploadFile1);
            File uploadFile2 = new File("prince2.jpg");
            mu.addFilePart("0", uploadFile2);
            // [종료] 이미지 첨부 로직 - 필요시 이미지수 만큼 반복

            // HTTP 호출 결과 수신
            List<String> response = mu.finish();
            System.out.println("SERVER REPLIED:");

            for (String line : response) {
                System.out.println(line);
            }

        } catch (Exception e) {
            System.out.println(e);
        }
    }
}
/*
카페 가입시 clubid는 없어도 됨 
{"message":{"@type":"response","@service":"korea.naverkoreaservice.community.cafe","@version":"1.0.0","status":"200","result":{"msg":"Success","cafeUrl":"onmashup","articleId":352,"articleUrl":"http://cafe.naver.com/onmashup/352"}}}
 */