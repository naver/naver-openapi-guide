# API 공통 가이드

네이버 오픈API는 네이버 플랫폼의 기능을 외부 개발자가 쉽게 이용할 수 있게 웹 또는 SDK 형태로 공개한 기술들입니다. 네이버 오픈API로 활용할 수 있는 기술에는 네이버 로그인과 지도, 검색이 있으며, Clova의 음성 인식 기술과 음성 합성 기술, 얼굴 인식 기술, Papago의 기계 번역 기술 등이 있습니다.

## API 공통 가이드 개요

API 공통 가이드는 네이버 오픈API를 사용해 클라이언트 애플리케이션을 개발할 때 미리 알아 두어야 하는 내용을 설명합니다.

> - 최종 수정일: 2021년 8월 27일</li>
>
> 이 문서의 내용은 언제든지 변경될 수 있습니다.

## API 공통 가이드 구성

API 공통 가이드의 내용은 다음과 같습니다.

- [네이버 오픈API 종류](apilist.md)
   - [로그인 방식 오픈 API](apilist.md#로그인-방식-오픈-api)
   - [비로그인 방식 오픈 API](apilist.md#비로그인-방식-오픈-api)
- [사전 준비 사항](appregister.md)
  - [애플리케이션 등록](appregister.md#애플리케이션-등록)
  - [애플리케이션 등록 세부 정보](appregister.md#애플리케이션-등록-세부-정보)
  - [애플리케이션 등록 확인](appregister.md#애플리케이션-등록-확인)
  - [클라이언트 아이디와 클라이언트 시크릿 확인](appregister.md#클라이언트-아이디와-클라이언트-시크릿-확인)
- [내 애플리케이션 관리](appconf.md)
  - [기본 정보](appconf.md#기본-정보)
  - [API 설정](appconf.md#api-설정)
  - [멤버 관리](appconf.md#멤버-관리)
  - [통계 보기](appconf.md#통계-보기)
  - [애플리케이션 삭제](appconf.md#애플리케이션-삭제)
- [용어 정리](apiterms.md)
  - [API의 기본](apiterms.md#api의-기본)
  - [API 인증](apiterms.md#api-인증)
  - [API 호출](apiterms.md#api-호출)
  - [HTTP](apiterms.md#http)
- [샘플 코드](apicall.md)
  - [로그인 방식 오픈 API 호출 예](apicall.md#로그인-방식-오픈-api-호출-예)
  - [비로그인 방식 오픈 API 호출 예](apicall.md#비로그인-방식-오픈-api-호출-예)
- [오류 코드](errorcode.md)
  - [주요 오류 코드](errorcode.md#주요-오류-코드)
  - [오류 메시지 형식](errorcode.md#오류-메시지-형식)