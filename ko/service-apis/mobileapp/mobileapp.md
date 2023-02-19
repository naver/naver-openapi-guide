---
title: 네이버 앱 URL Scheme 연동 가이드
description: 네이버 앱 URL Scheme 연동은 네이버 앱용 URL Scheme을 사용해 모바일 앱과 모바일 브라우저에서 네이버 앱을 실행하는 기능입니다.
---

네이버 앱 URL Scheme 연동
====================

<div class="table-of-contents">
  <ul>
    <li><a href="#네이버-앱-url-scheme-연동-개요">네이버 앱 URL Scheme 연동 개요</a></li>
    <ul>
        <li><a href="#url-scheme과-네이버-앱-url-scheme-연동">URL Scheme과 네이버 앱 URL Scheme 연동</a></li>
        <li><a href="#네이버-앱-url-scheme-기본-형식">네이버 앱 URL Scheme 기본 형식</a></li>
        <li><a href="#모바일-웹-페이지에서-url-scheme-호출">모바일 웹 페이지에서 URL Scheme 호출</a></li>
        <li><a href="#네이버-앱-미설치-시-예외-처리">네이버 앱 미설치 시 예외 처리</a></li>
    </ul>
    <li><a href="#네이버-앱-url-scheme과-예외-처리">네이버 앱 URL Scheme과 예외 처리</a></li>
    <ul>
        <li><a href="#android의-intent-scheme">Android의 Intent Scheme</a></li>
        <li><a href="#ios의-중계-페이지">iOS의 중계 페이지</a></li>
    </ul>
    <li><a href="#url-scheme-레퍼런스">URL Scheme 레퍼런스</a></li>
    <ul>
        <li><a href="#네이버-앱-실행">네이버 앱 실행</a></li>
        <li><a href="#인식-검색">인식 검색</a></li>
        <li><a href="#네이버-앱에서-웹-페이지-열기">네이버 앱에서 웹 페이지 열기</a></li>
        <li><a href="#홈-화면에-바로가기-추가android-전용">홈 화면에 바로가기 추가(Android 전용)</a></li>
    </ul>
  </ul>
</div>

## 네이버 앱 URL Scheme 연동 개요

### URL Scheme과 네이버 앱 URL Scheme 연동

‘http://’, ‘ftp://’, ‘market://’ 등과 같은 문자열을 URL Scheme이라 부릅니다. URL Scheme을 사용하면 모바일 앱과 모바일 브라우저에서 특정 앱을 실행할 수 있습니다. URL Scheme을 통해 앱이 실행되는 방식은 다음과 같습니다.

1. 모바일 앱이나 모바일 브라우저에서 링크를 누르면 URL이 시스템에 전달됩니다.
2. 시스템에 전달된 URL의 URL Scheme을 실행할 수 있는 앱이 있는지 확인합니다.
3. URL Scheme을 실행할 수 있는 앱이 있으면 해당 앱을 실행하고 URL을 전달합니다.
4. 앱이 실행되면서 URL에 포함된 내용을 참조해 특정 기능을 수행합니다.

네이버 앱 URL Scheme 연동은 네이버 앱용 URL Scheme을 사용해 모바일 앱과 모바일 브라우저에서 네이버 앱을 실행하는 기능입니다. 네이버 앱 URL Scheme으로 다음과 같은 작업을 할 수 있습니다.

- 네이버 앱 실행
- 네이버 앱의 인식 검색 기능 실행
- 네이버 앱에서 웹 페이지 열기
- 홈 화면에 바로가기 추가(Android에서만 가능)

### 네이버 앱 URL Scheme 기본 형식

네이버 앱을 실행하는 URL Scheme은 ‘naversearchapp://’입니다. 다음과 같은 형식으로 URL을 구성해 네이버 앱을 실행합니다.

```swift
naversearchapp://{명령어}?{파라미터}={옵션}&version={버전}
```

- 명령어: 실행할 네이버 앱의 기능
- 파라미터, 옵션: 네이버 앱 기능 실행에 필요한 내용
- 버전: 명령어를 지원하는 네이버 앱 URL Scheme의 버전. 설치된 네이버 앱이 해당 버전의 URL Scheme을 지원하지 않으면 네이버 앱을 업데이트하도록 안내합니다.

다음은 네이버 앱 URL Scheme을 사용해 네이버 앱을 실행하는 URL의 예입니다.

```swift
naversearchapp://default?version=5
```

### 모바일 웹 페이지에서 URL Scheme 호출

모바일 웹 페이지에서 다음 예와 같이 네이버 앱 URL Scheme을 사용해 네이버 앱을 실행할 수 있습니다. 네이버 앱 URL Scheme을 사용한 링크를 누르면 네이버 앱이 실행됩니다.

```html
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width">
  </head>
  <body>
    <h2>
      <a href="naversearchapp://default?version=5">네이버 앱 열기</a>
   </h2>
   <p>
     <i>모바일 기기에 네이버 앱이 설치되어 있어야 합니다.</i>
   </p>
  </body>
</html>
```

### 네이버 앱 미설치 시 예외 처리

네이버 앱 URL Scheme을 사용할 때 시스템에 네이버 앱이 설치되어 있지 않으면 URL Scheme이 작동하지 않습니다. 네이버 앱이 설치되어 있지 않을 때 네이버 앱을 설치하도록 하는 예외 처리를 구현해야 합니다. Android에서는 Intent Scheme을 사용해 예외 처리를 구현할 수 있습니다. iOS에서는 중계 페이지를 사용해 예외 처리를 구현할 수 있습니다.

Intent Scheme과 중계 페이지에 관해서는 [네이버 앱 URL Scheme과 예외 처리](#네이버-앱-url-scheme과-예외-처리)를 참고합니다.

## 네이버 앱 URL Scheme과 예외 처리

### Android의 Intent Scheme

Android에서는 ‘intent://’로 시작하는 Intent Scheme을 네이버 앱 URL Scheme으로 사용해 예외 처리를 할 수 있습니다. Intent Scheme을 사용하면 네이버 앱이 설치되어 있지 않을 때 자동으로 Google Play의 네이버 앱 설치 페이지로 이동합니다.

Intent Scheme을 네이버 앱 URL Scheme으로 사용하려면 다음과 같은 형식으로 URL을 구성합니다.

```kotlin
intent://{명령어}?{파라미터}={옵션}&version={버전}
    #Intent;
        scheme=naversearchapp;
        action=android.intent.action.VIEW;
        category=android.intent.category.BROWSABLE;
        package=com.nhn.android.search;
    end;
```

다음은 네이버 앱을 실행하는 URL인 `naversearchapp://default?version=5`를 Intent Scheme을 사용해 실행하도록 구현한 URL의 예입니다.

```kotlin
intent://default?version=5#Intent;scheme=naversearchapp;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=com.nhn.android.search;end
```

### iOS의 중계 페이지

iOS에서는 중계 페이지를 네이버 앱 URL Scheme으로 사용해 예외 처리를 할 수 있습니다. 중계 페이지를 사용하면 네이버 앱이 설치되어 있지 않을 때 네이버 앱 설치를 안내하는 페이지로 이동합니다. 안내 페이지에서 네이버 앱 설치를 선택하면 App Store의 네이버 앱 설치 페이지로 이동합니다.

> **중계 페이지와 네이버 앱 URL Scheme 공유**
>
> 중계 페이지는 네이버 앱 URL Scheme이 포함된 링크를 메일이나 문자 메시지 등으로 공유할 때에도 사용할 수 있습니다.

중계 페이지를 네이버 앱 URL Scheme으로 사용하려면 다음과 같은 형식으로 URL을 구성합니다.

```swift
https://naverapp.m.naver.com/?urlScheme={URL 인코딩 방식으로 인코딩된 URL Scheme 실행 URL}
```

다음은 네이버 앱을 실행하는 URL인 `naversearchapp://default?version=5`를 중계 페이지를 사용해 실행하도록 구현한 URL의 예입니다.

```swift
https://naverapp.m.naver.com/?urlScheme=naversearchapp%3A%2F%2Fdefault%3Fversion%3D5
```

## URL Scheme 레퍼런스

### 네이버 앱 실행

#### 설명

네이버 앱을 실행합니다.

#### 명령어

default

#### URL Scheme 구문

```swift
naversearchapp://default?version=5
```

#### 파라미터

|파라미터|타입|필수 여부|설명|
|---|---|:-:|---|
|version|Integer|Y|`default` 명령어를 지원하는 네이버 앱 URL Scheme의 버전. 값을 `5`로 설정합니다.|

#### URL Scheme 예

- 기본 URL

```swift
naversearchapp://default?version=5
```

- Intent Scheme URL(Android용)

```kotlin
intent://default?version=5#Intent;scheme=naversearchapp;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=com.nhn.android.search;end
```

- 중계 페이지 URL(iOS용)

```swift
https://naverapp.m.naver.com/?urlScheme=naversearchapp%3A%2F%2Fdefault%3Fversion%3D5
```

### 인식 검색

#### 설명

네이버 앱의 인식 검색을 실행합니다. 네이버 앱 URL Scheme으로 실행할 수 있는 인식 검색 기능은 다음과 같습니다.

- 음성
- 음악
- 스마트렌즈

#### 명령어

search

#### URL Scheme 구문

```swift
naversearchapp://search?{파라미터}={옵션}&version=1
```

#### 파라미터

|파라미터|타입|필수 여부|설명|
|---|---|:-:|---|
|qmenu|String|Y|네이버 앱으로 실행할 인식 검색 기능<br/>- `voicerecg`: 음성 인식 검색<br/>- `music`: 음악 인식 검색<br/>- `searchbyimage`: 스마트렌즈 검색<br/>|
|version|Integer|Y|`search` 명령어를 지원하는 네이버 앱 URL Scheme의 버전. 값을 `1`로 설정합니다.|

#### URL Scheme 예

- 기본 URL

```swift
naversearchapp://search?qmenu=voicerecg&version=1
```

- Intent Scheme URL(Android용)

```kotlin
intent://search?qmenu=voicerecg&version=1#Intent;scheme=naversearchapp;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=com.nhn.android.search;end
```

- 중계 페이지 URL(iOS용)

```swift
https://naverapp.m.naver.com/?urlScheme=naversearchapp%3A%2F%2Fsearch%3Fqmenu%3Dvoicerecg%26version%3D1
```

### 네이버 앱에서 웹 페이지 열기

#### 설명

웹 페이지를 네이버 앱의 인앱 브라우저로 엽니다. 네이버 앱으로 열 웹 페이지의 URL은 URL 인코딩 방식으로 인코딩되어야 합니다.

#### 명령어

inappbrowser

#### URL Scheme 구문

```swift
naversearchapp://inappbrowser?{파라미터}={옵션}&version=6
```

#### 파라미터

|파라미터|타입|필수 여부|설명|
|---|---|:-:|---|
|url|String|Y|네이버 앱에서 열 웹 페이지의 URL. URL 인코딩 방식으로 인코딩되어야 합니다.|
|target|String|N|웹 페이지를 여는 방식<br/>- `new`: 새 창으로 열기(기본값)<br/>- `replace`: 마지막으로 보던 창의 기록을 삭제하고 열기<br/>- `inpage`: 마지막으로 보던 창에 열기. 방문 기록에 추가됩니다.|
|version|Integer|Y|`inappbrowser` 명령어를 지원하는 네이버 앱 URL Scheme의 버전. 값을 `6`으로 설정합니다.|

#### URL Scheme 예

- 기본 URL

```swift
naversearchapp://inappbrowser?url=https%3A%2F%2Fn.news.naver.com%2Fmnews%2Farticle%2F030%2F0003072446&target=new&version=6
```

- Intent Scheme URL(Android용)

```kotlin
intent://inappbrowser?url=https%3A%2F%2Fn.news.naver.com%2Fmnews%2Farticle%2F030%2F0003072446&target=new&version=6#Intent;scheme=naversearchapp;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=com.nhn.android.search;end
```

- 중계 페이지 URL(iOS용)

```swift
https://naverapp.m.naver.com/?urlScheme=naversearchapp%3A%2F%2Finappbrowser%3Furl%3Dhttps%253A%252F%252Fn.news.naver.com%252Fmnews%252Farticle%252F030%252F0003072446%26target%3Dnew%26version%3D6
```

### 홈 화면에 바로가기 추가(Android 전용)

#### 설명

네이버 앱에서 웹 페이지를 여는 바로가기를 홈 화면에 추가합니다.

> **Android 전용**
>
> 홈 화면에 바로가기 추가는 Android 환경에서만 작동합니다.

#### 명령어

addshortcut

#### URL Scheme 구문

```kotlin
naversearchapp://addshortcut?{파라미터}={옵션}&version=1
```

#### 파라미터

|파라미터|타입|필수 여부|설명|
|---|---|:-:|---|
|url|String|Y|네이버 앱에서 열 웹 페이지의 URL. URL 인코딩 방식으로 인코딩되어야 합니다.|
|icon|String|Y|바로기기에 사용할 아이콘 이미지 파일의 URL. URL 인코딩 방식으로 인코딩되어야 합니다.|
|title|String|Y|바로가기에 표시할 이름. URL 인코딩 방식으로 인코딩되어야 합니다.|
|serviceCode|String|Y|바로가기를 구별할 수 있는 이름. 10자 이하의 영문자이어야 합니다(대소문자 구분 안 함).|
|version|Integer|Y|`addshortcut` 명령어를 지원하는 네이버 앱 URL Scheme의 버전. 값을 `1`로 설정합니다.|

#### URL Scheme 예

- 기본 URL

```kotlin
naversearchapp://addshortcut?url=http%3A%2F%2Fm.nstore.naver.com&icon=http%3A%2F%2Fstatic.naver.net%2Fwww%2Fu%2F2012%2F0604%2Fnmms_153256734.png&title=N%EC%8A%A4%ED%86%A0%EC%96%B4&serviceCode=nstore&version=1
```

- Intent Scheme URL(Android용)

```kotlin
intent://addshortcut?url=http%3A%2F%2Fm.nstore.naver.com&icon=http%3A%2F%2Fstatic.naver.net%2Fwww%2Fu%2F2012%2F0604%2Fnmms_153256734.png&title=N%EC%8A%A4%ED%86%A0%EC%96%B4&serviceCode=nstore&version=1#Intent;scheme=naversearchapp;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=com.nhn.android.search;end
```