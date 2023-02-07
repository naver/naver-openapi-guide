---
title: 네이버 앱 URL Scheme 연동 가이드
description: NAVER Developers - 네이버 앱 URL Scheme 연동 가이드
---

네이버 앱 URL Scheme 연동
====================

<div class="table-of-contents">
  <ul>
    <li><a href="#1-url-scheme-구성">1. URL Scheme 구성</a></li>
    <ul>
      <li><a href="#11-기본-형식">1.1. 기본 형식</a></li>
      <li><a href="#12-intent-schemeandroid용">1.2. Intent Scheme(Android용)</a></li>
      <li><a href="#13-중계-페이지">1.3. 중계 페이지</a></li>
    </ul>
    <li><a href="#2-url-scheme-적용-예제">2. URL Scheme 적용 예제</a></li>
    <ul>
      <li><a href="#21-단순-호출">2.1. 단순 호출</a></li>
      <li><a href="#22-인식검색">2.2. 인식검색</a></li>
      <li><a href="#23-인앱-브라우저로-열기">2.3. 인앱 브라우저로 열기</a></li>
      <li><a href="#24-단말-홈-화면에-바로가기-추가android용">2.4. 단말 홈 화면에 바로가기 추가(Android용)</a></li>
    </ul>
    <li><a href="#3-모바일-웹-페이지에서-url-scheme-호출">3. 모바일 웹 페이지에서 URL Scheme 호출</a></li>
    <ul>
      <li><a href="#31-앱이-설치되어-있을-경우">3.1. 앱이 설치되어 있을 경우</a></li>
      <li><a href="#32-앱이-설치되어-있지-않을-경우">3.2. 앱이 설치되어 있지 않을 경우</a></li>
    </ul>
    <li><a href="#4-타-앱을-통해-네이버-앱-연동하기">4. 타 앱을 통해 네이버 앱 연동하기</a></li>
    <ul>
      <li><a href="#41-ios">4.1. iOS</a></li>
      <li><a href="#42-android">4.2. Android</a></li>
    </ul>
    <li><a href="#5-android-네이버-앱에서-url-scheme-호출-시-이슈-처리-방법">5. Android 네이버 앱에서 URL Scheme 호출 시 이슈 처리 방법</a></li>
    <ul>
      <li><a href="#51-이슈-환경">5.1. 이슈 환경</a></li>
      <li><a href="#52-이슈-내용">5.2. 이슈 내용</a></li>
      <li><a href="#53-이슈-처리">5.3. 이슈 처리</a></li>
    </ul>
  </ul>
</div>

모바일 애플리케이션 및 브라우저에서 네이버 앱을 실행시키는 Custom URL Scheme을 사용해 보세요. 'http://', 'ftp://', 'market://'과 같은 문자열을 URL Scheme이라 부릅니다. URL Scheme을 통해 앱이 실행되는 방식은 다음과 같습니다.

- 웹 페이지에서 하이퍼링크 클릭 시 URL Scheme이 시스템에 전달됨
- 시스템에서 전달된 URL Scheme을 보고 실행 가능한 앱이 있는지 확인
- 해당 URL Scheme을 받을 수 있는 앱이 있다면 앱을 실행시키며 이 URL을 함께 전달
- 앱이 실행되면서 URL에 포함된 내용을 참조해서 특정 기능을 수행함

※ 웹 페이지에서 URL Scheme을 사용해 네이버 앱을 실행하는 경우, 앱이 미설치된 경우의 예외 처리를 구현해야 합니다(4번 항목 참조).

## 1. URL Scheme 구성

### 1.1. 기본 형식

네이버 앱을 실행시키기 위해서는 다음과 같은 형식의 Custom URL을 구성해야 합니다.

```swift
naversearchapp://{명령어}?{파라미터}={옵션}&version={버전}
```

### 1.2. Intent Scheme(Android용)

Android에서는 Intent Scheme을 사용할 수도 있습니다. 다음과 같은 형식의 Custom URL을 구성하면, 앱이 설치되어 있지 않을 때 자동으로 Google Play 설치 페이지로 이동합니다.

```kotlin
intent://{명령어}?{파라미터}={옵션}&version=1
    #Intent;
        scheme=naversearchapp;
        action=android.intent.action.VIEW;
        category=android.intent.category.BROWSABLE;
        package=com.nhn.android.search;
    end;
```

### 1.3. 중계 페이지

네이버 앱을 호출하는 URL Scheme이 포함된 링크를 메일이나 문자 등으로 공유하고자 할 경우에는 중계 페이지를 사용할 수 있습니다. 아래 중계 페이지를 브라우저에서 열면, 네이버 앱이 설치된 경우 해당 기능이 자동으로 호출되며, 네이버 앱이 설치되지 않은 경우는 OS에 따라 네이버 앱 설치를 위한 안내 사항을 노출하게 됩니다.

```swift
http://naverapp.naver.com/{명령어}/?{파라미터}={옵션}&version={버전}
```

## 2. URL Scheme 적용 예제

### 2.1. 단순 호출

|명령어|버전|OS|
|---|:-:|---|
|default|1|iOS|
|default|5|Android|

#### Sample

- 기본 형식: `naversearchapp://default?version=1`(iOS)
- 중계 페이지: `http://naverapp.naver.com/default/?version=5`(Android)

### 2.2. 인식검색

|기능|명령어|파라미터=옵션|버전|OS|
|---|---|---|:-:|---|
|음성인식|search|qmenu=voicerecg|1|공통|
|음성인식|search|qmenu=music|1|공통|
|코드인식|search|qmenu=qrcode|1|공통|
|일본어인식|search|qmenu=japanese|1|공통|
|와인라벨인식|search|qmenu=wine|1|공통|
|한자필기인식|search|qmenu=hanja|2|공통|

#### Sample

- 기본 형식: `naversearchapp://search?qmenu=voicerecg&version=1`(음성검색)
- 중계 페이지: `http://naverapp.naver.com/search/?qmenu=voicerecg&version=1`(음성검색)

### 2.3. 인앱 브라우저로 열기

네이버 앱 인앱 브라우저 형태로 특정 URL을 열 수 있습니다. URL 정보 입력 시 대체 URL 코드는 다음과 같습니다.

|인코딩 문자|원본 문자|
|:-:|:-:|
|%26|&|
|%2F|/|
|%3A|:|
|%3F|?|
|%3D|=|

|기능|명령어|파라미터=옵션|버전|OS|
|---|---|---|:-:|---|
|새창으로 추가|inappbrowser|url={주소 입력}&target=new|6|공통|
|기존 창을 삭제하고 다시 만들어서 URL을 로딩|inappbrowser|url={주소 입력}&target=replace|6|공통|
|마지막에 보던 창에 URL 로딩(히스토리에 추가됨)|inappbrowser|url={주소 입력}&target=inpage|6|공통|

#### Sample

- 기본 형식: `naversearchapp://inappbrowser?url=http%3A%2F%2Fm.naver.com&target=new&version=6`
- 중계 페이지: `http://naverapp.naver.com/inappbrowser/?url=http%3A%2F%2Fm.naver.com&target=new&version=6`

### 2.4. 단말 홈 화면에 바로가기 추가(Android용)

|명령어|파라미터=옵션|버전|OS|
|---|---|:-:|---|
|addshortcut|url={클릭시 이동할 주소}&icon={등록할 아이콘의 주소}&title={한글 또는 영문 이름(UTF-8 코딩)}&serviceCode={서비스 코드(서비스 영문 이름)}|7|Android|

#### Sample

```kotlin
* 기본 형식
naversearchapp://addshortcut?url=http%3A%2F%2Fm.nstore.naver.com&icon=http%3A%2F%2Fstatic.naver.net%2Fwww%2Fu%2F2012%2F0604%2Fnmms_153256734.png&title=N%EC%8A%A4%ED%86%A0%EC%96%B4&serviceCode=nstore&version=7
```

## 3. 모바일 웹 페이지에서 URL Scheme 호출

HTML hyperlink reference로 위에서 정의된 Custom URL을 입력합니다. 사용자가 해당 link 선택시 아래와 같이 분기할 수 있도록 HTML 페이지를 구성합니다.

### 3.1. 앱이 설치되어 있을 경우

위에서 정의된 URL Scheme으로 앱 실행이 가능합니다.

### 3.2. 앱이 설치되어 있지 않을 경우

Android의 경우는 Intent Scheme을 사용할 경우 자동으로 Google Play로 이동하나 iOS에서는 시스템에서 해석 불가능한 URL로 인식하여 오류 팝업 또는 페이지가 나타납니다. 따라서 아래 "앱 미설치 시 처리 방법"을 참고하여 추가적인 처리가 필요합니다.

## 4. 타 앱을 통해 네이버 앱 연동하기

타 앱에서 네이버 앱과 연동하는 경우에도 다음과 같은 방법으로 네이버 앱 기능을 호출할 수 있습니다. 네이버 앱 호출이 불가능한 경우에는 다음 링크로 이동시켜서 앱 설치를 유도하도록 합니다.

- iOS: `http://itunes.apple.com/kr/app/id393499958?mt=8`
- Android: `http://m.androidapp.naver.com/naverapp`

### 4.1. iOS

앱이 있을 때는 바로 실행 가능하지만, 없을 때는 JavaScript timer를 사용해 일정 시간 후 App Store로 분기시키는 방법을 사용합니다(앱 미설치 시 App Store로 이동 전에 잠시 오류 팝업이 보일 수 있습니다). 타이머 설정 시에 timeout ID를 `naverAppCheckTimer`에 할당해야 네이버 앱의 인앱에서도 제대로 처리될 수 있습니다. 아래는 스크립트 구성 예입니다.

```html
<script>
var appstoreUrl = "http://itunes.apple.com/kr/app/id393499958?mt=8";

//url은 “naversearchapp://search?qmenu=voicerecg&version=1”
function onClickApp(url) {
    var clickedAt = +new Date;

    naverAppCheckTimer = setTimeout(function() {
        if (+new Date - clickedAt < 2000){
            if (window.confirm("네이버 앱 최신 버전이 설치되어 있지 않습니다.   \n설치 페이지로 이동하시겠습니까?"))
            { location.href = appstoreUrl; }
        }
    }, 1500);
}
location.href = url;
</script>
```

### 4.2. Android

Android도 iOS와 동일한 방식으로 앱 미설치 시 예외 처리를 할 수 있으나, 시스템 에러 메시지를 숨기기 위한 iframe 처리 등이 필요할 수 있습니다. Intent Scheme을 사용하면 앱 미설치 시 자동으로 Google Play로 이동하므로, 좀 더 단순한 처리가 가능합니다. Intent Scheme을 사용한 웹 페이지 구성 예는 아래와 같습니다.

```html
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width">
  </head>
  <body>
    <h2>
      <a id="applink" href="intent://qmenu=voicerecg&version=1#Intent;scheme=naversearchapp;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=com.nhn.android.search;end">음성인식실행</a>
   </h2>
   <p>
     <i>Only works on Android!</i>
   </p>
  </body>
</html>
```

## 5. Android 네이버 앱에서 URL Scheme 호출 시 이슈 처리 방법

### 5.1. 이슈 환경

- Android KitKat(API 수준 19) 이상이 적용된 기기
- window open 또는 target으로 발생된 webview 창

### 5.2. 이슈 내용

- 네이버 앱은 기본적으로 window open 또는 target 방식으로 페이지를 슬라이드 창으로 표현해 줍니다.
- 위와 같은 형태의 페이지 상에서 Android OS 이슈로 URL Scheme(Custom Scheme) 형태를 처리할 수 없습니다(Custom Scheme 예: `market://detail?id=com.android.xxxx`).

### 5.3. 이슈 처리

- 네이버 앱 처리  
페이지 URL 로딩 전 URL을 handle하는 구간이 없기 때문에, 페이지 URL 로딩 중 URL을 handle하여 처리할 수 있습니다. 하지만 Custom Scheme은 'http' 형태의 valid한 URL이 아니므로, 알 수 없는 페이지로 로딩될 수 있습니다. 따라서, 각 웹 서비스 단에서는 아래 "웹 서비스 처리 가이드"와 같은 처리가 필요합니다.
- 웹 서비스 처리 가이드  
각 웹 서비스 단에서는 URL Scheme(Custom Scheme) 처리를 위해 영역이 없는 iframe을 통하여 호출하면, 알 수 없는 페이지 로딩 없이 URL Scheme(Custom Scheme) 기능을 수행할 수 있습니다. 아래는 스크립트 구성 예입니다.

```html
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width">
</head>
<body>
 <iframe id="uriFrame" src="notfound.html" height="0" width="0"></iframe>
 <a href ="callScheme()"> call scheme</a>
</body>
</html>
<script>
function callScheme(){
    var ifr = document.all["uriFrame"];
    if( ifr != null ){
        ifr.src  = url;// url : URL Scheme(Custom scheme)
    }
}
</script>
```

iframe 영역에 history가 없을 경우 네이버 앱 6.6.1 미만에서는 오동작이 발생할 수 있습니다. 따라서, iframe src로 바로 Custom Scheme 호출 시에는 useragent를 참고하여 네이버 앱 6.6.1 이상에서 호출해 주시기 바랍니다.

```html
<iframe src="url" height="0" width="0"></iframe> // url: URL Scheme(Custom Scheme)
```