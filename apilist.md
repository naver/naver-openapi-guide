# 네이버 오픈 API 목록   
현재 제공하고 있는 네이버 오픈 API 목록입니다. 네이버 오픈 API를 사용하기 전에 아래 사항들이 되어 있는지 확인 바랍니다.
- 애플리케이션 등록 및 클라이언트 아이디와 시크릿 값 확인: [애플리케이션 등록 가이드](https://developers.naver.com/docs/common/register) >
- API 권한 설정 확인: [API 권한 설정 및 호출 방법 가이드](https://developers.naver.com/docs/common/apicall) >

[[오픈API 이용신청](https://developers.naver.com/apps/#/register)]

네이버 오픈 API 종류는 인증 여부에 따라 호출 방법이 달라지며, 1) 로그인 오픈 API 2) 비로그인 오픈 API로 분류할 수 있습니다. 아래 목록에서 인증에 'Y'라 마킹이 되어 있는 API들이 로그인 오픈 API 들입니다.
- 로그인 오픈 API: '네이버 아이디로 로그인'의 접근 토큰(access token)을 획득해야 이용가능한 오픈 API들로서 회원 기본 정보 조회, 블로그 글쓰기, 카페 가입 및 글쓰기, 캘린더 일정 담기 오픈 API들이 해당되며, API를 호출 할 때 네이버 아이디로 로그인 API를 통해 받은 접근 토큰(access token)값을 전송해야 합니다.
- 비로그인 오픈 API: '네이버 아이디로 로그인'의 접근 토큰(access token) 값 없이 HTTP 헤더에 클라이언트 아이디와 시크릿 값만 전송하면 바로 호출하여 사용할 수 있는 오픈 API들로서 지도, 검색, 좌표변환, 단축 URL을 비롯 음성인식, 기계번역, 음성합성 오픈 API들이 해당됩니다.

|API명	|메서드	|인증	|요청 URL|	포맷	|설명|
| ---- | ---- | ---- | --------- | ---- | ---- |
|네이버 아이디로 로그인	|GET / POST|	Y	|https://nid.naver.com/oauth2.0/authorize	|-|	네이버 아이디로 로그인 인증 요청|
|네이버 아이디로 로그인	|GET / POST|	Y|	https://nid.naver.com/oauth2.0/token|	JSON|	접근 토큰 발급/갱신/삭제 요청|
|네이버 아이디로 로그인	|GET|	Y|	https://openapi.naver.com/v1/nid/me	|JSON	|네이버 회원 프로필 조회|
|Papago NMT 번역	|POST	|N	|https://openapi.naver.com/v1/papago/n2mt	|JSON|	인공신경망 기반 기계 번역 (영,중)|
|Papago SMT 번역	|POST	|N	|https://openapi.naver.com/v1/language/translate	|JSON|	통계 기반 기계 번역 (영,일,중)|
|Clova Speech Recognition	|-	|N|	-	|JSON	|입력된 음성을 인식해 텍스트로 리턴|
|Clova Speech Synthesis	|POST	|N|	https://openapi.naver.com/v1/voice/tts.bin|	MP3	|텍스트를 입력받은 후 지정된 음색과 속도로 음성 합성한 오디오 데이터를 반환(한,영,일,중)|
|Clova Face Recognition	|https://openapi.naver.com/v1/vision/face|N|	-	|JSON	|입력된 사진을 입력받아 얼굴윤곽/부위/표정을 리턴|
|Clova Face Recognition	|https://openapi.naver.com/v1/vision/celebrity|N|	-	|JSON	|입력된 사진을 입력받아 유명인 닮음도를 리턴|
|캡차(이미지)	|GET|	N	|https://openapi.naver.com/v1/captcha/nkey|	JSON|	캡차 키 발급/입력값 비교|
|캡차(이미지)	|GET|	N	|https://openapi.naver.com/v1/captcha/ncaptcha.bin	|JPG|	캡차 이미지 요청|
|지도	|GET	|N|	https://openapi.map.naver.com/openapi/v3/maps.js?clientId=CLIENT_ID	|-|	네이버 지도|
|지도	|GET	|N|	https://openapi.naver.com/v1/map/geocode|	JSON, XML|	주소 좌표 변환|
|지도	|GET	|N|	https://openapi.naver.com/v1/map/reversegeocode	|JSON, XML|	좌표 주소 변환|
|지도	|GET	|N|	https://openapi.naver.com/v1/map/staticmap.bin	|JPG, PNG|	지정된 좌표의 네이버 지도 이미지를 출력|
|블로그	|POST	|Y|	https://openapi.naver.com/blog/writePost.json	|JSON	|블로그 글쓰기|
|블로그	|GET	|Y|	https://openapi.naver.com/blog/listCategory.json	|JSON|	블로그 카테고리 조회|
|카페	|POST	|Y|	https://openapi.naver.com/v1/cafe/{clubid}/members	|JSON|	특정 카페 가입하기|
|카페	|POST	|Y|	https://openapi.naver.com/v1/cafe/{clubid}/menu/{menuid}/articles	|JSON|	카페 게시판에 글 쓰기|
|캘린더	|POST|	Y	|https://openapi.naver.com/calendar/createSchedule.json|	JSON	|캘린더 일정 추가|
|단축URL	|GET / POST	|N|	https://openapi.naver.com/v1/util/shorturl	|JSON, XML|	입력된 URL을 me2.do 형태의 짧은 URL로 변환|
|공유하기	|GET|	N	|http://share.naver.com/web/shareView.nhn	|-|	블로그, 카페, 폴라 공유하기|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/blog	|JSON, XML	|블로그 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/news	|JSON, XML	|뉴스 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/book	|JSON, XML	|책 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/adult	|JSON, XML	|성인 검색어 판별|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/encyc	|JSON, XML	|백과사전 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/movie	|JSON, XML	|영화 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/cafearticle	|JSON, XML|	카페글 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/kin	|JSON, XML|	지식iN 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/local	|JSON, XML	|지역 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/errata	|JSON, XML|	오타 변환|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/webkr|	JSON, XML|	웹문서 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/image	|JSON, XML|	이미지 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/shop	|JSON, XML	|쇼핑 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/doc	|JSON, XML|	전문자료 검색|
|검색	|GET	|N|	https://openapi.naver.com/v1/search/adult	|JSON, XML	|성인검색어 판별|

가이드 오류, API 개발문의는 개발자 포럼에 글을 올려주시기 바랍니다. [개발자포럼 가기](https://developers.naver.com/forum) >
