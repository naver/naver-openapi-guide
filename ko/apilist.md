# 네이버 오픈API 종류

네이버 오픈API는 인증 여부에 따라 로그인 방식 오픈 API와 비로그인 방식 오픈 API로 구분됩니다.

## 로그인 방식 오픈 API

로그인 방식 오픈 API는 '[네이버 로그인](https://developers.naver.com/products/login/api/api.md)'의 인증을 받아 접근 토큰(access token)을 획득해야 사용할 수 있는 오픈 API입니다. API를 호출할 때 네이버 로그인 API를 통해 받은 접근 토큰의 값을 전송해야 합니다.

다음과 같은 네이버 오픈API가 로그인 방식 오픈 API입니다. 회원 기본 정보 조회, 카페 가입 및 글쓰기, 캘린더 일정 담기 등의 기능을 구현할 때 로그인 방식 오픈 API를 사용합니다.

- [네이버 로그인](https://developers.naver.com/products/login/api/api.md): 별도의 아이디와 비밀번호 없이 네이버 아이디로 간편하게 외부 서비스에 로그인할 수 있게 하는 API입니다.
- [카페](https://developers.naver.com/products/login/cafe/cafe.md): 외부 서비스에서 네이버 카페에 가입하거나 게시글을 등록할 수 있게 하는 API입니다.
- [캘린더](https://developers.naver.com/products/login/calendar/calendar.md): 외부 서비스에 네이버 캘린더에 일정을 등록할 수 있게 하는 API입니다.

### 네이버 로그인

다음은 네이버 로그인 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://nid.naver.com/oauth2.0/authorize`|GET/POST|-|네이버 로그인 인증을 요청합니다.|
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

비로그인 방식 오픈 API는 HTTP 헤더에 클라이언트 아이디와 클라이언트 시크릿 값만 전송해 사용할 수 있는 오픈 API입니다. 네이버 로그인의 인증을 통한 접근 토큰을 획득할 필요가 없습니다.

다음과 같은 네이버 오픈API가 비로그인 방식 오픈 API입니다.

- [데이터랩](https://developers.naver.com/docs/serviceapi/datalab/search/search.md): [네이버 데이터랩](https://datalab.naver.com/)의 [검색어 트렌드](https://datalab.naver.com/keyword/trendSearch.naver)와 [쇼핑인사이트](https://datalab.naver.com/shoppingInsight/sCategory.naver)를 API로 실행할 수 있게 하는 API입니다.
- [검색](https://developers.naver.com/docs/serviceapi/search/blog/blog.md): 네이버 검색 결과를 뉴스, 백과사전, 블로그, 쇼핑, 웹 문서, 전문정보, 지식iN, 책, 카페글 등 분야별로 볼 수 있는 API입니다. 그 외에 지역 검색 결과와 성인 검색어 판별 기능, 오타 변환 기능을 제공합니다.
- [이미지 캡차](https://developers.naver.com/docs/utils/captcha/overview/): 네이버 서비스에서 사용하는 이미지 캡차 기능을 외부 서비스에 사용할 수 있게 하는 API입니다.
- [음성 캡차](https://developers.naver.com/docs/utils/scaptcha/overview/): 네이버 서비스에서 사용하는 음성 캡차 기능을 외부 서비스에 사용할 수 있게 하는 API입니다.
- [네이버 공유하기](https://developers.naver.com/docs/share/navershare/): 콘텐츠를 네이버 블로그, 네이버 카페, PHOLAR에 공유할 수 있게 하는 API입니다.
- [네이버 오픈메인](https://developers.naver.com/docs/openmain/): 웹 페이지를 네이버 메인에 추가할 수 있게 하는 플러그인입니다.
- [Clova Face Recognition](https://developers.naver.com/products/clova/face/): 입력된 사진 이미지 속의 얼굴을 인식하거나 얼굴 감지를 이용한 애플리케이션을 만들 수 있게 하는 API입니다.

### 데이터랩

다음은 데이터랩 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/datalab/search`|POST|JSON|그룹으로 묶은 검색어에 대한 네이버 통합검색에서 검색 추이 데이터를 반환합니다.|
|`https://openapi.naver.com/v1/datalab/shopping/categories`|POST|JSON|네이버 통합검색의 쇼핑 영역과 [네이버쇼핑](https://shopping.naver.com/)에서의 검색 클릭 추이를 쇼핑 분야별로 조회한 데이터를 반환합니다.|
|`https://openapi.naver.com/v1/datalab/shopping/category/device`|POST|JSON|네이버 통합검색의 쇼핑 영역과 [네이버쇼핑](https://shopping.naver.com/)에서 특정 쇼핑 분야의 검색 클릭 추이를 기기별(PC, 모바일)로 조회한 데이터를 JSON 형식으로 반환합니다.|POST|JSON|
|`https://openapi.naver.com/v1/datalab/shopping/category/gender`|POST|JSON|네이버 통합검색의 쇼핑 영역과 [네이버쇼핑](https://shopping.naver.com/)에서 특정 쇼핑 분야의 검색 클릭 추이를 사용자의 성별로 조회한 데이터를 JSON 형식으로 반환합니다.|
|`https://openapi.naver.com/v1/datalab/shopping/category/age`|POST|JSON|네이버 통합검색의 쇼핑 영역과 [네이버쇼핑](https://shopping.naver.com/)에서 특정 쇼핑 분야의 검색 클릭 추이를 사용자의 연령별로 조회한 데이터를 JSON 형식으로 반환합니다.|
|`https://openapi.naver.com/v1/datalab/shopping/category/keywords`|POST|JSON|네이버 통합검색의 쇼핑 영역과 [네이버쇼핑](https://shopping.naver.com/)에서 특정 쇼핑 분야의 검색 클릭 추이를 검색 키워드별로 조회한 데이터를 반환합니다.|
|`https://openapi.naver.com/v1/datalab/shopping/category/keyword/device`|POST|JSON|네이버 통합검색의 쇼핑 영역과 [네이버쇼핑](https://shopping.naver.com/)에서 특정 쇼핑 분야와 검색 키워드의 검색 클릭 추이를 기기별(PC, 모바일)로 조회한 데이터를 JSON 형식으로 반환합니다.|
|`https://openapi.naver.com/v1/datalab/shopping/category/keyword/gender`|POST|JSON|네이버 통합검색의 쇼핑 영역과 [네이버쇼핑](https://shopping.naver.com/)에서 특정 쇼핑 분야와 검색 키워드의 검색 클릭 추이를 사용자의 성별로 조회한 데이터를 JSON 형식으로 반환합니다.|
|`https://openapi.naver.com/v1/datalab/shopping/category/keyword/age`|POST|JSON|네이버 통합검색의 쇼핑 영역과 [네이버쇼핑](https://shopping.naver.com/)에서 특정 쇼핑 분야와 검색 키워드의 검색 클릭 추이를 사용자의 연령별로 조회한 데이터를 JSON 형식으로 반환합니다.|

### 검색

다음은 검색 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/search/news`|GET|JSON, XML|네이버 검색의 뉴스 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/encyc`|GET|JSON, XML|네이버 검색의 백과사전 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/blog`|GET|JSON, XML|네이버 검색의 블로그 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/shop`|GET|JSON, XML|네이버 검색의 쇼핑 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/webkr`|GET|JSON, XML|네이버 검색의 웹 문서 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/image`|GET|JSON, XML|네이버 검색의 이미지 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/doc`|GET|JSON, XML|네이버 검색의 전문정보 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/kin`|GET|JSON, XML|네이버 검색의 지식iN 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/book`|GET|JSON, XML|네이버 검색의 책 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/cafearticle`|GET|JSON, XML|네이버 검색의 카페글 검색 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/adult`|GET|JSON, XML|입력한 검색어가 성인 검색어인지 판별한 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/errata`|GET|JSON, XML|입력한 검색어의 한영 오류를 변환한 결과를 반환합니다.|
|`https://openapi.naver.com/v1/search/local`|GET|JSON, XML|네이버 지역 서비스에 등록된 지역별 업체 및 상호 검색 결과를 반환합니다.|

### 이미지 캡차

다음은 이미지 캡차 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/captcha/ncaptcha.bin`|GET|JPG|캡차 이미지를 요청합니다.|
|`https://openapi.naver.com/v1/captcha/nkey`|GET|JSON|캡차 키를 발급하거나 입력값을 비교한 결과를 반환합니다.|

### 음성 캡차

다음은 음성 캡차 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/captcha/scaptcha`|GET|WAV|캡차 음성을 요청합니다.|
|`https://openapi.naver.com/v1/captcha/skey`|GET|JSON|캡차 키를 발급하거나 입력값을 비교한 결과를 반환합니다.|

### 네이버 공유하기

다음은 네이버 공유하기 API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`http://share.naver.com/web/shareView`|GET|-|콘텐츠를 네이버 블로그, 네이버 카페, PHOLAR에 공유합니다.|

### Clova Face Recognition

다음은 Clova Face Recognition API에서 사용하는 주요 요청 URL과 메서드, 응답 형식입니다.

|요청 URL|메서드|응답 형식|설명|
|------|--|--|------|
|`https://openapi.naver.com/v1/vision/face`|POST|JSON|입력된 사진에서 얼굴 윤곽, 부위, 표정을 반환합니다.|
|`https://openapi.naver.com/v1/vision/celebrity`|POST|JSON|입력된 사진과 닮은 유명인의 이름과 닮은 정도를 반환합니다.|