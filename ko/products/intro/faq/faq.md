# FAQ

<html lang="ko">
<head>
    <title>NAVER Developers - FAQ</title>
</head>
<body>
<div class="con">
    <div id='tutorial1' class="faq_w">
        <h2>일반</h2>
        <dl>
            <dt>Q. 2016년 1월 26일 전에 기존 개발자센터에서 오픈 API 키를 발급받아 쓰는 사용자입니다. 기존 오픈 API는 언제까지 이용 가능한가요?</dt>
            <dd>기존 오픈 API키는 2016년 12월 26일까지만 사용할 수 있습니다. 그 이후에는 사용하실 수 없으며, 새로운 버전의 오픈 API로 호출방식을 변경하시면 서비스를 그대로 이용하실 수 있습니다. 새 호출 방식으로 API가 변경되는 서비스 대상은 지도, 검색, 단축 URL, 카페 API에만 해당되며, 네이버 아이디로 로그인 API는 그대로 사용하실 수 있습니다.</dd>
            <dt>Q. API 호출 방식이 2016년 1월 26일 이후로 어떻게 달라졌나요?</dt>
            <dd>
                기존 개발자센터에서는 API 키를 발급받아서 사용했지만, 이제는 애플리케이션을 등록한 다음 클라이언트 아이디와 시크릿값을 발급받고, 애플리케이션 설정 화면에서 API 권한을 설정하여 사용하시면 됩니다.<br>
                <ul>
                    <li>1) 애플리케이션 등록 가이드: <a target="_blank" href="https://developers.naver.com/docs/common/register">https://developers.naver.com/docs/common/register</a></li>
                    <li>2) API 권한 설정 및 API 호출 가이드: <a target="_blank" href="https://developers.naver.com/docs/common/apicall">https://developers.naver.com/docs/common/apicall</a></li>
                </ul>
            </dd>
            <dt>Q. 오픈 API를 이용하려고 하는데, 오픈 API 키 발급이 안되는데 어떻게 된 건가요?</dt>
            <dd>2016년 1월 26일 부터 오픈 API 키는 발급되지 않습니다. 대신 오픈 API를 이용하려면 애플리케이션을 등록한 다음 API 권한 설정을 하셔야 합니다.</dd>
            <dt>Q. 애플리케이션 등록은 어디서 하나요?</dt>
            <dd>
                <ul>
                    <li>1) 애플리케이션 등록: 메뉴에서 [개발자센터]-[Application]-[애플리케이션등록]을 클릭<br>
                        (바로가기: <a target="_blank" href="https://developers.naver.com/apps/#/register">https://developers.naver.com/register</a>)</li>
                    <li>2) 가이드: <a target="_blank" href="https://developers.naver.com/docs/common/register">https://developers.naver.com/docs/common/register</a></li>
                </ul>
            </dd>
            <dt>Q. 기존에 발급받은 오픈 API 키들은 어디서 확인할 수 있나요?</dt>
            <dd><a target="_blank" href="https://developers.naver.com/openapi">https://developers.naver.com/openapi</a> 에서 확인할 수 있습니다. 2016년 1월 26일부터 API 키는 더 이상 발급받으실 수 없습니다.</dd>
            <dt>Q. 기존의 오픈 API 가이드는 어디서 볼 수 있나요?</dt>
            <dd>아래 경로에서 보실 수 있으며, 2016년 말까지만 유지합니다.<br>
                <a target="_blank" href="https://developer.naver.com/wiki/pages/OpenAPI">https://developer.naver.com/wiki/pages/OpenAPI</a></dd>
            <dt>Q 어떤 API들을 제공하고 있습니까?</dt>
            <dd>네이버 오픈 API 목록을 참고하시기 바랍니다. <a target="_blank" href="https://developers.naver.com/docs/common/apilist">https://developers.naver.com/docs/common/apilist</a></dd>
            <dt>Q API를 처음 사용합니다. 어떻게 이용하면 되나요?</dt>
            <dd>
                아래와 같은 단계로 API를 이용하시면 됩니다.<br>
                <ul>
                    <li>1) 애플리케이션 등록 (가이드 <a target="_blank" href="https://developers.naver.com/docs/common/register">https://developers.naver.com/docs/common/register</a>)</li>
                    <li>2) 애플리케이션 설정 (가이드 <a target="_blank" href="https://developers.naver.com/docs/common/appconf">https://developers.naver.com/docs/common/appconf</a>)</li>
                    <li>3) API 권한 설정 및 호출 (가이드 <a target="_blank" href="https://developers.naver.com/docs/common/apicall">https://developers.naver.com/docs/common/apicall</a>)</li>
                    <li>4) 에러 코드 확인 (가이드 <a target="_blank" href="https://developers.naver.com/docs/common/common_error">https://developers.naver.com/docs/common/common_error</a>)</li>
                    <li>5) API 용어 정리 (가이드 <a target="_blank" href="https://developers.naver.com/docs/common/terms">https://developers.naver.com/docs/common/terms</a>)</li>
                </ul>
            </dd>
            <dt>Q API는 비용을 지불하나요?</dt>
            <dd>네이버의 오픈 API는 약관에 따라 무료로 제공되고 있습니다.<br>
                제휴가 필요한 경우 심사를 통하여 제휴를 체결하여 드리고 있으며, 제휴를 통한 오픈 API 사용 또한 무료로 이용이 가능합니다.
            </dd>
            <dt>Q API가이드에는 어떤 것들이 있나요?</dt>
            <dd>
                <ul>
                    <li>1) 쿼리 제한이 있습니다. 서비스별로 발급 키(key) 당 쿼리 제한이 있으며, 이를 초과할 경우 서비스가 중지됩니다.<br><br></li>
                    <li>2) NAVER의 상표를 사용할 경우, <a href="/intro/brand_guide/brand_guide.md">상표사용 가이드</a>를 지켜야 합니다.<br>
                        상표 사용 가이드 내 기본 가이드 및 오픈 API 특례를 모두 준수하면 사전 허락을 받지 않아도 NAVER의 상표를 사용할 수 있습니다.<br>
                        NAVER <a href="/intro/brand_guide/brand_guide.md">상표사용 가이드</a>에 대한 문의사항이 있거나 실제 상표 사용 가능 여부에 대한 명확한 승인이 필요한 경우,<br>
                        <a href="http://www.naver.com/rules/nhnBrandRequest.doc">상표 사용 허락 요청서</a>에 구체적인 사항을 기재하여 NAVER에 제출해주시기 바랍니다.<br><br></li>
                    <li>3) 네이버 오픈 API를 사용하고 있음을 나타내 주셔야 합니다.<br>
                        애플리케이션이 네이버 오픈 API에 의거해 개발한 프로그램이나 서비스라는 것을 링크나, 네이버 로고를 통해 나타내 주셔야 합니다.<br>
                        로고 사용은 <a href="/intro/bi_guide/bi_guide.md">BI 가이드</a>을 참조하세요.</li>
                </ul>
            </dd>
            <dt>Q API가 작동하지 않아요!</dt>
            <dd>
                API가 작동하지 않을 때는 오타로 인해 API 호출 URL이 잘못되었거나 필수 요청 변수가 잘못된 경우가 많습니다. 오타가 없는지, 요청 변수가 빠진 게 아닌지 한 번 더 확인해주시고, 그래도 에러라고 생각이 되면 아래 에러 코드 목록을 보시고 그에 맞는 조치를 하시면 되겠습니다.<br>
                <a target="_blank" href="https://developers.naver.com/docs/common/common_error">https://developers.naver.com/docs/common/common_error</a>
            </dd>
            <dt>Q 그래도 API가 작동하지 않아요!</dt>
            <dd>포럼에 글을 올려주시면 담당자가 확인해보고 조치하겠습니다. 포럼에 글을 올리기 전에 검색하고 올려주시는 센스 환영합니다.<br>
                <a target="_blank" href="https://developers.naver.com/forum/list">https://forum.developers.naver.com</a></dd>
            <dt>Q 제휴 신청은 어떻게 진행해야 하나요?</dt>
            <dd>
                제휴 신청은 아래 경로에서 올려주시면 되며 회원수나 사용 규모로 볼 때 사용량이 초과가 예상되거나 실제로 초과하였을 경우에만
                네이버 오픈 API 제휴 신청을 이용해 주시길 바랍니다..<br>
                <a target="_blank" href="https://developers.naver.com/openapi/cooperation">https://developers.naver.com/openapi/cooperation</a>
            </dd>
            <dt>Q Syndication API를 적용했는데 상태가 변경되지 않아요.</dt>
            <dd>
                Syndication API는 연동 후 일정 기간이 지나야 네이버와의 연동이 완료 됩니다.<br>
                만약 1주일 이상 연동이 되지 않는다면 네이버 고객센터를 통하여 문의를 부탁드립니다.<br>
                추가적으로 Syndication API의 연동 상태는 오픈 API에서 처리하여 드리기 어려운 점 양해 부탁드립니다.<br>
                고객 센터 Syndication 문의 URL: <a target="_blank" href="https://help.naver.com/ops/step2/mail.nhn?catg=525">https://help.naver.com/ops/step2/mail.nhn?catg=525</a>
            </dd>
            <dt>Q 네이버 지도 API는 어떤 서비스입니까?</dt>
            <dd>
                네이버 지도 API는 여러분의 웹 사이트에 자바스크립트를 이용해서 네이버 지도를 표시할 수 있게 해 줍니다.<br>
                또한, 위치 표시 마커(marker)와 정보창을 통해 지도상의 원하는 위치에 원하는 정보를 표시할 수 있게 됩니다.<br>
                이용 예제를 보시려면 API 사용자 문서를 참고해 주세요.
            </dd>
            <dt>Q 네이버 지도 API를 사용하려면 어떤 것들이 필요합니까?</dt>
            <dd>
                네이버 오픈 API 서비스의 이용 등록을 통해 발급받은 클라이언트아이디(ClientID)가 필요합니다.<br>
                <a target="_blank" href="https://developers.naver.com/register?defaultScope=map">https://developers.naver.com/register?defaultScope=map</a><br>
                이용 등록을 위해서는 사용 가능한 네이버 ID를 가지고 있으셔야 하며, 네이버 오픈 API 서비스의 이용 약관에 동의를 하셔야 합니다.
            </dd>
            <dt>Q 지도 API를 통하지 않고 지도 이미지를 사용할 수 있습니까?</dt>
            <dd>사용할 수 없습니다. 지도 이미지는 반드시 지도 API를 통해서만 제공되는 형태로 웹 사이트에 사용할 수 있습니다.</dd>
            <dt>Q 오픈 API서버의 IP를 고정적으로 제공할 수 있습니까?</dt>
            <dd>오픈API 서버들의 IP는 내부 사정상 언제라도 바뀔 수 있으며 고정 IP로 제공할 수 없습니다.</dd>
            <dt>Q 지도 API의 쿼리 제한은 어떻게 됩니까?</dt>
            <dd>웹/모바일 모두 2016년 11월 1일부터 일 20만 요청까지 사용가능합니다. <br>
                회원수나 사용 규모로 볼 때 사용량이 20만 이상이 예상되거나 실제로 초과하였을 경우에만<br>
                네이버 오픈 API 제휴 신청을 이용해 주시길 바랍니다.<br>
            </dd>
            <dt>Q 주소를 좌표로 변경하려면 어떻게 해야 합니까?</dt>
            <dd>가능합니다. Geocode를 통하여 주소를 네이버 지도의 좌표로 변환하실 수 있습니다.<br>
                자세한 내용은 <a target="_blank" href="https://developers.naver.com/docs/map/overview">지도 API 명세</a>의 "3.2. 주소 -> 좌표 변환 API (geocode API)" 부분을 확인하시기 바립니다.</dd>
        </dl>
    </div>
    <div id='tutorial2' class="faq_w">
        <!--<h3 class="h_sub">네이버 아이디로 로그인 서비스 관련</h3>-->
        <h2>네아로</h2>
        <dl>
            <dt>
            Q. 네이버아이디로로그인 서비스 이용과 관련하여 서비스 변경사항이나 공지사항은 어디서 확인 가능한가요?
            </dt>
            <dd>
            서비스 변경사항 및 공지사항은 네이버 개발자센터의 공지사항 게시판을 통해 확인이 가능합니다.<br/>
            네이버 개발자센터 공지사항 게시판 : <a href="https://developers.naver.com/notice">https://developers.naver.com/notice</a><br/>
            또는 개발자센터 공식 포럼의 게시글을 통해서도 관련 내용을 확인할 수 있습니다.<br/>
            네이버 개발자센터 공식 포럼 - 네이버 아이디로 로그인 카테고리 : <a href="http://forum.developers.naver.com/c/5-category">http://forum.developers.naver.com/c/5-category</a><br/>
            </dd>
            <dt>
            Q. 영문으로 된 서비스를 제공 중입니다. 네아로를 영문으로 적용하고 싶은데 영문으로 된 페이지를 제공하고 있나요?
            </dt>
            <dd>
            네아로는 사용자 브라우저의 Locale 설정을 기준으로 한글 페이지, 영문, 중문 페이지를 제공하고 있습니다.<br/>
            사용자 브라우저의 언어설정이 "한국어/대한민국(ko-KR)" 인 경우에는 한글페이지를 제공하고,
            "영어(en)은 영문 (en-US) 페이지를 중국어는 간체와 번체 두가지 버전으로 페이지를 제공합니다.
            </dd>
            <dt>
            Q. 파트너 개발사가 외국 회사입니다. 영문으로 된 개발가이드가 있나요?
            </dt>
            <dd>
            네아로는 영문 개발가이드를 별도로 제공하고 있습니다.<br/>
            <a href="mailto:dl_naverid@navercorp.com">dl_naverid@navercorp.com</a>로 관련사항을 문의주시면 영문 개발가이드를 별도로 전달드립니다.<br/>
            </dd>
            <dt>
            Q. 네아로에서 제공하는 개인정보는 어떠한 것들이 있나요?
            </dt>
            <dd>
            네아로 연동을 하게 되면 사용자의 다음 정보를 얻을 수 있습니다.<br/>
            - 기본 정보 : 별명, 프로필이미지, 성별, 생일, 연령대<br/>
            - 선택 정보 : 이름, 이메일
            </dd>
            <dt>
            Q. 네아로에서 제공하는 개인정보를 별도로 저장하고 사용해도 문제가 없나요?
            </dt>
            <dd>
            사용자가 네아로 연동 시 "개인정보제공동의"를 반드시 거쳐야지만 사용자 프로필을 얻을 수 있습니다.<br/>
            즉 사용자 프로필은 개인정보 제공동의를 수락한 사용자에 대해서만 조회가 가능하기 때문에
            별도로 저장하여 사용하여도 문제가 없습니다.<br/>
            단, 별도의 수집과 활용에 대한 동의를 별도로 사용자에게 받아야 합니다.
            </dd>
            <dt>
            Q. 네아로 사용자 프로필 조회를 통해 수집한 이메일로 사용자에게 메일을 발송해도 괜찮은가요?
            </dt>
            <dd>
            상품 결제에 따른 공지 메일 발송, 약관 개정 공지 메일 발송 등 광고성/마케팅용도가 아닌
            서비스 제공 혹은 계약이행을 위한 안내 메일은 사전 동의 없이 발송이 가능합니다.<br/>
            다만 광고성/마케팅/이벤트성 메일의 경우에는 사용자아게 사전 동의를 받은 후 발송이 가능합니다.
            </dd>
        <!--
        </dl>
        <h2 class="h_page">네이버 아이디로 로그인 서비스 관련</h3>
        <dl>
        -->
            <dt>
            Q. 우리 서비스에 네아로를 적용하려고 합니다. 적용에 필요한 절차나 가이드가 있나요?
            </dt>
            <dd>
            네아로 적용을 위해서는 "개발자센터"에 애플리케이션을 등록하는 절차가 필요합니다.<br/>
            개발자센터에 애플리케이션을 등록하는 절차는 다음의 가이드에 상세히 설명되어있습니다.<br/>
            <a href='https://developers.naver.com/docs/common/register'>https://developers.naver.com/docs/common/register</a><br/><br/>
            또한 다음의 가이드에 따라 개발을 진행하시면 됩니다.<br/>
            <a href="https://developers.naver.com/docs/login/overview/overview.md">https://developers.naver.com/docs/login/overview</a>
            </dd>
            <dt>
            Q. 안드로이드 (또는 아이폰) 앱에 네아로를 적용할 예정입니다.<br/>아직 앱스토어 앱등록을 하지 않아 "다운로드 URL"이 없는 상태인데 개발자 센터에 애플리케이션 등록이 가능한가요?
            </dt>
            <dd>
            모바일 앱을 마켓에 등록하기 전이라면 (아직 마켓의 URL이 발급되지 않은 상태라면) 마켓 다운로드 URL대신 귀사의 홈페이지 URL등으로 대체하여 입력이 가능합니다.<br/>
            다만 마켓 등록 이후에는 다운로드 URL로 변경을 해주셔야합니다.
            </dd>
            <dt>
            Q. 개발자 센터에 등록한 애플리케이션은 등록한 개인이 혼자 관리하게 되나요?
            </dt>
            <dd>
            애플리케이션을 등록하면 애플리케이션 등록자 본인 이외에 관리자 아이디 등록을 통하여 여러사람이 관리할수 있습니다.<br/>
            관리자 아이디 등록은 "개발자센터 > 내 애플리케이션 > 멤버관리 > 관리자 아이디 등록/관리" 메뉴를 통해서 등록 및 해제가 가능합니다.<br/>
            관리자 아이디로 등록된 사용자는 애플리케이션 등록정보 수정 및 권한 관리 / 통계 확인 등 모든 메뉴를 사용할 수 있습니다.
            </dd>
            <dt>
            Q. 개발자 센터에  10개이상의 애플리케이션을 등록하고 싶은 경우에는 어떻게 해야하나요?
            </dt>
            <dd>
            애플리케이션 등록은 네이버 계정 당 10개로 제한이 되어있습니다.<br/>
            더 많은 애플리케이션의 등록을 원하시면 별도로 연락을 주시기 바랍니다.
            </dd>
            <dt>
            Q. 애플리케이션을 등록하면 바로 사용가능한가요? 아니면 사전 검수 이후 사용이 가능한가요?
            </dt>
            <dd>
            애플리케이션 등록과 개발과정이 완료되면, 사전 검수 요청을 등록해야 합니다.<br/>
            최초 등록시에는 “개발중”상태로 등록되며 사전 검수에서 승인이 완료되면 “서비스적용”으로 상태값은 자동 변경됩니다.<br/>
            사전 검수 등록 가이드를 참고하세요.<br/>
            (링크 : <a href='https://developers.naver.com/docs/login/devguide/devguide.md#3-1-4-사전-검수-요청'>https://developers.naver.com/docs/login/devguide/devguide.md#3-1-4-사전-검수-요청</a>)
            </dd>
            <dt>
            Q. 사전 검수가 완료되기까지 얼마의 시간이 소요되나요?
            </dt>
            <dd>
            비즈니스 데이로 3~4일 소요되고 있습니다.<br/>
            사전 검수 요청 등록 시 제출 및 기재해야 하는 내용에 문제가 없으면 빠르게 승인이 완료될 수 있습니다.<br/>
            검수 요청 등록 전에 다시 한번 점검을 부탁 드립니다.
            </dd>
        <!--
        </dl>
        <h3 class="h_sub">개발 관련</h3>
        <dl>
        -->
            <dt>
            Q. ClientID와 ClientSecret은 어디에 사용되는 값이며 어디서 발급받을수 있나요?
            </dt>
            <dd>
            ClientID는 네아로 애플리케이션을 식별할수 있도록 구분하는 값이며
            ClientID와 ClientSecret은 네아로 로그인 연동을 하는 과정에서 애플리케이션 인증을 위해 필요한 중요한 정보입니다.<br/>
            ClientSecret은 ClientID와는 달리 외부에 노출되면 안되는 정보이기때문에 별도로 안전하게 보관을 하시기 바랍니다.<br/>
            ClientID와 ClientSecret은 네이버 개발자센터에서 애플리케이션 등록을 마치면 발급받는 정보이며
            개발자센터에서 언제든지 값을 확인 할 수 있습니다.
            </dd>
            <dt>
            Q. 네이버 아이디로 로그인 후 로그인 된 사용자는 어떻게 구분할 수 있나요?
            </dt>
            <dd>
            네아로 로그인 후 로그인 결과값으로 Token (access token)을 획득할 수 있습니다.<br/><br/>
            획득한 Token 정보를 통해 사용자 프로필 조회 API를 호출할 수 있는데
            현재 로그인한 사용자를 구분하기 위해서는 이 프로필 정보 중 "id" 정보를 이용하시면 됩니다. (네이버ID 아님)<br/>
            "id" 정보는 네이버 계정에 1:1 로 매핑된 정보이기 때문에 매번 동일한 정보를 내려주게 됩니다.
            </dd>
            <dt>
            Q. Access Token으로 API를 호출하면 024 인증실패 오류가 발생합니다. 이런 경우 어떻게 처리해야하나요?
            </dt>
            <dd>
            "024 인증실패" 오류의 경우 Access Token이 만료가 되었거나 올바르지 않은 Access Token이 전달되었을 경우에 발생가능합니다.<br/>
            "024 인증실패" 오류가 발생하면 다음과 같은 과정으로 Access Token에 대하여 처리가 가능합니다.<br/><br/>
            1. AccessToken으로 API를 호출하였을때 024 인증 실패가 발생<br/>
            2. RefreshToken을 이용하여 Access Token을 갱신<br/>
            3. Access Token 갱신이 성공하면 갱신된 Access Token으로 API호출<br/>
            4. Access Token 갱신이 실패하면 Refresh Token도 유효하지 않은것으로 사용자를 로그아웃 시키고 다시 로그인 인증을 받도록 유도<br/>
            </dd>
            <dt>
            Q. 로그인 성공 이후 Access Token으로 카페(또는 캘린더) openAPI를 호출하면 인증 실패(024 인증실패) 오류가 발생합니다.
            </dt>
            <dd>
            카페, 캘린더의 openAPI를 이용하시려면 애플리케이션의 API권한 관리를 통해 API에 대하여 사용신청을 하여야합니다.
            </dd>
            <dt>
            Q. API는 비용을 지불하나요?
            </dt>
            <dd>
            네아로는 오픈 API 약관에 따라 무료로 제공되고 있습니다.<br/>
            제휴가 필요한 경우 심사를 통하여 제휴를 체결하여 드리고 있으며, 제휴를 통한 오픈 API 사용 또한 무료로 이용이 가능합니다.
            </dd>
            <dt>
            Q. 사내 네트워크에서 네아로를 개발 중입니다. 방화벽이 적용되어있는 경우 어떠한 IP와 PORT를 열어야하나요?
            </dt>
            <dd>
            네아로 개발을 위해서는 다음 3개의 도메인에 대하여 접근이 가능해야합니다. (Outbound ACL)<br/><br/>
            * nid.naver.com (210.89.164.56, 125.209.226.33)<br/>
            * openapi.naver.com (125.209.234.165)<br/><br/>
            또한 Port는 다음과 같습니다.<br/><br/>
            * 80(http), 443(https)<br/><br/>
            위 정보는 변경이 일어날수 있는 정보이므로 테스트 시 nslookup 명령을 통해 확인하시는것이 정확합니다.
            </dd>
            <dt>
            Q. 네이버 앱이 설치되지 않은 모바일 단말에서 네이버 로그인을 시도하면 "네이버 앱을 설치하면 이용할 수 있는 서비스입니다." 설치/취소 선택 팝업창이 로그인시도마다 출력됩니다. 해당 팝업을 없앨 수 있나요?
            </dt>
            <dd>
            네이버앱이 있는 경우 네이버 로그인을 더 쉽게 할 수 있기 때문에 네이버앱 설치를 권하고 있습니다만,<br/>
            네이버앱 설치 팝업이 있는 경우 특정 마켓에 등록을 못한다는 건의가 있어서 팝업 없앨 수 있는 메쏘드를 제공하고 있습니다.<br/>
            아래의 명령어 실행해주신 뒤 로그인을 하게 되면 네이버앱이 없어도 팝업이 안나오게 됩니다.<br/><br/>
<pre>
`OAuthLogin.getInstance().setMarketLinkWorking(false);`
</pre>
            </dd>
        </dl>
    </div>
    <div id="tutorial3" class="faq_w">
    <h2>개발관련</h2>
        <dl>
            <dt>Q 네이버 지도가 잠시 나타났다가, 'ClientID와 URL을 확인하세요'라는 인증 실패 alert 메세지가 뜹니다.</dt>
            <dd>애플리케이션 등록후 발급받은 ClientID 값이 잘못되었거나 애플리케이션 등록시 설정한 서비스URL이 실제 서버 URL과 다르기 때문입니다.<br>
                애플리케이션 설정상 ClientID값과 서비스 URL 값을 확인해주세요.
            </dd>
            <dt>Q 방화벽 때문에 오픈API 서버의 IP를 알고 싶습니다.</dt>
            <dd>Open API를 포함한 네이버 서비스에 관련된 모든 IP 정보는 통보없이 바뀔 수 있으므로 공식 확인해 드릴 수 없는 사항입니다.<br>
                다만, 이용자가 적절한 주기로 nslookup으로 IP정보를 확인하거나, ASN(Autonomous System Numbers) 정보로 IP 대역을 파악하시는 것은 가능합니다.<br>
                방화벽 사용시 80, 443 포트는 허용 하셔야 합니다.
            </dd>
            <dt>Q 주소좌표 변환 API 검색 결과가 없어요</dt>
            <dd>주소-좌표 변환 API는 지번 또는 도로명 주소와 같이 실제 주소 체계를 사용하여야만 검색이 가능합니다. (건물명 또는 아파트명 검색 불가)<br>
                지번주소가 같더라도, 도로명 주소가 다른 경우가 존재할 수 있습니다.
            </dd>
            <dt>Q 오픈 API의 요청 URL에 한글 검색어를 사용하려면 어떻게 해야하나요?</dt>
            <dd>네이버 오픈 API는 기본적으로 UTF-8 인코딩을 지원합니다.<br>
                영문 검색어는 UTF-8로 인코딩하지 않아도 동작하지만, 한글 검색어에 대해서는 동작하지 않습니다.<br>
                따라서 요청URL에 한글 검색어를 사용하고자 하는 경우에는, 한글 검색어를 UTF-8 방식으로 인코딩해야 합니다.<br>
                UTF-8 인코딩 방법은 오픈 API 를 이용하는 툴이나 언어에서 제공하는 인코딩 방식을 이용하면 됩니다.<br><br>
                예: php에서는 iconv 함수를 사용하여 UTF-8로 인코딩 할 수 있습니다.<br><br>
                - JavaScript에서 URL 인코딩 방법:
<pre>
var encTxt = encodeURIComponent("인코딩할 한글문자열");
</pre>
                <br>
                - Java에서 URL 인코딩 방법:
<pre>
import java.net.URLEncoder;
String encTxt = URLEncoder.encode("인코딩할 한글문자열", "UTF-8");
</pre>
                <br>
                - PHP에서 URL 인코딩 방법:
<pre>
$encText = urlencode("인코딩할 한글문자열");
</pre>
            </dd>
            <dt>Q 로컬 PC에서는 잘 동작하던 오픈 API가 서버에 업로드한 이후부터 동작하지 않습니다. 어떻게 된것인가요?</dt>
            <dd>
                AJAX 방식과 같이 JavaScript에서 XMLHttpRequest 함수를 사용하여 네이버 오픈 API 에 요청하면, 보안과 관련된 메세지와 함께 검색 결과를 받아오지 못하는 경우가 발생합니다.<br>
                이것은 XMLHttpRequest 함수가 보안상의 이유로 같은 도메인으로의 요청만 실행하기 때문에 발생하는 문제입니다.<br>
                예를 들어 "http://unknown.user.com/"라는 서버에 AJAX 방식을 사용한 웹페이지 sample.html을 올려두었다고 하면, 사용자는 "http://unknown.user.com/sample.html"로 접근합니다.<br>
                이 때 sample.html가 오픈 API에 요청을 보내는 경우 "http://openapi.naver.com/search?..." 도메인을 사용하여 요청하게 됩니다.<br>
                이 도메인이 sample.html이 있는 도메인 "http://unknown.user.com/"과 다르기 때문에 XMLHttpRequest는 결괏값을 받아오지 못하게 됩니다.<br>
                sample.html에서 XMLHttpRequest를 사용하여 요청할 수 있는 곳은 "http://unknown.user.com"뿐입니다.<br>
                이를 해결하기 위한 방법 중의 하나로는 "http://unknown.user.com"에 일종의 proxy 페이지를 만들어서 이 페이지가 대신 "http://naver.openapi.com/search?..."를 요청하도록 하는 것이 있습니다.<br><br>
                proxy 페이지의 구성 방법에 대해서는 <a href="http://cafe.naver.com/openapi/26" target="_blank">카페글</a>을 참고하세요.
            </dd>
            <dt>Q 검색 API란 무엇인가요?</dt>
            <dd>네이버의 통합검색을 통하여 검색이 가능한 결과를 서비스별로 구분하여 결과 검색이 가능하도록 한 API 입니다.<br>
                다만, 실제 컨텐츠 저작자의 공개 범위 지정에 따라 네이버의 통합검색 결과와 일부 다르게 나올 수 있습니다.
            </dd>
            <dt>Q 검색 API 결과를 따로 저장하여 사용하여 되나요?</dt>
            <dd>네이버 오픈 API는 원칙상 별도의 저장이나 재가공을 허용하지 않습니다.<br>
                부하에 따른 단순 캐시 목적이 아니라면 별도로 저장하거나 재가공하여 이용하실 수 없습니다.
            </dd>
            <dt>Q 네이버 지도는 외국어는 지원하지 않나요?</dt>
            <dd>네이버 지도 및 지도 API는 대한민국에 한하여 제공되고 있습니다. 아직은 다국어에 대한 지원이 되지 않는 점 양해해 주시기 바랍니다.</dd>
            <dt>Q 지도API 에서 길찾기를 사용하고 싶어요</dt>
            <dd>현재 길찾기 기능은 API로 제공되고 있지 않습니다. 이 점 양해해 주시기 바랍니다.</dd>
            <dt>Q JS2.0 API 의 모바일 웹 페이지로 모바일기기에서 사용할 수 있나요?</dt>
            <dd>JavaScript 2.0 지도API는 모바일 웹 페이지를 지원합니다.<br>
                다만, JQueryMobile 등의 라이브러리 사용 시 지도 API와 일부 충돌한다는 사례가 보고되고 있으니 별도의 라이브러리 사용 시 참고하시기 바랍니다.
            </dd>
            <dt>Q Your query request count is over the limit 란 메시지가 나옵니다.</dt>
            <dd>오픈 API의 하루 최대 사용량을 초과한 경우 발생하는 메시지입니다.<br>
                오픈 API의 하루 사용량은 0시 ~ 1시에 초기화되니 기다려 주시거나 제휴 신청을 통하여 최대 사용량 제한을 늘려서 사용해 주시기 바랍니다.
            </dd>
            <dt>Q 네이버 오픈 API는 JSON은 지원하지 않나요?</dt>
            <dd>일부 API를 제외한 네이버 오픈 API 대부분은 JSON을 지원합니다. (검색API는 2016년 말 예정).</dd>
            <dt>Q OAuth를 사용한 앱에서 동의 절차를 철회하고 싶어요!</dt>
            <dd>네이버 OAuth 를 사용한 애플리케이션의 경우 아래의 절차에 따라 로그아웃 및 동의 절차를 철회할 수 있도록 하고 있습니다.<br>
                네이버 내정보(https://nid.naver.com/user2/help/myInfo.nhn?menu=home)<br><br>
                <ul>
                    <li>1) 로그아웃 절차: 네이버 내정보 &gt; 내 정보보호 &gt; 로그인 관리 에서 로그인된 정보를 확인하고 로그아웃이 가능합니다.</li>
                    <li>2) 애플리케이션 동의 철회: 네이버 내정보에서 동의한 외부 서비스를 확인하고 연결 동의를 철회할 수 있습니다.</li>
                </ul>
            </dd>
        </dl>
    </div>
    <div id="tutorial3" class="faq_w">
    <h2>이용가이드</h2>
        <dl>
            <dt>Q 오픈 API에서 상업적 이용 불가란 무엇인가요?</dt>
            <dd>네이버의 오픈 API를 이용함에 있어 직접적인 수익이 발생할 수 있는 경우를 이야기합니다.<br>
                오픈 API를 사용한 컨텐츠가 적용되는 곳에 배너광고, 스폰서 링크 등이 적용되는 경우 및 유료 회원만 접근이 가능한 경우가 이에 해당됩니다.
            </dd>
            <dt>Q NAVER 상표 사용 가이드를 준수해야 하나요?</dt>
            <dd><a href="/intro/brand_guide/brand_guide.md">상표 사용 가이드</a> 내 기본 가이드 및 오픈 API 특례를 모두 준수하면 사전 허락을 받지 않아도 NAVER의 상표를 사용할 수 있습니다.<br>
                NAVER 상표 사용 가이드에 대한 문의사항이 있거나 상표 사용 가능 여부에 대한 명확한 승인을 받고 싶은 경우,<br>
                <a href="http://www.naver.com/rules/nhnBrandRequest.doc">상표사용허락 요청서</a>에 구체적인 사항을 기재하여 NAVER에 제출하여 주시기 바랍니다.
            </dd>
            <dt>Q 상품을 판매하는 매장에 약도를 안내하려 하는데요 상업적 인가요?</dt>
            <dd>네이버 지도 API를 이용하여 단순 찾아오는 길 등의 약도를 목적으로 한다면 상품을 판매하는 웹사이트라고 하여도 이용이 가능합니다.</dd>
            <dt>Q 검색엔진을 만들고 있는 업체인데요 네이버의 오픈 API 결과를 함께 노출해도 되나요?</dt>
            <dd>검색결과를 보여주는 서비스의 경우 또는 네이버와 유사한 검색서비스의 경우 오픈API의 검색결과의 이용은 상업적 목적에 의하여 사용 하실 수 없습니다.</dd>
            <dt>Q 네이버 오픈 API를 사용하려면 돈을내야 하나요?</dt>
            <dd>네이버의 오픈 API는 무료로 제공되고 있습니다.</dd>
            <dt>Q 네이버 오픈 API에 대한 문의는 어디로 해야 하나요?</dt>
            <dd>
                <ul>
                    <li>1) 제휴 신청: <a target="_blank" href="https://developers.naver.com/openapi/cooperation">https://developers.naver.com/openapi/cooperation</a></li>
                    <li>2) 개발 문의: <a target="_blank" href="https://forum.developers.naver.com">https://forum.developers.naver.com</a></li>
                </ul>
                <br>
            </dd>
        </dl>
    </div>
</div>
</body>
</html>
