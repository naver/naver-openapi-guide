# 쇼핑

<html lang="ko">
<head>
    <title>NAVER Developers - 검색 API 쇼핑 검색 개발가이드</title>
    <meta name="description" content="NAVER Developers - 검색 API 쇼핑 검색 개발가이드">
</head>
<body>
<div class="con">
    <div class="h_page_area">
        <h2 class="h_page">검색 &gt; 쇼핑</h2>
    </div>
    <p class="p_desc">
        네이버 쇼핑 검색 결과를 출력해주는 REST API입니다. 비로그인 오픈 API이므로 GET으로 호출할 때 HTTP Header에 애플리케이션 등록 시 발급받은 <a href="https://developers.naver.com/docs/common/apicall" class="color_p2 underline ">Client ID와 Client Secret 값을 같이 전송</a>해 주시면 활용 가능합니다.
    </p>
    <div class="buttons2">
        <a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?defaultScope=search">오픈 API 이용 신청 &gt;</a>
    </div>
    <h3 class="h_sub">1. 준비사항</h3>
    <ul class="list_type1">
        <li>애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 <a href="https://developers.naver.com/apps/#/register?defaultScope=search" class="color_p2 underline">'Application-애플리케이션
            등록'</a> 메뉴에서 애플리케이션을 등록하셔야 합니다. <br>
            <a href="https://developers.naver.com/docs/common/register" class="color_p2 underline">[자세한 방법 보기] &gt;</a></li>
        <li>클라이언트 ID와 secret 확인: <a href="https://developers.naver.com/appinfo" class="color_p2 underline">'내 애플리케이션'</a>에서 등록한 애플리케이션을 선택하면 Client
            ID와 Client Secret 값을 확인할 수 있습니다.
        </li>
        <li>API 권한 설정: <a href="https://developers.naver.com/appinfo" class="color_p2 underline">'내 애플리케이션'</a>의 'API 권한관리' 탭에서 사용하려는 API가 체크되어 있는지
            확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.
        </li>
    </ul>
    <h3 class="h_sub">2. API 기본 정보</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">API 기본 정보 설명 표</span></caption>
        <colgroup>
            <col>
            <col>
            <col style="width:40%">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">메서드</th>
            <th scope="col">인증</th>
            <th scope="col">요청 URL</th>
            <th scope="col">출력 포맷</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">GET</td>
            <td class="center">-</td>
            <td class="left">https://openapi.naver.com/v1/search/shop.xml</td>
            <td class="center">XML</td>
        </tr>
        <tr>
            <td class="center">GET</td>
            <td class="center">-</td>
            <td class="left">https://openapi.naver.com/v1/search/shop.json</td>
            <td class="center"><em class="color_p3">JSON</em></td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">3. 요청 변수</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">요청 변수 설명 표</span></caption>
        <colgroup>
            <col>
            <col>
            <col>
            <col>
            <col style="width:40%">
        </colgroup>
        <thead>
        <tr>
            <th scope="col">요청 변수명</th>
            <th scope="col">타입</th>
            <th scope="col">필수 여부</th>
            <th scope="col">기본값</th>
            <th scope="col">설명</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">query</td>
            <td class="center">string</td>
            <td class="center">Y</td>
            <td class="center">-</td>
            <td class="left">검색을 원하는 문자열로서 UTF-8로 인코딩한다.</td>
        </tr>
        <tr>
            <td class="center">filter</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">모든 상품</td>
            <td class="left">검색 결과 중 설정한 옵션만 나온다. 필터 옵션: naverpay(네이버페이 연동)</td>
        </tr>
<tr>
            <td class="center">exclude</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">모든 상품</td>
            <td class="left">검색 결과 중 설정한 옵션을 제외한 상품이 나온다.<br>제외옵션: used(중고), rental(렌탈), cbshop(해외직구, 구매대행)<br>사용 방법: exclude={option}:{option}:{option}, 원하는 옵션을 넣으면 된다.<br>(예제: exclude=used:cbshop )</td>
        </tr>
        <tr>
            <td class="center">display</td>
            <td class="center">integer</td>
            <td class="center">N</td>
            <td class="center">10(기본값), 100(최대)</td>
            <td class="left">검색 결과 출력 건수 지정</td>
        </tr>
        <tr>
            <td class="center">start</td>
            <td class="center">integer</td>
            <td class="center">N</td>
            <td class="center">1(기본값), 1000(최대)</td>
            <td class="left">검색 시작 위치로 최대 1000까지 가능</td>
        </tr>
        <tr>
            <td class="center">sort</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">sim(기본값), date, asc, dsc</td>
            <td class="left">정렬 옵션: sim (유사도순), date (날짜순), asc(가격오름차순) ,dsc(가격내림차순)</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">4. 출력 결과</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">출력 결과 설명 표</span></caption>
        <colgroup>
            <col>
            <col>
            <col style="width:60%">
        </colgroup>
        <thead>
        <tr>
            <th scope="col">필드</th>
            <th scope="col">타입</th>
            <th scope="col">설명</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">rss</td>
            <td class="center">-</td>
            <td class="left">디버그를 쉽게 하고 RSS 리더기만으로 이용할 수 있게 하기 위해 만든 RSS 포맷의 컨테이너이며 그 외의 특별한 의미는 없다.</td>
        </tr>
        <tr>
            <td class="center">channel</td>
            <td class="center">-</td>
            <td class="left">검색 결과를 포함하는 컨테이너이다. 이 안에 있는 title, link, description 등의 항목은 참고용으로 무시해도 무방하다.</td>
        </tr>
        <tr>
            <td class="center">lastBuildDate</td>
            <td class="center">datetime</td>
            <td class="left">검색 결과를 생성한 시간이다.</td>
        </tr>
        <tr>
            <td class="center">total</td>
            <td class="center">integer</td>
            <td class="left">검색 결과 문서의 총 개수를 의미한다.</td>
        </tr>
        <tr>
            <td class="center">start</td>
            <td class="center">integer</td>
            <td class="left">검색 결과 문서 중, 문서의 시작점을 의미한다.</td>
        </tr>
        <tr>
            <td class="center">display</td>
            <td class="center">integer</td>
            <td class="left">검색된 검색 결과의 개수이다.</td>
        </tr>
        <tr>
            <td class="center">item/items</td>
            <td class="center">-</td>
            <td class="left">XML 포멧에서는 item 태그로, JSON 포멧에서는 items 속성으로 표현된다. 개별 검색 결과이며 title, link을 포함한다.</td>
        </tr>
        <tr>
            <td class="center">title</td>
            <td class="center">string</td>
            <td class="left">검색 결과 문서의 제목을 나타낸다. 제목에서 검색어와 일치하는 부분은 <strong>태그로 감싸져 있다.</strong></td>
        </tr>
        <tr>
            <td class="center">link</td>
            <td class="center">string</td>
            <td class="left">검색 결과 문서의 하이퍼텍스트 link를 나타낸다.</td>
        </tr>
        <tr>
            <td class="center">image</td>
            <td class="center">string</td>
            <td class="left">썸네일 이미지의 URL이다. 이미지가 있는 경우만 나타난다.</td>
        </tr>
        <tr>
            <td class="center">lprice</td>
            <td class="center">integer</td>
            <td class="left">최저가 정보이다. 최저가 정보가 없는 경우 0으로 표시되며, 가격비교 데이터가 없는 경우 이 필드는 가격을 나타낸다.</td>
        </tr>
        <tr>
            <td class="center">hprice</td>
            <td class="center">integer</td>
            <td class="left">최고가 정보이다. 최고가 정보가 없거나 가격비교 데이터가 없는 경우 0으로 표시된다.</td>
        </tr>
        <tr>
            <td class="center">mallName</td>
            <td class="center">string</td>
            <td class="left">상품을 판매하는 쇼핑몰의 상호이다. 정보가 없을 경우 네이버로 표기된다.</td>
        </tr>
        <tr>
            <td class="center">productId</td>
            <td class="center">integer</td>
            <td class="left">해당 상품에 대한 ID 이다.</td>
        </tr>
        <tr>
            <td class="center">productType</td>
            <td class="center">integer</td>
            <td class="left">
                상품군 정보를 일반상품, 중고상품, 단종상품, 판매예정상품으로 구분한다. 상품군의 종류는 다음과 같다.
                <table border="1" class="tbl_h">
                    <caption><span class="blind">상품군 종류 설명 표</span></caption>
                    <colgroup>
                        <col style="width:30%">
                        <col style="width:40%">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">상품군</th>
                        <th scope="col">상품 종류</th>
                        <th scope="col">타입</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td rowspan="3" class="left">일반상품</td>
                        <td class="left">가격비교 상품</td>
                        <td class="left">1</td>
                    </tr>
                    <tr>
                        <td class="left">가격비교 비매칭 일반상품</td>
                        <td class="left">2</td>
                    </tr>
                    <tr>
                        <td class="left">가격비교 매칭 일반상품</td>
                        <td class="left">3</td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="left">중고상품</td>
                        <td class="left">가격비교 상품</td>
                        <td class="left">4</td>
                    </tr>
                    <tr>
                        <td class="left">가격비교 비매칭 일반상품</td>
                        <td class="left">5</td>
                    </tr>
                    <tr>
                        <td class="left">가격비교 매칭 일반상품</td>
                        <td class="left">6</td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="left">단종상품</td>
                        <td class="left">가격비교 상품</td>
                        <td class="left">7</td>
                    </tr>
                    <tr>
                        <td class="left">가격비교 비매칭 일반상품</td>
                        <td class="left">8</td>
                    </tr>
                    <tr>
                        <td class="left">가격비교 매칭 일반상품</td>
                        <td class="left">9</td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="left">판매예정상품</td>
                        <td class="left">가격비교 상품</td>
                        <td class="left">10</td>
                    </tr>
                    <tr>
                        <td class="left">가격비교 비매칭 일반상품</td>
                        <td class="left">11</td>
                    </tr>
                    <tr>
                        <td class="left">가격비교 매칭 일반상품</td>
                        <td class="left">12</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td class="center">maker</td>
            <td class="center">string</td>
            <td class="left">해당 상품의 제조사 명이다.</td>
        </tr>
        <tr>
            <td class="center">brand</td>
            <td class="center">string</td>
            <td class="left">해당 상품의 브랜드 명이다.</td>
        </tr>
        <tr>
            <td class="center">category1</td>
            <td class="center">string</td>
            <td class="left"> 해당 상품의 카테고리, 대분류이다.</td>
        </tr>
        <tr>
            <td class="center">category2</td>
            <td class="center">string</td>
            <td class="left"> 해당 상품의 카테고리, 중분류이다.</td>
        </tr>
        <tr>
            <td class="center">category3</td>
            <td class="center">string</td>
            <td class="left"> 해당 상품의 카테고리, 소분류이다.</td>
        </tr>
        <tr>
            <td class="center">category4</td>
            <td class="center">string</td>
            <td class="left"> 해당 상품의 카테고리, 세분류이다.</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">5. 에러 코드 </h3>
    <div class="p_desc"> 공통 에러 코드는 <a href="https://developers.naver.com/docs/common/openapiguide/errorcode.md" class="color_p2 underline">여기</a>를 참조하세요.</div>
    <table border="1" class="tbl_h">
        <caption><span class="blind">에러 코드 설명 표</span></caption>
        <colgroup>
            <col style="width:10%">
            <col style="width:10%">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">HTTP 코드</th>
            <th scope="col">에러 코드</th>
            <th scope="col">에러 메시지</th>
            <th scope="col">조치 방안</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center color_p3">400</td>
            <td class="center">SE01</td>
            <td class="left">Incorrect query request (잘못된 쿼리요청입니다.)</td>
            <td class="left">검색 API 요청에 오류가 있습니다. 요청 URL, 필수 요청 변수가 정확한지 확인 바랍니다.</td>
        </tr>
        <tr>
            <td class="center color_p3">400</td>
            <td class="center">SE02</td>
            <td class="left">Invalid display value (부적절한 display 값입니다.)</td>
            <td class="left">display 요청 변수값이 허용 범위(1~100)인지 확인해 보세요.</td>
        </tr>
        <tr>
            <td class="center color_p3">400</td>
            <td class="center">SE03</td>
            <td class="left">Invalid start value (부적절한 start 값입니다.)</td>
            <td class="left">start 요청 변수값이 허용 범위(1~1000)인지 확인해 보세요.</td>
        </tr>
        <tr>
            <td class="center color_p3">400</td>
            <td class="center">SE04</td>
            <td class="left">Invalid sort value (부적절한 sort 값입니다.)</td>
            <td class="left">sort 요청 변수 값에 오타가 없는지 확인해 보세요.</td>
        </tr>
        <tr>
            <td class="center color_p3">400</td>
            <td class="center">SE06</td>
            <td class="left">Malformed encoding (잘못된 형식의 인코딩입니다.)</td>
            <td class="left">검색어를 UTF-8로 인코딩하세요.</td>
        </tr>
        <tr>
            <td class="center color_p3">404</td>
            <td class="center">SE05</td>
            <td class="left">Invalid search api (존재하지 않는 검색 api 입니다.)</td>
            <td class="left">검색 API 대상에 오타가 없는지 확인해 보세요.</td>
        </tr>
        <tr>
            <td class="center color_p3">500</td>
            <td class="center">SE99</td>
            <td class="left">System Error (시스템 에러)</td>
            <td class="left">서버 내부 에러가 발생하였습니다. 포럼에 올려주시면 신속히 조치하겠습니다.</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">6. 예시</h3>
    <h4 class="h_subsub">호출</h4>
    <div class="code_area">
<pre class="prettyprint">
curl "https://openapi.naver.com/v1/search/shop.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&sort=sim" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}" -v
</pre>
    </div>
    <h4 class="h_subsub">요청</h4>
    <div class="code_area">
<pre class="prettyprint">
> GET /v1/search/shop.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&sort=sim HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}
</pre>
    </div>
    <h4 class="h_subsub">응답</h4>
    <div class="code_area">
<pre class="prettyprint">
< HTTP/1.1 200 OK
< Server: nginx
< Date: Mon, 26 Sep 2016 09:04:44 GMT
< Content-Type: text/xml;charset=utf-8
< Transfer-Encoding: chunked
< Connection: keep-alive
< Keep-Alive: timeout=5
< Vary: Accept-Encoding
< X-Powered-By: Naver
< Cache-Control: no-cache, no-store, must-revalidate
< Pragma: no-cache
<
&lt;rss version=&quot;2.0&quot;&gt;
    &lt;channel&gt;
        &lt;title&gt;Naver Open API - shop ::'&#xac00;&#xbc29;'&lt;/title&gt;
        &lt;link&gt;http://search.naver.com&lt;/link&gt;
        &lt;description&gt;Naver Search Result&lt;/description&gt;
        &lt;lastBuildDate&gt;Tue, 04 Oct 2016 13:23:58 +0900&lt;/lastBuildDate&gt;
        &lt;total&gt;17161390&lt;/total&gt;
        &lt;start&gt;1&lt;/start&gt;
        &lt;display&gt;10&lt;/display&gt;
        &lt;item&gt;
            &lt;title&gt;&#xd5c8;&#xb2c8;&#xd2b8;&#xb9bd; &#xbcf4;&#xc2a4;&#xd134;&#xbc31;&lt;/title&gt;
            &lt;link&gt;http://openapi.naver.com/l?AAABWLsQ7CIBRFv+Z1JLzSShkYqLajRmPcG6TQRCgiNunfizdnODnJfX9N2iUMCnoKHYWh/4sSlUtmli7nCExBPRY+bo1xCZaEaTOJ6NWXaKdsSHAB2Lg8gZ2QMmybA0cuqiyx4W0ZZR2KrvJyx2CPV3RQ95fbnDT3r+Fh2kbfz5su7x8wIs7ZjgAAAA==&lt;/link&gt;
            &lt;image&gt;http://shopping.phinf.naver.net/main_1031546/10315467179.jpg&lt;/image&gt;
            &lt;lprice&gt;6700&lt;/lprice&gt;
            &lt;hprice&gt;0&lt;/hprice&gt;
            &lt;mallName&gt;&#xd5c8;&#xb2c8;&#xd2b8;&#xb9bd;&lt;/mallName&gt;
            &lt;productId&gt;10315467179&lt;/productId&gt;
            &lt;productType&gt;2&lt;/productType&gt;
            &lt;brand&gt;&lt;/brand&gt;
            &lt;maker&gt;허니트립&lt;/maker&gt;
            &lt;category1&gt;패션잡화&lt;/category1&gt;
            &lt;category2&gt;여행용가방/소품&lt;/category2&gt;
            &lt;category3&gt;보스턴백&lt;/category3&gt;
            &lt;category4>&lt;/category4&gt;
        &lt;/item&gt;
        ...
    &lt;/channel&gt;
&lt;/rss&gt;
</pre>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>
</body>
</html>
