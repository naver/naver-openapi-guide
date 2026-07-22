---
title: 네이버 공유하기
description: 네이버 공유하기 버튼으로 여러분의 콘텐츠를 블로그·카페 등 네이버 서비스에 쉽고 빠르게 공유할 수 있습니다.
---

# 네이버 공유하기 API 명세

네이버 공유하기는 여러분의 컨텐츠를 네이버 서비스에 쉽게 공유할 수 있게 해주는 플러그인입니다. 간단한 스크립트를 복사해 붙이는 것만으로도 쉽게 개발할 수 있습니다.

공유하려는 URL이 로컬 경로일 경우는 네이버 서버에서 해당 URL을 파싱할 수 없어 공유하기가 안되니 주의 바랍니다.

## API 호출 예제

```html
<!doctype html>
<html lang="ko">
<head>
  <meta charset="utf-8">
<head>
  <title>네이버 공유하기</title>
  <script>
    function share() {
      var url = encodeURI(encodeURIComponent(myform.url.value));
      var title = encodeURI(myform.title.value);
      var shareURL = "https://share.naver.com/web/shareView?url=" + url + "&title=" + title;
      document.location = shareURL;
    }
  </script>
</head>
<body>
  <form id="myform">
    URL입력:  <input type="text" id="url" value="https://search.naver.com/search.naver?sm=tab_hty.top&where=nexearch&oquery=네이버+개발자센터&ie=utf8&query=네이버+개발자센터"><br/>
    Title입력:  <input type="text" id="title" value="네이버개발자센터 검색결과"><br/>
  </form>
  <input type="button" value="네이버공유하기" onclick="share()"/>
</body>
</html>
```

## 1. 사용자가 콘텐츠를 네이버로 공유하는 방법

<div class="img_area naver_share_img_list">
<img alt="" src="/inc/devcenter/images/cont/img_naver_share_02.png">
<img alt="" src="/inc/devcenter/images/cont/img_naver_share_03.png">
<img alt="" src="/inc/devcenter/images/cont/img_naver_share_04.png">
<img alt="" src="/inc/devcenter/images/cont/img_naver_share_05.png">
<img alt="" src="/inc/devcenter/images/cont/img_naver_share_06.png">
</div>

## 2. 네이버 공유하기 개발 방법

### 2.1. 버튼 유형 선택

서비스 환경에 맞는 네이버 N스퀘어 버튼 이미지를 선택합니다.

<div class="imagelist_area naver_share_btn_list">
<label><input type="radio" name="ns-btn" value="a" checked/> <span class="btn_naver_share btn_naver_share_mc">네이버 공유하기</span></label>
<label><input type="radio" name="ns-btn" value="b"/> <span class="btn_naver_share btn_naver_share_sm">네이버 공유하기</span></label>
<label><input type="radio" name="ns-btn" value="c"/> <span class="btn_naver_share btn_naver_share_rg">네이버 공유하기</span></label>
<label><input type="radio" name="ns-btn" value="d"/> <span class="btn_naver_share btn_naver_share_lg">네이버 공유하기</span></label>
<label><input type="radio" name="ns-btn" value="e"/> <span class="btn_naver_share btn_naver_share_vt">네이버 공유하기</span></label>
<label><input type="radio" name="ns-btn" value="f"/> <span class="btn_naver_share btn_naver_share_ht">네이버 공유하기</span></label>
</div>

### 2.2. 페이지 제목 텍스트 선택

페이지 공유될 때 사용될 제목을 선택합니다. 각 페이지의 제목을 그대로 가져올 수도 있고, 사용자 정의를 선택해 직접 입력할 수도 있습니다.

<div class="blockquote_area openmain-select">
<label><input type="radio" name="ns-text" value="default" checked/> 페이지 제목 + URL (각 페이지의 제목을 그대로 사용)</label>
<label><input type="radio" name="ns-text" value="custom"/> 사용자 정의 <input type="text" id="ns-text-input" placeholder="본문 텍스트"/> + URL</label>
</div>

### 2.3. 미리보기 및 코드 복사

소스코드에 출력된 플러그인 코드를 복사해 개발합니다.

<table style="table-layout:fixed">
<caption><span class="blind">네이버 공유하기 붙이기 표</span></caption>
<colgroup>
<col style="width:30%">
<col style="width:70%">
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

## 3. 네이버 공유하기 인터페이스 명세

네이버 공유 버튼은 모바일과 PC에서 모두 사용할 수 있습니다. 공유할 URL과 title은 반드시 인코딩하셔야 합니다.

### 모바일과 PC웹에서 네이버 공유하기 플러그인 열기

```
인코딩 : UTF-8
요청방식 : GET방식
https://share.naver.com/web/shareView?url=인코딩한URL값&title=인코딩한title값
```

| # | 파라미터 | 값 | 설명 |
| --- | --- | --- | --- |
| 1 | url | 문자열 | 인코딩한 공유할 웹 URL |
| 2 | title | 문자열 (optional) | 인코딩한 제목 문자열 |

### 바른 예

```
https://share.naver.com/web/shareView?url=https%3A%2F%2Fwww.exampple.co.kr%2Ftest.html%3Fa%3D123%26b%3D456
```

### 잘못된 예

```
https://share.naver.com/web/shareView?url=https://www.example.co.kr/test.html?a=123&b=456
```

## 4. 네이버 공유하기 이미지 다운로드

### N스퀘어 이미지 다운로드

다양한 종류의 N스퀘어 이미지를 다운받을 수 있습니다. 이미지 변경이 필요한 경우, N스퀘어 가이드에 따라 이미지를 변경할 수 있습니다.

<div class="naver_share_down_img">
<div class="blockquote_area">
<div class="down_img">
<img alt="" src="/inc/devcenter/images/cont/img_naver_share_07.png">
</div>
<a href="https://ssl.pstatic.net/share/download/NAVER_SQUARE_Logo.zip">N스퀘어 이미지 다운로드 <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="ndc-ico"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></a>
</div>
<div class="blockquote_area">
<div class="down_img">
<img alt="" src="/inc/devcenter/images/cont/img_naver_share_08.png">
</div>
<a href="https://ssl.pstatic.net/share/download/NAVER_SQUARE_Guide.zip">N스퀘어 가이드 다운로드 <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="ndc-ico"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></a>
</div>
</div>
