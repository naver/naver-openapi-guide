<html lang="ko">
<head>
    <title>NAVER Developers - 검색 API 백과사전 검색 개발가이드</title>
    <meta name="description" content="NAVER Developers - 검색 API 백과사전 검색 개발가이드">
</head>
<body>
<div class="con">
    <div class="h_page_area">
        <h2 class="h_page">검색 &gt; 백과 사전</h2>
    </div>
    <p class="p_desc">
        네이버 백과사전 검색 결과를 출력해주는 REST API입니다. 비로그인 오픈 API이므로 GET으로 호출할 때 HTTP Header에 애플리케이션 등록 시 발급받은 <a href="https://developers.naver.com/docs/common/apicall" class="color_p2 underline">Client ID와 Client Secret 값을 같이 전송</a>해 주시면 활용 가능합니다.
        백과사전 검색 대상은 다음과 같습니다.<br>
        : 두산백과 doopedia, 네이버 백과사전, 네이버 테마백과, 네이버캐스트, 위키백과, 향토문화대전, 한국역대인물종합정보, 자연도감식물정보, 자연도감동물정보, 음식재료정보, 용어사전
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
            <td class="left">https://openapi.naver.com/v1/search/encyc.xml</td>
            <td class="center">XML</td>
        </tr>
        <tr>
            <td class="center">GET</td>
            <td class="center">-</td>
            <td class="left">https://openapi.naver.com/v1/search/encyc.json</td>
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
        </tbody>
    </table>
    <h3 class="h_sub">4. 출력 결과</h3>
    <table border="1" class="tbl_h">
        <caption><span class="blind">출력 결과 설명 표</span></caption>
        <colgroup>
            <col>
            <col>
            <col style="width:50%">
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
            <td class="left">검색 결과를 포함하는 컨테이너이다. 이 안에 있는 title link, description 등의 항목은 참고용으로 무시해도 무방하다.</td>
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
            <td class="left">XML 포멧에서는 item 태그로, JSON 포멧에서는 items 속성으로 표현된다. 개별 검색 결과이며 title, link, description, thumbnail을 포함한다.</td>
        </tr>
        <tr>
            <td class="center">title</td>
            <td class="center">string</td>
            <td class="left">검색 결과 사전 정의의 제목을 나타낸다.</td>
        </tr>
        <tr>
            <td class="center">link</td>
            <td class="center">string</td>
            <td class="left">사전 정의 정보 및 추가 정보를 볼 수 있는 link를 제공한다. link값은 두산 백과사전 사이트의 해당 페이지로 연결된다.</td>
        </tr>
        <tr>
            <td class="center">description</td>
            <td class="center">string</td>
            <td class="left">검색 결과 문서의 내용을 요약한 패시지 정보이다. 문서 전체의 내용은 link를 따라가면 읽을 수 있다. 패시지에서 검색어와 일치하는 부분은 <strong>태그로
                감싸져 있다.</strong></td>
        </tr>
        <tr>
            <td class="center">thumbnail</td>
            <td class="center">string</td>
            <td class="left">검색 결과에 이미지가 포함된 경우, 해당 이미지의 썸네일 link url을 나타낸다.</td>
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
curl "https://openapi.naver.com/v1/search/encyc.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&sort=sim" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}" -v
</pre>
    </div>
    <h4 class="h_subsub">요청</h4>
    <div class="code_area">
<pre class="prettyprint">
> GET /v1/search/encyc.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&sort=sim HTTP/1.1
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
< Date: Mon, 26 Sep 2016 01:50:00 GMT
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
        &lt;title&gt;Naver Open API - encyc ::'&#xc8fc;&#xc2dd;'&lt;/title&gt;
        &lt;link&gt;http://search.naver.com&lt;/link&gt;
        &lt;description&gt;Naver Search Result&lt;/description&gt;
        &lt;lastBuildDate&gt;Mon, 26 Sep 2016 10:50:00 +0900&lt;/lastBuildDate&gt;
        &lt;total&gt;28034&lt;/total&gt;
        &lt;start&gt;1&lt;/start&gt;
        &lt;display&gt;10&lt;/display&gt;
        &lt;item&gt;
            &lt;title&gt;&lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt;&lt;/title&gt;
            &lt;link&gt;http://openapi.naver.com/l?AAAB2NPQ+CMBiEf83LSPrxAu3QAQoYYhwZdCNQRSMFaiXh31tMbrjncpdbv8btCioNOYdCH0YUIMtodOauRu8X4DmwOsgbN31i223Gxf08hcRY7/bYjhZ4Pcx9MwAvKUUmmQCW9s+DkUhkB3XePGa3/0ucCk4iryhmKBJMCcFERpPSTXVdX1ty0XijnCzh45zRdcnb07sNux+iWggwrgAAAA==&lt;/link&gt;
            &lt;description&gt; &lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt;&#xd68c;&#xc0ac;&#xc758; &#xc790;&#xbcf8;&#xc744; &#xc774;&#xb8e8;&#xb294; &#xb2e8;&#xc704;&#xb85c;&#xc11c;&#xc758; &#xae08;&#xc561; &#xbc0f; &#xc774;&#xb97c; &#xc804;&#xc81c;&#xb85c; &#xd55c; &#xc8fc;&#xc8fc;&#xc758; &#xad8c;&#xb9ac;&#x00b7;&#xc758;&#xbb34;(&#xc8fc;&#xc8fc;&#xad8c;).  &lt;b&gt;&#xc8fc;&#xc2dd;&lt;/b&gt;&#xd68c;&#xc0ac;&#xb294; &#xc790;&#xbcf8;&#xb2e8;&#xccb4;&#xc774;&#xbbc0;&#xb85c; &#xc790;&#xbcf8;&#xc774; &#xc5c6;&#xc774;&#xb294; &#xc131;&#xb9bd;&#xd560; &#xc218; &#xc5c6;&#xb2e4;. &#xc790;&#xbcf8;&#xc740; &#xc0ac;&#xc6d0;&#xc778; &#xc8fc;&#xc8fc;(&#x682a;&#x4e3b;)&#xc758; &#xcd9c;&#xc790;&#xc774;&#xba70;, &#xad8c;&#xb9ac;&#xc640; &#xc758;&#xbb34;&#xc758;... &lt;/description&gt;
            &lt;thumbnail /&gt;
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