# Android

해당 문서는 네이버 아이디 로그인 Android SDK(이하 네아로SDK)의 최신 버전에 대한 가이드를 제공합니다.
네아로SDK는 서드파티 애플리케이션에서 네이버 로그인이 제공하는 로그인, 로그아웃, 토큰 관리 등의 기능을 쉽게 구현할 수 있게 합니다.
<div class="con">
    <div class="buttons2">
        <a class="btn_b_hi3" href="https://github.com/naver/naveridlogin-sdk-android">라이브러리 및 샙플앱 보기 &gt;</a>
        <a class="btn_b_hi3" href="https://github.com/naver/naveridlogin-sdk-android/issues">이슈 등록 &gt;</a>
        <a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?api=nvlogin">오픈 API 이용 신청 &gt;</a>
    </div>
</div>

라이브러리 및 샘플앱 보기를 통해 소스코드를 확인할 수 있습니다. 문의사항이 있다면 Github Issue를 등록주세요.

'네이버 아이디로 로그인'을 구현하기 전 오픈 API 이용 신청을 먼저 진행해주세요.

아래 네아로SDK 적용 예제는 Kotlin으로 작성되었습니다. 개발 시 참고 부탁드립니다.

## 목차

### 1. 시작하기
- [1.1. 요구사항](#11-요구사항)
- [1.2. 안드로이드용 네아로SDK 구성](#12-안드로이드용-네아로sdk-구성)
- [1.3. 개발 환경 설정](#13-개발-환경-설정)

### 2. 기본 기능
- [2.1. SDK 초기화](#21-sdk-초기화)
- [2.2. 로그인](#22-로그인)
  - [2.2.1. NidLoginButton 객체로 버튼 추가](#221-nidloginbutton-객체로-버튼-추가)
  - [2.2.2. requestLogin() 메서드를 이용한 로그인](#222-requestlogin-메서드를-이용한-로그인)
- [2.3. 접근 토큰 얻기](#23-접근-토큰-얻기)
- [2.4. 로그아웃](#24-로그아웃)
- [2.5. 연동 해제](#25-연동-해제)
- [2.6. 프로필 API 호출](#26-프로필-api-호출)

### 3. 기타 설정
- [3.1. 로그 설정](#31-로그-설정)
- [3.2. 문구 변경](#32-문구-변경)

### 4. 네아로SDK API 상세 설명
  - [4.1. NidOAuthErrorCode](#41-nidoautherrorcode)
  - [4.2. NidOAuth](#42-nidoauth)
    - [getAccessToken()](#421-getaccesstoken)
    - [getExpiresAt()](#422-getexpiresat)
    - [getLastErrorCode()](#423-getlasterrorcode)
    - [getLastErrorDescription()](#424-getlasterrordescription)
    - [getRefreshToken()](#425-getrefreshtoken)
    - [getState()](#426-getstate)
    - [getTokenType()](#427-gettokentype)
    - [getVersion()](#428-getversion)
    - [initialize(context, clientId, clientSecret, clientName, callback)](#429-initializecontext-clientid-clientsecret-clientname-callback)
    - [requestlogin(context, launcher)](#4210-requestlogincontext-launcher)
    - [requestlogin(context, callback)](#4211-requestlogincontext-callback)
    - [repromptpermissions(context, launcher)](#4212-repromptpermissionscontext-launcher)
    - [repromptpermissions(context, callback)](#4213-repromptpermissionscontext-callback)
    - [logout(callback)](#4214-logoutcallback)
    - [disconnect(callback)](#4215-disconnectcallback)
    - [getUserProfile(callback)](#4216-getuserprofilecallback)
    - [getUserProfileMap(callback)](#4217-getuserprofilemapcallback)
  - [4.3. NidLoginButton](#43-nidloginbutton)
  - [4.4. NidOAuthCallback](#44-nidoauthcallback)
  - [4.5. NidProfileCallback](#45-nidprofilecallback)
  - [4.6. NidOAuthIntializingCallback](#46-nidoauthinitializingcallback)
  - [4.7 NidOAuthLoginState](#47-nidoauthloginstate)

## 1. 시작하기
### 1.1. 요구사항
네아로SDK를 사용하려면 다음과 같은 환경이 필요합니다.
- SDK: Android API 21 이상
- JDK: JDK 11 이상
- IDE: Android Studio

> **참고** <br/>
> JDK 8 버전의 경우 별도의 artifact를 의존해주세요.

### 1.2. 안드로이드용 네아로SDK 구성
소스 코드는 다음과 같이 두 모듈로 구성되어 있습니다.

- **Nid-OAuth**: 네아로SDK
- **Samples**: 네아로SDK를 사용하는 예제 프로젝트 

### 1.3. 개발 환경 설정

gradle 스크립트에 아래와 같이 추가하시면 사용할 수 있습니다.

```groovy
# groovy
implementation 'com.navercorp.nid:oauth:5.11.0' // jdk 17
implementation 'com.navercorp.nid:oauth-jdk8:5.11.0' // jdk 8
```

```kts
# kts
implementation("com.navercorp.nid:oauth:5.11.0") // jdk 17
implementation("com.navercorp.nid:oauth-jdk8:5.11.0") // jdk 8
```

네아로SDK에서 사용하는 라이브러리는 다음과 같습니다. 필요에 따라 exclude 하여 사용하시면 됩니다.

```groovy
implementation 'org.jetbrains.kotlin:kotlin-stdlib:2.1.0'
implementation 'org.jetbrains.kotlinx:kotlinx-coroutines-android:1.10.0'
implementation 'androidx.appcompat:appcompat:1.3.1'
implementation 'androidx.legacy:legacy-support-core-utils:1.0.0'
implementation 'androidx.browser:browser:1.4.0'
implementation 'androidx.constraintlayout:constraintlayout:1.1.3'
implementation 'androidx.security:security-crypto:1.1.0-alpha06'
implementation 'androidx.core:core-ktx:1.3.0'
implementation 'androidx.fragment:fragment-ktx:1.3.6'
implementation 'androidx.lifecycle:lifecycle-viewmodel-ktx:2.4.0'
implementation 'androidx.datastore:datastore-preferences:1.1.7'
implementation 'com.squareup.retrofit2:retrofit:2.9.0'
implementation 'com.squareup.retrofit2:converter-gson:2.9.0'
implementation 'com.squareup.moshi:moshi-kotlin:1.15.2'
implementation 'com.squareup.okhttp3:logging-interceptor:4.2.1'
implementation 'com.airbnb.android:lottie:3.1.0'
```

## 2. 기본 기능
### 2.1. SDK 초기화
네아로SDK를 애플리케이션에 적용하려면 다음과 같은 코드를 추가해 네아로 객체를 초기화합니다.
```kt
// 사용 예시
NidOAuth.initialize(context, {OAUTH_CLIENT_ID}, {OAUTH_CLIENT_SECRET}, {OAUTH_CLIENT_NAME}, callback)
```

- OAUTH_CLIENT_ID: 애플리케이션 등록 후 발급받은 클라이언트 아이디
- OAUTH_CLIENT_SECRET: 애플리케이션 등록 후 발급받은 클라이언트 시크릿
- OAUTH_CLIENT_NAME: 네이버 앱의 로그인 화면에 표시할 애플리케이션 이름
    - 모바일 웹의 로그인 화면을 사용할 때는 서버에 저장된 애플리케이션 이름이 표시됩니다.
- callback: SDK 초기화 완료 및 실패에 대한 콜백

> **참고** <br/>
> `NidOAuth.initialize()` 메서드가 여러 번 실행돼도 기존에 저장된 접근 토큰(access token)과 갱신 토큰(refresh token)은 삭제되지 않습니다.<br/>
> 기존에 저장된 접근 토큰과 갱신 토큰을 삭제하려면 `NidOAuth.logout()` 메서드나 `NidOAuth.disconnect()` 메서드를 호출해야 합니다.

### 2.2. 로그인
로그인은 두 가지 방법으로 구현합니다.

1. `NidLoginButton` 네이버 로그인 버튼을 레이아웃에 추가하는 방법
2. `NidOAuth.requestLogin()` 메서드를 직접 실행하는 방법

<img src = "./images/img_naverid13.png" width = 300 />

#### 2.2.1. NidLoginButton 객체로 버튼 추가
`NidLoginButton` 객체로 네이버 로그인 버튼을 추가하는 방법은 다음과 같습니다.

레이아웃 파일에 다음과 같은 구문을 추가합니다.

```xml
<!-- 사용 예시 -->
<com.navercorp.nid.oauth.view.NidLoginButton
    android:id="@+id/buttonOAuthLoginImg"
    android:layout_width="wrap_content"
    android:layout_height="50dp" />
```

로그인 창을 실행할 `ActivityResultLauncher`나 로그인 후 실행될 `NidOAuthCallback` 객체를 등록하는 코드를 추가합니다.

```kt
// 사용 예시
binding.buttonOAuthLoginImg.setOAuthLogin(launcher)

// OR

binding.buttonOAuthLoginImg.setOAuthLogin(oauthLoginCallback)
```

> **주의** <br/>
> `NidLoginButton` 객체를 이용할 때 네이버 로그인 버튼의 디자인은 반드시 [네이버 로그인 버튼 사용 가이드](/bi/bi.md)를 따라야 합니다. <br/>


#### 2.2.2. requestLogin() 메서드를 이용한 로그인
`NidOAuth.requestLogin()` 메서드는 **로그인 혹은 접근토큰 갱신**을 위해 사용됩니다.


메서드 내부 동작은 아래와 같습니다.
1. 메서드를 직접 실행하면 먼저 갱신 토큰이 있는지 확인합니다. 갱신 토큰이 있으면 접근 토큰의 갱신을 시도합니다.
    - 갱신에 성공하면 `launcher의 ActivityResultCallback` 이나 `callback.success()`을 통해 결과를 확인할 수 있습니다.
    - 갱신에 실패하면 로그인 창이 나타납니다.
2. 갱신 토큰이 없으면 로그인 창이 나타납니다.

> **주의: 접근 토큰 갱신 관련** <br/>
>
> 접근토큰은 일정 시간(현재 1시간)이 지나면 만료되기 때문에 만료시간이 지난 경우 `requestLogin()` 을 재호출해서 access token을 갱신해주어야 합니다.<br/>
> `requestLogin()` 성공 시 매개변수로 넣은 `NidOAuthCallback` 객체의 `onSuccess()` 메소드 안에서 `NidOAuth.getAccessToken()`을 호출하면 access token을 얻을 수 있습니다.

`NidOAuth.requestLogin(context, launcher)`을 실행 한 경우 `launcher의 ActivityResultCallback`를 통해 결과를 확인 할 수 있습니다. resultCode가 Activity.RESULT_OK 일 경우 성공, Activity.RESULT_CANCELED일 경우 실패나 에러입니다.

`NidOAuth.requestLogin(context, callback)`을 실행한 경우 `callback`이 호출됩니다. 로그인 창에서 로그인이 완료되거나 취소될 때에도 `callback`이 호출됩니다.

다음은 `NidOAuth.requestLogin()` 메서드를 이용한 로그인을 구현한 예제입니다.

```kt
// 사용 예시

private val launcher = registerForActivityResult<Intent, ActivityResult>(ActivityResultContracts.StartActivityForResult()) { result ->
        when (result.resultCode) {
            RESULT_OK -> {
                // 네이버 로그인 인증이 성공할 떄 수행할 코드 추가
                // ex. access token, refresh token에 접근 등
                updateView()
            }
            RESULT_CANCELED -> {
                // 실패 or 에러
                val errorCode = NidOAuth.getLastErrorCode().code
                val errorDescription = NidOAuth.getLastErrorDescription()
                Toast.makeText(context, "errorCode:$errorCode, errorDesc:$errorDescription", Toast.LENGTH_SHORT).show()
            }
        }
    }

NidOAuth.requestLogin(context, launcher)

// OR

val nidOAuthCallback = object : NidOAuthCallback {
    override fun onSuccess() {
        // 네이버 로그인 인증이 성공했을 때 수행할 코드 추가
        // ex. access token, refresh token에 접근 등
        updateView()
    }

    override fun onFailure(
        errorCode: String,
        errorDesc: String,
    ) {
        Toast.makeText(
            context,
            "errorCode:$errorCode, errorDesc:$errorDesc",
            Toast.LENGTH_SHORT,
        ).show()
        updateView()
    }
}

NidOAuth.requestLogin(context, nidOAuthCallback)
```

> **참고** <br/>
> 커스텀탭 로그인 모드를 사용하는 경우에 사용자 기기의 기본 브라우저 앱이 네이버앱이라면 네이버앱으로 로그인이 진행됩니다. 

### 2.3. 접근 토큰 얻기
로그인에 성공했을 때는 `NidOAuth.getAccessToken()` 메서드로 접근 토큰 정보를 얻을 수 있습니다. 

```kt
// 사용 예시
NidOAuth.getAccessToken()
```

로그인에 실패했다면 `NidOAuth.getLastErrorCode()` 메서드나 `NidOAuth.getLastErrorDescription()` 메서드로 실패 이유와 에러 코드를 얻을 수 있습니다.


### 2.4. 로그아웃
애플리케이션에서 로그아웃할 때는 다음과 같이 `NidOAuth.logout(callback)` 메서드를 호출합니다.

```kt
// 사용 예시
val nidOAuthCallback = object : NidOAuthCallback {
    override fun onSuccess() {
        //클라이언트에서 토큰 삭제를 성공한 상태입니다.
        updateView()
    }

    override fun onFailure(
        errorCode: String,
        errorDesc: String,
    ) {
        // 클라이언트에 있는 토큰 삭제 실패한 상태입니다.
        Toast.makeText(
            context,
            "errorCode:$errorCode, errorDesc:$errorDesc",
            Toast.LENGTH_SHORT,
        ).show()
        updateView()
    }
}

NidOAuth.logout(callback)
```

`NidOAuth.logout(callback)` 메서드가 호출되면 클라이언트에 저장된 토큰이 삭제되고 `NidOAuth.getState()` 메서드가 NidOAuthLoginState.NEED_LOGIN 값을 반환합니다.
 
> **참고: 약전계에서 로그아웃 호출 시** <br/>
> 로그아웃의 경우, 클라이언트에 저장된 토큰만 삭제하므로 약전계나 네트워크 오류에 영향을 받지 않습니다.


### 2.5. 연동 해제
네이버 아이디와 애플리케이션의 연동을 해제하는 기능은 다음과 같이 `NidOAuth.disconnect(callback)` 메서드로 구현합니다.

연동을 해제하면 클라이언트에 저장된 토큰과 서버에 저장된 토큰이 모두 삭제됩니다.

```kt
// 사용 예시

val nidOAuthCallback = object : NidOAuthCallback {
    override fun onSuccess() {
        //클라이언트 및 서버에서 토큰 삭제에 성공한 상태입니다.
        updateView()
    }

    override fun onFailure(
        errorCode: String,
        errorDesc: String,
    ) {
        // 서버에서 토큰 삭제가 실패되었고, 클라이언트에 있는 토큰 역시 삭제가 되지 않은 상태입니다.
        Toast.makeText(
            context,
            "errorCode:$errorCode, errorDesc:$errorDesc",
            Toast.LENGTH_SHORT,
        ).show()
        updateView()
    }
}

NidOAuth.disconnect(nidOAuthCallback)
```

연동이 해제된 것은 PC에서 네이버의 내정보 > 보안설정 > 외부 사이트 연결 페이지에 접속해 외부사이트 → 네이버에서 연결 정보 삭제 여부로 확인할 수 있습니다.

> **참고: 약전계에서 연동 해제 시** <br/>
> `NidOAuth.disconnect(callback)` 메서드로 연동을 해제할 때는 클라이언트에 저장된 토큰과 서버에 저장된 토큰을 모두 삭제합니다.<br/>
> 이때 네트워크 오류가 발생하면 서버 호출에 실패하기 때문에 서버에 저장된 토큰을 삭제하지 못할 수 있습니다. 
> PC에서 네이버의 내정보 > 보안설정 > 외부 사이트 연결 페이지에 접속해 외부사이트 → 네이버에서 확인했을 때 연결 정보가 삭제되지 않은 채로 남아 있을 수 있습니다.


### 2.6. 프로필 API 호출
접근 토큰으로 프로필 정보를 가져올 때는 `NidOAuth.getUserProfile(callback)` 혹은 `NidOAuth.getUserProfileMap(callback)` 메서드를 사용합니다.

```kt
// 사용예시

NidOAuth.getUserProfile( 
    object : NidProfileCallback<NidProfile> {
        override fun onSuccess(result: NidProfile) {
            Toast.makeText(
                context,
                "$result",
                Toast.LENGTH_SHORT,
            ).show()
            binding.tvApiResult.text = result.toString()
        }

        override fun onFailure(
            errorCode: String,
            errorDesc: String,
        ) {
            Toast.makeText(
                context,
                "errorCode:$errorCode, errorDesc:$errorDesc",
                Toast.LENGTH_SHORT,
            ).show()
            binding.tvApiResult.text = ""
        }
    },
)

// OR

NidOAuth.getUserProfileMap(
    object : NidProfileCallback<NidProfileMap> {
        override fun onSuccess(result: NidProfileMap) {
            Toast.makeText(
                context,
                "$result",
                Toast.LENGTH_SHORT,
            ).show()
            binding.tvApiResult.text = result.toString()
        }

        override fun onFailure(
            errorCode: String,
            errorDesc: String,
        ) {
            Toast.makeText(
                context,
                "errorCode:$errorCode, errorDesc:$errorDesc",
                Toast.LENGTH_SHORT,
            ).show()
            binding.tvApiResult.text = ""
        }
    },
)
```

### 3. 기타 설정
#### 3.1. 로그 설정
Android의 logcat 로그에 네이버 로그인 로그를 확인할 수 있게 하려면 `NidOAuth` 객체에서 `setLogEnabled` 메소드를 통해 설정합니다.

네아로SDK가 출력하는 logcat 로그의 접두어는 NaverIdLogin입니다.

```kt
// 사용 예시
NidOAuth.setLogEnabled(true)
```

> **주의** <br/>
> 로그 출력이 활성화되면 토큰 등의 민감한 정보가 로그에 표시되기 때문에 배포 버전에는 로그를 남기지 않도록 false로 설정합니다.

#### 3.2. 문구 변경
다국어 지원 등으로 대화 상자에 나타나는 문구를 변경하려면 다음 예제와 같이 리소스 파일 (예: res/value/message.xml)을 덮어 쓸 수 있습니다.

```xml
<resources>
      <string name="naveroauthlogin_string_getting_token">Receiving access token..</string>
</resources>
```

설정 가능한 리소스 이름은 다음과 같습니다.

| 리소스 명 | 기본 설정 |
| :-- | :-- |
| use_application | 사용할 어플리케이션 |
| retry | 재시도 |
| naveroauthlogin_string_getting_token | 네이버 아이디로 로그인 중입니다. |
| naveroauthlogin_string_network_state_not_available | 네트워크에 접속할 수 없습니다. 네트워크 연결상태를 확인해 주세요. |
| naveroauthlogin_string_group_id_not_available | 단체아이디는 네이버 아이디로 로그인이 지원되지 않습니다. 개인아이디로 로그인 해 주세요. |
| naveroauthlogin_string_update_naverapp | 네이버 앱 업데이트 후 이용할 수 있는 서비스입니다. |


### 4. 네아로SDK API 상세 설명
#### 4.1. NidOAuthErrorCode
OAuth 인증 과정 중 발생할 수 있는 오류의 에러 코드를 가지고 있는 enum 타입의 클래스입니다. 

##### 4.1.1 NidOAuthErrorCode 클래스 프로퍼티

- code
- description

###### 4.1.1.1 code

**설명** <br/>
에러 코드를 반환합니다.

**구문**
```kt
val code: String
```

**반환값** <br/>
에러 코드

**코드 예** <br/>
없음

###### 4.1.1.2 description

**설명** <br/>
오류에 대한 설명을 반환합니다.

**구문**
```kt
val description: String
```

**반환값** <br/>
오류에 대한 설명

**코드 예** <br/>
없음

##### 4.1.2 NidOAuthErrorCode 구성
NidOAuthErrorCode 속 Code는 크게 두 가지로 구분됩니다.

1. 'The OAuth 2.0 Authorization Framework' 문서 의 '4.1.2.1. Error Response'에서 제시하는 오류 유형에 해당하는 에러 코드

    - `SERVER_ERROR_`로 시작하는 에러 코드는 서버에서 발생하는 오류의 에러 코드입니다.

    - `CLIENT_ERROR_`로 시작하는 에러 코드는 애플리케이션에서 발행하는 오류의 에러 코드입니다.

2. 그 외 OAuth 인증 과정에서 발생할 수 있는 추가적인 에러 코드
    - `ACTIVITY_IS_SINGLE_TASK`는 개발자 설정의 활동 보관 안 함 설정에 관련된 에러 코드입니다.

    - 네아로SDK v5.2.0 부터 WebView 가 제거되었습니다. WebView 로그인 모드로 인증을 시도할 경우 `WEB_VIEW_IS_DEPRECATED` 에러코드를 반환합니다.

    - `NO_APP_FOR_AUTHENTICATION`는 인증을 진행할 수 있는 앱(네이버앱이나 커스텀탭)이 없는 경우 발생합니다.

    - `SDK_IS_NOT_INITIALIZED`는 SDK 초기화가 되지 않은 경우 발생합니다.
    
    - `NEED_APP_UPDATE`는 인증 과정에서 네이버앱 업데이트가 필요한 경우 발생합니다.

    - `SDK_EXECUTION_ERROR / ERROR_NO_CATEGORIZED`는 SDK 동작 과정에서 알 수 없는 오류가 발생한 경우에 대한 에러 코드입니다.

상세 에러 코드의 종류는 아래를 참고해주세요.

<details>
<summary>에러 코드 종류 보기</summary>

- NONE
- SERVER_ERROR_INVALID_REQUEST
- SERVER_ERROR_UNAUTHORIZED_CLIENT
- SERVER_ERROR_ACCESS_DENIED
- SERVER_ERROR_UNSUPPORTED_RESPONSE_TYPE
- SERVER_ERROR_INVALID_SCOPE
- SERVER_ERROR_SERVER_ERROR
- SERVER_ERROR_TEMPORARILY_UNAVAILABLE
- CLIENT_ERROR_PARSING_FAIL
- CLIENT_ERROR_NO_CLIENTID
- CLIENT_ERROR_NO_CLIENTSECRET
- CLIENT_ERROR_NO_CLIENTNAME
- CLIENT_ERROR_NO_CALLBACKURL
- CLIENT_ERROR_CONNECTION_ERROR
- CLIENT_ERROR_CERTIFICATION_ERROR
- CLIENT_USER_CANCEL
- ACTIVITY_IS_SINGLE_TASK
- WEB_VIEW_IS_DEPRECATED
- NO_APP_FOR_AUTHENTICATION
- SDK_IS_NOT_INITIALIZED
- NEED_APP_UPDATE
- ERROR_NO_CATAGORIZED
- SDK_EXECUTION_ERROR

</details>

#### 4.2. NidOAuth
네아로SDK를 초기화하고, 사용하기 위한 매니저 클래스입니다.

> 참고<br/>
> 네아로SDK v5.11.0부터 `NaverIdLoginSDK`, `NidOAuthLogin` 클래스에서 제공하는 API를 통합해 제공합니다.

NidOAuth 클래스의 메서드는 다음과 같습니다.

- getAccessToken()
- getExpiresAt()
- getLastErrorCode()
- getLastErrorDescription()
- getRefreshToken()
- getState()
- getTokenType()
- getVersion()
- initialize(context, clientId, clientSecret, clientName, callback)
- requestLogin(context, launcher)
- requestLogin(context, callback)
- repromptPermissions(context, launcher)
- repromptPermissions(context, callback)
- logout(callback)
- disconnect(callback)
- getUserProfile(callback)
- getUserProfileMap(callback)

##### 4.2.1. getAccessToken()

**설명** <br/>
로그인 결과로 얻은 접근 토큰(access token)을 반환합니다.

**구문**
```kt
fun getAccessToken(): String?
```

**파라미터** <br/>
없음

**반환값** <br/>
접근 토큰

**코드 예**
```kt
val at = NidOAuth.getAccessToken()
```

##### 4.2.2. getExpiresAt()

**설명** <br/>
접근 토큰(access token)의 만료 시간을 반환합니다.

**구문**
```kt
fun getExpiresAt(): Long
```

**파라미터** <br/>
없음

**반환값** <br/>
타임스탬프(단위: 초)

**코드 예**
```kt
Log.d(TAG, "DEBUG expires at : ${NidOAuth.getExpiresAt()}")
```

##### 4.2.3. getLastErrorCode()

**설명** <br/>
마지막으로 실패한 로그인의 에러 코드를 반환합니다.

**구문**
```kt
fun getLastErrorCode(): NidOAuthErrorCode
```

**파라미터** <br/>
없음

**반환값** <br/>
NidOAuthErrorCode 타입의 에러 코드. NidOAuthErrorCode 클래스에 관한 자세한 내용은 `NidOAuthErrorCode`를 참고합니다.

**코드 예**
```kt
val errorCode = NidOAuth.getLastErrorCode().code
val errorDesc = NidOAuth.getLastErrorDescription()
Toast.makeText(context, "errorCode: $errorCode, errorDesc: $errorDesc", Toast.LENGTH_SHORT).show()
```

##### 4.2.4. getLastErrorDescription()

**설명** <br/>
마지막으로 실패한 로그인의 에러 메시지를 반환합니다.

**구문**
```kt
fun getLastErrorDescription(): String?
```

**파라미터** <br/>
없음

**반환값** <br/>
에러 메시지

**코드 예**
```kt
val errorCode = NidOAuth.getLastErrorCode().code
val errorDesc = NidOAuth.getLastErrorDescription()
Toast.makeText(context, "errorCode: $errorCode, errorDesc: $errorDesc", Toast.LENGTH_SHORT).show()
```

##### 4.2.5. getRefreshToken()

**설명** <br/>
로그인 결과로 얻은 갱신 토큰(refresh token)을 반환합니다.

**구문**
```kt
fun getRefreshToken(): String?
```

**파라미터** <br/>
없음

**반환값** <br/>
갱신 토큰

**코드 예**
```kt
Log.d(TAG, "DEBUG refresh token : ${NidOAuth.getRefreshToken()}")
```

##### 4.2.6. getState()

**설명** <br/>
네이버 로그인 인스턴스의 현재 상태를 반환합니다.

**구문**
```kt
fun getState(): NidOAuthLoginState
```

**파라미터** <br/>
없음

**반환값** <br/>
NidOAuthLoginState 타입의 종류
- NidOAuthLoginState.NEED_INIT
- NidOAuthLoginState.OAUTH_DATA_INITIALIZING
- NidOAuthLoginState.NEED_LOGIN
- NidOAuthLoginState.NEED_REFRESH_TOKEN
- NidOAuthLoginState.OK

NidOAuthLoginState 클래스에 관한 자세한 내용은 [NidOAuthLoginState](#47-nidoauthloginstate)를 참고합니다.

**코드 예**
```kt
if (NidOAuthLoginState.OK.equals(NidOAuth.getState())) {
    // access token 이 있는 상태로 로그인 버튼 안보여 줌
} else {
    showNaverLoginButton()
}
```

##### 4.2.7. getTokenType()

**설명** <br/>
로그인 결과로 얻은 토큰의 타입을 반환합니다.

**구문**
```kt
fun getTokenType(): String?
```

**파라미터** <br/>
없음

**반환값** <br/>
토큰의 타입

**코드 예**
```kt
Log.d(TAG, "DEBUG token type : ${NidOAuth.getTokenType()}")
```

##### 4.2.8. getVersion()

**설명** <br/>
네아로SDK의 버전을 반환합니다.

**구문**
```kt
fun getVersion(): String
```

**파라미터** <br/>
없음

**반환값** <br/>
"5.x.x" 형식으로 된 문자열

**코드 예** <br/>
없음

##### 4.2.9. initialize(context, clientId, clientSecret, clientName, callback)

**설명** <br/>
네이버 로그인 인스턴스에 클라이언트 정보를 설정합니다.

**구문**
```kt
fun initialize(
    context: Context, 
    clientId: String, 
    clientSecret: String, 
    clientName: String,
    callback: NidOAuthInitializingCallback? = null,
)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|context|Context|Y|내부 저장소를 초기화 할 때 사용할 Context 객체|
|clientId|String|Y|애플리케이션 등록 후 발급받은 클라이언트 아이디|
|clientSecret|String|Y|애플리케이션 등록 후 발급받은 클라이언트 시크릿|
|clientName|String|Y|네이버 앱의 로그인 화면에 표시할 애플리케이션 이름(모바일 웹의 로그인 화면을 사용할 때는 서버에 저장된 애플리케이션 이름이 표시됨)|
|callback|NidOAuthInitializingCallback|N|초기화 완료 및 실패에 대한 callback. NidOAuthInitializingCallback에 관한 자세한 내용은 [NidOAuthInitializingCallback](#46-nidoauthinitializingcallback)을 참고합니다.|

**반환값** <br/>
없음

**코드 예**
```kt
NidOAuth.initialize(context, clientId, clientSecret, clientName, callback)
```

##### 4.2.10. requestLogin(context, launcher)
 
 **설명** <br/>
로그인에 성공하면 접근 토큰(access token)과 갱신 토큰(refresh token)을 받아 옵니다. 접근 토큰을 갱신할 때도 활용이 됩니다.

`NidOAuth.getAccessToken()`, `NidOAuth.getRefreshToken()`을 호출함으로써 받아온 토큰을 활용할 수 있습니다.

**구문**
```kt
fun requestLogin(
    context: Context, 
    launcher: ActivityResultLauncher<Intent>
)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|context|Context|Y|메서드를 호출한 Activity의 Context 객체|
|launcher|ActivityResultLauncher&#60;Intent&#62;|Y|OAuth 인증을 실행할 ActivityResultLauncher|

**반환값** <br/>
없음

> **참고** <br/>
> 접근 토큰이 유효하지 않아 API 호출이 실패했을 때(인증 실패) `requestLogin()` 메서드로 접근 토큰을 새로 받아 API를 다시 호출합니다. <br/>
>
> 단, API 인증에 실패했을 때에만 `requestLogin()` 메서드를 호출해야 합니다.
> 서버 오류 등으로 실패했을 때에 `requestLogin()` 메서드를 호출하면 재시도를 무한으로 반복할 수 있습니다. <br/>
>
> 재시도 횟수를 제한하는 로직을 추가하면 서비스를 더 안정적으로 제공할 수 있습니다.

**코드 예**
```kt
// 접근 토큰과 갱신 토큰을 가져오는 경우
// OR 접근 토큰을 갱신하는 경우
NidOAuth.requestLogin(context, launcher)
```

##### 4.2.11. requestLogin(context, callback)
 
 **설명** <br/>
로그인에 성공하면 접근 토큰(access token)과 갱신 토큰(refresh token)을 받아 옵니다. 접근 토큰을 갱신할 때도 활용이 됩니다.

`NidOAuth.getAccessToken()`, `NidOAuth.getRefreshToken()`을 호출함으로써 받아온 토큰을 활용할 수 있습니다.


**구문**
```kt
fun requestLogin(
    context: Context, 
    callback: NidOAuthCallback
)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|context|Context|Y|메서드를 호출한 Activity의 Context 객체|
|callback|NidOAuthCallback|Y|메서드가 끝나고 실행될 callback. NidOAuthCallback에 관한 자세한 내용은 [NidOAuthCallback](#44-nidoauthcallback)을 참고합니다.|

**반환값** <br/>
없음

> **참고** <br/>
> 접근 토큰이 유효하지 않아 API 호출이 실패했을 때(인증 실패) `requestLogin()` 메서드로 접근 토큰을 새로 받아 API를 다시 호출합니다. <br/>
>
> 단, API 인증에 실패했을 때에만 `requestLogin()` 메서드를 호출해야 합니다.
> 서버 오류 등으로 실패했을 때에 `requestLogin()` 메서드를 호출하면 재시도를 무한으로 반복할 수 있습니다. <br/>
>
> 재시도 횟수를 제한하는 로직을 추가하면 서비스를 더 안정적으로 제공할 수 있습니다.

**코드 예**
```kt
NidOAuth.requestLogin(context, callback)
```

##### 4.2.12. repromptPermissions(context, launcher)
 
 **설명** <br/>
재동의를 요청하고, 로그인에 성공하면 접근 토큰(access token)과 갱신 토큰(refresh token)을 받아 옵니다.

`NidOAuth.getAccessToken()`, `NidOAuth.getRefreshToken()`을 호출함으로써 받아온 토큰을 활용할 수 있습니다.

**구문**
```kt
fun repromptPermissions(
    context: Context, 
    launcher :ActivityResultLauncher<Intent>
)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|context|Context|Y|메서드를 호출한 Activity의 Context 객체|
|launcher|ActivityResultLauncher&#60;Intent&#62;|Y|OAuth 인증을 실행할 ActivityResultLauncher|

**반환값** <br/>
없음

**코드 예**
```kt
NidOAuth.repromptPermissions(context, launcher)
```

##### 4.2.13. repromptPermissions(context, callback)
 
 **설명** <br/>
재동의를 요청하고, 로그인에 성공하면 접근 토큰(access token)과 갱신 토큰(refresh token)을 받아 옵니다.

`NidOAuth.getAccessToken()`, `NidOAuth.getRefreshToken()`을 호출함으로써 받아온 토큰을 활용할 수 있습니다.

**구문**
```kt
fun repromptPermissions(
    context: Context, 
    callback :NidOAuthCallback
)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|context|Context|Y|메서드를 호출한 Activity의 Context 객체|
|callback|NidOAuthCallback|Y|메서드가 끝나고 실행될 callback. NidOAuthCallback에 관한 자세한 내용은 [NidOAuthCallback](#44-nidoauthcallback)을 참고합니다.|

**반환값** <br/>
없음

**코드 예**
```kt
NidOAuth.repromptPermissions(context, callback)
```

##### 4.2.14. logout(callback)

**설명** <br/>
클라이언트에 저장된 접근 토큰(access token)과 갱신 토큰(refresh token)을 삭제합니다.

**구문**
```kt
fun logout(callback: NidOAuthCallback)
```

**파라미터** <br/>
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|callback|NidOAuthCallback|Y|메서드가 끝나고 실행될 callback. NidOAuthCallback에 관한 자세한 내용은 [NidOAuthCallback](#44-nidoauthcallback)을 참고합니다.|

**반환값** <br/>
없음

**코드 예**
```kt
binding.logout.setOnClickListener {
    NidOAuth.logout(nidOAuthCallback)
}
```

##### 4.2.15. disconnect(callback)

**설명** <br/>
클라이언트와 서버에 저장된 접근 토큰(access token)과 갱신 토큰(refresh token)을 삭제해 애플리케이션과 네이버 아이디의 연동을 해제합니다.

**구문**
```kt
fun disconnect(callback: NidOAuthCallback)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|callback|NidOAuthCallback|Y|메서드가 끝나고 실행될 callback. NidOAuthCallback에 관한 자세한 내용은 [NidOAuthCallback](#44-nidoauthcallback)을 참고합니다.|

**반환값** <br/>
없음

**코드 예**
```kt
NidOAuth.disconnect(nidOAuthCallback)
```

##### 4.2.16. getUserProfile(callback)

**설명** <br/>
회원 프로필 조회 API를 호출합니다. 성공하면 `NidProfileCallback.onSuccess()`가 실행됩니다.

**구문**
```kt
fun getUserProfile(callback: NidProfileCallback<NidProfile>)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|callback|NidProfileCallback<NidProfile>|Y|메서드가 끝나고 실행될 callback. NidProfileCallback에 관한 자세한 내용은 [NidProfileCallback](#45-nidprofilecallback)을 참고합니다.|

**반환값** <br/>
없음

**코드 예**
```kt
val nidProfileCallback = object : NidProfileCallback<NidProfile> {
    override fun onSuccess(result: NidProfile) {
        Toast
            .makeText(
                context,
                "$result",
                Toast.LENGTH_SHORT,
            ).show()
        binding.tvApiResult.text = result.toString()
    }

    override fun onFailure(
        errorCode: String,
        errorDesc: String,
    ) {
        Toast
            .makeText(
                context,
                "errorCode:$errorCode, errorDesc:$errorDesc",
                Toast.LENGTH_SHORT,
            ).show()
        binding.tvApiResult.text = ""
    }
}

NidOAuth.getUserProfile(nidProfileCallback)
```

##### 4.2.17. getUserProfileMap(callback)

**설명** <br/>
회원 프로필 조회 API를 호출합니다. API 명세에 정의된 값 외의 다른 값도 함께 map 형태로 받을 수 있습니다. 성공하면 `NidProfileCallback.onSuccess()`가 실행됩니다.

**구문**
```kt
fun getUserProfileMap(callback: NidProfileCallback<NidProfileMap>)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|callback|NidProfileCallback<NidProfileMap>|Y|메서드가 끝나고 실행될 callback. NidProfileCallback에 관한 자세한 내용은 [NidProfileCallback](#45-nidprofilecallback)을 참고합니다.|

**반환값** <br/>
없음

**코드 예**
```kt
val nidProfileCallback = object : NidProfileCallback<NidProfileMap> {
    override fun onSuccess(result: NidProfileMap) {
        Toast.makeText(
            context,
            "$result",
            Toast.LENGTH_SHORT,
        ).show()
        binding.tvApiResult.text = result.toString()
    }

    override fun onFailure(
        errorCode: String,
        errorDesc: String,
    ) {
        Toast.makeText(
            context,
            "errorCode:$errorCode, errorDesc:$errorDesc",
            Toast.LENGTH_SHORT,
        ).show()
        binding.tvApiResult.text = ""
    }
}

NidOAuth.getUserProfileMap(nidProfileCallback)
```

#### 4.3. NidLoginButton
네이버 로그인 버튼 클래스. NidLoginButton 클래스의 메서드는 다음과 같습니다

- setOAuthLogin(launcher)
- setOAuthLogin(oauthLoginCallback)

##### 4.3.1. setOAuthLogin(launcher)

**설명** <br/>
네이버 로그인 버튼을 클릭해 로그인하는 경우 OAuth 인증을 실행할 ActivityResultLauncher를 지정합니다.

**구문**
```kt
fun setOAuthLogin(launcher: ActivityResultLauncher<Intent>)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|launcher|ActivityResultLauncher&#60;Intent&#62;|Y|OAuth 인증을 실행할 ActivityResultLauncher|

**반환값** <br/>
없음

**코드 예**
```kt
private val launcher = registerForActivityResult<Intent, ActivityResult>(ActivityResultContracts.StartActivityForResult()) { result ->
        when(result.resultCode) {
            RESULT_OK -> {
                // 네이버 로그인 인증이 성공했을 때 수행할 코드 추가
                // ex. access token, refresh token에 접근 등
                updateView()
            }
            RESULT_CANCELED -> {
                // 실패 or 에러
                val errorCode = NidOAuth.getLastErrorCode().code
                val errorDescription = NidOAuth.getLastErrorDescription()
                Toast.makeText(context, "errorCode:$errorCode, errorDesc:$errorDescription", Toast.LENGTH_SHORT).show()
            }
        }
    }

binding.buttonOAuthLoginImg.setOAuthLogin(launcher)
```

##### 4.3.2. setOAuthLogin(oauthLoginCallback)

**설명** <br/>
네이버 로그인 버튼을 클릭해 로그인하는 경우 로그인 후 실행될 Callback을 지정합니다.

**구문**
```kt
fun setOAuthLogin(oauthLoginCallback: NidOAuthCallback)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|oauthLoginCallback|NidOAuthCallback|Y|버튼을 눌러서 로그인 요청이 완료되면 수행할 Callback. NidOAuthCallback 관한 자세한 내용은 [NidOAuthCallback](#44-nidoauthcallback)를 참고합니다.|

**반환값** <br/>
없음

**코드 예**
```kt
val nidOAuthCallback = object : NidOAuthCallback {
    override fun onSuccess() {
        // 네이버 로그인 인증이 성공했을 때 수행할 코드 추가
        // ex. access token, refresh token에 접근 등
        updateView()
    }

    override fun onFailure(
        errorCode: String,
        errorDesc: String,
    ) {
        Toast.makeText(
            context,
            "errorCode:$errorCode, errorDesc:$errorDesc",
            Toast.LENGTH_SHORT,
        ).show()
        updateView()
    }
}

binding.buttonOAuthLoginImg.setOAuthLogin(nidOAuthCallback)
```

#### 4.4. NidOAuthCallback
OAuth 인증 요청이 종료됐음을 알려 주는 콜백 인터페이스로 NidOAuthCallback 인터페이스의 메서드는 다음과 같습니다.

- onSuccess()
- onFailure(errorCode, errorDesc)

##### 4.4.1. onSuccess()

**설명** <br/>
`NidOAuthCallback` 인터페이스를 상속하는 익명클래스를 만들어 `onSuccess()` 메서드를 구현한 뒤 생성된 인스턴스를 다음 다섯 개 메서드의 파라미터로 전달하면 인스턴스의 `onSuccess()` 메서드로 요청이 성공했음을 확인할 수 있습니다.

- `NidOAuth.requestLogin()`
- `NidOAuth.repromptPermissions()`
- `NidLoginButton.setOAuthLogin()`
- `NidOAuth.logout()`
- `NidOAuth.disconnect()`

위 메서드를 호출해 얻은 데이터는 `NidOAuthCallback`으로 직접 전달되지 않기 때문에 `NidOAuth.getAccessToken()` 메서드나 `NidOAuth.getRefreshToken()` 메서드, `NidOAuth.getLastErrorCode()` 메서드 등으로 확인합니다.

**구문**
```kt
fun onSuccess()
```

**파라미터** <br/>
없음

**반환값** <br/>
없음

**코드 예**
```kt
val nidOAuthCallback = object : NidOAuthCallback {
    override fun onSuccess() {
        // 네이버 로그인 인증이 성공했을 때 수행할 코드 추가
        // ex. access token, refresh token에 접근 등
        updateView()
    }

    override fun onFailure(
        errorCode: String,
        errorDesc: String,
    ) {
        Toast.makeText(
            context,
            "errorCode:$errorCode, errorDesc:$errorDesc",
            Toast.LENGTH_SHORT,
        ).show()
        updateView()
    }
}

binding.buttonOAuthLoginImg.setOAuthLogin(nidOAuthCallback)
```

##### 4.4.2. onFailure(errorCode, errorDesc)

**설명** <br/>
`NidOAuthCallback` 인터페이스를 상속하는 익명클래스를 만들어 `onFailure()` 메서드를 구현한 뒤 생성된 인스턴스를 다음 다섯 개 메서드의 파라미터로 전달하면 인스턴스의 `onFailure()` 메서드로 요청이 실패했음을 확인할 수 있습니다.

- `NidOAuth.requestLogin()`
- `NidOAuth.repromptPermissions()`
- `NidLoginButton.setOAuthLogin()`
- `NidOAuth.logout()`
- `NidOAuth.disconnect()`

위 메서드를 호출해 얻은 데이터는 `NidOAuthCallback`으로 직접 전달되지 않기 때문에 `NidOAuth.getAccessToken()` 메서드나 `NidOAuth.getRefreshToken()` 메서드, `NidOAuth.getLastErrorCode()` 메서드 등으로 확인합니다.

**구문**
```kt
fun onFailure(
    errorCode: String,
    errorDesc: String,
)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|errorCode|String|Y|발생한 에러 code|
|errorDesc|String|Y|발생한 에러에 대한 desc|

**반환값** <br/>
없음

#### 4.5. NidProfileCallback
Profile 요청이 종료됐음을 알려 주는 콜백 인터페이스로 NidProfileCallback 인터페이스의 메서드는 다음과 같습니다.

- onSuccess(result)
- onFailure(errorCode, errorDesc)

##### 4.5.1. onSuccess(result)

**설명** <br/>
`NidProfileCallback` 인터페이스를 상속하는 익명클래스를 만들어 `onSuccess()` 메서드를 구현한 뒤 생성된 인스턴스를 다음 메서드의 파라미터로 전달하면 인스턴스의 `onSuccess()` 메서드로 요청이 성공했음을 확인할 수 있습니다.

- `NidOAuth.getUserProfile(callback)`: result 타입은 `NidProfile`가 됨
- `NidOAuth.getUserProfileMap(callback)`: result 타입은 `NidProfileMap`가 됨

**구문**
```kt
fun onSuccess(result: T)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|result|T|Y|호출하는 함수에 따라 NidProfile or NidProfileMap이 `onSuccess()`로 전달됩니다.|

**반환값** <br/>
없음

**코드 예**
```kt
// getUserProfileMap를 호출하므로 onSuccess 반환값으로 NidProfileMap 필요
val nidProfileCallback = object : NidProfileCallback<NidProfileMap> {
    override fun onSuccess(result: NidProfileMap) {
        Toast.makeText(
            context,
            "$result",
            Toast.LENGTH_SHORT,
        ).show()
        binding.tvApiResult.text = result.toString()
    }

    override fun onFailure(
        errorCode: String,
        errorDesc: String,
    ) {
        Toast.makeText(
            context,
            "errorCode:$errorCode, errorDesc:$errorDesc",
            Toast.LENGTH_SHORT,
        ).show()
        binding.tvApiResult.text = ""
    }
}

NidOAuth.getUserProfileMap(nidProfileCallback)
```

##### 4.5.2. onFailure()

**설명** <br/>
`NidProfileCallback` 인터페이스를 상속하는 익명클래스를 만들어 `onFailure()` 메서드를 구현한 뒤 생성된 인스턴스를 다음 메서드의 파라미터로 전달하면 인스턴스의 `onFailure()` 메서드로 요청이 실패했음을 확인할 수 있습니다.

- `NidOAuth.getUserProfile(callback)`
- `NidOAuth.getUserProfileMap(callback)`

**구문**
```kt
fun onFailure(
    errorCode: String,
    errorDesc: String,
)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|errorCode|String|Y|발생한 에러 code|
|errorDesc|String|Y|발생한 에러에 대한 desc|

**반환값** <br/>
없음

#### 4.6. NidOAuthInitializingCallback
NidOAuth 초기화 완료(성공 혹은 실패) 후 호출되는 Callback 인터페이스로 NidOAuthInitializingCallback 인터페이스의 메서드는 다음과 같습니다.

- onSuccess()
- onFailure(e)

##### 4.6.1. onSuccess()

**설명** <br/>
`NidOAuthInitializingCallback` 인터페이스를 상속하는 익명클래스를 만들어 `onSuccess()` 메서드를 구현한 뒤 생성된 인스턴스를 `NidOAuth.initialize()`의 파라미터로 전달하면 인스턴스의 `onSuccess()` 메서드로 요청이 성공했음을 확인할 수 있습니다.

**구문**
```kt
fun onSuccess()
```

**파라미터** <br/>
없음

**반환값** <br/>
없음

**코드 예**
```kt
val nidOAuthInitializingCallback = object: NidOAuthInitializingCallback {
    override fun onSuccess() {
        // NidOAuth 초기화가 성공적으로 완료된 후 수행할 코드 추가
        Log.d(TAG, "Success to initialize SDK")
    }

    override fun onFailure(e: Exception) {
        Log.e(TAG, "Fail to initialize SDK", e)
    }

}

NidOAuth.initialize(context, clientId, clientSecret, clientName, nidOAuthInitializingCallback)
```

##### 4.6.2. onFailure(e)

**설명** <br/>
`nidOAuthInitializingCallback` 인터페이스를 상속하는 익명클래스를 만들어 `onFailure()` 메서드를 구현한 뒤 생성된 인스턴스를 `NidOAuth.initialize()`의 파라미터로 전달하면 인스턴스의 `onFailure()` 메서드로 요청이 실패했음을 확인할 수 있습니다.

**구문**
```kt
fun onFailure(e: Exception)
```

**파라미터**
| 파라미터 | 타입 | 필수 여부 | 설명 |
|:--:|:--:|:--:|:--|
|e|Exception|Y|발생한 Exception|

**반환값** <br/>
없음

#### 4.7. NidOAuthLoginState
네이버 로그인 인스턴스의 현재 로그인 상태를 반환하는 클래스로 네이버 로그인 인스턴스의 상태의 종류는 다음과 같습니다.
- `NEED_INIT`: 초기화가 필요한 상태. 해당 상태에서는 requestLogin / repromptPermissions 요청이 불가합니다.
- `OAUTH_DATA_INITIALIZING`: NidOAuth 필수 데이터 초기화가 진행 중인 상태. 해당 상태에서는 requestLogin / repromptPermissions 요청이 불가합니다.
- `NEED_LOGIN`: 로그인이 필요한 상태. 접근 토큰(access token)과 갱신 토큰(refresh token)이 모두 없습니다.
- `NEED_REFRESH_TOKEN`: 토큰 갱신이 필요한 상태. 접근 토큰은 없고, 갱신 토큰은 있습니다.
- `OK`: 접근 토큰이 있는 상태. 단, 사용자가 네이버의 내정보 > 보안설정 > 외부 사이트 연결 페이지에서 연동을 해제했다면 서버에서는 상태 값이 유효하지 않을 수 있습니다.
