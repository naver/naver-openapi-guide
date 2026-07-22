---
title: 네이버 로그인 SDK 다운로드
description: Android, iOS, Windows, JavaScript 등 플랫폼별 네이버 로그인 라이브러리 다운로드 정보와 버전별 변경 이력을 제공합니다.
---

# SDK 다운로드

### 1\. Android용 네이버 로그인 라이브러리

| 버전 | 날짜 | 종류 | 내역 |
| --- | --- | --- | --- |
| [Github](https://github.com/naver/naveridlogin-sdk-android) | 2019.11.21 이후 | 라이브러리,<br>예제 프로젝트 | [Release](https://github.com/naver/naveridlogin-sdk-android/releases)<br>앞으로는 Github를 참조해주세요 |
| [4.2.5](https://github.com/naver/naveridlogin-sdk-android/releases/tag/v4.2.5) | 2019.01.02 | 라이브러리 | **버그 수정** <br>URL Hooking 로직 개선 |
| [4.2.4](https://github.com/naver/naveridlogin-sdk-android/releases/tag/v4.2.4) | 2018.11.22 | 라이브러리 | **버그 수정** <br>안정화 작업 |
| [4.2.3](https://github.com/naver/naveridlogin-sdk-android/releases/tag/v4.2.3) | 2018.06.08 | 라이브러리 | **기능 추가** <br>Do not keep activities 설정 관련 예외 처리<br>**버그 수정** <br>Log 출력 관련 설정 오류 수정<br>OAuthLoginActivity Single Task 버그 수정 |
| [4.2.0](https://github.com/naver/naveridlogin-sdk-android/releases/tag/v4.2.0) | 2017.11.07 | 라이브러리,<br>예제 프로젝트 | **기능 추가** <br>Chrome custom tab 적용<br>(네앱이 설치되지 않을 경우 CustomTab이 우선 실행 됨)<br>Material 스타일의 다이얼로그 테마 적용<br>Android Studio 프로젝트로 변경<br>기존 jar에서 aar로 아카이브 변경<br>내부 deprecate API제거 및 불필요 코드 정리 |
| [4.1.4](/inc/devcenter/downloads/naveridro/3rdparty_login_library_android_4.1.4.zip)<br>[4.1.4-sample](/inc/devcenter/downloads/naveridro/3rdparty_login_sample_android_4.1.4.zip) | 2015.08.07 | 라이브러리 | **기능 추가** <br>네이버 앱 설치 유도하는 Dialog 대신 다운로드 배너 보여주도록 변경 <br>SDK 초기화 시 Callback Intent 값 넣지 않고 앱의 package name 을 넘기도록 변경 |

### 2\. iOS용 네이버 로그인 라이브러리

| 버전 | 날짜 | 종류 | 내역 |
| --- | --- | --- | --- |
| [Github 지원 (신버전)](https://github.com/naver/naveridlogin-sdk-ios-swift) | 2025.02.11 | Github 배포 | **신버전 추가** <br>네아로 iOS SDK Swift 버전 추가 |
| [Github 지원](https://github.com/naver/naveridlogin-sdk-ios) | 2017.11.10 | Github 배포 | **버그 수정** <br>간헐적으로 인증 해제가 되지않는 현상 수정<br>**기능 추가** <br>SafariViewController를 이용한 로그인 지원 |
| [4.0.7](/inc/devcenter/downloads/naveridro/3rdparty_login_library_ios_4.0.7.zip)<br>[4.0.7-sample](/inc/devcenter/downloads/naveridro/3rdparty_login_sample_ios_4.0.7.zip) | 2015.12.31 | SDK, Sample | **버그 수정** <br>인앱 브라우저 UI 개선 및 로테이션 시 UI 노출 버그 수정<br>샘플앱 XCode 7 관련 수정 |
| [4.0.6](/inc/devcenter/downloads/naveridro/3rdparty_login_library_ios_4.0.6.zip)<br>[4.0.6-sample](/inc/devcenter/downloads/naveridro/3rdparty_login_sample_ios_4.0.6.zip) | 2015.09.21 | SDK, Sample | **기능 추가** <br>iOS9 deprecated 메소드 변경, bitcode 지원, 최저 지원 버전 iOS 7으로 상향<br>**버그 수정** <br>XCode 7 beta 에서 샘플앱 빌드시 발생하는 크래쉬 수정 |
| [4.0.5](/inc/devcenter/downloads/naveridro/3rdparty_login_library_ios_4.0.5.zip)<br>[4.0.5-sample](/inc/devcenter/downloads/naveridro/3rdparty_login_sample_ios_4.0.5.zip) | 2015.08.13 | SDK, Sample | **기능 추가** <br>네이버 앱 미설치시 인앱 브라우저 인증화면에서 설치 배너 노출 |
| [4.0.4](/inc/devcenter/downloads/naveridro/3rdparty_login_library_ios_4.0.4.zip)<br>[4.0.4 sample](/inc/devcenter/downloads/naveridro/3rdparty_login_sample_ios_4.0.4.zip) | 2015.07.30 | SDK, Sample | **버그 수정** <br>토큰 유효기간이 지났지만 isValidAccessTokenExpireTimeNow에서 YES로 반환되는 이슈 수정 |
| [4.0.3](/inc/devcenter/downloads/naveridro/3rdparty_login_library_ios_4.0.3.zip) | 2015.06.17 | SDK, Sample | **기능 추가** <br>User-Agent 변경<br>토큰 초기화 시 로그인 쿠키 삭제 로직 수정 |
| [4.0.2](/inc/devcenter/downloads/naveridro/3rdparty_login_library_ios_4.0.2.zip) | 2015.02.27 | 라이브러리,<br>예제 프로젝트 | **버그 수정** <br>인앱 브라우저 이슈 수정 |
| [4.0.1](/inc/devcenter/downloads/naveridro/3rdparty_login_library_ios.zip) | 2014.12.15 | 라이브러리,<br>예제 프로젝트 | 최초 배포 |

### 3\. Windows 애플리케이션 예제 프로젝트

Windows 애플리케이션 설명 표 
| 버전 | 날짜 | 종류 | 내역 |
| --- | --- | --- | --- |
| [Sample](/inc/devcenter/downloads/naveridro/NaverOAuth_pcapp.7z) |  |  |  |

### 4\. JavaScript용 네이버 로그인 라이브러리

| 버전 | 날짜 | 종류 | 내역 |
| --- | --- | --- | --- |
| [2.0.2](https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.2.js)<br>[2.0.2-nopolyfill](https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.2-nopolyfill.js)<br>[2.0.2 sample](https://static.nid.naver.com/oauth/sample/javascript_sample.html) | 2021.01.07 | 라이브러리 | **기능 추가** <br>프로필 응답항목 추가(출생년도,휴대전화번호) |
| [2.0.1](https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.1.js)<br>[2.0.1-nopolyfill](https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.1-nopolyfill.js) | 2020.08.31 | 라이브러리 | **기능 추가 및 버그 수정** <br>popup 처리 버그 수정<br>polyfill 의존제거 버전 추가 |
| [2.0.0](https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js) | 2017.11.17 | 라이브러리 | **기능 추가** <br>Javascript SDK구조 및 인터페이스 변경<br>사용자 재동의 프로세스 추가 |
| [1.0.3](https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js)<br>[1.0.3-minify](https://static.nid.naver.com/js/naverLogin_implicit-1.0.3-min.js) | 2017.04.25 | 라이브러리 | **버그 수정** <br>get_naver_userprofile 호출 시 callback function 수정 |
| [1.0.2](https://static.nid.naver.com/js/naverLogin_implicit-1.0.2.js)<br>[1.0.2-minify](https://static.nid.naver.com/js/naverLogin_implicit-1.0.2-min.js) | 2015.09.21 | 라이브러리 | **기능 추가** <br>프로필 정보 조회 API URL 변경사항 적용<br>get_naver_userprofile 호출 시 callback function 추가<br>**버그 수정** <br>없음 |
| [1.0.1](https://static.nid.naver.com/js/naverLogin_implicit-1.0.1.js)<br>[1.0.1-minify](https://static.nid.naver.com/js/naverLogin_implicit-1.0.1-min.js) | 2015.07.30 | 라이브러리 | **기능 추가** <br>implicit grant 를 지원하도록 라이브러리 수정<br>**버그 수정** <br>없음 |
| [1.0.0](https://static.nid.naver.com/js/naverLogin-1.0.0.js)<br>[1.0.0-minify](https://static.nid.naver.com/js/naverLogin-1.0.0.min.js) | 2015.03.24 | 라이브러리 | **신규 추가** <br>JavaScript용 라이브러리 신규 추가<br>**버그 수정** <br>없음 |

### 5\. 변경 이력

| 운영체제 | 버전 | 날짜 | 종류 | 내역 |
| --- | --- | --- | --- | --- |
| iOS | 4.0.8 | 2017.11.10 | Github | **버그 수정** <br>간헐적으로 인증 해제가 되지않는 현상 수정<br>**기능 추가** <br>SafariViewController를 이용한 로그인 지원 |
| iOS | 4.0.7 | 2015.12.31 | 라이브러리,<br>예제 프로젝트 | **버그 수정** <br>인앱 브라우저 UI 개선 및 로테이션 시 UI 노출 버그 수정<br>샘플앱 XCode 7 관련 수정 |
| iOS | 4.0.6 | 2015.09.21 | 라이브러리,<br>예제 프로젝트 | **기능 추가** <br>iOS9 deprecated 메소드 변경, bitcode 지원, 최저 지원 버전 iOS 7으로 상향<br>**버그 수정** <br>XCode 7 beta 에서 샘플앱 빌드 시 발생하는 크래쉬 수정 |
| Javascript | 1.0.2 | 2015.09.21 | 라이브러리 | **기능 추가** <br>프로필 정보 조회 API URL 변경 사항 적용<br>get_naver_userprofile 호출 시 callback function 추가 |
| iOS | 4.0.5 | 2015.08.13 | 라이브러리,<br>예제 프로젝트 | **기능 추가** <br>네이버 앱 미설치 시 인앱 브라우저 인증화면에서 설치 배너 노출 |
| Android | 4.1.4 | 2015.08.07 | 라이브러리,<br>예제 프로젝트 | **기능 추가** <br>네이버 앱 설치 유도하는 Dialog 대신 다운로드 배너 보여주도록 변경 <br>SDK 초기화 시 Callback Intent 값을 넣지 않고 앱의 package name을 넘기도록 변경 |
| Javascript | 1.0.1 | 2015.07.30 | 라이브러리 | **기능 추가** <br>implicit grant 를 지원하도록 라이브러리 수정 |
| iOS | 4.0.4 | 2015.07.30 | 라이브러리,<br>예제 프로젝트 | **버그 수정** <br>토큰 유효 기간이 지났지만 isValidAccessTokenExpireTimeNow에서 YES로 반환되는 이슈 수정 |
| Android | 4.1.3 | 2015.03.10 | 라이브러리,<br>예제 프로젝트 | **기능 추가** <br>데이터를 사용하는지 Wi-Fi를 사용하는지 서버로 전달<br>라이브러리의 버전 정보를 네이버 앱으로 전달<br>라이브러리의 버전 정보로 화면 회전 여부 결정<br>**버그 수정** <br>개발 도구에서 레이아웃을 미리 볼 때 OAuthLoginButton 클래스가 오류를 발생하는 현상 수정 |
| iOS | 4.0.2 | 2015.02.27 | 라이브러리,<br>예제 프로젝트 | **기능 추가** <br>iPhone 6, iPhone6+에서 인앱 브라우저 아래의 버튼 위치 조정<br>**버그 수정** <br>인앱 브라우저에서 인증 시 동의창에서 인증을 취소하는 경우 콜백 호출이 안 되는 오류 수정 |
| Android | 4.1.2 | 2014.12.23 | 라이브러리,<br>예제 프로젝트 | **기능 추가** <br>가로 모드와 세로 모드를 모두 지원하도록 변경<br>**버그 수정** <br>없음 |
| iOS | 4.0.1 | 2014.12.15 | 라이브러리,<br>예제 프로젝트 | iOS용 네이버 로그인 라이브러리 최초 배포 |

