---
title: 이미지 캡차 API 적용 가이드 - API 레퍼런스
description: 이미지 캡차 API는 자동 입력 방지를 위해 사람의 눈으로 식별 가능한 문자가 포함된 이미지를 전송하고 입력값을 검증하는 RESTful API입니다.
---

이미지 캡차 API 레퍼런스
====================

* [캡차 키 발급 요청](#캡차-키-발급-요청)
* [사용자 입력값 검증 요청](#사용자-입력값-검증-요청)
* [캡차 이미지 요청](#캡차-이미지-요청)
* [오류 코드](#오류-코드)

## 캡차 키 발급 요청

### 설명

캡차 키를 JSON 형식으로 반환합니다.

### 요청 URL

```sh
https://openapi.naver.com/v1/captcha/nkey
```

### 프로토콜

HTTPS

### HTTP 메서드

GET

### 파라미터

|파라미터|타입|필수 여부|설명|
|---|---|:-:|----|
|code|Integer|N|요청하는 작업의 코드(기본값: `0`). 캡차 키 발급을 요청할 때는 값을 `0`으로 설정해야 합니다.|

### 참고 사항

API를 요청할 때 다음 예와 같이 HTTP 요청 헤더에 [클라이언트 아이디와 클라이언트 시크릿](https://developers.naver.com/docs/common/openapiguide/appregister.md#클라이언트-아이디와-클라이언트-시크릿-확인)을 추가해야 합니다.

```sh
> GET /v1/captcha/nkey?code=0 HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}
```

### 요청 예

```sh
curl "https://openapi.naver.com/v1/captcha/nkey?code=0" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}" -v
```

### 응답

응답에 성공하면 결괏값을 JSON 형식으로 반환합니다.

|속성|타입|설명|
|---|---|----|
|key|string|캡차 키|

### 응답 예

```sh
< HTTP/1.1 200 OK
< Server: nginx
< Date: Tue, 04 Oct 2016 05:20:47 GMT
< Content-Type: text/plain;charset=UTF-8
< Content-Length: 26
< Connection: keep-alive
< Keep-Alive: timeout=5
< Vary: Accept-Encoding
< Pragma: no-cache
< Expires: Thu, 01 Jan 1970 00:00:00 GMT
< Cache-Control: no-cache
< Cache-Control: no-store
<
* Connection #0 to host openapi.naver.com left intact
{"key":"t521bp3qM7Qyk2X2"}
```

## 사용자 입력값 검증 요청

### 설명

캡차 이미지를 보고 사용자가 입력한 값이 올바른 값인지 검증한 결과를 JSON 형식으로 반환합니다.

### 요청 URL

```sh
https://openapi.naver.com/v1/captcha/nkey
```

### 프로토콜

HTTPS

### HTTP 메서드

GET

### 파라미터

|파라미터|타입|필수 여부|설명|
|---|---|:-:|----|
|code|Integer|Y|요청하는 작업의 코드. 사용자 입력값 검증을 요청할 때는 값을 `1`로 설정해야 합니다.|
|key|String|Y|발급 받은 캡차 키|
|value|String|Y|캡차 이미지를 보고 사용자가 입력한 값|

### 참고 사항

API를 요청할 때 다음 예와 같이 HTTP 요청 헤더에 [클라이언트 아이디와 클라이언트 시크릿](https://developers.naver.com/docs/common/openapiguide/appregister.md#클라이언트-아이디와-클라이언트-시크릿-확인)을 추가해야 합니다.

```sh
> GET /v1/captcha/nkey?code=1&key=eioDb7T8M703uht0&value=1PUNUST HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}
```

### 요청 예

```sh
curl "https://openapi.naver.com/v1/captcha/nkey?code=1&key=eioDb7T8M703uht0&value=1PUNUST" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}" -v
```

### 응답

응답에 성공하면 결괏값을 JSON 형식으로 반환합니다.

|속성|타입|설명|
|---|---|----|
|result|boolean|검증 결과.<br/>- `true`: 사용자가 입력한 값이 올바른 값입니다.<br/>- `false`: 사용자가 입력한 값이 올바른 값이 아닙니다.|
|responseTime|string|사용자가 값을 입력하는 데 걸린 시간(단위: 초). 0~7200 사이의 값을 반환합니다. 시간을 계산할 수 없거나 7200초를 초과했을 때는 `-1`을 반환합니다.|

### 응답 예

```sh
< HTTP/1.1 403 Forbidden
< Server: nginx
< Date: Tue, 04 Oct 2016 05:25:21 GMT
< Content-Type: application/json;charset=UTF-8
< Content-Length: 66
< Connection: keep-alive
< Keep-Alive: timeout=5
< Vary: Accept-Encoding
< Pragma: no-cache
< Expires: Thu, 01 Jan 1970 00:00:00 GMT
< Cache-Control: no-cache
< Cache-Control: no-store
* Connection #0 to host openapi.naver.com left intact
{"result":true,"responseTime":84.6}
```

## 캡차 이미지 요청

### 설명

캡차 이미지를 JPEG 형식의 이미지 데이터로 반환합니다.

### 요청 URL

```sh
https://openapi.naver.com/v1/captcha/ncaptcha.bin
```

### 프로토콜

HTTPS

### HTTP 메서드

GET

### 파라미터

|파라미터|타입|필수 여부|설명|
|---|---|:-:|----|
|key|String|Y|발급 받은 캡차 키|

### 참고 사항

API를 요청할 때 다음 예와 같이 HTTP 요청 헤더에 [클라이언트 아이디와 클라이언트 시크릿](https://developers.naver.com/docs/common/openapiguide/appregister.md#클라이언트-아이디와-클라이언트-시크릿-확인)을 추가해야 합니다.

```sh
> GET /v1/captcha/ncaptcha.bin?key=t521bp3qM7Qyk2X2 HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}
```

### 요청 예

```sh
curl "https://openapi.naver.com/v1/captcha/ncaptcha.bin?key=t521bp3qM7Qyk2X2" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}" -v > out.wav
```

### 응답

응답에 성공하면 JPEG 형식의 이미지 데이터를 반환합니다.

### 응답 예

```sh
< HTTP/1.1 200 OK
< Server: nginx
< Date: Tue, 04 Oct 2016 05:21:24 GMT
< Content-Type: image/jpeg;charset=UTF-8
< Transfer-Encoding: chunked
< Connection: keep-alive
< Keep-Alive: timeout=5
< Pragma: no-cache
< Expires: Thu, 01 Jan 1970 00:00:00 GMT
< Cache-Control: no-cache
< Cache-Control: no-store
```

## 오류 코드

이미지 캡차 API의 주요 오류 코드는 다음과 같습니다.

|오류 코드|HTTP 상태 코드|오류 메시지|설명|
|---|---|----|----|
|CT001|403|Invalid key. (키가 만료되거나 없는 키)|캡차 키가 없거나 만료된 캡차 키입니다. 캡차 키 발급을 다시 요청하고 새로운 캡차 키를 발급받으십시오.|
|CT002|400|Unissued image(이미지 발급을 하지 않음)|캡차 이미지가 발급되지 않았습니다. 캡차 키 발급을 다시 요청하고 새로운 캡차 키를 발급받은 다음 캡차 이미지를 요청하십시오.|
|CT500|500|System error|서버 내부에 오류가 발생했습니다. "[개발자 포럼](https://developers.naver.com/forum)"에 오류를 신고해 주십시오.|

> **403 오류**  
> 개발자 센터에 등록한 애플리케이션에서 이미지 캡차를 사용하도록 설정하지 않았다면 'API 권한 없음'을 의미하는 403 오류가 발생할 수 있습니다. 403 오류가 발생했다면 네이버 개발자 센터의 **[Application &gt; 내 애플리케이션](https://developers.naver.com/apps/#/list)** 메뉴에서 오류가 발생한 애플리케이션의 **API 설정** 탭을 클릭한 다음 **캡차 (이미지)**<!-- -->가 선택돼 있는지 확인해 보십시오.  

> **참고**  
> 네이버 오픈API 공통 오류 코드는 "[API 공통 가이드](https://developers.naver.com/docs/common/openapiguide/)"의 '[오류 코드](https://developers.naver.com/docs/common/openapiguide/errorcode.md)'를 참고하십시오.  
