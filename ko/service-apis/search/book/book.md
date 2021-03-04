# 책

<html lang="ko">
<head>
    <title>NAVER Developers - 검색 API 책 검색 개발가이드</title>
    <meta name="description" content="NAVER Developers - 검색 API 책 검색 개발가이드">
</head>
<body>
<div class="con">
    <div class="h_page_area">
        <h2 class="h_page">검색 &gt; 책</h2>
    </div>
    <p class="p_desc">
        네이버 책 검색 결과를 출력해주는 REST API입니다. 비로그인 오픈 API이므로 GET으로 호출할 때 HTTP Header에 애플리케이션 등록 시 발급받은 <a href="https://developers.naver.com/docs/common/apicall" class="color_p2 underline ">Client ID와 Client Secret 값을 같이 전송</a>해 주시면 활용 가능합니다.
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
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">메서드</th>
            <th scope="col">인증</th>
            <th scope="col">요청 URL</th>
            <th scope="col">출력 포맷</th>
            <th scope="col">설명</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">GET</td>
            <td class="center">-</td>
            <td class="left">https://openapi.naver.com/v1/search/book.xml</td>
            <td class="center">XML</td>
            <td class="center">책 기본 검색</td>
        </tr>
        <tr>
            <td class="center">GET</td>
            <td class="center">-</td>
            <td class="left">https://openapi.naver.com/v1/search/book_adv.xml</td>
            <td class="center">XML</td>
            <td class="center">책 상세 검색</td>
        </tr>
        <tr>
            <td class="center">GET</td>
            <td class="center">-</td>
            <td class="left">https://openapi.naver.com/v1/search/book.json</td>
            <td class="center"><em class="color_p3">JSON</em></td>
            <td class="center">책 기본 검색</td>
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
            <col style="width:30%">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">요청 변수명</th>
            <th scope="col">타입</th>
            <th scope="col">필수 여부</th>
            <th scope="col">기본값</th>
            <th scope="col">설명</th>
            <th scope="col">비고</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">query</td>
            <td class="center">string</td>
            <td class="center">-</td>
            <td class="center">-</td>
            <td class="left">검색을 원하는 문자열로서 UTF-8로 인코딩한다.</td>
            <td class="center">상세검색시 생략가능</td>
        </tr>
        <tr>
            <td class="center">display</td>
            <td class="center">integer</td>
            <td class="center">N</td>
            <td class="center">10(기본값), 100(최대)</td>
            <td class="left">검색 결과 출력 건수 지정</td>
            <td class="center">-</td>
        </tr>
        <tr>
            <td class="center">start</td>
            <td class="center">integer</td>
            <td class="center">N</td>
            <td class="center">1(기본값), 1000(최대)</td>
            <td class="left">검색 시작 위치로 최대 1000까지 가능</td>
            <td class="center">-</td>
        </tr>
        <tr>
            <td class="center">sort</td>
            <td class="center"> string</td>
            <td class="center">N</td>
            <td> sim(기본값), date</td>
            <td class="left">정렬 옵션: sim(유사도순), date(출간일순), count(판매량순)</td>
        </tr>
        <tr>
            <td class="center">d_titl</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">-</td>
            <td class="left">책 제목 검색</td>
            <td class="center">상세 검색만 해당</td>
        </tr>
        <tr>
            <td class="center">d_auth</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">-</td>
            <td class="left">저자명 검색</td>
            <td class="center">상세 검색만 해당</td>
        </tr>
        <tr>
            <td class="center">d_cont</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">-</td>
            <td class="left">목차 검색</td>
            <td class="center">상세 검색만 해당</td>
        </tr>
        <tr>
            <td class="center">d_isbn</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">-</td>
            <td class="left">isbn 검색</td>
            <td class="center">상세 검색만 해당</td>
        </tr>
        <tr>
            <td class="center">d_publ</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">-</td>
            <td class="left">출판사 검색</td>
            <td class="center">상세 검색만 해당</td>
        </tr>
        <tr>
            <td class="center">d_dafr</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">(ex.20000203)</td>
            <td class="left">출간 시작일</td>
            <td class="center">상세 검색만 해당</td>
        </tr>
        <tr>
            <td class="center">d_dato</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">(ex.20000203)</td>
            <td class="left">출간 종료일</td>
            <td class="center">상세 검색만 해당</td>
        </tr>
        <tr>
            <td class="center">d_catg</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">-</td>
            <td class="left">책 검색 카테고리(<a href="/inc/devcenter/downloads/categoryList.txt">카테고리 목록 다운로드</a>)</td>
            <td class="center">상세 검색만 해당</td>
        </tr>
        </tbody>
    </table>
    <p class="p_desc">상세 검색은 책 제목(d_titl), 저자명(d_auth), 목차(d_cont), ISBN(d_isbn), 출판사(d_publ) 5개 항목 중에서 1개 이상 값을 입력해야
        함.</p>
    <h3 class="h_sub">4. 출력 결과</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">출력 결과 설명 표</span></caption>
        <colgroup>
            <col style="width:25%">
            <col style="width:20%">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">요청 변수</th>
            <th scope="col">값</th>
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
            <td class="left">XML 포멧에서는 item 태그로, JSON 포멧에서는 items 속성으로 표현된다. 개별 검색 결과이며 title, link, description을 포함한다.</td>
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
            <td class="left">썸네일 이미지의 URL이다. 이미지가 있는 경우만 나타납난다.</td>
        </tr>
        <tr>
            <td class="center">author</td>
            <td class="center">string</td>
            <td class="left">저자 정보이다.</td>
        </tr>
        <tr>
            <td class="center">price</td>
            <td class="center">integer</td>
            <td class="left">정가 정보이다. 절판도서 등으로 가격이 없으면 나타나지 않는다.</td>
        </tr>
        <tr>
            <td class="center">discount</td>
            <td class="center">integer</td>
            <td class="left">할인 가격 정보이다. 절판도서 등으로 가격이 없으면 나타나지 않는다.</td>
        </tr>
        <tr>
            <td class="center">publisher</td>
            <td class="center">string</td>
            <td class="left">출판사 정보이다.</td>
        </tr>
        <tr>
            <td class="center">isbn</td>
            <td class="center">integer</td>
            <td class="left">ISBN 넘버이다.</td>
        </tr>
        <tr>
            <td class="center">description</td>
            <td class="center">string</td>
            <td class="left">검색 결과 문서의 내용을 요약한 패시지 정보이다. 문서 전체의 내용은 link를 따라가면 읽을 수 있다. 패시지에서 검색어와 일치하는 부분은 <strong>태그로
                감싸져 있다.</strong></td>
        </tr>
        <tr>
            <td class="center">pubdate</td>
            <td class="center">datetime</td>
            <td class="left">출간일 정보이다.</td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">5. 에러 코드 </h3>
    <div class="p_desc"> 공통 에러 코드는 <a href="/docs/common/common_error" class="color_p2 underline">여기</a>를 참조하세요.</div>
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
    <h3 class="h_sub">6. 예시 </h3>
    <h4 class="h_subsub">호출</h4>
    <div class="code_area">
<pre class="prettyprint">
curl "https://openapi.naver.com/v1/search/book.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}" -v
</pre>
    </div>
    <h4 class="h_subsub">요청</h4>
    <div class="code_area">
<pre class="prettyprint">
> GET /v1/search/book.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1 HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}
>
</pre>
    </div>
    <h4 class="h_subsub">응답</h4>
    <div class="code_area">
<pre class="prettyprint">
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
&lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;
&lt;rss version=&quot;2.0&quot;&gt;
    &lt;channel&gt;
        &lt;title&gt;Naver Open API - book ::'&#xc8fc;&#xc2dd;'&lt;/title&gt;
        &lt;link&gt;http://search.naver.com&lt;/link&gt;
        &lt;description&gt;Naver Search Result&lt;/description&gt;
        &lt;lastBuildDate&gt;Mon, 26 Sep 2016 10:40:35 +0900&lt;/lastBuildDate&gt;
        &lt;total&gt;20177&lt;/total&gt;&lt;start&gt;1&lt;/start&gt;&lt;display&gt;10&lt;/display&gt;
        &lt;item&gt;
            &lt;title&gt;&#xbd88;&#xacf0;&#xc758; &lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt;&#xd22c;&#xc790; &#xbd88;&#xd328;&#xacf5;&#xc2dd; (60&#xac1c; &#xb9e4;&#xb3c4;&#xc885;&#xbaa9; &#xd3c9;&#xade0; &#xc218;&#xc775;&#xb960; 62%)&lt;/title&gt;
            &lt;link&gt;http://openapi.naver.com/l?AAAC3LSwqDMBSF4dXcDCV6YxsHGfiog6JIV1A0SYloGpumQnffFIQz+DnwvT7afwVcaigRqvofvIKiIcbrhzAhbIAlZG3c5NySPMdd+0Q6exxqOuKudBjnNdlMFO00K8AmpRzZKackiJSdGc8ZxZzSglix3vqhG6KVKPcis0vXX+k+vqXM2BLpDzHjEYWYAAAA&lt;/link&gt;
            &lt;image&gt;http://bookthumb.phinf.naver.net/cover/108/346/10834650.jpg?type=m1&amp;udate=20160902&lt;/image&gt;
            &lt;author&gt;&#xbd88;&#xacf0; &#xbc15;&#xc120;&#xbaa9;&lt;/author&gt;
            &lt;price&gt;16000&lt;/price&gt;
            &lt;discount&gt;14400&lt;/discount&gt;
            &lt;publisher&gt;&#xbd80;&#xd0a4;&lt;/publisher&gt;
            &lt;pubdate&gt;20160729&lt;/pubdate&gt;
            &lt;isbn&gt;8960515523 9788960515529&lt;/isbn&gt;
            &lt;description&gt;&#xc798;&#xbabb;&#xb41c; &lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt;&#xd22c;&#xc790; &#xc2b5;&#xad00;&#xc744; &#xbc84;&#xb9ac;&#xace0;, &#xc808;&#xb300;&#xb85c; &#xc9c0;&#xc9c0; &#xc54a;&#xb294; &#xd22c;&#xc790;&#xbc95;&#xc744; &#xccb4;&#xb4dd;&#xd558;&#xb2e4;!&#xbd88;&#xacf0;&lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt;&#xc5f0;&#xad6c;&#xc18c; &#xb300;&#xd45c; &#x2018;&#xbd88;&#xacf0;&#x2019;&#xc774; &#xc54c;&#xb824; &#xc8fc;&#xb294; &#xc138;&#xc0c1;&#xc5d0;&#xc11c; &#xac00;&#xc7a5; &#xc26c;&#xc6b4; &#x2018;&lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt;&#xd22c;&#xc790; &#xbd88;&#xd328;&#xacf5;&#xc2dd;&#x2019; &#x300e;&#xbd88;&#xacf0;&#xc758; &lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt;&#xd22c;&#xc790; &#xbd88;&#xd328;&#xacf5;&#xc2dd;&#x300f;. &#xbd88;&#xacf0;&#xc740; &#xc804;&#xc5c5;&#xd22c;&#xc790;&#xc790;&#xac00; &#xc544;&#xb2c8;&#xb2e4;. &#xbd88;&#xacf0;&lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt;&#xc5f0;&#xad6c;&#xc18c;&#xb294; &#xd0dc;&#xd3c9;&#xc2a4;&#xb7fd;&#xac8c;&#xb3c4; &#xd55c; &#xb2ec;&#xc5d0; &#xd55c; &#xc885;&#xbaa9; &#xc815;&#xb3c4;&#xb9cc; &#xcd94;&#xcc9c;&#xd560; &#xb530;&#xb984;&#xc774;&#xb2e4;. &#xadf8;&#xb7fc;&#xc5d0;&#xb3c4;... &lt;/description&gt;&lt;/item&gt;&lt;item&gt;&lt;title&gt;&#xc5c4;&#xb9c8;, &lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt; &#xc0ac;&#xc8fc;&#xc138;&#xc694; (&#xc544;&#xc774;&#xc640; &#xc5c4;&#xb9c8;&#xc758; &#xbbf8;&#xb798;&#xb97c; &#xc704;&#xd55c; &#xd22c;&#xc790; &#xc6d0;&#xce59;)&lt;/title&gt;&lt;link&gt;http://openapi.naver.com/l?AAACssTS2qtFV1dVZ1NFZ1cgYxLJxULV3UMopS02wzSkoKVI0dVY3cgCgpPz9bLy+xLLVILzk/FyqQkgRlxKekliRm5ugVZAB1uCVlpqgauxgamJsZmZlZqpXYGpqYm1iYmhgYmxoYWKrl2oaYpnokpmR6mhX6G1mkhHsDzXOqAGJDU8+M8rRIoGYA29JYJ5oAAAA=&lt;/link&gt;&lt;image&gt;http://bookthumb.phinf.naver.net/cover/107/626/10762669.jpg?type=m1&amp;udate=20160802&lt;/image&gt;&lt;author&gt;&#xc874; &#xb9ac;&lt;/author&gt;&lt;price&gt;14000&lt;/price&gt;&lt;discount&gt;12600&lt;/discount&gt;&lt;publisher&gt;&#xd55c;&#xad6d;&#xacbd;&#xc81c;&#xc2e0;&#xbb38;&#xc0ac;&lt;/publisher&gt;&lt;pubdate&gt;20160627&lt;/pubdate&gt;&lt;isbn&gt;8947541184 9788947541183&lt;/isbn&gt;&lt;description&gt;&#xc5c4;&#xb9c8;&#xc758; &lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt; &#xd22c;&#xc790;&#xac00; &#xc544;&#xc774;&#xc758; &#xbbf8;&#xb798;&#xb2e4;!&#x300e;&#xc5c4;&#xb9c8;, &lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt; &#xc0ac;&#xc8fc;&#xc138;&#xc694;&#x300f;&#xb294; &#xc804;&#xc124;&#xc758; &#xd380;&#xb4dc; &#xd22c;&#xc790;&#xc790;, &#xcf54;&#xb9ac;&#xc544;&#xd380;&#xb4dc;&#xc758; &#xadc0;&#xc7ac;&#xb85c; &#xbd88;&#xb9ac;&#xba70; &#xc0c8;&#xb85c;&#xc6b4; &#xb9c8;&#xcf13; &#xb9ac;&#xb354;&#xb85c; &#xbd80;&#xc0c1;&#xd55c; &#xc874; &#xb9ac;&#xac00;... &#xc800;&#xc790;&#xb294; &#xc774; &#xcc45;&#xc744; &#xd1b5;&#xd574; &#xc790;&#xb140;&#xb97c; &#xc6d4;&#xae09;&#xc7c1;&#xc774;&#xac00; &#xc544;&#xb2cc; &#xc790;&#xbcf8;&#xac00;&#xb85c; &#xd0a4;&#xc6b8; &#xac83;&#xacfc;, &lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt;&#xd22c;&#xc790;&#xc5d0; &#xb300;&#xd55c; &#xc5c4;&#xb9c8;&#xb4e4;&#xc758; &#xd3b8;&#xacac;&#xc5d0; &#xb300;&#xd574; &#xc911;&#xc810;&#xc801;&#xc73c;&#xb85c; &#xc774;&#xc57c;&#xae30;&#xd55c;&#xb2e4;. &#xbd80;&#xb97c; &#xcd95;&#xc801;&#xd558;&#xae30; &#xc704;&#xd55c; &#xc790;&#xbcf8;&#xac00;... &lt;/description&gt;
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