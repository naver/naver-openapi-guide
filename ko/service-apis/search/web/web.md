---
title: 검색 API 웹문서 검색 개발가이드
description: 네이버 웹 문서 검색 결과를 출력해주는 REST API입니다.
---

# 검색 &gt; 웹문서

네이버 웹 문서 검색 결과를 출력해주는 REST API입니다. 비로그인 오픈 API이므로 GET으로 호출할 때 HTTP Header에 애플리케이션 등록 시 발급받은 [Client ID와 Client Secret 값을 같이 전송](https://developers.naver.com/docs/common/apicall)해 주시면 활용 가능합니다.

<div class="buttons2"><a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?defaultScope=search">오픈 API 이용 신청 &gt;</a></div>

## 1. 준비사항

- 애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 **[Application-애플리케이션 등록](https://developers.naver.com/apps/#/register?defaultScope=search)** 메뉴에서 애플리케이션을 등록하셔야 합니다. <br>[\[자세한 방법 보기\] &gt;](https://developers.naver.com/docs/common/register)
- 클라이언트 ID와 secret 확인: [**내 애플리케이션**](https://developers.naver.com/appinfo)에서 등록한 애플리케이션을 선택하면 Client ID와 Client Secret 값을 확인할 수 있습니다.
- API 권한 설정: [**내 애플리케이션**](https://developers.naver.com/appinfo)의 **API 권한관리** 탭에서 사용하려는 API가 체크되어 있는지 확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.

## 2. API 기본 정보

|메서드|인증|요청 URL|출력 포맷|
|---|---|---|---|
|GET|-|https://openapi.naver.com/v1/search/webkr.xml|XML|
|GET|-|https://openapi.naver.com/v1/search/webkr.json|<em class="color_p3">JSON</em>|

## 3. 요청 변수

|요청 변수명|타입|필수 여부|기본값|설명|
|---|---|---|---|---|
|query|string|Y|-|검색을 원하는 문자열로서 UTF-8로 인코딩한다.|
|display|integer|N|10(기본값), 100(최대)|검색 결과 출력 건수 지정|
|start|integer|N|1(기본값), 1000(최대)|검색 시작 위치로 최대 1000까지 가능|

## 4. 출력 결과

|필드|타입|설명|
|---|---|---|
|rss|-|디버그를 쉽게 하고 RSS 리더기만으로 이용할 수 있게 하기 위해 만든 RSS 포맷의 컨테이너이며 그 외의 특별한 의미는 없다.|
|channel|-|검색 결과를 포함하는 컨테이너이다. 이 안에 있는 title, link, description 등의 항목은 참고용으로 무시해도 무방하다.|
|lastBuildDate|datetime|검색 결과를 생성한 시간이다.|
|total|integer|검색 결과 문서의 총 개수를 의미한다.|
|start|integer|검색 결과 문서 중, 문서의 시작점을 의미한다.|
|display|integer|검색된 검색 결과의 개수이다.|
|item/items|-|XML 포멧에서는 item 태그로, JSON 포멧에서는 items 속성으로 표현된다. 개별 검색 결과이며 title, link, description을 포함한다.|
|title|string|검색 결과 문서의 제목을 나타낸다. 제목에서 검색어와 일치하는 부분은 <strong>태그로 감싸져 있다.</strong>|
|link|string|검색 결과 문서의 하이퍼텍스트 link를 나타낸다.|
|description|string|검색 결과 문서의 내용을 요약한 패시지 정보이다. 문서 전체의 내용은 link를 따라가면 읽을 수 있다. 패시지에서 검색어와 일치하는 부분은 <strong>태그로 감싸져 있다.</strong>|

## 5. 에러 코드 

|HTTP 코드|에러 코드|에러 메시지|조치 방안|
|---|---|---|---|
|400|SE01|Incorrect query request (잘못된 쿼리요청입니다.)|검색 API 요청에 오류가 있습니다. 요청 URL, 필수 요청 변수가 정확한지 확인 바랍니다.|
|400|SE02|Invalid display value (부적절한 display 값입니다.)|display 요청 변수값이 허용 범위(1~100)인지 확인해 보세요.|
|400|SE03|Invalid start value (부적절한 start 값입니다.)|start 요청 변수값이 허용 범위(1~1000)인지 확인해 보세요.|
|400|SE04|Invalid sort value (부적절한 sort 값입니다.)|sort 요청 변수 값에 오타가 없는지 확인해 보세요.|
|400|SE06|Malformed encoding (잘못된 형식의 인코딩입니다.)|검색어를 UTF-8로 인코딩하세요.|
|404|SE05|Invalid search api (존재하지 않는 검색 api 입니다.)|검색 API 대상에 오타가 없는지 확인해 보세요.|
|500|SE99|System Error (시스템 에러)|서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다.|

## 6. 예시

### 호출

```sh
curl "https://openapi.naver.com/v1/search/webkr.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}" -v
```

### 요청

```sh
> GET /v1/search/webkr.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1 HTTP/1.1
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
< Date: Wed, 28 Sep 2016 07:43:34 GMT
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
        <title>Naver Open API - webkr ::'주식'</title>
        <link>http://search.naver.com</link>
        <description>Naver Search Result</description>
        <lastBuildDate>Wed, 28 Sep 2016 16:43:34 +0900</lastBuildDate>
        <total>81296956</total>
        <start>1</start>
        <display>10</display>
        <item>
            <title>&lt;b&gt;주식&lt;/b&gt;</title>
            <link>http://openapi.naver.com/l?AAABWLywrDIBQFv+ZmGXykRhcu8miWLRT6AcZY0tjURi2Sfn0NHDjDwGxf43cJ5w4aCm13AG9B9MXszUPOMX6ANkCGvJRSmVx6m1hqV1p/KJfsojOMTvkp/+sZYqlCjoZRu8kA7S9cIIIwQkDYGsyWFRY1K6LEVX1CFWe4ojUuVqluM8EKh7AsbX//Mcas0vuVWcFz9AdOGABxqgAAAA==</link>
            <description>23 &lt;b&gt;주식&lt;/b&gt; 와우스마트 종목시스템 김종철의 인공지능차트 투자전략 &lt;b&gt;주식&lt;/b&gt; 번호 제목 작성자 작성일 1212 [금요일]오전장전략... 멘토컨설팅 &lt;b&gt;주식&lt;/b&gt;창 WOWNET 서비스 공인인증센터 대박네... </description>
        </item>
        ...
    </channel>
</rss>
```