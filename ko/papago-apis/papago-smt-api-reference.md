# Papago SMT 번역 API 레퍼런스

- [통계 기반 기계 번역](#통계-기반-기계-번역)
- [오류 코드](#오류-코드)

## 통계 기반 기계 번역

### 설명

통계 기반의 기계 번역 결과를 반환합니다.

### 요청 URL

```sh
https://openapi.naver.com/v1/language/translate
```

### 프로토콜

HTTPS

### HTTP 메서드

POST

### 파라미터

|파라미터|타입|필수 여부|설명|
|---|---|:-:|----|
|source|String|Y|원본 언어(source language)의 언어 코드|
|target|String|Y|목적 언어(target language)의 언어 코드|
|text|String|Y|번역할 텍스트. UTF-8로 인코딩되어야 합니다. 1회 호출 시 최대 5,000자까지 번역할 수 있습니다.|

Papago SMT 번역에서 사용하는 언어 코드는 다음과 같습니다.

|언어 코드|언어|
|---|---|
|ko|한국어|
|en|영어|
|ja|일본어|
|zh-CN|중국어 간체|
|zh-TW|중국어 번체|

번역할 수 있는 원본 언어와 목적 언어는 다음과 같습니다.

|원본 언어(언어 코드)||목적 언어(언어 코드)|\||원본 언어(언어 코드)||목적 언어(언어 코드)|
|---|:-:|---|:-:|---|:-:|---|
|한국어(ko)|&rarr;|영어(en)|\||영어(en)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|일본어(ja)|\||일본어(ja)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|중국어 간체(zh-CN)|\||중국어 간체(zh-CN)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|중국어 번체(zh-TW)|\||중국어 번체(zh-TW)|&rarr;|한국어(ko)|


### 참고 사항

API를 요청할 때 다음 예와 같이 HTTP 요청 헤더에 [클라이언트 아이디와 클라이언트 시크릿](https://developers.naver.com/docs/common/openapiguide/appregister.md#클라이언트-아이디와-클라이언트-시크릿-확인)을 추가해야 합니다.

```sh
> POST /v1/language/translate HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> Content-Type: application/x-www-form-urlencoded; charset=UTF-8
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}
> Content-Length: 51
>
```

### 요청 예

```sh
curl "https://openapi.naver.com/v1/language/translate" \
    -d "source=ko&target=en&text=만나서 반갑습니다." \
    -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}" -v
```

### 응답

응답에 성공하면 결괏값을 JSON 형식으로 반환합니다.

|속성|타입|필수 여부|설명|
|---|---|:-:|----|
|translatedText|String|Y|번역된 문장|

### 응답 예

```sh
< HTTP/1.1 200 OK
< Server: nginx
< Date: Wed, 28 Sep 2016 06:48:40 GMT
< Content-Type: application/json;charset=utf-8
< Content-Length: 136
< Connection: keep-alive
< Keep-Alive: timeout=5
< Vary: Accept-Encoding
< X-QUOTA: 10
<
* Connection #0 to host openapi.naver.com left intact
{"message":
    {"@type":"response",
        "@service":"naverservice.labs.api",
        "@version":"1.0.0",
        "result":
            {"translatedText":"So glad to see you."}
    }
}
```

## 오류 코드

|오류 코드|HTTP 상태 코드|오류 메시지|
|---|---|----|
|TR01|400|source parameter is needed (source 파라미터가 필요합니다.)|
|TR02|400|Unsupported source language (지원하지 않는 source 언어입니다.)|
|TR03|400|target parameter is needed (target 파라미터가 필요합니다.)|
|TR04|400|Unsupported target language (지원하지 않는 target 언어입니다.)|
|TR05|400|source and target must be different (source와 target이 동일합니다.)|
|TR06|400|There is no source-to-target translator (source->target 번역기가 없습니다.)|
|TR07|400|text parameter is needed (text 파라미터가 필요합니다.)|
|TR08|400|text parameter exceeds max bytes (text 파라미터가 최대 용량을 초과했습니다.)|
|TR99|500|Internal server error|

<div class="note"><p><strong>Internal server errors</strong></p>
<p>반환 받은 오류 메시지가 <strong>Internal server errors</strong>면 "<a href="https://developers.naver.com/forum" target="_blank">개발자 포럼</a>"에 오류를 신고해 주십시오.</p>  
</div>  

<div class="note"><p><strong>403 오류</strong></p>
<p>개발자 센터에 등록한 애플리케이션에서 Papago SMT 번역을 사용하도록 설정하지 않았다면 'API 권한 없음'을 의미하는 403 오류가 발생할 수 있습니다. 403 오류가 발생했다면 네이버 개발자 센터의 <strong><a href="https://developers.naver.com/apps/#/list" target="_blank">Application &gt; 내 애플리케이션</a></strong> 메뉴에서 오류가 발생한 애플리케이션의 <strong>API 설정</strong> 탭을 클릭한 다음 <strong>Papago SMT 번역</strong>이 선택돼 있는지 확인해 보십시오.</p>
</div>

<div class="info"><p><strong>참고</strong></p>
<p>네이버 오픈API 공통 오류 코드는 "<a href="https://developers.naver.com/docs/common/openapiguide/" target="_blank">API 공통 가이드</a>"의 '<a href="https://developers.naver.com/docs/common/openapiguide/errorcode.md" target="_blank">오류 코드</a>'를 참고하십시오.</p>  
</div>  
