# 한글 인명-로마자 변환 API 레퍼런스

> **지원 종료 안내**
>
> 한글 인명-로마자 변환 기능의 지원이 **2024년 1월 17일(수)**<!-- -->부로 종료됐습니다.

- [한글 인명-로마자 변환](#한글-인명-로마자-변환)
- [오류 코드](#오류-코드)

## 한글 인명-로마자 변환

### 설명

한글로 된 이름을 로마자 표기로 변환한 결과를 반환합니다.

### 요청 URL

```sh
https://openapi.naver.com/v1/krdict/romanization
```

### 프로토콜

HTTPS

### HTTP 메서드

- GET
- POST

### 파라미터

|파라미터|타입|필수 여부|설명|
|---|---|:-:|----|
|query|String|Y|로마자로 변환할 한글 이름|

### 참고 사항

API를 요청할 때 다음 예와 같이 HTTP 요청 헤더에 [클라이언트 아이디와 클라이언트 시크릿](https://developers.naver.com/docs/common/openapiguide/appregister.md#클라이언트-아이디와-클라이언트-시크릿-확인)을 추가해야 합니다.

```sh
> GET /v1/krdict/romanization?query=%EA%B9%80%EC%A0%95%ED%99%98 HTTP/1.1
> Host: openapi.naver.com
> User-Agent: curl/7.49.1
> Accept: */*
> X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}
> X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}
>
```

### 요청 예

```sh
curl "https://openapi.naver.com/v1/krdict/romanization?query=%EA%B9%80%EC%A0%95%ED%99%98" \
    -H "X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}" \
    -H "X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}" -v
```

### 응답

응답에 성공하면 결괏값을 JSON 형식으로 반환합니다.

|속성|타입|필수 여부|설명|
|---|---|:-:|----|
|sFirstName|String|Y|한글 이름의 성에 해당하는 유니코드 값|
|aItems|String 배열|Y|로마자로 변환된 이름의 배열|
|name|String|Y|변환된 로마자 이름|
|score|Integer|Y|로마자 이름의 빈도수|

### 응답 예

```sh
< HTTP/1.1 200 OK
< Server: nginx
< Date: Wed, 28 Sep 2016 06:54:30 GMT
< Content-Type: application/json;charset=utf-8
< Content-Length: 271
< Connection: keep-alive
< Keep-Alive: timeout=5
< Vary: Accept-Encoding
<
* Connection #0 to host openapi.naver.com left intact
{
    "aResult":[
        {
            "sFirstName":"\uae40","aItems":[
                {"name":"Kim Junghwan","score":"99"},
                {"name":"Kim Jeonghwan","score":"70"},
                {"name":"Kim Jungwhan","score":"39"},
                {"name":"Kim Jeongwhan","score":"27"},
                {"name":"Kim Jenghwan","score":"21"},
                {"name":"Kim Jengwhan","score":"8"}
            ]
        }
    ]
}
```

## 오류 코드

|오류 코드|HTTP 상태 코드|오류 메시지|해결 방법|
|---|---|----|----|
|400|400|Incorrect query request (잘못된 쿼리요청입니다.)|API 레퍼런스에서 필수 요청 변수를 확인합니다.|
|024|401|Authentication failed. (인증에 실패했습니다.)|클라이언트 아이디와 클라이언트 시크릿이 정확한지 확인바랍니다.|
|024|401|Scope Status Invalid|[**내 애플리케이션**](https://developers.naver.com/apps/#/list) 메뉴의 **API 설정** 탭에서 **한글인명-로마자변환**이 선택돼 있는지 확인합니다.|
|072|403|HTTPS only allowed : Unsupported protocol (지원하지 않는 프로토콜입니다.)|API 요청 URL의 프로토콜이 HTTPS인지 확인합니다.|
|051|404|API does not exist. (존재하지 않는 API입니다.)|API 요청 URL에 오류가 있는지 확인합니다.|

> **403 오류**  
> 개발자 센터에 등록한 애플리케이션에서 한글 인명-로마자 변환을 사용하도록 설정하지 않았다면 'API 권한 없음'을 의미하는 403 오류가 발생할 수 있습니다. 403 오류가 발생했다면 네이버 개발자 센터의 [**Application &gt; 내 애플리케이션**](https://developers.naver.com/apps/#/list) 메뉴에서 오류가 발생한 애플리케이션의 **API 설정** 탭을 클릭한 다음 **한글인명-로마자변환**<!-- -->이 선택돼 있는지 확인해 보십시오.

> **참고**  
> 네이버 오픈API 공통 오류 코드는 "[API 공통 가이드](https://developers.naver.com/docs/common/openapiguide/)"의 '[오류 코드](https://developers.naver.com/docs/common/openapiguide/errorcode.md)'를 참고하십시오.  
