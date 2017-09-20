# 샘플 코드

## 로그인 방식 오픈 API 호출 예

다음은 네이버 회원 프로필을 조회하는 API를 호출하는 코드를 Java로 작성한 예입니다.

네이버 아이디로 로그인해서 획득한 접근 토큰을 요청 헤더에 추가해 프로필 조회 API를 RESTful API 방식으로 호출합니다. 반환받은 결괏값은 JSON 형식으로 출력합니다.

```java
{% include 'https://raw.githubusercontent.com/naver/naver-openapi-guide/draft/sample/java/APIExamMemberProfile.java' %}
```

## 비로그인 방식 오픈 API 호출 예

다음은 Papago 번역 API를 호출하는 코드를 Java로 작성한 예입니다.

클라이언트 아이디와 클라이언트 시크릿을 요청 헤더에 추가해 Papago NMT API를 RESTful API 방식으로 호출합니다. 반환받은 결괏값은 JSON 형태로 출력합니다.

```java
{% include 'https://raw.githubusercontent.com/naver/naver-openapi-guide/draft/sample/java/APIExamTranslateNMT.java' %}
```
