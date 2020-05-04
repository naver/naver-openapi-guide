# 네이버 오픈API 종류

네이버 오픈API는 인증 여부에 따라 로그인 방식 오픈 API와 비로그인 방식 오픈 API로 구분됩니다.

## 로그인 방식 오픈 API

로그인 방식 오픈 API는 '[네이버 아이디로 로그인](https://developers.naver.com/products/login/api/)'의 인증을 받아 접근 토큰(access token)을 획득해야 사용할 수 있는 오픈 API입니다. API를 호출할 때 네이버 아이디로 로그인 API를 통해 받은 접근 토큰의 값을 전송해야 합니다.

다음과 같은 네이버 오픈API가 로그인 방식 오픈 API입니다. 회원 기본 정보 조회, 블로그 글쓰기, 카페 가입 및 글쓰기, 캘린더 일정 담기 등의 기능을 구현할 때 로그인 방식 오픈 API를 사용합니다.

-	[네이버 아이디로 로그인](https://developers.naver.com/products/login/api/): 별도의 아이디와 비밀번호 없이 네이버 아이디로 간편하게 외부 서비스에 로그인할 수 있게 하는 API입니다.
-	[카페](https://developers.naver.com/products/cafe/): 외부 서비스에서 네이버 카페에 가입하거나 게시글을 등록할 수 있게 하는 API입니다.
-	[캘린더](https://developers.naver.com/products/calendar/): 외부 서비스에 네이버 캘린더에 일정을 등록할 수 있게 하는 API입니다.

### 네이버 아이디로 로그인

다음은 네이버 아이디로 로그인 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://nid.naver.com/oauth2.0/authorize`|GET/POST|-|네이버 아이디로 로그인 인증을 요청합니다.|
|`https://nid.naver.com/oauth2.0/token`|GET/POST|JSON|접근 토큰의 발급, 갱신, 삭제를 요청합니다.|
|`https://openapi.naver.com/v1/nid/me`|GET|JSON|네이버 회원의 프로필을 조회합니다.|

### 카페

다음은 카페 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/cafe/{clubid}/members`|POST|JSON|특정 네이버 카페에 가입합니다.|
|`https://openapi.naver.com/v1/cafe/{clubid}/menu/{menuid}/articles`|POST|JSON|네이버 카페 게시판에 게시글을 등록합니다.|

### 캘린더

다음은 캘린더 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/calendar/createSchedule.json`|POST|JSON|네이버 캘린더에 일정을 추가합니다.|

## 비로그인 방식 오픈 API

비로그인 방식 오픈 API는 HTTP 헤더에 클라이언트 아이디와 클라이언트 시크릿 값만 전송해 사용할 수 있는 오픈 API입니다. 네이버 아이디로 로그인의 인증을 통한 접근 토큰을 획득할 필요가 없습니다.

다음과 같은 네이버 오픈API가 비로그인 방식 오픈 API입니다.

-	[검색](https://developers.naver.com/docs/search/blog/): 네이버 검색 결과를 뉴스, 백과사전, 블로그, 쇼핑, 영화, 웹 문서, 전문정보, 지식iN, 책, 카페글 등 분야별로 볼 수 있는 API입니다. 그 외에 지역 검색 결과와 성인 검색어 판별 기능, 오타 변환 기능을 제공합니다.
-	[공유하기](https://developers.naver.com/docs/share/navershare/): 콘텐츠를 네이버 블로그, 네이버 카페, PHOLAR에 공유할 수 있게 하는 API입니다.
-	[단축URL](https://developers.naver.com/docs/utils/shortenurl/): 원본 URL을 `http://me2.do/example`과 같은 형태의 짧은 URL로 반환받을 수 있는 API입니다.
-	[지도](https://developers.naver.com/docs/map/javascriptv3/): 웹 서비스나 애플리케이션에 네이버 지도를 활용할 수 있게 하는 API입니다.
-	[캡차(이미지)](https://developers.naver.com/docs/utils/captcha/): 네이버 서비스에서 사용하는 이미지 캡차 기능을 외부 서비스에 사용할 수 있게 하는 API입니다.
-	[Clova Face Recognition](https://developers.naver.com/products/clova/face/): 입력된 사진 이미지 속의 얼굴을 인식하거나 얼굴 감지를 이용한 애플리케이션을 만들 수 있게 하는 API입니다.
-	[Papago 번역](https://developers.naver.com/products/nmt/): 인공 신경망 기술 기반의 기계 번역 결과를 반환하는 API입니다.

### 검색

다음은 검색 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/search/news`|GET|JSON, XML|네이버 검색의 뉴스 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/encyc`|GET|JSON, XML|네이버 검색의 백과사전 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/blog`|GET|JSON, XML|네이버 검색의 블로그 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/shop`|GET|JSON, XML|네이버 검색의 쇼핑 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/movie`|GET|JSON, XML|네이버 검색의 영화 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/webkr`|GET|JSON, XML|네이버 검색의 웹 문서 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/image`|GET|JSON, XML|네이버 검색의 이미지 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/doc`|GET|JSON, XML|네이버 검색의 전문정보 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/kin`|GET|JSON, XML|네이버 검색의 지식iN 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/book`|GET|JSON, XML|네이버 검색의 책 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/cafearticle`|GET|JSON, XML|네이버 검색의 카페글 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/adult`|GET|JSON, XML|입력한 검색어가 성인 검색어인지 판별한 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/errata`|GET|JSON, XML|입력한 검색어의 한영 오류를 변환한 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/local`|GET|JSON, XML|네이버 지역 서비스에 등록된 지역별 업체 및 상호 검색 결과를 반환합니다.|

### 공유하기

다음은 공유하기 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`http://share.naver.com/web/shareView.nhn`|GET|-|콘텐츠를 네이버 블로그, 네이버 카페, PHOLAR에 공유합니다.|

### 단축URL

다음은 단축URL API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/util/shorturl`|GET/POST|JSON, XML|입력된 URL을 `http://me2.do/example`과 같은 형태의 짧은 URL로 변환한 결과를 반환합니다.|

### 지도

다음은 지도 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.map.naver.com/openapi/v3/maps.js?clientId=CLIENT_ID`|GET|-|웹 페이지에 네이버 지도 화면을 출력합니다.|
|`https://openapi.naver.com/v1/map/geocode`|GET|JSON, XML|주소를 좌표로 변환한 결과를 반환합니다.|
|`https://openapi.naver.com/v1/map/reversegeocode`|GET|JSON, XML|좌표를 주소로 변환한 결과를 반환합니다.|
|`https://openapi.naver.com/v1/map/staticmap.bin`|GET|JPG, PNG|지정된 좌표의 네이버 지도 이미지를 출력합니다.|

### 캡차(이미지)

다음은 캡차 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/captcha/ncaptcha.bin`|GET|JPG|캡차 이미지를 요청합니다.|
|`https://openapi.naver.com/v1/captcha/nkey`|GET|JSON|캡차 키를 발급하거나 입력값을 비교한 결과를 반환합니다.|

### Clova Face Recognition

다음은 Clova Face Recognition API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/vision/face`|POST|JSON|입력된 사진에서 얼굴 윤곽, 부위, 표정을 반환합니다.|
|`https://openapi.naver.com/v1/vision/celebrity`|POST|JSON|입력된 사진과 닮은 유명인의 이름과 닮은 정도를 반환합니다.|

### Papago 번역

다음은 Papago 번역 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/papago/n2mt`|POST|JSON|인공 신경망 기반의 기계 번역 결과(영어, 중국어(간체))를 반환합니다.|
