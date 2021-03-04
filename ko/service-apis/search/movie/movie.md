# 영화

<html lang="ko">
<head>
    <title>NAVER Developers - 검색 API 영화 검색 개발가이드</title>
    <meta name="description" content="NAVER Developers - 검색 API 영화 검색 개발가이드">
</head>
<body>
<div class="con">
    <div class="h_page_area">
        <h2 class="h_page">검색 &gt; 영화</h2>
    </div>
    <p class="p_desc">
        네이버 영화 검색 결과를 출력해주는 REST API입니다. 비로그인 오픈 API이므로 GET으로 호출할 때 HTTP Header에 애플리케이션 등록 시 발급받은 <a href="https://developers.naver.com/docs/common/apicall" class="color_p2 underline ">Client ID와 Client Secret 값을 같이 전송</a>해 주시면 활용 가능합니다.
    </p>
    <div class="buttons2">
        <a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?defaultScope=search">오픈 API 이용 신청 &gt;</a>
    </div>
    <h3 class="h_sub">1. 준비사항</h3>
    <ul class="list_type1">
        <li>애플리케이션 등록: 네이버 오픈 API로 개발하시려면 먼저 <a href="https://developers.naver.com/apps/#/register?defaultScope=search" class="color_p2 underline">'Application-애플리케이션등록'</a> 메뉴에서 애플리케이션을 등록하셔야 합니다. <br>
            <a href="/docs/common/register" class="color_p2 underline">[자세한 방법 보기] &gt;</a></li>
        <li>클라이언트 ID와 secret 확인: <a href="/appinfo" class="color_p2 underline">'내 애플리케이션'</a>에서 등록한 애플리케이션을 선택하면 ClientID와 Client Secret 값을 확인할 수 있습니다.</li>
        <li>API 권한 설정: <a href="/appinfo" class="color_p2 underline">'내 애플리케이션'</a>의 'API 권한관리' 탭에서 사용하려는 API가 체크되어 있는지 확인합니다. 체크되어 있지 않을 경우 403 에러(API 권한 없음)가 발생하니 주의하시기 바랍니다.</li>
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
            <td class="left">https://openapi.naver.com/v1/search/movie.xml</td>
            <td class="center">XML</td>
        </tr>
        <tr>
            <td class="center">GET</td>
            <td class="center">-</td>
            <td class="left">https://openapi.naver.com/v1/search/movie.json</td>
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
            <td class="center">string (필수)</td>
            <td class="center">Y</td>
            <td class="center">-</td>
            <td class="left">검색을 원하는 질의. UTF-8 인코딩이다.</td>
        </tr>
        <tr>
            <td class="center">display</td>
            <td class="center">integer</td>
            <td class="center">N</td>
            <td class="center">기본값 10, 최대 100</td>
            <td class="left">검색 결과 출력 건수를 지정한다. 최대 100까지 가능하다.</td>
        </tr>
        <tr>
            <td class="center">start</td>
            <td class="center">integer</td>
            <td class="center">N</td>
            <td class="center">기본값 1, 최대 1000</td>
            <td class="left">검색의 시작 위치를 지정할 수 있다. 최대 1000까지 가능하다.</td>
        </tr>
        <tr>
            <td class="center">genre</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">-</td>
            <td class="left">검색을 원하는 장르 코드를 의미한다. 영화 코드는 다음과 같다.<br>1: 드라마 2: 판타지<br>3: 서부 4: 공포<br>5: 로맨스 6:
                모험<br>7: 스릴러 8: 느와르<br>9: 컬트 10: 다큐멘터리<br>11: 코미디 12: 가족<br>13: 미스터리 14: 전쟁<br>15: 애니메이션 16:
                범죄<br>17: 뮤지컬 18: SF<br>19: 액션20: 무협<br>21: 에로 22: 서스펜스<br>23: 서사 24: 블랙코미디<br>25: 실험 26: 영화카툰<br>27: 영화음악 28: 영화패러디포스터
            </td>
        </tr>
        <tr>
            <td class="center">country</td>
            <td class="center">string</td>
            <td class="center">N</td>
            <td class="center">-</td>
            <td class="left">검색을 원하는 국가 코드를 의미한다. 국가코드는 대문자만 사용 가능하며,<br>분류는 다음과 같다.<br>한국 (KR), 일본 (JP), 미국 (US), 홍콩
                (HK),<br>영국 (GB), 프랑스 (FR), 기타 (ETC)
            </td>
        </tr>
        <tr>
            <td class="center">yearfrom</td>
            <td class="center">integer(ex : 2000)</td>
            <td class="center">N</td>
            <td class="center">-</td>
            <td class="left">검색을 원하는 영화의 제작년도(최소)를 의미한다.<br>yearfrom은 yearto와 함께 사용되어야 한다.</td>
        </tr>
        <tr>
            <td class="center">yearto</td>
            <td class="center">integer(ex : 2008)</td>
            <td class="center">N</td>
            <td class="center">-</td>
            <td class="left">검색을 원하는 영화의 제작년도(최대)를 의미한다.<br>yearto는 yearfrom과 함께 사용되어야 한다.</td>
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
            <td class="left">검색 결과를 포함하는 컨테이너이다. 이 안에 있는 title, link, description 등의 항목은 참고용으로 무시해도 무방하다.</td>
        </tr>
        <tr>
            <td class="center">lastBuildDate</td>
            <td class="center">datetime</td>
            <td class="left">검색 결과를 생성한 시간이다.</td>
        </tr>
        <tr>
            <td class="center">item/items</td>
            <td class="center">-</td>
            <td class="left">XML 포멧에서는 item 태그로, JSON 포멧에서는 items 속성으로 표현된다. 개별 검색 결과이며 title, link, image, subtitle, pubDate, director, actor, userRating을 포함한다.</td>
        </tr>
        <tr>
            <td class="center">title</td>
            <td class="center">string</td>
            <td class="left">검색 결과 영화의 제목을 나타낸다. 제목에서 검색어와 일치하는 부분은 태그로 감싸져 있다.</td>
        </tr>
        <tr>
            <td class="center">link</td>
            <td class="center">string</td>
            <td class="left">검색 결과 영화의 하이퍼텍스트 link를 나타낸다.</td>
        </tr>
        <tr>
            <td class="center">image</td>
            <td class="center">string</td>
            <td class="left">검색 결과 영화의 썸네일 이미지의 URL이다. 이미지가 있는 경우만 나타난다.</td>
        </tr>
        <tr>
            <td class="center">subtitle</td>
            <td class="center">string</td>
            <td class="left">검색 결과 영화의 영문 제목이다.</td>
        </tr>
        <tr>
            <td class="center">pubDate</td>
            <td class="center">date</td>
            <td class="left">검색 결과 영화의 제작년도이다.</td>
        </tr>
        <tr>
            <td class="center">director</td>
            <td class="center">string</td>
            <td class="left">검색 결과 영화의 감독이다.</td>
        </tr>
        <tr>
            <td class="center">actor</td>
            <td class="center">string</td>
            <td class="left">검색 결과 영화의 출연 배우이다.</td>
        </tr>
        <tr>
            <td class="center">userRating</td>
            <td class="center">integer</td>
            <td class="left">검색 결과 영화에 대한 유저들의 평점이다.</td>
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
            <td class="left">Incorrect query request (잘못된 쿼리 요청입니다.)</td>
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
            <td class="left">sort 요청 변수값에 오타가 없는지 확인해 보세요.</td>
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
curl "https://openapi.naver.com/v1/search/movie.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&genre=1" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 client id 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 client secret 값}" -v
</pre>
    </div>
    <h4 class="h_subsub">요청</h4>
    <div class="code_area">
<pre class="prettyprint">
> GET /v1/search/movie.xml?query=%EC%A3%BC%EC%8B%9D&display=10&start=1&genre=1 HTTP/1.1
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
&lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;
&lt;rss version=&quot;2.0&quot;&gt;
    &lt;channel&gt;
        &lt;title&gt;Naver Open API - movie ::'&#xc8fc;&#xc2dd;'&lt;/title&gt;
        &lt;link&gt;http://search.naver.com&lt;/link&gt;
        &lt;description&gt;Naver Search Result&lt;/description&gt;
        &lt;lastBuildDate&gt;Wed, 28 Sep 2016 16:40:17 +0900&lt;/lastBuildDate&gt;
        &lt;total&gt;2&lt;/total&gt;
        &lt;start&gt;1&lt;/start&gt;
        &lt;display&gt;2&lt;/display&gt;
        &lt;item&gt;
            &lt;title&gt;&#xc8fc;&#xb9c8;&#xb4f1;&amp;lt;b&amp;gt;&#xc8fc;&#xc2dd;&amp;lt;/b&amp;gt;&#xd68c;&#xc0ac;&lt;/title&gt;
            &lt;link&gt;http://openapi.naver.com/l?AAADWLQQvCIBzFP83f48h0zh08uK1B0S2IOm7mUEIts0F9+vQQPN77vQfv+dbxI2DXgyTQ9QV4B+2ATNSLMCk9gEjYjlkurFZXflp1rFRw/yXnbEspNk8vqypvPJBRhZsGMrSMY4ySwLSpN5RT3NSYIScO5nxhdzc18cjq0958w8LneKUy8fz6AdRxjD6YAAAA&lt;/link&gt;&lt;image&gt;http://imgmovie.naver.com/mdi/mit110/0968/96811_P01_142155.jpg&lt;/image&gt;
            &lt;subtitle&gt;&#x8d70;&#x99ac;&amp;amp;amp;#28783;&#x682a;&#x5f0f;&amp;amp;amp;#20250;&#x793e;&lt;/subtitle&gt;
            &lt;pubDate&gt;2012&lt;/pubDate&gt;
            &lt;director&gt;&#xbbf8;&#xd0a4; &#xcf54;&#xc774;&#xce58;&#xb85c;|&lt;/director&gt;
            &lt;actor&gt;&#xce74;&#xc2dc;&#xc774; &#xc720;&#xc6b0;|&#xcfe0;&#xbcf4;&#xd0c0; &#xb9c8;&#xc0ac;&#xd0c0;&#xce74;|&#xce74;&#xc9c0;&#xc640;&#xb77c; &#xd788;&#xce74;&#xb9ac;|&#xce58;&#xc694; &#xc1fc;&#xd0c0;|&#xc694;&#xcf54;&#xc57c;&#xb9c8; &#xba54;&#xad6c;&#xbbf8;|&#xce74;&#xc2dc;&#xc640;&#xbc14;&#xb77c; &#xc288;&#xc9c0;|&lt;/actor&gt;
            &lt;userRating&gt;4.50&lt;/userRating&gt;
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