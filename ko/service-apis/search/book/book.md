---
title: 검색 API 책 검색 적용 가이드
description: 네이버 검색의 책 검색 결과를 반환하는 RESTful API입니다. 
---

검색 &gt; 책
====================

<div class="table-of-contents">
<ul>
    <li><a href="#책-검색-개요">책 검색 개요</a></li>
    <ul>
        <li><a href="#개요">개요</a></li>
        <li><a href="#사전-준비-사항">사전 준비 사항</a></li>
    </ul>
    <li><a href="#책-검색-api-레퍼런스">책 검색 API 레퍼런스</a></li>
    <ul>
        <li><a href="#책-검색-결과-조회">책 검색 결과 조회</a></li>
        <li><a href="#책-상세-검색-결과-조회">책 상세 검색 결과 조회</a></li>
        <li><a href="#오류-코드">오류 코드</a></li>
    </ul>
    <li><a href="#검색-api-책-검색-구현-예제">검색 API 책 검색 구현 예제</a></li>
</ul>
</div>

## 책 검색 개요

* [개요](#개요)
* [사전 준비 사항](#사전-준비-사항)

### 개요

#### 검색 API와 책 검색 개요

검색 API는 네이버 검색 결과를 뉴스, 백과사전, 블로그, 쇼핑, 웹 문서, 전문정보, 지식iN, 책, 카페글 등 분야별로 볼 수 있는 API입니다. 그 외에 지역 검색 결과와 성인 검색어 판별 기능, 오타 변환 기능을 제공합니다.

책 검색은 검색 API를 사용해 네이버 검색의 책 검색 결과를 반환하는 RESTful API입니다. 책 검색 결과를 XML 형식 또는 JSON 형식으로 반환합니다. API를 호출할 때는 검색어와 검색 조건을 쿼리 스트링(Query String) 형식의 데이터로 전달합니다.

책 검색은 검색 API를 사용하며, 검색 API의 하루 호출 한도는 25,000회입니다.

#### 검색 API 특징

검색 API는 비로그인 방식 오픈 API입니다.

비로그인 방식 오픈 API는 네이버 오픈API를 호출할 때 HTTP 요청 헤더에 클라이언트 아이디와 클라이언트 시크릿 값만 전송해 사용할 수 있는 오픈 API입니다. 클라이언트 아이디와 클라이언트 시크릿은 네이버 오픈API에서 인증된 사용자인지 확인하는 수단입니다. [네이버 개발자 센터](https://developers.naver.com/)에서 애플리케이션을 등록하면 클라이언트 아이디와 클라이언트 시크릿이 발급됩니다.

> **참고**  
> 네이버 오픈API의 종류와 클라이언트 아이디, 클라이언트 시크릿에 관한 자세한 내용은 "[API 공통 가이드](https://developers.naver.com/docs/common/openapiguide/)"를 참고하십시오.  

### 사전 준비 사항

검색 API를 사용해 책 검색을 실행하려면 먼저 [네이버 개발자 센터](https://developers.naver.com/)에서 애플리케이션을 등록하고 클라이언트 아이디와 클라이언트 시크릿을 발급받아야 합니다.

클라이언트 아이디와 클라이언트 시크릿은 인증된 사용자인지를 확인하는 수단이며, 애플리케이션이 등록되면 발급됩니다. 클라이언트 아이디와 클라이언트 시크릿을 네이버 오픈API를 호출할 때 HTTP 헤더에 포함해서 전송해야 API를 호출할 수 있습니다. API 사용량은 클라이언트 아이디별로 합산됩니다.

책 검색을 실행하기 위해 발급받은 클라이언트 아이디와 클라이언트 시크릿은 검색 API의 다른 작업을 실행할 때에도 사용할 수 있습니다. 애플리케이션을 등록하고 클라이언트 아이디와 클라이언트 시크릿을 발급받는 방법은 [블로그 검색의 사전 준비 사항](../blog/blog.md#사전-준비-사항)을 참고합니다.

> **주의**  
> 네이버에 로그인한 사용자 계정으로 애플리케이션이 등록됩니다. 애플리케이션을 등록한 네이버 아이디는 '관리자' 권한을 가지게 되므로 네이버 계정의 보안에 각별히 주의해야 합니다.  
> 회사나 단체에서 애플리케이션을 등록할 때는 추후 키 관리 등이 용이하도록 네이버 단체 회원으로 로그인해 이용할 것을 권장합니다.  
> - [네이버 단체 회원 가입하기](https://nid.naver.com/group/commonAction.nhn?m=viewTerms)  

## 책 검색 API 레퍼런스

* [책 검색 결과 조회](#책-검색-결과-조회)
* [책 상세 검색 결과 조회](#책-상세-검색-결과-조회)

### 책 검색 결과 조회

#### 설명

네이버 검색의 책 검색 결과를 XML 형식 또는 JSON 형식으로 반환합니다.

#### 요청 URL

|요청 URL|반환 형식|
|---|:-:|
|`https://openapi.naver.com/v1/search/book.xml`|XML|
|`https://openapi.naver.com/v1/search/book.json`|JSON|

#### 프로토콜

HTTPS

#### HTTP 메서드

GET

#### 파라미터

파라미터를 쿼리 스트링 형식으로 전달합니다.

|파라미터|타입|필수 여부|설명
|---|---|:-:|---|
|query|String|Y|검색어. UTF-8로 인코딩되어야 합니다.|
|display|Integer|N|한 번에 표시할 검색 결과 개수(기본값: 10, 최댓값: 100)|
|start|Integer|N|검색 시작 위치(기본값: 1, 최댓값: 1000)|
|sort|String|N|검색 결과 정렬 방법<br/>- `sim`: 정확도순으로 내림차순 정렬(기본값)<br/>- `date`: 출간일순으로 내림차순 정렬|

#### 참고 사항

API를 요청할 때 다음 예와 같이 HTTP 요청 헤더에 [클라이언트 아이디와 클라이언트 시크릿](https://developers.naver.com/docs/common/openapiguide/appregister.md#클라이언트-아이디와-클라이언트-시크릿-확인)을 추가해야 합니다.

```sh
> GET /v1/search/book.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1 HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}
>
```

#### 요청 예

```sh
curl "https://openapi.naver.com/v1/search/book.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}" -v
```

#### 응답

응답에 성공하면 결괏값을 XML 형식 또는 JSON 형식으로 반환합니다. XML 형식의 결괏값은 다음과 같습니다.

|요소|타입|설명|
|---|:-:|---|
|rss|-|RSS 컨테이너. RSS 리더기를 사용해 검색 결과를 확인할 수 있습니다.|
|rss/channel|-|검색 결과를 포함하는 컨테이너. `channel` 요소의 하위 요소인 `title`, `link`, `description`은 RSS에서 사용하는 정보이며, 검색 결과와는 상관이 없습니다.|
|rss/channel/lastBuildDate|dateTime|검색 결과를 생성한 시간|
|rss/channel/total|Integer|총 검색 결과 개수|
|rss/channel/start|Integer|검색 시작 위치|
|rss/channel/display|Integer|한 번에 표시할 검색 결과 개수|
|rss/channel/item|-|개별 검색 결과. JSON 형식의 결괏값에서는 `items` 속성의 JSON 배열로 개별 검색 결과를 반환합니다.|
|rss/channel/item/title|String|책 제목|
|rss/channel/item/link|String|네이버 도서 정보 URL|
|rss/channel/item/image|String|섬네일 이미지의 URL|
|rss/channel/item/author|String|저자 이름|
|rss/channel/item/discount|Integer|판매 가격. 절판 등의 이유로 가격이 없으면 값을 반환하지 않습니다.|
|rss/channel/item/publisher|String|출판사|
|rss/channel/item/isbn|Integer|ISBN|
|rss/channel/item/description|String|네이버 도서의 책 소개|
|rss/channel/item/pubdate|dateTime|출간일|

#### 응답 예

```xml
```xml
< HTTP/1.1 200 OK
< Server: nginx
< Date: Mon, 26 Sep 2016 01:40:35 GMT
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
        <title>Naver Open API - book ::'주식'</title>
        <link>http://search.naver.com</link>
        <description>Naver Search Result</description>
        <lastBuildDate>Mon, 26 Sep 2016 10:40:35 +0900</lastBuildDate>
        <total>20177</total><start>1</start><display>10</display>
        <item>
            <title>불곰의 <b>주식</b>투자 불패공식 (60개 매도종목 평균 수익률 62%)</title>
            <link>http://openapi.naver.com/l?AAAC3LSwqDMBSF4dXcDCV6YxsHGfiog6JIV1A0SYloGpumQnffFIQz+DnwvT7afwVcaigRqvofvIKiIcbrhzAhbIAlZG3c5NySPMdd+0Q6exxqOuKudBjnNdlMFO00K8AmpRzZKackiJSdGc8ZxZzSglix3vqhG6KVKPcis0vXX+k+vqXM2BLpDzHjEYWYAAAA</link>
            <image>http://bookthumb.phinf.naver.net/cover/108/346/10834650.jpg?type=m1&udate=20160902</image>
            <author>불곰 박선목</author>
            <price>16000</price>
            <discount>14400</discount>
            <publisher>부키</publisher>
            <pubdate>20160729</pubdate>
            <isbn>8960515523 9788960515529</isbn>
            <description>잘못된 <b>주식</b>투자 습관을 버리고, 절대로 지지 않는 투자법을 체득하다!불곰<b>주식</b>연구소 대표 ‘불곰’이 알려 주는 세상에서 가장 쉬운 ‘<b>주식</b>투자 불패공식’ 『불곰의 <b>주식</b>투자 불패공식』. 불곰은 전업투자자가 아니다. 불곰<b>주식</b>연구소는 태평스럽게도 한 달에 한 종목 정도만 추천할 따름이다. 그럼에도... </description></item><item><title>엄마, <b>주식</b> 사주세요 (아이와 엄마의 미래를 위한 투자 원칙)</title><link>http://openapi.naver.com/l?AAACssTS2qtFV1dVZ1NFZ1cgYxLJxULV3UMopS02wzSkoKVI0dVY3cgCgpPz9bLy+xLLVILzk/FyqQkgRlxKekliRm5ugVZAB1uCVlpqgauxgamJsZmZlZqpXYGpqYm1iYmhgYmxoYWKrl2oaYpnokpmR6mhX6G1mkhHsDzXOqAGJDU8+M8rRIoGYA29JYJ5oAAAA=</link><image>http://bookthumb.phinf.naver.net/cover/107/626/10762669.jpg?type=m1&udate=20160802</image><author>존 리</author><price>14000</price><discount>12600</discount><publisher>한국경제신문사</publisher><pubdate>20160627</pubdate><isbn>8947541184 9788947541183</isbn><description>엄마의 <b>주식</b> 투자가 아이의 미래다!『엄마, <b>주식</b> 사주세요』는 전설의 펀드 투자자, 코리아펀드의 귀재로 불리며 새로운 마켓 리더로 부상한 존 리가... 저자는 이 책을 통해 자녀를 월급쟁이가 아닌 자본가로 키울 것과, <b>주식</b>투자에 대한 엄마들의 편견에 대해 중점적으로 이야기한다. 부를 축적하기 위한 자본가... </description>
        </item>
        ...
    </channel>
</rss>
```

### 책 상세 검색 결과 조회

#### 설명

네이버 검색의 책 상세 검색 결과를 XML 형식으로 반환합니다. 책 제목과 ISBN으로 검색할 수 있습니다.

#### 요청 URL

```sh
https://openapi.naver.com/v1/search/book_adv.xml
```

#### 프로토콜

HTTPS

#### HTTP 메서드

GET

#### 파라미터

파라미터를 쿼리 스트링 형식으로 전달합니다. 책 제목(`d_titl`)과 ISBN(`d_isbn`) 중 1개 이상의 파라미터를 사용해야 합니다.

|파라미터|타입|필수 여부|설명
|---|---|:-:|---|
|query|String|N|검색어. UTF-8로 인코딩되어야 합니다.|
|display|Integer|N|한 번에 표시할 검색 결과 개수(기본값: 10, 최댓값: 100)|
|start|Integer|N|검색 시작 위치(기본값: 1, 최댓값: 1000)|
|sort|String|N|검색 결과 정렬 방법<br/>- `sim`: 정확도순으로 내림차순 정렬(기본값)<br/>- `date`: 출간일순으로 내림차순 정렬|
|d_titl|String|N|검색할 책 제목. UTF-8로 인코딩되어야 합니다. `d_titl`과 `d_isbn` 중 1개 이상의 파라미터를 사용해야 합니다.|
|d_isbn|String|N|검색할 ISBN. `d_titl`과 `d_isbn` 중 1개 이상의 파라미터를 사용해야 합니다.|

#### 참고 사항

API를 요청할 때 다음 예와 같이 HTTP 요청 헤더에 [클라이언트 아이디와 클라이언트 시크릿](https://developers.naver.com/docs/common/openapiguide/appregister.md#클라이언트-아이디와-클라이언트-시크릿-확인)을 추가해야 합니다.

```sh
> GET /v1/search/book_adv.xml?d_titl=%EC%A3%BC%EC%8B%9D&display=10&start=1 HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}
>
```

#### 요청 예

```sh
curl "https://openapi.naver.com/v1/search/book_adv.xml?d_titl=%EC%A3%BC%EC%8B%9D&display=10&start=1" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}" -v
```

#### 응답

응답에 성공하면 결괏값을 XML 형식으로 반환합니다.

|요소|타입|설명|
|---|:-:|---|
|rss|-|RSS 컨테이너. RSS 리더기를 사용해 검색 결과를 확인할 수 있습니다.|
|rss/channel|-|검색 결과를 포함하는 컨테이너. `channel` 요소의 하위 요소인 `title`, `link`, `description`은 RSS에서 사용하는 정보이며, 검색 결과와는 상관이 없습니다.|
|rss/channel/lastBuildDate|dateTime|검색 결과를 생성한 시간|
|rss/channel/total|Integer|총 검색 결과 개수|
|rss/channel/start|Integer|검색 시작 위치|
|rss/channel/display|Integer|한 번에 표시할 검색 결과 개수|
|rss/channel/item|-|개별 검색 결과|
|rss/channel/item/title|String|책 제목|
|rss/channel/item/link|String|네이버 도서 정보 URL|
|rss/channel/item/image|String|섬네일 이미지의 URL|
|rss/channel/item/author|String|저자 이름|
|rss/channel/item/discount|Integer|판매 가격. 절판 등의 이유로 가격이 없으면 값을 반환하지 않습니다.|
|rss/channel/item/publisher|String|출판사|
|rss/channel/item/isbn|Integer|ISBN|
|rss/channel/item/description|String|네이버 도서의 책 소개|
|rss/channel/item/pubdate|dateTime|출간일|

#### 응답 예

```xml
< HTTP/1.1 200 OK
< Server: nginx
< Date: Mon, 26 Sep 2016 01:40:35 GMT
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
        <title>Naver Open API - book ::'주식'</title>
        <link>http://search.naver.com</link>
        <description>Naver Search Result</description>
        <lastBuildDate>Mon, 26 Sep 2016 10:40:35 +0900</lastBuildDate>
        <total>20177</total><start>1</start><display>10</display>
        <item>
            <title>불곰의 <b>주식</b>투자 불패공식 (60개 매도종목 평균 수익률 62%)</title>
            <link>http://openapi.naver.com/l?AAAC3LSwqDMBSF4dXcDCV6YxsHGfiog6JIV1A0SYloGpumQnffFIQz+DnwvT7afwVcaigRqvofvIKiIcbrhzAhbIAlZG3c5NySPMdd+0Q6exxqOuKudBjnNdlMFO00K8AmpRzZKackiJSdGc8ZxZzSglix3vqhG6KVKPcis0vXX+k+vqXM2BLpDzHjEYWYAAAA</link>
            <image>http://bookthumb.phinf.naver.net/cover/108/346/10834650.jpg?type=m1&udate=20160902</image>
            <author>불곰 박선목</author>
            <price>16000</price>
            <discount>14400</discount>
            <publisher>부키</publisher>
            <pubdate>20160729</pubdate>
            <isbn>8960515523 9788960515529</isbn>
            <description>잘못된 <b>주식</b>투자 습관을 버리고, 절대로 지지 않는 투자법을 체득하다!불곰<b>주식</b>연구소 대표 ‘불곰’이 알려 주는 세상에서 가장 쉬운 ‘<b>주식</b>투자 불패공식’ 『불곰의 <b>주식</b>투자 불패공식』. 불곰은 전업투자자가 아니다. 불곰<b>주식</b>연구소는 태평스럽게도 한 달에 한 종목 정도만 추천할 따름이다. 그럼에도... </description></item><item><title>엄마, <b>주식</b> 사주세요 (아이와 엄마의 미래를 위한 투자 원칙)</title><link>http://openapi.naver.com/l?AAACssTS2qtFV1dVZ1NFZ1cgYxLJxULV3UMopS02wzSkoKVI0dVY3cgCgpPz9bLy+xLLVILzk/FyqQkgRlxKekliRm5ugVZAB1uCVlpqgauxgamJsZmZlZqpXYGpqYm1iYmhgYmxoYWKrl2oaYpnokpmR6mhX6G1mkhHsDzXOqAGJDU8+M8rRIoGYA29JYJ5oAAAA=</link><image>http://bookthumb.phinf.naver.net/cover/107/626/10762669.jpg?type=m1&udate=20160802</image><author>존 리</author><price>14000</price><discount>12600</discount><publisher>한국경제신문사</publisher><pubdate>20160627</pubdate><isbn>8947541184 9788947541183</isbn><description>엄마의 <b>주식</b> 투자가 아이의 미래다!『엄마, <b>주식</b> 사주세요』는 전설의 펀드 투자자, 코리아펀드의 귀재로 불리며 새로운 마켓 리더로 부상한 존 리가... 저자는 이 책을 통해 자녀를 월급쟁이가 아닌 자본가로 키울 것과, <b>주식</b>투자에 대한 엄마들의 편견에 대해 중점적으로 이야기한다. 부를 축적하기 위한 자본가... </description>
        </item>
        ...
    </channel>
</rss>
```

### 오류 코드

검색 API 책 검색의 주요 오류 코드는 다음과 같습니다.

|오류 코드|HTTP 상태 코드|오류 메시지|설명|
|:-:|:-:|---|---|
|SE01|400|Incorrect query request (잘못된 쿼리요청입니다.)|API 요청 URL의 프로토콜, 파라미터 등에 오류가 있는지 확인합니다.|
|SE02|400|Invalid display value (부적절한 display 값입니다.)|`display` 파라미터의 값이 허용 범위의 값(1\~100)인지 확인합니다.|
|SE03|400|Invalid start value (부적절한 start 값입니다.)|`start` 파라미터의 값이 허용 범위의 값(1\~1000)인지 확인합니다.|
|SE04|400|Invalid sort value (부적절한 sort 값입니다.)|`sort` 파라미터의 값에 오타가 있는지 확인합니다.|
|SE06|400|Malformed encoding (잘못된 형식의 인코딩입니다.)|검색어를 UTF-8로 인코딩합니다.|
|SE05|404|Invalid search api (존재하지 않는 검색 api 입니다.)|API 요청 URL에 오타가 있는지 확인합니다.|
|SE99|500|System Error (시스템 에러)|서버 내부에 오류가 발생했습니다. "[개발자 포럼](https://developers.naver.com/forum)"에 오류를 신고해 주십시오.|

> **403 오류**  
> 개발자 센터에 등록한 애플리케이션에서 검색 API를 사용하도록 설정하지 않았다면 'API 권한 없음'을 의미하는 403 오류가 발생할 수 있습니다. 403 오류가 발생했다면 네이버 개발자 센터의 [**Application &gt; 내 애플리케이션**](https://developers.naver.com/apps/#/list) 메뉴에서 오류가 발생한 애플리케이션의 **API 설정** 탭을 클릭한 다음 **검색**<!-- -->이 선택돼 있는지 확인해 보십시오.  

> **참고**  
> 네이버 오픈API 공통 오류 코드는 "[API 공통 가이드](https://developers.naver.com/docs/common/openapiguide/)"의 '[오류 코드](https://developers.naver.com/docs/common/openapiguide/errorcode.md)'를 참고하십시오.  

## 검색 API 책 검색 구현 예제

검색 API로 책 검색 결과를 조회하는 방법은 블로그 검색 결과를 조회하는 방법과 유사합니다. 책 검색 결과 조회를 구현하는 방법은 [검색 API 블로그 검색 구현 예제](../blog/blog.md#검색-api-블로그-검색-구현-예제)를 참고합니다.