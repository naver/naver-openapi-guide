---
title: 네이버 로그인 개발가이드
description: 네이버 로그인 개발가이드
---
네이버 로그인 개발가이드
=================

[[TOC]]

# 1. 개요

**4,200만 네이버 회원을 여러분의 사용자로!**<br/>
네이버 회원이라면, 여러분의 사이트를 간편하게 이용할 수 있습니다.<br/>
전 국민 모두가 가지고 있는 네이버 아이디 한 개만 있으면 별도 가입 없이 어떤 플랫폼에서도 간편하게 로그인할 수 있습니다.

**동의한 사용자 정보를 조회**<br/>
이름, 이메일, 별명, 생일, 연령대, 성별 등의 사용자 정보를 API로 간단한 조회를 통해 얻을 수 있습니다.<br/>
또한 마케팅에 활용할 수 있는  카페, 캘린더 등 다양한 네이버 서비스들과의 매시업이 가능합니다. 

**빠른 개발, 간편한 운영**<br/>
플랫폼별 SDK를 제공하여 쉽고 빠르게 개발할 수 있도록 지원합니다.<br/>
또한 환경별 로그인, 누적 사용자 등 다양한 통계를 제공하여 성과를 확인할 수 있습니다.

# 2. 네이버 로그인 서비스 소개

## 2.1 네이버 로그인 서비스에 대하여

네이버 로그인 서비스는 네이버가 아닌 다른 서비스에서 네이버의 사용자 인증 기능을 이용할 수 있게 하는 서비스입니다.<br/>
별도의 아이디나 비밀번호를 기억할 필요 없이 네이버 아이디로 간편하고 안전하게 서비스에 로그인할 수 있어, 가입이 귀찮거나 가입한 계정이 생각나지 않아 서비스를 이탈하는 사용자를 잡고 싶다면 네이버 로그인을 사용해 보세요. 

## 2.2 제공하는 기능

네이버 로그인은 다음과 같은 서비스를 제공합니다.

### 2.2.1 소셜 로그인

네이버 로그인을 사용하면 복잡하고 번거로운 회원 가입 절차 대신 빠르고 안전한 네이버 로그인으로 간편하게 서비스를 이용할 수 있습니다.<br/>
여러가지 개인정보 입력과 본인인증에 대한 불편함, 쉽게 잊어버릴 수 있는 ID와 비밀번호에 대해 고민할 필요가 없습니다.

네이버의 4,200만 사용자가 여러분과 함께 할 고객입니다.<br/>
쉽고 간편한 로그인을 제공하여 사용자에게 편리함을 선물하세요.

![social_login.png](./images/social_login.png)


### 2.2.2 로그인 연동 회원 프로필 조회

네이버 로그인을 적용한 경우 네이버 로그인 연동 사용자의 프로필 정보를 동의 하에 얻을 수 있으며 서비스에 활용할 수 있습니다.<br/>
프로필 정보는 사용자의 이름, 메일 주소, 별명, 프로필 사진, 생일, 연령대, 성별 정보가 포함되며 API로 간단하게 조회할 수 있습니다.


### 2.2.3 네이버의 로그인 오픈API 이용

네이버 로그인을 활용해 로그인 오픈 API(로그인이 되어야만 사용할 수 있는 오픈 API)로 제공되는 네이버 서비스를 이용할 수 있습니다.<br/>
네이버 로그인을 이용하여 로그인한 사용자가 애플리케이션에서 캘린더에 일정을 담을 수 있으며 카페에 가입하고 게시판에 글을 쓸 수 있습니다.<br/>
네이버 로그인을 이용할 수 있는 오픈 API는 계속해서 추가할 예정입니다.<br/>
자세한 내용은 개발자 센터의 API 사용 가이드를 참고해 주세요. 

[API 사용가이드 바로가기 >](../../common/openapiguide/apilist.md)


### 2.2.4 서비스 이용 통계 제공 

네이버 로그인을 적용할 경우 별도의 통계정보를 구축하지 않더라도 개발자센터의 로그인 통계 메뉴를 통해서 간편하게 서비스 이용 통계를 확인할 수 있습니다.

![statistics.png](./images/statistics.png)

### 2.2.5 네이버 로그인 뱃지

애플리케이션 등록 시 서비스 URL과 네이버 검색에 노출되는 사이트 URL이 동일하면 아래 그림과 같이 네이버 검색결과에서 네이버 로그인 뱃지가 노출됩니다.

![badge.png](./images/badge.png)

네이버 로그인 뱃지 적용을 통해 사용자로 하여금 안심하여 이용 가능한 서비스임을 알리고 또한 네이버 검색을 통한 사용자 유입의 증대를 기대할 수 있습니다.

## 2.3 서비스 환경

네이버 로그인은 다양한 서비스 환경을 지원하고 있습니다.<br/>
서비스 환경에 맞게 네이버 로그인을 적용하여 보다 효과적인 사용자 환경을 제공할 수 있습니다. 

### 2.3.1 웹/모바일 웹 서비스

네이버 로그인은 웹/모바일웹 서비스 환경에서 모두 사용이 가능합니다.<br/>
네이버 로그인은 oAuth 2.0 오픈 프로토콜을 통해 서비스가 되고 있습니다.<br/>
oAuth2.0 오픈소스 라이브러리를 이용하여 다양한 개발 환경에서 손쉽게 적용이 가능합니다.<br/>
또한 javascript plugin를 제공하여 좀 더 쉽고 간편하게 적용이 가능합니다.

[javascript sdk 바로가기 >](/web/web.md)

### 2.3.2 모바일 앱

네이버 로그인은 다양한 서비스 환경을 지원하기 위하여 모바일 앱 용 SDK를 제공하고 있습니다.<br/>
모바일 앱 용 SDK를 이용하여 네이버 로그인을 적용할 경우 개발작업이 보다 쉽고 간편해지며 서비스 이용자도 쉽게 네이버 로그인을 이용할 수 있어서 서비스에 큰 도움이 됩니다.<br/>
네이버에서는 현재 iOS와 Android 용 SDK를 제공하고 있습니다.

[iOS 개발가이드 바로가기 >](/ios/ios.md)

[Andorid 개발가이드 바로가기 >](/android/android.md)

### 2.3.3 브라우저 및 모바일 OS 호환성

네이버에서 개발편의를 위하여 제공하는 SDK는 아래 버전에서 원활히 동작합니다.

***Javascript SDK***

* 필요 라이브러리 
  * jQuery 1.10.0 이상
* IE 7 버전 이상
* 기타 모던 브라우저 (사파리, 파이어폭스, 크롬 등)

***Android SDK***

* 지원 안드로이드 OS 버전
  * 안드로이드 2.2 버전 이상

***iOS SDK***

* 지원 iOS 버전
  * iOS 7 버전 이상

***개발 환경에 따라서 다양한 3rdParty opensource library가 제공되고 있습니다.***

[3rdParty opensource library 바로가기 >](/sdks_external/sdks_external.md)

# 3. 네이버 로그인 적용

## 3.1 네이버 로그인 적용 전 점검 사항

### 3.1.1 서비스 환경 확인

네이버 로그인 서비스에 적용하기 위해서는 먼저 본인의 서비스 환경에 대한 확인이 필요합니다.<br/>
네이버 로그인 지원 환경은 아래와 같이 크게 4개의 환경으로 구분할 수 있습니다.

* PCWEB / MOBILEWEB : 웹서비스 환경
* Android : 안드로이드 애플리케이션 환경
* iOS : iOS애플리케이션 환경
* Windows : 윈도우즈 데스크탑 프로그램 환경

각각의 서비스 환경에 따라 애플리케이션 등록 방법 및 개발 방법이 다소 차이가 날 수 있습니다.


### 3.1.2 애플리케이션 등록

네이버 로그인을 적용하기 위해서는 먼저 'Application-애플리케이션 등록' 메뉴에서 애플리케이션을 등록하여야 합니다.<br/>
애플리케이션 등록에 대한 가이드는 아래의 링크에서 확인이 가능합니다.

[애플리케이션 등록 가이드 바로가기 >](../../common/openapiguide/appregister.md)


### 3.1.3 필수 항목 확인

네이버 개발자센터에 애플리케이션 등록이 완료되면 개발자센터의 'Application-내 애플리케이션' 메뉴에서 등록된 애플리케이션에 대한 확인이 가능합니다.<br/>
네이버 로그인의 올바른 적용을 위해서 필수적으로 확인이 필요한 사항은 다음과 같습니다.

1. 애플리케이션 이름은 명확하고 간결하게 작성이 되어야합니다
2. 애플리케이션 이름은 네이버 로그인 연동 시 사용자에게 보여지는 항목이므로 "의미를 알수 없는 문자" 또는 "서비스와 관련없는 이름"은 사용하지 말아야 합니다.
3. 로고이미지는 규격을 준수하며 서비스를 대표할수 있는 이미지로 설정하여야합니다.<br/>
   로고이미지는 네이버 로그인 연동 시 사용자에게 보여지는 항목으로 서비스를 대표할수 있는 아이콘 또는 이미지여야합니다.
4. 추가 정보 입력을 위하여 사용 API에 "네이버 로그인(네이버 로그인)"를 반드시 선택하여야합니다.<br/>
   로그인 오픈API 서비스 환경은 반드시 1개 이상의 서비스 환경을 선택하여야합니다.
5. 웹 서비스 환경에서는 서비스의 대표 URL(홈페이지 URL)이 정확하게 입력이 되어야합니다.
6. 애플리케이션 환경에서는 애플리케이션의 기본 설정 정보 중 AppScheme 과 package name을 반드시 확인하여 정확하게 입력이 되어야합니다.

### 3.1.4 사전 검수 요청

개발이 완료되어 실제 서비스에 적용하고자 한다면 애플리케이션 검수 요청을 등록해야 합니다. **검수가 완료되어 승인이 될 경우에만 로그인 가능한 아이디의 제한 없이 네이버 로그인을 정상적으로 이용할 수 있습니다.**

검수 기준, 검수 신청 방법, 검수 자료 제출 요령 등은 네이버 로그인 검수 가이드를 참고해 주세요. 

검수 기준에 맞춰 네이버 로그인이 적용될 수 있도록 설계 단계부터 검수 가이드에 소개된 검수 기준을 숙지하시길 권장 드립니다.

[검수 가이드 바로가기 >](/verify/verify.md)

### 3.1.5 FAQ

네이버 로그인 적용과 관련된 여러가지 궁금한 사항들은 FAQ 페이지에서 찾아보실 수 있습니다.

[FAQ 바로가기 >](../../../products/intro/faq/faq.md)

## 3.2 네이버 로그인 버튼 적용 가이드


### 3.2.1  네이버 로그인 적용 사이트 A,B 왜 이렇게 다를까요?

![img_intro_naveridlogin01.png](./images/img_intro_naveridlogin01.png)

두 업체 모두 네이버 로그인을 적용했지만 적용 효과는 확연히 차이가 납니다.</br>
업체 B는 사용자가 소셜로그인에 기대하는 핵심 가치를 제대로 구현하지 않았기 때문입니다.</br>
어떻게 해야 업체 A처럼 확실한 효과를 볼 수 있을지 알려 드리겠습니다.</br>
다음 내용을 꼭 읽어 보시고 여러분의 사이트와 앱에는 어떻게 적용할지 생각해 보세요. 

### 3.2.2 네이버 로그인 버튼을 한눈에 알아볼 수 있게 제공하세요

사용자는 로그인 창에서 아이디와 비밀번호를 입력하는 데 집중하기 때문에 주변의 요소는 잘 인지하지 못합니다.<br/>
네이버 로그인 버튼이 로그인 페이지에서 눈에 띄게 드러나지 않는다면 사용자는 네이버 아이디로 간편하게 로그인할 수 있다는 것을 알지 못하기 때문에, 적용할 때 기대했던 서비스 활성화 효과를 얻지 못하게 됩니다. 

![img_intro_naveridlogin02.png](./images/img_intro_naveridlogin02.png)

**그럼 로그인 페이지를 어떻게 디자인 해야 하나요?**

***독립적인 로그인 화면으로 공간이 넉넉한 경우***
 
![img_intro_naveridlogin03.png](./images/img_intro_naveridlogin03.png)


***공간에 제약이 있는 경우***

![img_intro_naveridlogin04.png](./images/img_intro_naveridlogin04.png)


***PC와 모바일 환경 모두에 네이버 로그인 버튼을 사용합니다.***  

![img_intro_naveridlogin05.png](./images/img_intro_naveridlogin05.png)


### 3.2.3 가입 과정에서 정보는 최소한으로 수집하세요

사용자는 네이버 로그인을 통해 로그인하면 별도의 가입 절차 없이 바로 서비스를 이용할 수 있기를 기대합니다.<br/>
그러나 가입 과정에서 휴대폰 인증을 요구하거나 주소 등과 같은 추가 정보를 과다하게 요구해 ‘네이버 계정으로 간편하게 이용한다’는 느낌을 주지 못한다면 많은 사용자가 ‘별도의 가입 절차’ 앞에서 이탈하게 됩니다.<br/>
추가 정보는 필요한 시점에 수집해 저장하는 것이 좋습니다. 필요할 때 요구하는 정보는 사용자도 당연하다고 느낍니다. 서비스를 이용하도록 하는 것이 우선이라는 것을 기억하세요. 

또한 이미 네이버 아이디와 패스워드를 입력해 로그인 했는데 별도의 아이디와 패스워드를 한번 더 만들도록 요구한다면 사용자를 매우 불편하게 만드는 절차입니다.  다른 정보에 비해 아이디와 패스워드는 입력 조건이 까다로워 사용자는 더 번거롭게 느낄 수 있습니다.<br/>
‘네이버 로그인’ 연결에 대한 동의 절차에 바로 이어지는 회원 가입 페이지에서 별도의 비밀번호를 입력 받지 않도록 하세요. 이는 매우 중요한 부분이며 미준수시 이용이 제한될 수 있습니다.

![img_intro_naveridlogin07.png](./images/img_intro_naveridlogin07.png)

### 3.2.4 네이버 로그인을 가입과 로그인에 모두 적용하세요 

가입 화면과 로그인 화면에 모두 네이버 로그인을 적용하고 두 페이지가 자연스럽게 연결되게 하세요.

사이트에 처음 방문한 사용자는 일반적으로 ‘가입하기’를 클릭하기 때문에, 로그인 화면에만 네이버 로그인을 적용한다면 네이버 로그인의 효과는 떨어질 수 밖에 없습니다. 가입 화면과 로그인 화면에 모두 네이버 로그인을 적용해 어디로 접근하든 네이버 로그인을 이용할 수 있게 하세요. 

![img_intro_naveridlogin10.png](./images/img_intro_naveridlogin10.png)


### 3.2.5 네이버 로그인 SDK를 이용해 개발하세요

네이버 로그인은 JavaScript와 Android, iOS를 지원하는 SDK를 제공합니다. SDK에는 샘플 애플리케이션이 포함되어 있으며 이를 이용해 로그인 인증부터 API 호출까지 매우 쉽게 구현할 수 있습니다.

[네이버 로그인 SDK 다운로드 >](/sdks/sdks.md)

또한 모바일 애플리케이션을 개발할 때 SDK를 이용하면 네이버 앱을 이용한 간편 로그인을 사용할 수 있어 사용자가 훨씬 편하게 로그인할 수 있습니다. 

### 3.2.6 네이버 로그인 버튼 이미지와 관련하여 

네이버 로그인은 애플리케이션에 사용할 수 있는 네이버 로그인 버튼 기본 이미지를 제공합니다.<br/>
애플리케이션의 상황에 맞게 버튼 이미지의 디자인을 변경할 수 있지만 네이버 고유의 아이덴티티를 유지할수 있도록 다음의 가이드라인을 최대로 유지하는것을 권장합니다.

[로그인 버튼 사용 가이드 바로가기 >](/bi/bi.md)

iOS SDK 또는 Android SDK를 이용하여 네이버 로그인을 적용한 경우에는 SDK 자체에서 버튼 리소스를 제공하고 있습니다.

## 3.3 회원 정보 확인 및 기존 회원과의 연동

### 3.3.1 네이버 로그인 회원의 프로필 정보

네이버 로그인 연동을 성공적으로 완료하면 연동 결과로 접근 토큰을 얻을 수 있습니다.<br/>
접근 토큰을 이용하여 사용자 프로필 정보를 조회할 수 있습니다.

제공가능한 프로필 정보

* 이용자 식별자 (네이버 ID가 아닌 고유 식별자)
* 이름
* 닉네임 (네이버 별명)
* 프로필 이미지 (네이버 내정보 프로필 이미지 URL)
* 이메일 주소 (네이버 내정보 이메일)
* 생일
* 연령대
* 성별
* 출생연도
* 휴대전화번호

각각의 프로필 정보의 규격은 다음과 같습니다.

* 이용자 식별자 : 64자 이내로 구성된 BASE64 형식의 문자열
    * (2021년 5월 1일 이후 생성된 애플리케이션부터 적용. 기존 INT64 규격의 숫자)
* 이름 : 10자 이내로 구성된 문자열
* 닉네임 : 20자 이내로 구성된 문자열
* 프로필 이미지 : 255자 이내로 구성된 URL 형태의 문자열 
* 이메일 주소 : 이메일 규격의 문자열
* 생일 : 월-일 (MM-DD) 형태의 문자열
* 연령대 : 연령 구간에 따라 0-9 / 10-19 / 20-29 / 30-39 / 40-49 / 50-59 / 60- 으로 표현된 문자열 
* 성별 : M/F (남성/여성) 으로 표된 문자
* 출생연도 : 연(YYYY) 형태의 문자열
* 휴대전화번호 : 대쉬(-)를 포함한 휴대전화번호 문자열

프로필 정보 예시

* 이용자 식별자 : abcdefgABCDEFG1234567
* 이름 : 네이버
* 닉네임 : 네이버닉네임
* 프로필 이미지 : https://phinf.pstatic.net/.../image.jpg
* 이메일 주소 : naveridlogin@naver.com
* 생일 : 08-15
* 연령대 : 20-29
* 성별 : F
* 출생연도 : 1900
* 휴대전화번호 : 010-0000-0000

***네이버에서 제공하는 프로필 정보 중 "이용자 식별자"를 제외한 프로필정보는 사용자의 선택에 따라서 제공이 되지 않을수 있습니다.***

### 3.3.2 로그인한 회원의 네이버 로그인 사용 여부

네이버 로그인을 이용하여 로그인 연동을 수행한 사용자는 각각의 사용자를 구별하기 위한 사용자 유니크ID를 가지고 있습니다.<br/>
이용자 식별자는 프로필 정보 조회 API를 통하여 조회할수 있는 정보입니다.

이용자 식별자 (Unique Identifier)

* 64자 이내로 구성된 BASE64 형식의 문자열
    * (2021년 5월 1일 이후 생성된 애플리케이션부터 적용. 기존 애플리케이션은 INT64 규격의 숫자로 구성)
* 네이버 아이디 별로 고유하게 부여된 값
* 애플리케이션간에는 이용자 식별자가 공유되지 않습니다. 

서비스에서는 이용자 식별자를 네이버 로그인 사용자 식별값으로 이용하여 사용자 정보를 조회하거나 가입 등의 처리를 할 수 있습니다.


### 3.3.3 기존 회원을 네이버 로그인에 연동

기존 서비스에 회원을 이미 가지고 있는 경우, 중복 가입을 최소화하기 위하여 다음과 같은 정보를 이용할 수 있습니다.<br/>
네이버 로그인을 통한 연동 사용자는 일반적으로 이용자 식별자를 이용하여 식별할 수 있습니다.<br/>
이용자 식별자 이외에 네이버에서 제공하는 사용자 프로필 정보를 이용하여 기존 가입 사용자를 특정하는것이 가능합니다.

네이버에서 제공하는 사용자 기반 프로필 정보

* 이메일 주소
* 성별
* 이름
* 연령대
* 생일

처음 연동을 수행하는 사용자의 경우 (데이터 베이스에 동일한 유니크 ID를 지니는 사용자가 없는 경우) 위에 나열한 사용자 프로필 정보의 조합으로 사용자 정보를 조회하여 기존 사용자 계정에 네이버 로그인 계정을 "연동"하는것이 가능합니다.

일반적으로 다음과 같은 상황에서 적용하는것이 적합합니다.

* 서비스의 기존 회원체계가 존재
* 기존 서비스 가입자의 경우 서비스 고유 정보(포인트, 게시글 등)를 유지하고자 하는 요구사항이 있음
* 기존 서비스 가입자에 대해 서비스 고유 정보를 유지하며 로그인 과정을 간소화(네이버 로그인을 통해 로그인)

### 3.3.4 사용자 프로필 항목 선택적 제공에 대하여 

네이버 로그인을 이용하여 로그인 연동을 수행한 사용자가 최초 연동 시점에서 특정 프로필 항목에 대하여 ***제공하지않음***으로 선택할 수 있습니다. 

![naveridlogin_user_profile_2018.png](./images/naveridlogin_user_profile_2018.png)

네이버에서 기본으로 제공하는 프로필 항목은 ***이용자 식별자***이며 기본 제공항목을 제외한 프로필 항목은 모두 사용자 선택에 따라 프로필 정보 조회 API응답으로 전달될지 결정이 됩니다. 

애플리케이션에서도 제공받을 프로필 항목을 "내 애플리케이션" 메뉴를 통해서 선택이 가능합니다. 해당 메뉴를 통해 제공을 원치 않는 프로필 항목에 대해서 ***제공받지않음***으로 선택할 수 있습니다.

각 프로필 항목별로 ***필수 제공 항목***과 ***추가 제공 항목*** 중에 선택할 수 있는데요. ***필수 제공 항목***은 사용자가 내 서비스를 사용함에 있어 반드시 제공 받아야 하는 정보입니다.
네이버 로그인에서는 ***이용자 식별자***을 제외한 모든 프로필 항목을 사용자가 선택적으로 제공하도록 되어 있는데요. 적어도 필수적으로 받아야 하는 항목을 사용자에게 노출시킴으로서 제공이 거부되지 않도록 하고 있습니다. 
다만 이 때에도 사용자는 각 항목에 대해 제공 여부를 선택할 수 있으며, 기본적으로 각 항목이 ***체크(제공)*** 상태로 노출됩니다. ***추가 제공 항목***은 사용자에게 추가적으로 제공 받기를 원하는 정보이며, 기본적으로 각 항목이 ***체크 해제(제공하지않음)*** 상태로 노출됩니다.

![naveridlogin_user_profile_setting_2018.png](./images/naveridlogin_user_profile_setting_2018.png)


### 3.3.5 사용자가 거부한 프로필 권한에 대한 처리

사용자는 네이버 로그인 연동 동의시점에 사용자의 결정에 따라서 특정 프로필 항목을 ***제공하지않음***으로 선택할 수 있습니다. 이러한 경우 서비스는 거부한 프로필 항목에 대하여 프로필 조회를 통해 정보를 얻을 수 없습니다. 

서비스에서는 다음과 같이 선택하여 거부된 권한에 대하여 처리가 가능합니다.

1. 서비스에서는 추가적인 처리 없이 거부된 프로필 항목을 획득하지 않은 상태로 서비스를 계속 진행할 수 있습니다.
2. 서비스에서는 거부된 프로필 항목에 대해서 개별적으로 사용자에게 직접 입력받아서 서비스를 계속 진행할 수 있습니다.
3. 서비스에서는 거부된 프로필 항목에 대해서 해당 항목을 전달받기 위한 사유를 충분히 고지하고 다시한번 사용자 동의를 받을 수 있습니다. 관련 사항은 다음의 항목을 참고시기 바랍니다. (가이드 5.1.5 항목)


## 3.4 네이버 로그인 연동 개발하기

### 3.4.1 네이버 로그인 연동을 개발하기에 앞서

네이버 로그인을 적용하기 위해서는 먼저 네이버 개발자센터를 통해 애플리케이션을 등록하여야합니다.<br/>
개발자센터의 '내 애플리케이션' 메뉴에서 내가 등록한 애플리케이션의 Client ID와 Client Secret 값을 확인할 수 있습니다.

**ClientID와 ClientSecret에 대하여**

Client ID와 Client Secret은 내 애플리케이션을 구분해주는 중요한 정보입니다. 반드시 안전하게 보관하시기 바랍니다.<br/>
또한 네이버 로그인 연동 과정에서 활용되는 정보입니다. 잘못된 Client ID / Client Secret 정보를 사용하게 되면 연동이 실패할 수 있습니다.<br/>
한 번 발급이 된 Client ID는 변경이 불가능합니다. 하지만 Client Secret 정보는 개발자센터를 통해 재발급 받는것이 가능합니다.<br/>
Client Secret의 유출이 의심되면 재발급을 통해 도용을 방지할 수 있습니다.

***Client ID와 Client Secret의 규격***

* Client ID : 알파뱃 대소문자, 숫자가 조합된 40자리 이하의 문자열
* Client Secret : 알파뱃 대소문자, 숫자가 조합된 40자리 이하의 문자열

**API 권한에 대하여**

네이버 로그인을 이용하면 네이버에서 제공하는 로그인 오픈 API를 활용하여 서비스를 개발할 수 있습니다.<br/>
오픈 API를 이용하기 위해서는 애플리케이션에서 API를 호출할수 있도록 권한을 설정하여야합니다.
* API 권한 설정: '내 애플리케이션'의 'API 권한관리' 탭에서 사용하고자 하는 API에 대하여 권한을 설정 할 수 있습니다.

***API 호출권한이 없을 경우***

API 권한 설정을 하지 않았거나 네이버 로그인 시 사용자가 권한동의를 하지 않을 경우 API호출이 실패할 수 있습니다.<br/>
이에따라 원활한 API이용을 위해서는 권한 설정을 반드시 체크하여야 합니다.

![naveridlogin_user_profile_setting_2018.png](./images/naveridlogin_user_profile_setting_2018.png)

**등록정보가 올바르지 않을 경우**

만약 개발자센터의 애플리케이션 등록정보에서 서비스 URL 혹은 Callback URL 정보가 올바르지 않게 기입 또는 누락되거나
등록정보와 일치하지 않는 환경에서 네이버 로그인을 시도하는 경우 다음과 같이 로그인 과정에서 오류가 발생할 수 있습니다.<br/>
따라서 서비스 적용 전 반드시 등록정보가 올바르게 적용이 되어있는지 테스트를 수행하여야 합니다.

![invalid_login](./images/invalid_login.png)


### 3.4.2 네이버 로그인 연동 URL 생성하기

네이버 로그인 연동을 진행하기 위해서는 네이버 로그인 버튼을 클릭하였을 때 이동할 '네이버 로그인' URL을 먼저 생성하여야 합니다.<br/>
이 과정에서 사용자는 네이버에 로그인인증을 수행하고 네이버 로그인 연동 동의과정을 수행할 수 있습니다.<br/>
사용자가 로그인 연동에 동의하였을 경우 동의 정보를 포함하여 Callback URL로 전송됩니다.

***요청 URL 정보***

| 메서드 | 요청 URL | 출력 포맷 | 설명 | 
|:--:| ---- |:--:|:--:|
| GET / POST   |https://nid.naver.com/oauth2.0/authorize |  URL 리다이렉트   | 네이버 로그인 인증 요청|

***요청 변수 정보***

| 요청 변수명 |타입 |필수 여부 |기본값 |설명 |
|:--:|:-:|:-:|:-:|-----|
| response_type |string |Y |code |인증 과정에 대한 내부 구분값으로 'code'로 전송해야 함 |
| client_id |string |Y |- |애플리케이션 등록 시 발급받은 Client ID 값 |
| redirect_uri |string |Y |- |애플리케이션을 등록 시 입력한 Callback URL 값으로 URL 인코딩을 적용한 값 |
| state |string |Y |- |사이트 간 요청 위조(cross-site request forgery) 공격을 방지하기 위해 애플리케이션에서 생성한 상태 토큰값으로 URL 인코딩을 적용한 값을 사용 |

***요청문 샘플***

```text
https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=CLIENT_ID&state=STATE_STRING&redirect_uri=CALLBACK_URL
```

### 3.4.3 네이버 로그인 연동 결과 Callback 정보

네이버 로그인 인증 요청 API를 호출했을 때 사용자가 네이버로 로그인하지 않은 상태이면 네이버 로그인 화면으로 이동하고, 사용자가 네이버에 로그인한 상태이면 기본 정보 제공 동의 확인 화면으로 이동합니다.<br/>
네이버 로그인과 정보 제공 동의 과정이 완료되면 콜백 URL에 code값과 state 값이 URL 문자열로 전송됩니다. code 값은 접근 토큰 발급 요청에 사용합니다.<br/>
API 요청 실패시에는 에러 코드와 에러 메시지가 전송됩니다. 

***Callback 응답 정보***

* API 요청 성공시 : http://콜백URL/redirect?code={code값}&state={state값}
* API 요청 실패시 : http://콜백URL/redirect?state={state값}&error={에러코드값}&error_description={에러메시지}

|필드|타입|설명|
|:--:|:-:|-------|
|code|string|네이버 로그인 인증에 성공하면 반환받는 인증 코드, 접근 토큰(access token) 발급에 사용|
|state|string|사이트 간 요청 위조 공격을 방지하기 위해 애플리케이션에서 생성한 상태 토큰으로 URL 인코딩을 적용한 값|
|error|string|네이버 로그인 인증에 실패하면 반환받는 에러 코드|
|error_description|string|네이버 로그인 인증에 실패하면 반환받는 에러 메시지|

### 3.4.4 접근 토큰 발급 요청

Callback으로 전달받은 정보를 이용하여 접근 토큰을 발급받을 수 있습니다. 접근 토큰은 사용자가 인증을 완료했다는 것을 보장할 수 있는 인증 정보입니다.<br/>
이 접근 토큰을 이용하여 프로필 API를 호출하거나 오픈API를 호출하는것이 가능합니다.

Callback으로 전달받은 'code' 값을 이용하여 '접근토큰발급API'를 호출하게 되면 API 응답으로 접근토큰에 대한 정보를 받을 수 있습니다.<br/>
'code' 값을 이용한 API호출은 최초 1번만 수행할 수 있으며 접근 토큰 발급이 완료되면 사용된 'code'는 더 이상 재사용할수 없습니다.

***요청 URL 정보***

| 메서드 | 요청 URL | 출력 포맷 | 설명 | 
|:--:|-----|:-:| --- |
| GET / POST   |https://nid.naver.com/oauth2.0/token |  json    | 접근토큰 발급 요청|

***요청 변수 정보***

|요청 변수명 |타입 |필수 여부 |기본값 |설명|
|:--:|:-:|:-:|:-:|-----|
|grant_type |string |Y |- |인증 과정에 대한 구분값<br>1) 발급:'authorization_code'<br>2) 갱신:'refresh_token'<br>3) 삭제: 'delete'|
|client_id |string |Y |- |애플리케이션 등록 시 발급받은 Client ID 값|
|client_secret |string |Y |- |애플리케이션 등록 시 발급받은 Client secret 값|
|code |string |발급 때 필수 |- |로그인 인증 요청 API 호출에 성공하고 리턴받은 인증코드값 (authorization code)|
|state |string |발급 때 필수 |- |사이트 간 요청 위조(cross-site request forgery) 공격을 방지하기 위해 애플리케이션에서 생성한 상태 토큰값으로 URL 인코딩을 적용한 값을 사용|
|refresh_token |string |갱신 때 필수 |- |네이버 사용자 인증에 성공하고 발급받은 갱신 토큰(refresh token)|
|access_token |string |삭제 때 필수 |- |기 발급받은 접근 토큰으로 URL 인코딩을 적용한 값을 사용|
|service_provider |string |삭제 때 필수 |'NAVER' |인증 제공자 이름으로 'NAVER'로 세팅해 전송|

***요청문 샘플***

```text
https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=jyvqXeaVOVmV&client_secret=527300A0_COq1_XV33cf&code=EIc5bFrl4RibFls1&state=9kgsGTfH4j7IyAkg  
```

***응답 정보***

|필드 |타입 |설명|
|:--:|:--:|-----|
|access_token |string |접근 토큰, 발급 후 expires_in 파라미터에 설정된 시간(초)이 지나면 만료됨|
|refresh_token |string |갱신 토큰, 접근 토큰이 만료될 경우 접근 토큰을 다시 발급받을 때 사용|
|token_type |string |접근 토큰의 타입으로 Bearer와 MAC의 두 가지를 지원|
|expires_in |integer |접근 토큰의 유효 기간(초 단위)|
|error |string |에러 코드|
|error_description |string |에러 메시지|


### 3.4.5 접근 토큰을 이용하여 프로필 API 호출하기 

접근 토큰을 이용하면 프로필 정보 조회 API를 호출하거나 오픈 API를 호출하는것이 가능합니다.<br/>
사용자 로그인 정보를 획득하기 위해서는 프로필 정보 조회 API를 먼저 호출하여야 합니다.

***요청 URL 정보***

| 메서드 | 인증 | 요청 URL | 출력 포맷 | 설명 | 
| :--: | :--: | ------ |  :--: | -- |
| GET / POST   | OAuth2.0 | https://openapi.naver.com/v1/nid/me |  JSON   | 프로필 정보 조회  |

***요청 변수 정보***

요청 변수는 별도로 없으며, 요청 URL로 호출할 때 아래와 같이 요청 헤더에 접근 토큰 값을 전달하면 됩니다.

***요청 헤더***

| 요청 헤더명  | 설명 |
| :--: | -------- | 
| Authorization |  접근 토큰(access token)을 전달하는 헤더<br>다음과 같은 형식으로 헤더 값에 접근 토큰(access token)을 포함합니다. 토큰 타입은 "Bearer"로 값이 고정되어 있습니다.<br> Authorization: {토큰 타입] {접근 토큰] |

***요청문 예시***

```shell
curl  -XGET "https://openapi.naver.com/v1/nid/me" \
      -H "Authorization: Bearer AAAAPIuf0L+qfDkMABQ3IJ8heq2mlw71DojBj3oc2Z6OxMQESVSrtR0dbvsiQbPbP1/cxva23n7mQShtfK4pchdk/rc="
```

***출력 결과***

|필드 |타입 |필수 여부 |설명|
|:--:|:-:|:-:|------|
|resultcode |String |Y |API 호출 결과 코드|
|message |String |Y |호출 결과 메시지|
|response/id |String |Y |동일인 식별 정보<br>동일인 식별 정보는 네이버 아이디마다 고유하게 발급되는 값입니다.|
|response/nickname |String |Y |사용자 별명|
|response/name |String |Y |사용자 이름|
|response/email |String |Y |사용자 메일 주소|
|response/gender |String |Y |성별<br>- F: 여성<br>- M: 남성<br>- U: 확인불가|
|response/age |String |Y |사용자 연령대|
|response/birthday |String |Y |사용자 생일(MM-DD 형식)|
|response/profile_image |String |Y |사용자 프로필 사진 URL|
|response/birthyear |String |Y |출생연도|
|response/mobile |String |Y |휴대전화번호|

### 3.4.6 접근 토큰을 이용하여 사용자 허용 프로필 권한 확인하기 

접근 토큰을 이용하여 사용자가 제공을 허용한 프로필의 항목을 확인하는것이 가능합니다.<br />
특정 사용자 프로필 항목이 서비스 운영에 필수적으로 필요한 경우 프로필 조회에 앞서 먼저 제공 항목을 확인하는것이 좋습니다.

***요청 URL 정보***

| 메서드 | 인증 | 요청 URL | 출력 포맷 | 설명 |
|:---:|:---:|--------|:--:|---|
| GET / POST   | OAuth2.0 | https://openapi.naver.com/v1/nid/verify |  JSON   | 접근 토큰 검증 및 권한 확인  |

***요청 변수 정보***

|요청 변수명 |타입 |필수 여부 |기본값 |설명|
|:--:|:-:|:-:|:-:|-----|
|info |boolean |N |false | true일 경우 권한 설정정보 응답|


***요청 헤더***

| 요청 헤더명  | 설명 |
| :--: | -------- | 
| Authorization |  접근 토큰(access token)을 전달하는 헤더<br>다음과 같은 형식으로 헤더 값에 접근 토큰(access token)을 포함합니다. 토큰 타입은 "Bearer"로 값이 고정되어 있습니다.<br> Authorization: {토큰 타입] {접근 토큰] |

***요청문 예시***

```shell
curl  -XGET "https://openapi.naver.com/v1/nid/me" \
      -H "Authorization: Bearer AAAAPIuf0L+qfDkMABQ3IJ8heq2mlw71DojBj3oc2Z6OxMQESVSrtR0dbvsiQbPbP1/cxva23n7mQShtfK4pchdk/rc="
```

***출력 결과***

|필드 |타입 |필수 여부 |설명|
|:--:|:-:|:-:|------|
|resultcode |String |Y |API 호출 결과 코드|
|message |String |Y |호출 결과 메시지|
|response/token |String |Y |접근토큰|
|response/expire_date |String |Y |접근토큰만료시각|
|response/allowed_profile |String |Y |허용 프로필 항목(쉼표로 구분)|


## 3.5 네이버의 로그인오픈 API의 이용
로그인을 해야 사용할 수 있는 네이버의 다양한 오픈 API들을 사용할 수 있습니다. 여기에서는 그 중 주요 세 가지 로그인 오픈 API 에 대해 설명합니다.

### 3.5.1 카페 오픈 API

이제 카페 API를 통해 서비스에서부터 공식카페까지 자연스럽게 연결할 수 있습니다.<br/>
대한민국 대표 커뮤니티, 네이버 카페의 접근성을 높여 운영하시는 서비스의 커뮤니티를 더욱 알차게 만들어 보세요! 

[카페 오픈 API 소개 바로가기 >](../../../products/login/cafe/cafe.md)

[카페 오픈 API 개발가이드 바로가기 >](/cafe-api/cafe-api.md)

### 3.5.2 캘린더 오픈 API

캘린더 API를 통해 네이버 로그인 연동 유저의 네이버 캘린더에 일정을 등록하고 일정 미리 알림을 받을 수 있습니다.<br/>
1200만 다운로드에 빛나는 1위 캘린더앱 ‘네이버 캘린더’를 통해 유저에게 주요 일정도 홍보하고 서비스 참여도도 높이세요! 

[캘린더 오픈 API 소개 바로가기 >](../../../products/login/calendar/calendar.md)

[캘린더 오픈 API 개발가이드 바로가기 >](/calendar-api/calendar-api.md)


# 4. 시스템에 네이버 로그인 정보 유지

## 4.1 기존 로그인 시스템에 네이버 로그인 적용하기

많은 서비스들이 이미 회원 체계와 로그인 시스템을 가지고 있습니다. 이러한 환경에서도 네이버 로그인을 적용하여 기존의 로그인과 동일하게 동작하도록 처리할 수 있습니다. 

### 4.1.1 Database의 구성

일반적인 회원 시스템은 사용자 개인정보와 아이디 비밀번호를 지닌 구조일 것입니다.<br/>
네이버 로그인은 아이디/비밀번호를 통해 인증을 수행하는 구조가 아니기때문에 기존 회원 시스템을 변경해야할 필요가 있습니다.<br/>
네이버 로그인 사용자 정보를 기존 회원정보 시스템에 저장하기 위해서는 다음과 같이 데이터베이스 변경작업이 필요합니다.


***일반적인 회원 데이터베이스 구조***

![simple_login_database_model.png](./images/simple_login_database_model.png)

***테이블 구조 및 테이블 생성 SQL예시(MYSQL)***

```sql
CREATE  TABLE `USERS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NULL ,
  `password` VARCHAR(50) NULL ,
  `email` VARCHAR(100) NULL ,
  `nickname` VARCHAR(50) NULL ,
  `mobile` VARCHAR(20) NULL ,
  `create_date` DATETIME NULL ,
  `modify_date` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `idx1_username` (`username` ASC) ,
  INDEX `idx2_email` (`email` ASC) 
);
```

```shell
mysql> desc USERS;
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| username    | varchar(50)  | YES  | MUL | NULL    |                |
| password    | varchar(50)  | YES  |     | NULL    |                |
| email       | varchar(100) | YES  | MUL | NULL    |                |
| nickname    | varchar(50)  | YES  |     | NULL    |                |
| mobile      | varchar(20)  | YES  |     | NULL    |                |
| create_date | datetime     | YES  |     | NULL    |                |
| modify_date | datetime     | YES  |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+
8 rows in set (0.00 sec)
```

***회원 가입 및 회원정보 조회 SQL***

```html
  <select id="selectUserById" resultMap="userResultMap">
    select id, username, password, email, nickname, mobile from users
    where id = #{id}
  </select>

  <select id="selectUserByUserName" resultMap="userResultMap">
    select id, username, password, email, nickname, mobile from users
    where username = #{userName}
  </select>
  
  <insert id="insertNormalUser" parameterType="User">
    insert into  users(username, password, email, nickname, mobile, create_date, modify_date )
      values  (#{userName}, #{password},#{email}, #{nickName}, #{mobile}, now(), now())
    <selectKey resultType="int" keyProperty="id" order="AFTER">
      SELECT LAST_INSERT_ID()
    </selectKey>
  </insert>
```

네이버 로그인을 적용하게 되면 위의 회원 정보 데이터베이스 환경에서 네이버 로그인 사용자 정보를 연동할수 있는 별도의 테이블 구성이 필요합니다.<br/>
네이버 로그인 연동 사용자의 프로필 정보를 이용하여 기존 사용자 정보를 매핑하거나 신규 사용자로 등록하는것이 가능합니다.<br/>
데이터베이스는 일반적으로 아래와 같이 구성이 가능합니다.

***네이버 로그인 연동을 위한 테이블 구성***

![extern_table_for_sns_login.png](./images/extern_table_for_sns_login.png)


***네이버 로그인 사용자 정보를 저장하기 위한 테이블 구조 및 생성 SQL예시(MYSQL)***

```sql
CREATE TABLE `SNS_INFO` (
  `id` int(11) NOT NULL,
  `sns_id` varchar(255) NOT NULL,
  `sns_type` varchar(10)  NULL,
  `sns_name` varchar(255)  NULL,
  `sns_profile` varchar(255)  NULL,
  `sns_connect_date` datetime  NULL,
  KEY `idx01_id` (`id`),
  KEY `idx02_sns_id` (`sns_id`),
  CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `USERS` (`id`)
);
```

```shell
mysql> desc SNS_INFO;
+------------------+--------------+------+-----+---------+-------+
| Field            | Type         | Null | Key | Default | Extra |
+------------------+--------------+------+-----+---------+-------+
| id               | int(11)      | NO   | MUL | NULL    |       |
| sns_id           | varchar(255) | NO   | MUL | NULL    |       |
| sns_type         | varchar(10)  | YES  |     | NULL    |       |
| sns_name         | varchar(255) | YES  |     | NULL    |       |
| sns_profile      | varchar(255) | YES  |     | NULL    |       |
| sns_connect_date | datetime     | YES  |     | NULL    |       |
+------------------+--------------+------+-----+---------+-------+
6 rows in set (0.01 sec)
```


### 4.1.2 사용자 연동 처리 및 로그인 처리

네이버 로그인을 적용하였다면 ID/PW 대신 네이버 로그인을 통해서 로그인 처리가 가능합니다.<br/>
프로필 정보로 전달받은 사용자 유니크 ID정보를 앞서 데이터베이스에 저장하였고 또 이 정보를 데이터베이스의 키로 사용하였기때문에 아래와 같이 사용자 유니크 ID정보로 사용자 정보를 조회할 수 있습니다.
```html
  <select id="selectSnsUserBySnsId" resultMap="snsUserResultMap">
    select a.username,
    a.email,
    a.nickname,
    a.create_date,
    a.modify_date,
    b.sns_id,
    b.sns_type,
    b.sns_name,
    b.sns_profile,
    b.sns_connect_date
    from users a,
    sns_info b
    where
    a.id = b.id
    AND b.sns_id = #{snsId}
  </select>
```

사용자에 대한 인증은 네이버 로그인을 통한 인증으로 대체가 되었기 때문에 비밀번호에 대한 검증이 추가로 필요하지 않습니다.<br/>
사용자에 대한 조회가 완료되었을 경우 세션에 로그인 정보를 발행하거나 쿠키로 로그인 정보를 발행하여 로그인 상태로 만들 수 있습니다.

## 4.2 신규 시스템에 네이버 로그인 적용하기

### 4.2.1 Database의 구성

신규 서비스에 네이버 로그인을 통한 회원 체계를 구성하기 위해서는 회원 정보를 저장할 데이터베이스가 마련이 되어야합니다.<br/>
회원 정보를 저장하거나 조회할수 있는 기능이 기본적으로 구현이 되어있어야 하기때문에 아래와 같은 형태의 간단한 회원정보 데이터 베이스를 구성을 하고 필요에 따라 또는 서비스의 정책에 따라 변경하면 됩니다.

***네이버 로그인 연동을 위한 테이블 구성***

![db_scheme_01.png](./images/db_scheme_01.png)

***네이버 로그인 사용자 정보를 저장하기 위한 테이블 구조 및 생성 SQL예시(MYSQL)***

```sql
CREATE  TABLE `USERS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NULL ,
  `email` VARCHAR(100) NULL ,
  `nickname` VARCHAR(50) NULL ,
  `sns_id` VARCHAR(255) NULL ,
  `sns_type` varchar(10)  NULL,
  `sns_profile` varchar(255)  NULL,
  `create_date` DATETIME NULL ,
  `modify_date` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `idx1_username` (`username` ASC) ,
  INDEX `idx2_email` (`email` ASC),
  INDEX `idx3_sns_id` (`sns_id` ASC), 
);
```

```shell
mysql> desc USERS;
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| username    | varchar(50)  | YES  | MUL | NULL    |                |
| email       | varchar(100) | YES  | MUL | NULL    |                |
| nickname    | varchar(50)  | YES  |     | NULL    |                |
| sns_id      | varchar(255  | YES  |     | NULL    |                |
| sns_type    | varchar(10)  | YES  |     | NULL    |                |
| sns_profile | varchar(255) | YES  |     | NULL    |                |
| create_date | datetime     | YES  |     | NULL    |                |
| modify_date | datetime     | YES  |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+
8 rows in set (0.00 sec)
```


### 4.2.2 네이버 로그인을 통한 회원 가입

네이버 로그인을 통하여 얻은 사용자 프로필 정보 중 사용자 유니크 ID 정보를 이용하여 사용자를 식별할 수 있습니다.<br/>
이 식별값은 사용자가 이미 가입한 사용자인지 신규 연동 사용자인지 확인할수 있는 중요한 정보로써 데이터베이스의 키로 사용할 수 있습니다.

```html
  <insert id="insertSnsUser" parameterType="SnsUser">
    insert into
    sns_info(id, sns_id, sns_type, sns_name, sns_profile,
    sns_connect_date)
    values (#{id}, #{snsId}, #{snsType}, #{snsName}, #{snsProfile}, now() )
  </insert>
```

네이버 로그인 프로필 정보는 사용자 정보를 대체할수 있는 정보로 활용할 수 있으며 추가적으로 필요한 정보는 별도의 입력화면을 통해 입력 받는것도 가능합니다.


### 4.2.3 네이버 로그인을 통한 로그인 / 로그아웃의 구현 

네이버 로그인을 적용하였다면 ID/PW 대신 네이버 로그인을 통해서 로그인 처리가 가능합니다.<br/>
프로필 정보로 전달받은 사용자 유니크 ID정보를 앞서 데이터베이스에 저장하였고 또 이 정보를 데이터베이스의 키로 사용하였기때문에 아래와 같이 사용자 유니크 ID정보로 사용자 정보를 조회할 수 있습니다.

```html
  <select id="selectSnsUserBySnsId" resultMap="snsUserResultMap">
    select a.username,
    a.email,
    a.nickname,
    a.create_date,
    a.modify_date,
    b.sns_id,
    b.sns_type,
    b.sns_name,
    b.sns_profile,
    b.sns_connect_date
    from users a,
    sns_info b
    where
    a.id = b.id
    AND b.sns_id = #{snsId}
  </select>
```

사용자에 대한 인증은 네이버 로그인을 통한 인증으로 대체가 되었기 때문에 비밀번호에 대한 검증이 추가로 필요하지 않습니다.<br/>
사용자에 대한 조회가 완료되었을 경우 세션에 로그인 정보를 발행하거나 쿠키로 로그인 정보를 발행하여 로그인 상태로 만들 수 있습니다.



# 5. 네이버 로그인 사용자 프로필 갱신 및 재인증

## 5.1 네이버 로그인 사용자의 프로필 갱신

### 5.1.1 접근 토큰에 대하여

접근 토큰 발급 API를 통하여 접근 토큰 및 갱신 토큰을 발급받을수 있습니다.<br/>
접근 토큰은 다음과 같은 형식으로 이루어져 있습니다.<br/>

***접근 토큰 API 응답형태***

```json
{
  "access_token": "접근토큰(Access Token)",
  "refresh_token": "갱신토큰(Refresh Token)",
  "token_type": "접근토큰 타입(bearer)",
  "expires_in": "유효시간(초)"
}
```

***접근 토큰 규격***

접근 토큰은 아래와 같은 규격을 지니고 있습니다.

* access_token : 알파벳 대소문자, 숫자, 특수문자( +/= )가 조합된 256자리 이하의 문자열
* refresh_token : 알파벳 대소문자, 숫자가 조합된 256자리 이하의 문자열
* expires_in : 숫자, 발급 시점부터 expires_in(초) 후 까지 유효

***접근 토큰의 용도***

접근 토큰은 사용자 프로필 조회 API를 호출하거나 네이버에서 제공하는 로그인 OpenAPI를 이용할때 사용자 인증값으로 이용됩니다.

***접근 토큰 사용 방법***

접근 토큰을 이용하여 API를 호출하는 경우 다음과 같이 요청 헤더에 접근 토큰 값을 포함합니다.

* 요청 헤더명 : Authorization
* 요청 헤더값 형식 : TOKEN_TYPE ACCESS_TOKEN

***접근 토큰을 포함한 응답헤더 예시***

```text
Authorization: Bearer ACCESS_TOKEN
```

***접근 토큰을 이용한 API호출 예시***

```text
curl -XGET "https://openapi.naver.com/v1/nid/me" \
     -H "Authorization: Bearer ACCESS_TOKEN"

GET /v1/nid/me HTTP/1.1
Host: openapi.naver.com
User-Agent: curl/7.43.0
Accept: */*
Authorization: Bearer ACCESS_TOKEN
```


### 5.1.2 갱신 토큰에 대하여

접근 토큰은 접근 토큰 발급API를 통해 발급받은 시점부터 expires_in(초) 만큼만 유효합니다.<br/>
즉 발급 후 expires_in( 기본 3600초/ 1시간) 이내에만 사용이 가능하며 expires_in(초) 만큼의 시간이 지나게 되면 해당 접근 토큰은 더 이상 사용할 수 없습니다.

접근 토큰이 만료가 된 경우 접근 토큰과 함께 발급받은 갱신 토큰 (refresh token)을 이용하여 유효한 접근토큰을 재발급 받을 수 있습니다.<br/>
그렇기 때문에 갱신 토큰은 접근 토큰이 만료될 것을 대비하여 데이터베이스에 별도로 저장하고 이후 필요에 따라 갱신 토큰을 사용하면 됩니다.

갱신 토큰을 이용하여 접근 토큰을 재발급받는 방법은 아래와 같습니다.


***요청 URL 정보***

| 메서드 | 요청 URL | 출력 포맷 | 설명 | 
|:--:| ----- | :--: | ---- |
| GET / POST   |https://nid.naver.com/oauth2.0/token |  JSON  | 갱신토큰을 이용한 접근토큰 재발급 요청 |

***요청 변수 정보***

| 요청 변수명 |타입 |필수 여부 |기본값 |설명 |
| :--: | :-: | :-: | :-: | ----- |
| client_id |string |Y |- |애플리케이션 등록 시 발급받은 Client ID 값 |
| client_secret |string |Y |- |애플리케이션 등록 시 발급받은 Client Secret 값 |
| refresh_token |string |Y |- |접근토큰 발급API를 통하여 발급받은 갱신토큰 값|
| grant_type |string |Y |- | 요청 타입. refresh_token 으로 설정 |


***요청문 샘플***

```text
https://nid.naver.com/oauth2.0/token?grant_type=refresh_token&client_id=CLIENT_ID&client_secret=CLIENT_SECRET&refresh_token=REFRESH_TOKEN
```

***출력 결과***

|필드|타입|필수 여부|설명|
|:--:|:-:|:-:|-------|
|access_token|String|Y|재발급 받은 접근토큰  |
|token_type|String|Y|토큰 타입 (bearer) |
|expires_in|String|Y|접근토큰 유효성 체크 결과 메시지|

### 5.1.3 접근 토큰 만료와 갱신 주기. 프로필 정보의 갱신

접근 토큰은 만료일자에 따라 또는 접근 토큰 갱신, 삭제 등의 동작에 따라 유효하지 않게 될 수 있습니다.<br/>
유효하지 않은 접근 토큰으로는 프로필 정보를 조회하거나 로그인 OpenAPI를 호출할 수 없습니다.<br/>
따라서 접근 토큰이 유효하지 않은 경우에는 갱신토큰을 이용하여 유효한 접근 토큰으로 재발급 받거나 네이버 로그인 인증을 다시한번 수행하는것으로 유효한 접근 토큰을 발급받을 수 있습니다.

접근 토큰의 유효성을 판단하기 위해서는 다음과 같은 방법을 이용할 수 있습니다.

* 프로필 정보 조회 API 호출 시 응답이 정상적으로 전달될 경우 접근 토큰은 유효하다고 할 수 있습니다.
* 접근 토큰 유효성 체크 API 호출을 통해 현재 접근 토큰이 유효한지 판단할 수 있습니다.

접근 토큰 유효성 체크 API는 다음과 같이 이용 가능합니다.

***요청 URL 정보***

| 메서드 | 인증 | 요청 URL | 출력 포맷 | 설명 | 
| :--: | :--: | ------ |  :--: | --- |
| GET / POST   | OAuth2.0 | https://openapi.naver.com/v1/nid/me |  JSON   | 접근 토큰 유효성 체크 |

***요청 변수 정보***

요청 변수는 별도로 없으며, 요청 URL로 호출할 때 아래와 같이 요청 헤더에 접근 토큰 값을 전달하면 됩니다.

***요청 헤더***

| 요청 헤더명  | 설명 |
| :---: | ------------ | 
| Authorization |  접근 토큰(access token)을 전달하는 헤더다음과 같은 형식으로 헤더 값에 접근 토큰(access token)을 포함합니다. 토큰 타입은 "Bearer"로 값이 고정돼 있습니다. Authorization: {토큰 타입] {접근 토큰] |

***요청문 예시***

```shell
curl  -XGET "https://openapi.naver.com/v1/nid/verify" \
    -H "Authorization: Bearer AAAAPIuf0L+qfDkMABQ3IJ8heq2mlw71DojBj3oc2Z6OxMQESVSrtR0dbvsiQbPbP1/cxva23n7mQShtfK4pchdk/rc="

```

***출력 결과***

|필드|타입|필수 여부|설명|
|:-:|:-:|:-:|----|
|resultcode|String|Y|API 호출 결과 코드|
|message|String|Y|접근토큰 유효성 체크 결과 메시지|



### 5.1.4 프로필의 갱신       

네이버 로그인 사용자의 프로필 정보는 네이버 사용자의 정보 변경 여부에 따라 일부 정보가 변경될 수 있습니다.<br/>
변경이 가능한 정보는 다음과 같습니다.

* 이름 
* 닉네임
* 프로필이미지
* 이메일 주소
* 생일
* 성별
* 연령대
* 출생연도
* 휴대전화번호

사용자 정보가 변경이 되는 경우 네이버에서는 서비스에게 이 사실을 별도로 알려주지는 않고 있습니다.<br/>
따라서 주기적으로 또는 사용자 로그인이 발생할 때마다 프로필 정보를 조회하여 갱신하는것을 권장하고 있습니다.

### 5.1.5 사용자가 거부한 프로필 권한에 대하여 다시 동의를 수행하는 경우 

사용자는 네이버 로그인 최초 연동 동의과정에서 특정 프로필 항목에 대하여 ***제공하지않음***으로 선택할 수 있습니다. 이러한 경우 제공이 거부된 프로필 항목에 대해서는 프로필 조회로 정보를 얻을 수 없습니다. <br />
제공이 거부된 프로필 항목이 서비스 이용에 반드시 필요한 항목일 경우에는 사용자로 하여금 다시한번 동의로 선택하도록 **재동의**를 수행하는것이 가능합니다. 

네이버 로그인 재동의 API 명세는 다음과 같습니다.

***요청 URL 정보***

| 메서드 | 요청 URL | 출력 포맷 | 설명 | 
| :--: | ----- | :--: | --- |
| GET / POST   |https://nid.naver.com/oauth2.0/authorize |  URL 리다이렉트   | 네이버 로그인 인증 요청|

***요청 변수 정보***

| 요청 변수명 |타입 |필수 여부 |기본값 |설명 |
| :--: | :-: | :-: | :-: | -------- |
| response_type |string |Y |code |인증 과정에 대한 내부 구분값으로 'code'로 전송해야 함 |
| client_id |string |Y |- |애플리케이션 등록 시 발급받은 Client ID 값 |
| redirect_uri |string |Y |- |애플리케이션을 등록 시 입력한 Callback URL 값으로 URL 인코딩을 적용한 값 |
| state |string |Y |- |사이트 간 요청 위조(cross-site request forgery) 공격을 방지하기 위해 애플리케이션에서 생성한 상태 토큰값으로 URL 인코딩을 적용한 값을 사용 |
| auth_type | string | Y | - | 재동의 요청의 경우 'reprompt' 로 전송해야 함 |

***요청문 샘플***

```text
https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=CLIENT_ID&state=STATE_STRING&redirect_uri=CALLBACK_URL&auth_type=reprompt
```

위의 동작은 사용자가 권한을 거부한 경우에 대하여 다시한번 확인을 요청하는것이기 때문에 서비스에서 우선적으로 ***해당 항목이 반드시 필요한 사유***에 대해 충분히 고지하고 인증을 요청하시기 바랍니다.


## 5.2 재인증

### 5.2.1 사용자 재인증이 필요한 경우

접근 토큰이 유효하더라도 사용자로 하여금 다시한번 인증을 수행하여 계정보안 수준을 높이고자 할때, 
네이버 로그인 재인증을 통해서 네이버 사용자 인증을 수행할수 있습니다.

일반적으로 다음과 같은 상황에서 새로이 사용자 인증을 요구할 수 있습니다.

* 사용자의 개인정보 조회 또는 변경 페이지에 접근하는 경우 
* 사용자의 서비스 해지 또는 탈퇴를 수행하는 경우
* 사용자 계정 도용이 의심이 되어 사용자 확인이 필요한 경우

네이버 로그인 재인증은 다음과 같은 절차로 수행됩니다.

1. 네이버 로그인 재 인증 요청
2. 현재 로그인 상태와 관계없이 네이버 로그인 절차 요구
3. ID/PW입력
4. 인증 완료

네이버 로그인 재인증 API 명세는 다음과 같습니다.

***요청 URL 정보***

| 메서드 | 요청 URL | 출력 포맷 | 설명 | 
| :--: | ----- | :--: | --- |
| GET / POST   |https://nid.naver.com/oauth2.0/authorize |  URL 리다이렉트   | 네이버 로그인 인증 요청|

***요청 변수 정보***

| 요청 변수명 |타입 |필수 여부 |기본값 |설명 |
| :--: | :-: | :-: | :-: | -------- |
| response_type |string |Y |code |인증 과정에 대한 내부 구분값으로 'code'로 전송해야 함 |
| client_id |string |Y |- |애플리케이션 등록 시 발급받은 Client ID 값 |
| redirect_uri |string |Y |- |애플리케이션을 등록 시 입력한 Callback URL 값으로 URL 인코딩을 적용한 값 |
| state |string |Y |- |사이트 간 요청 위조(cross-site request forgery) 공격을 방지하기 위해 애플리케이션에서 생성한 상태 토큰값으로 URL 인코딩을 적용한 값을 사용 |
| auth_type | string | Y | - | 재인증 요청의 경우 'reauthenticate' 로 전송해야 함 |

***요청문 샘플***

```text
https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=CLIENT_ID&state=STATE_STRING&redirect_uri=CALLBACK_URL&auth_type=reauthenticate
```

이후 용법은 네이버 로그인 인증과 동일합니다.<br/>
네이버 로그인 인증 명세 바로가기

## 5.3 네이버 로그인 연동 해제 

### 5.3.1 네이버 로그인 연동 해제가 필요한 경우

사용자가 서비스를 더이상 이용하지 않거나 (서비스 탈퇴) 네이버 로그인의 연동을 더이상 이용하지 않을 경우 (연동 해제)<br/>
네이버 로그인 연동 해제 API를 통해 연결 관계를 끊을 수 있습니다.

연동 해제 API를 통해 성공적으로 연동이 해제되면 다음과 같이 변경사항이 적용됩니다.

* 앞서 발급받은 접근토큰과 갱신토큰은 API호출 즉시 만료처리됩니다. (더이상 접근토큰 및 갱신토큰을 이용할 수 없습니다.)
* 네이버의 "내정보>보안설정>외부사이트연결관리" 의 네이버 로그인 연동 목록에서 항목이 제거됩니다.
* 연동 해제 이후 사용자가 다시 연동을 수행할 수 있으며 연동 과정에서 사용자 동의를 새로이 받게 됩니다.

연동 해제는 아래와 같이 이용 가능합니다.

***요청 URL 정보***

| 메서드 | 요청 URL | 출력 포맷 | 설명 | 
| :--: | ----- | :--: | --- |
| GET / POST   |https://nid.naver.com/oauth2.0/token |  JSON  | 접근토큰을 이용한 연결해제 요청  |

***요청 변수 정보***

| 요청 변수명 |타입 |필수 여부 |기본값 |설명 |
| :---: | :---: | :---: | :---: | ---------- |
| client_id |string |Y |- |애플리케이션 등록 시 발급받은 Client ID 값 |
| client_secret |string |Y |- |애플리케이션 등록 시 발급받은 Client Secret 값 |
| access_token |string |Y |- |유효한 접근토큰 값|
| grant_type |string |Y |- | 요청 타입. delete 으로 설정 |


***요청문 샘플***

```text
https://nid.naver.com/oauth2.0/token?grant_type=delete&client_id=CLIENT_ID&client_secret=CLIENT_SECRET&access_token=ACCESS_TOKEN
```

***출력 결과***

|필드|타입|필수 여부|설명|
|:---:|:---:|:---:|----------|
|access_token|String|Y|삭제처리된 접근토큰  |
|result|String|Y| 처리결과 (success) |


**중요**

연동 해제 API에 사용되는 접근토큰은 반드시 유효한 접근토큰을 이용하여야 합니다.(만료된 토큰이나 존재하지 않는 토큰으로 연동해제 불가)<br/>
따라서 연동 해제를 수행하기 전에 접근토큰의 유효성을 점검하고 5.1의 접근토큰 갱신 과정에 따라 접근토큰을 갱신하는것을 권장합니다.

# 6. 네이버 로그인 부가 기능

## 6.1 네이버앱에서 서비스 자동로그인 처리

### 6.1.1 서비스 자동로그인이란

네이버 로그인을 통해 서비스를 이용한적이 있는 사용자가 네이버앱에서 서비스를 접근하는 경우, 사용자의 이용편의를 위하여 서비스에 자동으로 로그인된 상태로 전환하는 기능입니다.  

다음과 같은 상항에서 사용자의 로그인 과정을 간소화하여 편의를 제공할 수 있습니다.

* 네이버앱에서 검색을 통해 서비스에 접근하는 경우
* 네이버앱 즐겨찾기를 통해 서비스에 접근하는 경우
* 톡톡, 메일 등으로 전달된 링크를 통해 서비스에 접근하는 경우

자동 로그인은 다음과 같은 절차로 수행됩니다.

1. 자동 로그인 처리 가능 환경에 대한 체크
2. 네이버 로그인 연동 URL에 대한 처리
3. Callback 페이지에서 연동 처리 또는 오류 사항에 대한 처리
4. 로그인 완료


### 6.1.2 제약사항

본 기능은 "네이버앱"에서 서비스의 웹페이지를 접근하는 경우에만 수행이 가능한 기능합니다.

### 6.1.3 네이버앱 판별 조건 

네이버앱의 경우 특정 형식의 User-Agent를 지니고 있습니다. 따라서, 요청헤더의 User-Agent헤더를 통해 네이버앱 여부를 판별 가능합니다.

***판별 조건***

User-Agent 에 다음의 문자열이 포함되는지 확인

`NAVER(inapp; search;`

***네이버앱 User-Agent 샘플***

```
Mozilla/5.0 (iPhone; CPU iPhone OS like Mac OS X) AppleWebKit/605.1.15 NAVER(inapp; search; 620; 10.10.2; XR)
```

### 6.1.4 서비스 자동 로그인 명세

6.1.3의 조건에 부합하는 경우, 서비스에서는 302 redirect 처리 또는 javascript location replace 처리 등으로 사용자를 인증페이지로 이동시킵니다.

***요청 URL 정보***

| 메서드 | 요청 URL | 출력 포맷 | 설명 | 
| :--: | ----- | :--: | --- |
| GET / POST   |https://nid.naver.com/oauth2.0/authorize |  URL 리다이렉트   | 네이버 로그인 인증 요청|

***요청 변수 정보***

| 요청 변수명 |타입 |필수 여부 |기본값 |설명 |
| :--: | :-: | :-: | :-: | -------- |
| response_type |string |Y |code |인증 과정에 대한 내부 구분값으로 'code'로 전송해야 함 |
| client_id |string |Y |- |애플리케이션 등록 시 발급받은 Client ID 값 |
| redirect_uri |string |Y |- |애플리케이션을 등록 시 입력한 Callback URL 값으로 URL 인코딩을 적용한 값 |
| state |string |Y |- |사이트 간 요청 위조(cross-site request forgery) 공격을 방지하기 위해 애플리케이션에서 생성한 상태 토큰값으로 URL 인코딩을 적용한 값을 사용 |
| auth_type | string | Y | - | 자동로그인 요청의 경우 'autologin' 로 전송해야 함 |

***요청문 샘플***

```text
https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=CLIENT_ID&state=STATE_STRING&redirect_uri=CALLBACK_URL&auth_type=autologin
```

요청이 정상적으로 처리되면 recirect_uri (callback url) 로 처리 결과를 포함하여 페이지 Redirect 처리 됩니다. 정상적으로 자동로그인 대상으로 처리가 된 경우, 네이버 로그인 연동 callback 처리와 동일하게 처리하면 됩니다. (access token 발급 처리 후 로그인 처리)

### 6.1.5 오류 상태와 오류 코드 정의

정상적으로 자동로그인을 처리할 수 없는 경우에는 callback 페이지에 오류 코드를 파라미터로 전달합니다.

| 파라미터 | 타입 | 필수 여부 | 설명 |
| --- | --- | --- | --- |
| error | string | Y | 오류 코드 |
| error_description | string | Y | 오류 코드 상세 |

***오류 코드 및 메시지 정의***

| error 파라미터 | error_description 파라미터 | 설명 |
| --- | --- | --- |
| access_denied | user not logged in. | 네이버에 로그인된 상태가 아닙니다. |
| access_denied | need user consent. | 서비스에 연동된 사용자가 아닙니다. |
| access_denied | unsupported browser environment. | 네이버앱이 아닌 환경에서 접근하였습니다. |

***오류 처리 방안***

자동 로그인 처리 실패에 대한 오류코드를 콜백으로 전달받은 경우, 기존과 동일하게 로그인 버튼을 통해 로그인 할 수 있도록 처리가 필요합니다.


## 6.2 네이버 로그인 플러스

'네이버 로그인 플러스'는 서비스 가입에 필요한 약관 동의 대행 기능과 회원에게 마케팅 메시지 발송을 위한 톡톡 채널 연결까지 한번에 할 수 있는 기능입니다. 네이버 로그인 플러스를 적용하면 복잡한 가입 절차 없이 손쉽게 회원을 확보하고, 확보한 회원을 대상으로 네이버 톡톡을 이용해 다양한 마케팅/광고 메시지를 보낼 수 있습니다.


### 6.2.1 서비스 약관 동의 대행
#### 6.2.1.1 서비스 약관 동의 대행 기능이란?

네이버 로그인은 사용자 로그인 연동 외에 서비스의 이용에 필수적으로 필요한 "약관동의" 절차를 대행하는 기능을 제공하고 있습니다. 복잡한 동의 과정을 네이버 로그인을 통해 쉽고 편하게 제공하여 사용자의 편의를 높일 수 있습니다.

#### 6.2.1.2 약관 동의 대행 연동 전 확인 사항

- 개발가이드를 숙지하여, 네이버 로그인  연동에 필요한 사항들을 미리 점검합니다.
- 네이버 개발자센터를 통해 애플리케이션을 등록합니다. 
- 개발자센터의 "서비스 약관정보" 메뉴를 통해 약관동의 대행에 필요한 정보를 등록할 수 있습니다.
- 서비스 약관 정보가 허위로 등록되거나 실제 서비스의 약관과 다를 경우 검수가 반려될 수 있으며, 또한 이미 서비스 이용중이더라도 "적용사"의 귀책사유로 이용이 제한될 수 있습니다.

#### 6.2.1.3 주요 설정 정보

* 만 14세 이상만 가입 가능 
	* 만 14세 미만 사용자에게 서비스를 제공하지 않는 경우 '만 14세 이상만 가입 가능' 설정을 할 수 있습니다.
	* '만 14세 이상만 가입 가능'으로 체크한 경우 네이버 사용자의 연령 정보를 체크하여 만 14세 미만 사용자는 서비스에 가입되지 않도록 처리되며, 연령 정보가 없는 사용자는 동의 과정에서 [만 14세 이상입니다] 항목을 체크하고 가입할 수 있도록 동의 항목을 노출합니다.
* 약관정보는 복수개의 정보를 등록할 수 있으며, 필수 등록사항은 다음과 같습니다.
	* 약관 제목 (국문명) : 연동과정에서의 정보제공동의화면에서 노출할 약관 제목
	* 약관 제목 (영문명) : 연동과정에서의 정보제공동의화면에서 노출할 약관 제목
	* 약관 URL  : 약관 세부 정보를 확인할 수 있는 웹페이지의 URL
	* 약관 태그 : 약관을 구분하는데 필요한 값
	* 필수/선택 여부 : '필수동의'는 사용자가 동의하지 않을 경우 가입이 불가하며, '선택동의'는 사용자가 동의하지 않아도 가입을 진행할 수 있습니다.

### 6.2.1.4 약관 동의 대행 설정 화면 예시

![img_set_agreement_01.png](./images/img_set_agreement_01.png)


### 6.2.1.5 약관 동의 대행 이용 화면 예시

![img_agreement_example.png](./images/img_agreement_example.png)


### 6.2.1.6 약관 동의 대행 사용자의 동의 여부 확인

네이버 로그인 연동 이용자의 서비스 약관동의 상태 정보를 조회합니다. 약관 동의 대행을 설정한 애플리케이션에 한하여 조회기능을 제공합니다.


***요청 URL 정보***

| 메서드 | 인증 | 요청 URL | 출력 포맷 | 설명 |
|:---:|:---:|--------|:--:|---|
| GET / POST   | OAuth2.0 | https://openapi.naver.com/v1/nid/agreement |  JSON   | 접근 토큰 검증 및 약관동의정보 확인  |



***요청 헤더***

| 요청 헤더명  | 설명 |
| :--: | -------- | 
| Authorization |  접근 토큰(access token)을 전달하는 헤더<br>다음과 같은 형식으로 헤더 값에 접근 토큰(access token)을 포함합니다. 토큰 타입은 "Bearer"로 값이 고정되어 있습니다.<br> Authorization: {토큰 타입] {접근 토큰] |

***요청문 예시***

```shell
curl  -XGET "https://openapi.naver.com/v1/nid/agreement" \
      -H "Authorization: Bearer AAAAPIuf0L+qfDkMABQ3IJ8heq2m...dbvsiQbPbP1/cxva23n7mQShtfK4pchdk/rc="
```

***요청문 예시***

```http
> GET /v1/nid/agreement HTTP/2
> Host: openapi.naver.com
> user-agent: curl/7.79.1
> accept: */*
> authorization: Bearer AAAAPIuf0L+qfDkM...ShtfK4pchdk/rc=
​
< HTTP/2 200
< date: Tue, 07 Dec 2021 09:52:56 GMT
< content-type: application/json;charset=utf-8​
```


***출력 결과***

|필드 |타입 |필수 여부 |설명|
|:--:|:-:|:-:|------|
| result |  String | Y | API 처리 결과 (success / failure)|
| accessToken | String | Y | 헤더로 입력된 AccessToken 정보|
| agreementInfos | List\<Object\>  |  Y| 약관 동의 정보 리스트|
| agreementInfos[].termCode  | String  | Y|  약관 코드  |
| agreementInfos[].clientId | String | Y| ClientID (클라이언트 아이디, 애플리케이션 구분자)  |
| agreementInfos[]. agreeDate | DateTime | Y | 동의시각(HH:MI:SS.sss AM MM/DD/YYYY) |



> **_참고_**: 세부 JSON SCHEMA는 아래의 항목을 참고하시기 바랍니다.


***출력 결과 JSON SCHEMA***

```json
{
    "$schema": "http://json-schema.org/draft-07/schema",
    "type": "object",
    "description": "The root schema",
    "properties": {
        "result": {
            "type": "string",
            "description": "API 처리 결과 (success / failure)"
        },
        "accessToken": {
            "type": "string",
            "description": "헤더로 입력된 AccessToken 정보"
        },
        "agreementInfos": {
            "type": "array",
            "description": "약관 동의 정보 리스트",
            "items": {
                "type": "object",
                "properties": {
                    "termCode": {
                        "type": "string",
                        "description": "약관 코드 (Appendix 1 참고)"
                    },
                    "clientId": {
                        "type": "string",
                        "description": "ClientID (클라이언트 아이디, 애플리케이션 구분자)"
                    },
                    "agreeDate": {
                        "type": "string",
                        "description": "약관 동의 일자"
                    }
                }
            }
        }
    }
}
```

***출력 결과 JSON EXAMPLE***

```json
{
    "result": "success",
    "accessToken": "{input accessToken}",
    "agreementInfos": [{
        "termCode": "{TERMCODE}",
        "clientId": "{CLIENTID}",
        "agreeDate": "HH:MI:SS.sss AM MM/DD/YYYY"
    }, {
        "termCode": "{TERMCODE}",
        "clientId": "{CLIENTID}",
        "agreeDate": "HH:MI:SS.sss PM MM/DD/YYYY"
    }]
}
```

### 6.2.2 네이버 톡톡 연결을 통한 마케팅 정보 수신 동의 기능

#### 6.2.2.1 네이버 톡톡 연결 기능이란?

네이버 로그인 애플리케이션과 네이버 톡톡 계정을 연결하면, 네이버 로그인 동의창에서 톡톡 ‘알림받기’에 대한 동의(마케팅 정보 수신 동의)를 한번에 받을 수 있고, ‘알림받기’에 동의한 사용자들에게 [톡톡파트너센터](https://partner.talk.naver.com/)에서 서비스 소식 및 마케팅 메시지를 발송할 수 있습니다. 이제 네이버 로그인-톡톡 연결을 통해 마케팅 정보 수신 동의 고객을 효율적으로 모으고 마케팅 메시지를 보내보세요! 


[톡톡파트너센터에서 마케팅 메시지 발송하는 법 바로가기 >](https://blog.naver.com/naver_talk/220544102116)


#### 6.2.2.2 톡톡 연결 전 확인 사항

* 개발가이드를 숙지하여, 네이버 로그인 연동에 필요한 사항들을 미리 점검합니다.
* 네이버 개발자센터를 통해 애플리케이션을 등록합니다.
* 네이버 [톡톡파트너센터](https://partner.talk.naver.com/)를 통해 톡톡 계정을 생성합니다. 기존에 사용중인 톡톡 계정이 있다면 해당 계정 정보를 확인하여 연결을 준비합니다.

#### 6.2.2.3 주요 설정 방법

네이버 개발자센터와 톡톡파트너센터에서 네이버 로그인 애플리케이션과 톡톡 계정을 연결할 수 있습니다. 두 센터 중 한 곳에서만 연결해도 연결 정보가 연동되어 노출됩니다.

**1) 네이버 개발자센터에서 톡톡 계정 연결하기**

![img_talktalk_channel.png](./images/img_talktalk_channel.png)

* 1. API 설정 > ‘네이버 로그인 플러스’ > ‘네이버 톡톡 연결 및 서비스 노출 설정’ 영역에서 네이버 톡톡 연결하기 버튼을 클릭합니다.
* 2. 톡톡 간편연결 팝업에서 톡톡 계정을 선택합니다. 
* 3. 네이버 로그인 애플리케이션과 톡톡 계정 연결이 완료됩니다. 
* 4. 연결된 톡톡 계정 정보를 확인합니다.

**2) 톡톡파트너센터에서 로그인 애플리케이션 연결하기**

![img_talktalk_center.png](./images/img_talktalk_center.png)

* 1. 톡톡파트너센터 > 설정 > 서비스 연결 메뉴에 접속합니다.
* 2. 서비스 연결 버튼을 클릭합니다.
* 3. 네이버 로그인 선택 후 다음 버튼을 클릭합니다.
* 4. 연결할 로그인 애플리케이션을 선택 후 추가 버튼을 클릭합니다.
* 5. 네이버 로그인 애플리케이션과 톡톡계정 연결이 완료됩니다. 
* 6. 연결된 로그인 애플리케이션 정보를 확인합니다.

