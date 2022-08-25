---
title: 검색 API 영화 검색 개발가이드
description: 네이버 영화 검색 결과를 출력해주는 REST API입니다.
---

# 검색 &gt; 영화

네이버 영화 검색 결과를 출력해주는 REST API입니다. 비로그인 오픈 API이므로 GET으로 호출할 때 HTTP Header에 애플리케이션 등록 시 발급받은 [Client ID와 Client Secret 값을 같이 전송](https://developers.naver.com/docs/common/apicall)해 주시면 활용 가능합니다.

<div class="buttons2"><a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?defaultScope=search">오픈 API 이용 신청 &gt;</a></div>

## 1. 준비사항

- 애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 **[Application-애플리케이션등록](https://developers.naver.com/apps/#/register?defaultScope=search)** 메뉴에서 애플리케이션을 등록하셔야 합니다. <br>**[\[자세한 방법 보기\] &gt;](https://developers.naver.com/docs/common/register)**
- 클라이언트 ID와 secret 확인: [**내 애플리케이션**](https://developers.naver.com/appinfo)에서 등록한 애플리케이션을 선택하면 ClientID와 Client Secret 값을 확인할 수 있습니다.
- API 권한 설정: [**내 애플리케이션**](https://developers.naver.com/appinfo)의 **API 권한관리** 탭에서 사용하려는 API가 체크되어 있는지 확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.

## 2. API 기본 정보

|메서드|인증|요청 URL|출력 포맷|
|---|---|---|---|
|GET|-|https://openapi.naver.com/v1/search/movie.xml|XML|
|GET|-|https://openapi.naver.com/v1/search/movie.json|<em class="color_p3">JSON</em>|

## 3. 요청 변수

|요청 변수명|타입|필수 여부|기본값|설명|
|---|---|---|---|---|
|query|string (필수)|Y|-|검색을 원하는 질의. UTF-8 인코딩이다.|
|display|integer|N|기본값 10, 최대 100|검색 결과 출력 건수를 지정한다. 최대 100까지 가능하다.|
|start|integer|N|기본값 1, 최대 1000|검색의 시작 위치를 지정할 수 있다. 최대 1000까지 가능하다.|
|genre|string|N|-|검색을 원하는 장르 코드를 의미한다. 영화 코드는 다음과 같다.<br>1: 드라마 2: 판타지<br>3: 서부 4: 공포<br>5: 로맨스 6: 모험<br>7: 스릴러 8: 느와르<br>9: 컬트 10: 다큐멘터리<br>11: 코미디 12: 가족<br>13: 미스터리 14: 전쟁<br>15: 애니메이션 16: 범죄<br>17: 뮤지컬 18: SF<br>19: 액션20: 무협<br>21: 에로 22: 서스펜스<br>23: 서사 24: 블랙코미디<br>25: 실험 26: 영화카툰<br>27: 영화음악 28: 영화패러디포스터|
|country|string|N|-|검색을 원하는 국가 코드를 의미한다. 국가코드는 대문자만 사용 가능하며,<br>분류는 다음과 같다.<br>한국 (KR), 일본 (JP), 미국 (US), 홍콩(HK),<br>영국 (GB), 프랑스 (FR), 기타 (ETC)|
|yearfrom|integer(ex : 2000)|N|-|검색을 원하는 영화의 제작년도(최소)를 의미한다.<br>yearfrom은 yearto와 함께 사용되어야 한다.|
|yearto|integer(ex : 2008)|N|-|검색을 원하는 영화의 제작년도(최대)를 의미한다.<br>yearto는 yearfrom과 함께 사용되어야 한다.|

## 4. 출력 결과

|필드|타입|설명|
|---|---|---|
|rss|-|디버그를 쉽게 하고 RSS 리더기만으로 이용할 수 있게 하기 위해 만든 RSS 포맷의 컨테이너이며 그 외의 특별한 의미는 없다.|
|channel|-|검색 결과를 포함하는 컨테이너이다. 이 안에 있는 title, link, description 등의 항목은 참고용으로 무시해도 무방하다.|
|lastBuildDate|datetime|검색 결과를 생성한 시간이다.|
|item/items|-|XML 포멧에서는 item 태그로, JSON 포멧에서는 items 속성으로 표현된다. 개별 검색 결과이며 title, link, image, subtitle, pubDate, director, actor, userRating을 포함한다.|
|title|string|검색 결과 영화의 제목을 나타낸다. 제목에서 검색어와 일치하는 부분은 태그로 감싸져 있다.|
|link|string|검색 결과 영화의 하이퍼텍스트 link를 나타낸다.|
|image|string|검색 결과 영화의 썸네일 이미지의 URL이다. 이미지가 있는 경우만 나타난다.|
|subtitle|string|검색 결과 영화의 영문 제목이다.|
|pubDate|date|검색 결과 영화의 제작년도이다.|
|director|string|검색 결과 영화의 감독이다.|
|actor|string|검색 결과 영화의 출연 배우이다.|
|userRating|integer|검색 결과 영화에 대한 유저들의 평점이다.|

## 5. 에러 코드 

공통 에러 코드는 [여기](https://developers.naver.com/docs/common/openapiguide/errorcode.md)를 참조하세요.

|HTTP 코드|에러 코드|에러 메시지|조치 방안|
|---|---|---|---|
|400|SE01|Incorrect query request (잘못된 쿼리 요청입니다.)|검색 API 요청에 오류가 있습니다. 요청 URL, 필수 요청 변수가 정확한지 확인 바랍니다.|
|400|SE02|Invalid display value (부적절한 display 값입니다.)|display 요청 변수값이 허용 범위(1~100)인지 확인해 보세요.|
|400|SE03|Invalid start value (부적절한 start 값입니다.)|start 요청 변수값이 허용 범위(1~1000)인지 확인해 보세요.|
|400|SE04|Invalid sort value (부적절한 sort 값입니다.)|sort 요청 변수값에 오타가 없는지 확인해 보세요.|
|400|SE06|Malformed encoding (잘못된 형식의 인코딩입니다.)|검색어를 UTF-8로 인코딩하세요.|
|404|SE05|Invalid search api (존재하지 않는 검색 api 입니다.)|검색 API 대상에 오타가 없는지 확인해 보세요.|
|500|SE99|System Error (시스템 에러)|서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다.|

## 6. 예시

### 호출

```sh
curl "https://openapi.naver.com/v1/search/movie.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&genre=1" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}" -v
```

### 요청

```sh
> GET /v1/search/movie.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&genre=1 HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}
```

### 응답

```xml
< HTTP/1.1 200 OK
< Server: nginx
< Date: Wed, 28 Sep 2016 07:40:17 GMT
< Content-Type: text/xml;charset=utf-8
< Transfer-Encoding: chunked
< Connection: keep-alive
< Keep-Alive: timeout=5
< Vary: Accept-Encoding
< X-Powered-By: Naver
< Cache-Control: no-cache, no-store, must-revalidate
< Pragma: no-cache
<
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Naver Open API - movie ::'주식'</title>
        <link>http://search.naver.com</link>
        <description>Naver Search Result</description>
        <lastBuildDate>Wed, 28 Sep 2016 16:40:17 +0900</lastBuildDate>
        <total>2</total>
        <start>1</start>
        <display>2</display>
        <item>
            <title>주마등&lt;b&gt;주식&lt;/b&gt;회사</title>
            <link>http://openapi.naver.com/l?AAADWLQQvCIBzFP83f48h0zh08uK1B0S2IOm7mUEIts0F9+vQQPN77vQfv+dbxI2DXgyTQ9QV4B+2ATNSLMCk9gEjYjlkurFZXflp1rFRw/yXnbEspNk8vqypvPJBRhZsGMrSMY4ySwLSpN5RT3NSYIScO5nxhdzc18cjq0958w8LneKUy8fz6AdRxjD6YAAAA</link><image>http://imgmovie.naver.com/mdi/mit110/0968/96811_P01_142155.jpg</image>
            <subtitle>走馬&amp;amp;#28783;株式&amp;amp;#20250;社</subtitle>
            <pubDate>2012</pubDate>
            <director>미키 코이치로|</director>
            <actor>카시이 유우|쿠보타 마사타카|카지와라 히카리|치요 쇼타|요코야마 메구미|카시와바라 슈지|</actor>
            <userRating>4.50</userRating>
        </item>
        ...
    </channel>
</rss>
```