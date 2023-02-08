
<div class="con">
    <div class="h_page_area">
        <h2 class="h_page">네이버 공유하기 API 명세</h2>
    </div>
    <!-- 네이버 공유 API -->
    <p class="p_desc">
        네이버 공유하기는 여러분의 컨텐츠를 네이버 서비스에 쉽게 공유할 수 있게 해주는 플러그인입니다. <br>간단한 스크립트를 복사해 붙이는 것만으로도 쉽게 개발할 수 있습니다.
        <br>공유하려는 URL이 로컬 경로일 경우는 네이버 서버에서 해당 URL을 파싱할 수 없어 공유하기가 안되니 주의 바랍니다.
    </p>
    <h3 class="h_sub">API 호출 예제</h3>
    <div id="tutorial0">
    <div class="code_area">
       <pre class="prettyprint">
&lt;!doctype html&gt;
&lt;html lang="ko"&gt;
&lt;head&gt;
  &lt;meta charset="utf-8"&gt;
&lt;head&gt;
  &lt;title&gt;네이버 공유하기&lt;/title&gt;
  &lt;script&gt;
    function share() {
      var url = encodeURI(encodeURIComponent(myform.url.value));
      var title = encodeURI(myform.title.value);
      var shareURL = "https://share.naver.com/web/shareView?url=" + url + "&title=" + title;
      document.location = shareURL;
    }
  &lt;/script&gt;
&lt;/head&gt;
&lt;body&gt;
  &lt;form id="myform"&gt;
    URL입력:  &lt;input type="text" id="url" value="https://search.naver.com/search.naver?sm=tab_hty.top&where=nexearch&oquery=%EB%84%A4%EC%9D%B4%EB%B2%84+%EA%B0%9C%EB%B0%9C%EC%9E%90%EC%84%BC%ED%84%B0&ie=utf8&query=%EB%84%A4%EC%9D%B4%EB%B2%84+%EA%B0%9C%EB%B0%9C%EC%9E%90%EC%84%BC%ED%84%B0"&gt;&lt;br/&gt;
    Title입력:  &lt;input type="text" id="title" value="네이버개발자센터 검색결과"&gt;&lt;br/&gt;
  &lt;/form&gt;
  &lt;input type="button" value="네이버공유하기" onclick="share()"/&gt;
&lt;/body&gt;
&lt;/html&gt;
       </pre>
    </div>
    </div>
    <h3 class="h_sub">1. 사용자가 콘텐츠를 네이버로 공유하는 방법</h3>
    <div class="img_area naver_share_img_list">
        <img alt="" src="/inc/devcenter/images/cont/img_naver_share_02.png">
        <img alt="" src="/inc/devcenter/images/cont/img_naver_share_03.png">
        <img alt="" src="/inc/devcenter/images/cont/img_naver_share_04.png">
        <img alt="" src="/inc/devcenter/images/cont/img_naver_share_05.png">
        <img alt="" src="/inc/devcenter/images/cont/img_naver_share_06.png">
    </div>
    <h3 class="h_sub">2. 네이버 공유하기 개발 방법</h3>
    <h4 class="h_subsub">2.1. 버튼 유형 선택</h4>
    <p class="p_desc">
        서비스 환경에 맞는 네이버 N스퀘어 버튼 이미지를 선택합니다.
    </p>
    <div class="imagelist_area naver_share_btn_list">
        <input type="radio" checked="" id="share11" class="input_radio" name="naver_btn_share">
        <label for="share11">
            <span class="btn_naver_share btn_naver_share_mc">네이버 공유하기</span>
        </label>
        <input type="radio" id="share12" class="input_radio" name="naver_btn_share">
        <label for="share12">
            <span class="btn_naver_share btn_naver_share_sm">네이버 공유하기</span>
        </label>
        <input type="radio" id="share13" class="input_radio" name="naver_btn_share">
        <label for="share13">
            <span class="btn_naver_share btn_naver_share_rg">네이버 공유하기</span>
        </label>
        <input type="radio" id="share14" class="input_radio" name="naver_btn_share">
        <label for="share14">
            <span class="btn_naver_share btn_naver_share_lg">네이버 공유하기</span>
        </label>
        <input type="radio" id="share15" class="input_radio" name="naver_btn_share">
        <label for="share15">
            <span class="btn_naver_share btn_naver_share_vt">네이버 공유하기</span>
        </label>
        <input type="radio" id="share16" class="input_radio" name="naver_btn_share">
        <label for="share16">
            <span class="btn_naver_share btn_naver_share_ht">네이버 공유하기</span>
        </label>
    </div>
    <h4 class="h_subsub">2.2. 페이지 제목 텍스트 선택</h4>
    <p class="p_desc">
        페이지 공유될 때 사용될 제목을 선택합니다. 각 페이지의 제목을 그대로 가져올 수도 있고, 사용자 정의를 선택해 직접 입력할 수도 있습니다.
    </p>
    <div class="blockquote_area">
        <input type="radio" checked="" id="share21" class="input_radio" name="naver_share_text">
        <label for="share21">
            페이지 제목 + URL
        </label>
        <div class="td_dummy"></div>
        <input type="radio" id="share22" class="input_radio" name="naver_share_text">
        <label for="share22">
            <input type="text" placeholder="본문 텍스트" title="본문 텍스트 입력" id="naver_share_text" style="width:75%;max-width:265px;" class="input_txt input_txt_inline"> + URL
        </label>
    </div>
    <h4 class="h_subsub">2.3. 미리보기 및 코드 복사</h4>
    <p class="p_desc">
        소스코드에 출력된 플러그인 코드를 복사해 개발합니다.
    </p>
    <table border="1" class="tbl_h">
        <caption><span class="blind">네이버 공유하기 붙이기 표</span></caption>
        <colgroup>
            <col style="width:100px">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>버튼 미리보기</th>
            <th>소스코드</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">
                <div id="blog-share-preview">
                    <span class="btn_naver_share btn_naver_share_mc">네이버 공유하기</span>
                </div>
            </td>
            <td>
                <div class="code_area" id="blog-share-code">
									<pre class="prettyprint">&lt;span&gt;
	&lt;script type="text/javascript" src="https://ssl.pstatic.net/share/js/naver_sharebutton.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript"&gt;
	new ShareNaver.makeButton({"type": "a"});
	&lt;/script&gt;
&lt;/span&gt;
</pre>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <h3 class="h_sub">3. 네이버 공유하기 인터페이스 명세</h3>
    <p class="p_desc">
        네이버 공유 버튼은 모바일과 PC에서 모두 사용할 수 있습니다.<br>
        공유할 URL과 title은 반드시 인코딩하셔야 합니다.
    </p>
    <h4 class="h_subsub">모바일과 PC웹에서 네이버 공유하기 플러그인 열기</h4>
    <div class="code_area">
						<pre class="prettyprint prettyprinted">
인코딩 : UTF-8
요청방식 : GET방식
https://share.naver.com/web/shareView?url=인코딩한URL값&title=인코딩한title값</pre>
    </div>
    <table border="1" class="tbl_h">
        <caption><span class="blind">네이버 공유하기 인터페이스 설명 표</span></caption>
        <colgroup>
            <col style="width:10%">
            <col style="width:30%">
            <col style="width:30%">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">파라미터</th>
            <th scope="col">값</th>
            <th scope="col">설명</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="left">1</td>
            <td class="left">url</td>
            <td class="left">문자열</td>
            <td class="left">인코딩한 공유할 웹 URL</td>
        </tr>
        <tr>
            <td class="left">2</td>
            <td class="left">title</td>
            <td class="left">문자열 (optional)</td>
            <td class="left">인코딩한 제목 문자열</td>
        </tr>
        </tbody>
    </table>
    <h4 class="h_subsub">바른 예</h4>
    <div class="code_area">
        <pre class="prettyprint prettyprinted">https://share.naver.com/web/shareView?url=https%3A%2F%2Fwww.exampple.co.kr%2Ftest.html%3Fa%3D123%26b%3D456</pre>
    </div>
    <h4 class="h_subsub">잘못된 예</h4>
    <div class="code_area">
        <pre class="prettyprint prettyprinted">https://share.naver.com/web/shareView?url=https://www.example.co.kr/test.html?a=123&b=456</pre>
    </div>
    <div id="section-blogshare-4"></div>
    <h3 class="h_sub">4. 네이버 공유하기 이미지 다운로드</h3>
    <h4 class="h_subsub">N스퀘어 이미지 다운로드</h4>
    <p class="p_desc">
        다양한 종류의 N스퀘어 이미지를 다운받을 수 있습니다. 이미지 변경이 필요한 경우, N스퀘어 가이드에 따라 이미지를 변경할 수 있습니다.
    </p>
    <div class="naver_share_down_img">
        <div class="blockquote_area">
            <div class="down_img">
                <img alt="" src="/inc/devcenter/images/cont/img_naver_share_07.png">
            </div>
            <a href="https://ssl.pstatic.net/share/download/NAVER_SQUARE_Logo.zip">N스퀘어 이미지 다운로드 <i class="xi-download"></i></a>
        </div>
        <div class="blockquote_area">
            <div class="down_img">
                <img alt="" src="/inc/devcenter/images/cont/img_naver_share_08.png">
            </div>
            <a href="https://ssl.pstatic.net/share/download/NAVER_SQUARE_Guide.zip">N스퀘어 가이드 다운로드 <i class="xi-download"></i></a>
        </div>
    </div>
    <!--// 네이버 공유 API -->
    <br>
    <br>
    <br>
    <br>
    {{> forum_guide }}
</div>
<script type="text/javascript">
    function onReactLoad() {
        var codeFormat = '<span>' + '\n';
        codeFormat += '	<script type="text/javascript" src="https://ssl.pstatic.net/share/js/naver_sharebutton.js"><\/script>' + '\n';
        codeFormat += '	<script type="text/javascript">' + '\n';
        codeFormat += '	new ShareNaver.makeButton({$replacearea});' + '\n';
        codeFormat += '	<\/script>' + '\n';
        codeFormat += '</span>' + '\n';
        var replaceCodeFormat = function (type) {
            var another = codeFormat;
            if ($('#share22').is(":checked")) {
                another = another.replace('$replacearea', '"type": "' + type + '" , "title":"' + $('#naver_share_text').val() + '"');
            } else {
                another = another.replace('$replacearea', '"type": "' + type + '"');
            } $('#blog-share-code pre').text(another).removeClass('prettyprinted');
            PR.prettyPrint();
        };
        var share22or23checked = function () {
            var checkedInput = $('.naver_share_btn_list input:checked'),
                    type = 'a';
            switch (checkedInput[0].id) {
                case "share11":
                    type = 'a';
                    break;
                case "share12":
                    type = 'b';
                    break;
                case "share13":
                    type = 'c';
                    break;
                case "share14":
                    type = 'd';
                    break;
                case "share15":
                    type = 'e';
                    break;
                case "share16":
                    type = 'f';
                    break;
            }
            replaceCodeFormat(type);
        };
        $('#share11').click(function () {
            $('#blog-share-preview span').removeClass();
            $('#blog-share-preview span').addClass('btn_naver_share btn_naver_share_mc');
            replaceCodeFormat('a');
        });
        $('#share12').click(function () {
            $('#blog-share-preview span').removeClass();
            $('#blog-share-preview span').addClass('btn_naver_share btn_naver_share_sm');
            replaceCodeFormat('b');
        });
        $('#share13').click(function () {
            $('#blog-share-preview span').removeClass();
            $('#blog-share-preview span').addClass('btn_naver_share btn_naver_share_rg');
            replaceCodeFormat('c');
        });
        $('#share14').click(function () {
            $('#blog-share-preview span').removeClass();
            $('#blog-share-preview span').addClass('btn_naver_share btn_naver_share_lg');
            replaceCodeFormat('d');
        });
        $('#share15').click(function () {
            $('#blog-share-preview span').removeClass();
            $('#blog-share-preview span').addClass('btn_naver_share btn_naver_share_vt');
            replaceCodeFormat('e');
        });
        $('#share16').click(function () {
            $('#blog-share-preview span').removeClass();
            $('#blog-share-preview span').addClass('btn_naver_share btn_naver_share_ht');
            replaceCodeFormat('f');
        });
        $('#naver_share_text').focusout(share22or23checked);
        $('#share21').click(share22or23checked);
        $('#share22').click(share22or23checked);
    }
</script>