---
title: 검색 API 지역 검색 개발가이드
description: 네이버 지역 서비스에 등록된 각 지역별 업체 및 상호 검색 결과를 출력해주는 REST API입니다.
---

# 검색 &gt; 지역

네이버 지역 서비스에 등록된 각 지역별 업체 및 상호 검색 결과를 출력해주는 REST API입니다. 비로그인 오픈 API이므로 GET으로 호출할 때 HTTP Header에 애플리케이션 등록 시 발급받은 [Client ID와 Client Secret 값을 같이 전송](https://developers.naver.com/docs/common/openapiguide/#/apicall.md)해 주시면 활용 가능합니다.

<div class="buttons2"><a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?defaultScope=search">오픈 API 이용 신청 &gt;</a></div>

## 1. 준비사항

- 애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 **[Application-애플리케이션 등록](https://developers.naver.com/apps/#/register?defaultScope=search)** 메뉴에서 애플리케이션을 등록하셔야 합니다. <br>**[\[자세한 방법 보기\] &gt;](https://developers.naver.com/docs/common/register)**
- 클라이언트 ID와 secret 확인: [**내 애플리케이션**](https://developers.naver.com/appinfo)에서 등록한 애플리케이션을 선택하면 Client ID와 Client Secret 값을 확인할 수 있습니다.
- API 권한 설정: [**내 애플리케이션**](https://developers.naver.com/appinfo)의 **API 권한관리** 탭에서 사용하려는 API가 체크되어 있는지 확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.

## 2. API 기본 정보

|메서드|인증|요청 URL|출력 포맷|
|---|---|---|---|
|GET|-|https://openapi.naver.com/v1/search/local.xml|XML|
|GET|-|https://openapi.naver.com/v1/search/local.json|<em class="color_p3">JSON</em>|

## 3. 요청 변수

|요청 변수명|타입|필수 여부|기본값|설명|
|---|---|---|---|---|
|query|string|Y|-|검색을 원하는 문자열로서 UTF-8로 인코딩한다.|
|display|integer|N|1(기본값), 5(최대)|검색 결과 출력 건수 지정|
|start|integer|N|1(기본값), 1(최대)|검색 시작 위치로 1만 가능|
|sort|string|N|random (기본값), comment|정렬 옵션: random(유사도순), comment(카페/블로그 리뷰 개수 순)|

## 4. 출력 결과

|필드|타입|설명|
|---|---|---|
|rss|-|디버그를 쉽게 하고 RSS 리더기만으로 이용할 수 있게 하기 위해 만든 RSS 포맷의 컨테이너이며 그 외의 특별한 의미는 없다.|
|channel|-|검색 결과를 포함하는 컨테이너이다. 이 안에 있는 title, link, description 등의 항목은 참고용으로 무시해도 무방하다.|
|lastBuildDate|datetime|검색 결과를 생성한 시간이다.|
|total|integer|검색 결과 문서의 총 개수를 의미한다.|
|start|integer|검색 결과 문서 중, 문서의 시작점을 의미한다.|
|display|integer|검색된 검색 결과의 개수이다.|
|category|string|검색 결과 업체, 기관의 분류 정보를 제공한다.|
|item/items|-|XML 포멧에서는 item 태그로, JSON 포멧에서는 items 속성으로 표현된다. 개별 검색 결과이며 title, link, description, address, mapx, mapy를 포함한다.|
|title|string|검색 결과 업체, 기관명을 나타낸다.|
|link|string|검색 결과 업체, 기관의 상세 정보가 제공되는 네이버 페이지의 하이퍼텍스트 link를 나타낸다.|
|description|string|검색 결과 업체, 기관명에 대한 설명을 제공한다.|
|telephone|string|빈 문자열 반환. 과거에 제공되던 항목이라 하위 호환성을 위해 존재한다.|
|address|string|검색 결과 업체, 기관명의 주소를 제공한다.|
|roadAddress|string|검색 결과 업체, 기관명의 도로명 주소를 제공한다.|
|mapx|integer|검색 결과 업체, 기관명 위치 정보의 x좌표를 제공한다. 제공값은 카텍좌표계 값으로 제공된다. 이 좌표값은 지도 API와 연동 가능하다.|
|mapy|integer|검색 결과 업체, 기관명 위치 정보의 y좌표를 제공한다. 제공값은 카텍 좌표계 값으로 제공된다. 이 좌표값은 지도 API와 연동 가능하다.|

## 5. 에러 코드 
공통 에러 코드는 [여기](https://developers.naver.com/docs/common/openapiguide/errorcode.md)를 참조하세요.

|HTTP 코드|에러 코드|에러 메시지|조치 방안|
|---|---|---|---|
|400|SE01|Incorrect query request (잘못된 쿼리 요청입니다.)|검색 API 요청에 오류가 있습니다. 요청 URL, 필수 요청 변수가 정확한지 확인 바랍니다.|
|400|SE02|Invalid display value (부적절한 display 값입니다.)|display 요청 변수값이 허용 범위(1~30)인지 확인해 보세요.|
|400|SE03|Invalid start value (부적절한 start 값입니다.)|start 요청 변수값이 허용 범위(1~1000)인지 확인해 보세요.|
|400|SE04|Invalid sort value (부적절한 sort 값입니다.)|sort 요청 변수 값에 오타가 없는지 확인해 보세요.|
|400|SE06|Malformed encoding (잘못된 형식의 인코딩입니다.)|검색어를 UTF-8로 인코딩하세요.|
|404|SE05|Invalid search api (존재하지 않는 검색 api 입니다.)|검색 API 대상에 오타가 없는지 확인해 보세요.|
|500|SE99|System Error (시스템 에러)|서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다.|

## 6. 예시

### 호출

```sh
curl "https://openapi.naver.com/v1/search/local.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&sort=random" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}" -v
```

### 요청

```sh
> GET /v1/search/local.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&sort=random HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}
```

### 응답

```xml
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Naver Open API - local ::'갈비집'</title>
        <link>http://search.naver.com</link>
        <description>Naver Search Result</description>
        <lastBuildDate>Tue, 04 Oct 2016 13:10:58 +0900</lastBuildDate>
        <total>407</total>
        <start>1</start>
        <display>10</display>
        <item>
            <title>조선옥</title>
            <link />
            <category>한식&gt;육류,고기요리</category>
            <description>연탄불 한우갈비 전문점.</description>
            <telephone></telephone>
            <address>서울특별시 중구 을지로3가 229-1 </address>
            <roadAddress>서울특별시 중구 을지로15길 6-5 </roadAddress>
            <mapx>311277</mapx>
            <mapy>552097</mapy>
        </item>
        ...
    </channel>
</rss>
```