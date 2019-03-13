# Papago NMT 번역 API 레퍼런스

- [인공 신경망 기반 기계 번역](#인공-신경망-기반-기계-번역)
- [오류 코드](#오류-코드)

## 인공 신경망 기반 기계 번역

### 설명

인공 신경망 기반의 기계 번역 결과를 반환합니다.

### 요청 URL

```sh
https://openapi.naver.com/v1/papago/n2mt
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
|text|String|Y|번역할 텍스트. 1회 호출 시 최대 5,000자까지 번역할 수 있습니다.|
|honorific|Boolean|N|높임말 여부. 영한 번역 시에만 적용됩니다. 기본값은 false.|

Papago NMT 번역에서 사용하는 언어 코드는 다음과 같습니다.

|언어 코드|언어|
|---|---|
|ko|한국어|
|en|영어|
|ja|일본어|
|zh-CN|중국어 간체|
|zh-TW|중국어 번체|
|vi|베트남어|
|id|인도네시아어|
|th|태국어|
|de|독일어|
|ru|러시아어|
|es|스페인어|
|it|이탈리아어|
|fr|프랑스어|

번역할 수 있는 원본 언어와 목적 언어는 다음과 같습니다.

|원본 언어(언어 코드)||목적 언어(언어 코드)|\||원본 언어(언어 코드)||목적 언어(언어 코드)|
|---|:-:|---|:-:|---|:-:|---|
|한국어(ko)|&rarr;|영어(en)|\||영어(en)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|일본어(ja)|\||일본어(ja)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|중국어 간체(zh-CN)|\||중국어 간체(zh-CN)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|중국어 번체(zh-TW)|\||중국어 번체(zh-TW)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|베트남어(vi)|\||베트남어(vi)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|인도네시아어(id)|\||인도네시아어(id)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|태국어(th)|\||태국어(th)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|독일어(de)|\||독일어(de)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|러시아어(ru)|\||러시아어(ru)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|스페인어(es)|\||스페인어(es)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|이탈리아어(it)|\||이탈리아어(it)|&rarr;|한국어(ko)|
|한국어(ko)|&rarr;|프랑스어(fr)|\||프랑스어(fr)|&rarr;|한국어(ko)|
|영어(en)|&rarr;|일본어(ja)|\||일본어(ja)|&rarr;|영어(en)|
|영어(en)|&rarr;|프랑스어(fr)|\||프랑스어(fr)|&rarr;|영어(en)|
|영어(en)|&rarr;|중국어 간체(zh-CN)|\||중국어 간체(zh-CN)|&rarr;|영어(en)|
|영어(en)|&rarr;|중국어 번체(zh-TW)|\||중국어 번체(zh-TW)|&rarr;|영어(en)|
|일본어(ja)|&rarr;|중국어 간체(zh-CN)|\||중국어 간체(zh-CN)|&rarr;|일본어(ja)|\|
|일본어(ja)|&rarr;|중국어 번체(zh-TW)|\||중국어 번체(zh-TW)|&rarr;|일본어(ja)|
|중국어 간체(zh-CN)|&rarr;|중국어 번체(zh-TW)|\||중국어 번체(zh-TW)|&rarr;|중국어 간체(zh-CN)|

### 참고 사항

API를 요청할 때 다음 예와 같이 HTTP 요청 헤더에 [클라이언트 아이디와 클라이언트 시크릿](https://developers.naver.com/docs/common/openapiguide/appregister.md#클라이언트-아이디와-클라이언트-시크릿-확인)을 추가해야 합니다.

```sh
POST /v1/papago/n2mt HTTP/1.1
HOST: openapi.naver.com
User-Agent: curl/7.49.1
Accept: */*
Content-Type: application/x-www-form-urlencoded; charset=UTF-8
X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}
X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}
Content-Length: 51
```

### 요청 예

```sh
curl "https://openapi.naver.com/v1/papago/n2mt" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}" \
    -d "source=ko&target=en&text=만나서 반갑습니다." -v
```

### 응답

응답에 성공하면 결괏값을 JSON 형식으로 반환합니다.

|속성|타입|필수 여부|설명|
|---|---|:-:|----|
|srcLangType|String|Y|번역할 원본 언어의 언어 코드|
|tarLangType|String|Y|번역한 목적 언어의 언어 코드|
|translatedText|String|Y|번역된 텍스트|

### 응답 예

```json
{
    "message": {
        "@type": "response",
        "@service": "naverservice.nmt.proxy",
        "@version": "1.0.0",
        "result": {
            "srcLangType":"ko",
            "tarLangType":"en",
            "translatedText": "tea"
        }
    }
}
```

## 오류 코드

|오류 코드|HTTP 상태 코드|오류 메시지|
|---|---|----|
|N2MT01|400|source parameter is needed (source 파라미터가 필요합니다.)|
|N2MT02|400|Unsupported source language (지원하지 않는 source 언어입니다.)|
|N2MT03|400|target parameter is needed (target 파라미터가 필요합니다.)|
|N2MT04|400|Unsupported target language (지원하지 않는 target 언어입니다.)|
|N2MT05|400|source and target must be different (source와 target이 동일합니다.)|
|N2MT06|400|There is no source-to-target translator (source->target 번역기가 없습니다.)|
|N2MT07|400|text parameter is needed (text 파라미터가 필요합니다.)|
|N2MT08|400|text parameter exceeds max length (text 파라미터가 최대 용량을 초과했습니다.)|
|N2MT99|500|Internal server errors|

<div class="note"><p><strong>Internal server errors</strong></p>
<p>반환 받은 오류 메시지가 <strong>Internal server errors</strong>면 "<a href="https://developers.naver.com/forum" target="_blank">개발자 포럼</a>"에 오류를 신고해 주십시오.</p>  
</div>  

<div class="note"><p><strong>403 오류</strong></p>
<p>개발자 센터에 등록한 애플리케이션에서 Papago NMT 번역을 사용하도록 설정하지 않았다면 'API 권한 없음'을 의미하는 403 오류가 발생할 수 있습니다. 403 오류가 발생했다면 네이버 개발자 센터의 <strong><a href="https://developers.naver.com/apps/#/list" target="_blank">Application &gt; 내 애플리케이션</a></strong> 메뉴에서 오류가 발생한 애플리케이션의 <strong>API 설정</strong> 탭을 클릭한 다음 <strong>Papago NMT 번역</strong>이 선택돼 있는지 확인해 보십시오.</p>
</div>

<div class="info"><p><strong>참고</strong></p>
<p>네이버 오픈API 공통 오류 코드는 "<a href="https://developers.naver.com/docs/common/openapiguide/" target="_blank">API 공통 가이드</a>"의 '<a href="https://developers.naver.com/docs/common/openapiguide/errorcode.md" target="_blank">오류 코드</a>'를 참고하십시오.</p>  
</div>  
