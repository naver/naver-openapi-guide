---
title: 네이버 공유하기
description: 공유하기 RESTful API입니다.
---

# 네이버 공유하기

<div class="table-of-contents">
<ul>
    <li><a href="#음성-캡차-개요">음성 캡차 개요</a>
    </li>
    <ul>
        <li><a href="#개요">개요</a></li>
        <li><a href="#사전-준비-사항">사전 준비 사항</a></li>
    </ul>
    <li><a href="/docs/utils/scaptcha/reference/">음성 캡차 API 레퍼런스</a></li>
    <ul>
        <li><a href="/docs/utils/scaptcha/reference/#캡차-키-발급-요청">캡차 키 발급 요청</a></li>
        <li><a href="/docs/utils/scaptcha/reference/#사용자-입력값-검증-요청">사용자 입력값 검증 요청</a></li>
        <li><a href="/docs/utils/scaptcha/reference/#캡차-음성-요청">캡차 음성 요청</a></li>
        <li><a href="/docs/utils/scaptcha/reference/#오류-코드">오류 코드</a></li>
    </ul>
    <li><a href="/docs/utils/scaptcha/examples/">음성 캡차 API 구현 예제</a></li>
    <ul>
        <li><a href="/docs/utils/scaptcha/examples/#java">Java</a></li>
        <li><a href="/docs/utils/scaptcha/examples/#php">PHP</a></li>
        <li><a href="/docs/utils/scaptcha/examples/#node-js">Node.js</a></li>
        <li><a href="/docs/utils/scaptcha/examples/#python">Python</a></li>
        <li><a href="/docs/utils/scaptcha/examples/#c">C#</a></li>
    </ul>
</ul>
</div>

## 음성 캡차 개요

* [개요](#개요)
* [사전 준비 사항](#사전-준비-사항)

### 개요

#### 음성 캡차 API 개요

음성 캡차 API는 자동 입력 방지를 위해 숫자가 포함된 음성 메시지를 전송하고 입력값을 검증하는 RESTful API입니다.

음성 캡차 기능은 다음과 같은 단계로 진행되도록 구현합니다.

1. 캡차 키 발급을 요청합니다.
2. 발급받은 캡차 키로 캡차 음성 발급을 요청합니다.
3. 발급받은 캡차 음성을 듣고 사용자가 입력한 값을 검증하도록 요청합니다.

음성 캡차 API의 하루 API 처리 한도는 1,000건이며, 캡차 키 발급 요청과 입력값 검증 요청이 처리 한도에 포함됩니다.

#### 음성 캡차 API 특징

음성 캡차 API는 비로그인 방식 오픈 API입니다.

비로그인 방식 오픈 API는 네이버 오픈API를 호출할 때 HTTP 요청 헤더에 클라이언트 아이디와 클라이언트 시크릿 값만 전송해 사용할 수 있는 오픈 API입니다. 클라이언트 아이디와 클라이언트 시크릿은 네이버 오픈API에서 인증된 사용자인지 확인하는 수단입니다. [네이버 개발자 센터](https://developers.naver.com/)에서 애플리케이션을 등록하면 클라이언트 아이디와 클라이언트 시크릿이 발급됩니다.

> **참고**  
> 네이버 오픈API의 종류와 클라이언트 아이디, 클라이언트 시크릿에 관한 자세한 내용은 "[API 공통 가이드](https://developers.naver.com/docs/common/openapiguide/)"를 참고하십시오.  

### 사전 준비 사항

음성 캡차 API를 사용하려면 먼저 [네이버 개발자 센터](https://developers.naver.com/)에서 애플리케이션을 등록하고 클라이언트 아이디와 클라이언트 시크릿을 발급받아야 합니다.

클라이언트 아이디와 클라이언트 시크릿은 인증된 사용자인지를 확인하는 수단이며, 애플리케이션이 등록되면 발급됩니다. 클라이언트 아이디와 클라이언트 시크릿을 네이버 오픈API를 호출할 때 HTTP 헤더에 포함해서 전송해야 API를 호출할 수 있습니다. API 사용량은 클라이언트 아이디별로 합산됩니다.

> **주의**  
> 네이버에 로그인한 사용자 계정으로 애플리케이션이 등록됩니다. 애플리케이션을 등록한 네이버 아이디는 '관리자' 권한을 가지게 되므로 네이버 계정의 보안에 각별히 주의해야 합니다.  
> 회사나 단체에서 애플리케이션을 등록할 때는 추후 키 관리 등이 용이하도록 네이버 단체 회원으로 로그인해 이용할 것을 권장합니다.  
> - [네이버 단체 회원 가입하기](https://nid.naver.com/group/commonAction.nhn?m=viewTerms)  

#### 애플리케이션 등록

네이버 개발자 센터에서 애플리케이션을 등록하는 방법은 다음과 같습니다.

1. 네이버 개발자 센터의 메뉴에서 [**Application &gt; 애플리케이션 등록**](https://developers.naver.com/apps/#/wizard/register)을 선택합니다.
2. **이용약관 동의** 단계에서 **이용약관에 동의합니다.**<!-- -->를 선택한 다음 **확인**을 클릭합니다.
3. **계정 정보 등록** 단계에서 휴대폰 인증을 완료하고 회사 이름을 입력한 다음 **확인**을 클릭합니다. 휴대폰 인증은 담당자 연락처 확인을 위해 필요한 과정이며, 애플리케이션을 처음 등록할 때 한 번만 인증받으면 됩니다.
4. **애플리케이션 등록 (API이용신청)** 페이지에서 [애플리케이션 등록 세부 정보](#애플리케이션-등록-세부-정보)를 입력한 다음 **등록하기**를 클릭합니다.

#### 애플리케이션 등록 세부 정보

**애플리케이션 등록 (API이용신청)** 페이지에서 애플리케이션 세부 정보를 입력하는 방법은 다음과 같습니다.

1. 등록하려는 애플리케이션의 이름을 **애플리케이션 이름**에 입력합니다. 최대 40자까지 입력할 수 있습니다.
2. **사용 API**에서 **캡차 (음성)**<!-- -->을 선택해 추가합니다.
3. [**비로그인 오픈 API 서비스 환경**](https://developers.naver.com/docs/common/openapiguide/appregister.md#비로그인-오픈-api-서비스-환경)에서 애플리케이션을 서비스할 환경을 추가하고 필요한 상세 정보를 입력합니다.

![](images/scaptcha-01.png)

#### 애플리케이션 등록 확인

애플리케이션이 정상적으로 등록되면 네이버 개발자 센터의 **[Application &gt; 내 애플리케이션](https://developers.naver.com/apps/#/list)** 메뉴의 아래에 등록한 애플리케이션 이름으로 하위 메뉴가 생깁니다.

애플리케이션 이름을 클릭하면 **개요** 탭에서 애플리케이션에 부여된 클라이언트 아이디와 클라이언트 시크릿을 확인할 수 있습니다.

![](images/scaptcha-02.png)
