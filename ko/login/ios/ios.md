# iOS

>  위 문서는 네이버 아이디로 로그인 iOS SDK의 최신 버전에 대한 가이드를 제공합니다.

네이버 아이디로 로그인 iOS SDK는 서드파티 애플리케이션에서 네이버에서 제공하는 로그인, 로그아웃, 토큰 관리 등의 기능을 쉽게 구현할 수 있게 합니다.

<div class="con">
    <div class="buttons2">
        <a class="btn_b_hi3" href="https://github.com/naver/naveridlogin-sdk-ios-swift">라이브러리 및 샘플앱 보기 &gt;</a>
        <a class="btn_b_hi3" href="https://github.com/naver/naveridlogin-sdk-ios-swift/issues">이슈 등록 &gt;</a>
        <a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?api=nvlogin">오픈 API 이용 신청 &gt;</a>
    </div>
</div>



라이브러리 및 샘플앱 보기를 통해 소스코드를 참고할 수 있습니다.

문의사항이 있다면 GitHub Issue를 생성해서 이슈를 등록해주세요.

네이버 아이디로 로그인을 구현하기 전 오픈 API 이용 신청을 먼저 진행해주세요.



아래 네아로 SDK 적용 예제는 Swift로 작성되었습니다. 개발 시 참고 부탁드립니다.



## 1. 요구 사항

네이버 아이디로 로그인 iOS SDK 5.0.0 버전부터는 다음과 같은 환경이 필요합니다.

- 애플리케이션 사용 환경: iOS 13.0 이상
- IDE: Xcode 16.0 이상
- Swift: 5.0 이상





## 2. 네이버 아이디로 로그인 SDK 구성

네이버 아이디로 로그인 iOS SDK는 다음과 같이 이루어져있습니다.

- `NidThirdPartyLogin`: 네아로 SDK
- `NidThirdPartyLoginSample`: 네아로 SDK를 사용하는 예제 프로젝트

<div class="con">
    <div class="buttons2">
        <a class="btn_b_hi3" href="https://github.com/naver/naveridlogin-sdk-ios-swift">라이브러리 및 샘플앱 보기 &gt;</a>
    </div>
</div>



## 3. 개발 환경 설정

네아로 SDK는 CocoaPods와 Swift Package를 통한 설치를 지원합니다.

### 3.1 Swift Package Manager를 사용하는 경우

Xcode 프로젝트를 연 후, `File` > `Add Package Dependencies...` 를 선택합니다.

아래 URL을 패키지 레포지토리(repository)에 입력한 후,  `Add Package` 를 선택합니다.

```
https://github.com/naver/naveridlogin-sdk-ios-swift
```





### 3.2 CocoaPods를 사용하는 경우

`Podfile`에 아래와 같이 작성해서 네이버 아이디로 로그인 SDK 의존성을 추가합니다.

```swift
# Podfile
use_frameworks!

target 'YOUR_APP_TARGET' do
  pod 'NidThirdPartyLogin'
end
```

`YOUR_APP_TARGET` 에는 네아로 SDK 의존성을 추가할 타겟을 작성합니다.



아래 명령어를 입력해 `Podfile`에 작성된 라이브러리를 설치합니다.

```shell
$ pod install
```





## 4. `Info.plist` 설정

### 4.1 애플리케이션 설정 값 등록

로그인을 수행하기 전 아래 항목들을 `Info.plist`에 작성해야합니다.

애플리케이션 설정 값은 <a class="btn_b_hi3" href="https://developers.naver.com/apps/#/register?api=nvlogin">오픈 API 이용 신청 &gt;</a>후, `Application` > `내 애플리케이션` > 앱 선택을 통해 확인할 수 있습니다.



|        Key        |                             설명                             | 확인 방법                                                    |
| :---------------: | :----------------------------------------------------------: | :------------------------------------------------------------ |
|    NidAppName     |      네이버 앱의 로그인 화면에 표시할 애플리케이션 이름      | 직접 입력                                                    |
|    NidClientID    |       애플리케이션 등록 후 발급받은 클라이언트 아이디        | `애플리케이션 정보`                                          |
|  NidClientSecret  |       애플리케이션 등록 후 발급받은 클라이언트 시크릿        | `애플리케이션 정보`                                          |
|   NidUrlScheme    | 애플리케이션을 등록할 때 입력한 URL Scheme으로,<br /> OAuth 2.0 로그인 프로세스가 완료되고 난 뒤 콜백을 받을 URL Scheme | `API 설정` > `로그인 오픈 API 서비스 환경` > `iOS` > `URL Scheme` |



`Info.plist` 를 `Open As` > `Source Code`로 연 후, `<dict>...</dict>`에 다음과 같은 형태로 애플리케이션 설정 값들을 입력합니다.

```Swift
<dict>
  <key>NidAppName</key>
  <string>{애플리케이션 이름}</string
  <key>NidClientID</key>
  <string>{클라이언트 아이디}</string
  <key>NidClientSecret</key>
  <string>{클라이언트 시크릿}</string
  <key>NidUrlScheme</key>
  <string>{콜백 URL Scheme}</string>
</dict>
```



> **참고**<br>
>
>
> 콜백 URL Scheme은 서비스 앱에서 유니크한 값을 사용해야합니다.
> 위 값이 사용자 기기에 설치된 다른 앱과 중복될 경우, 해당 기능이 비정상적으로 동작할 수 있습니다.<br>이를 방지하려면 단순한 값보다는 앱 이름, bundle identifier 등 고유 정보를 포함한 형식의 URL Scheme을 사용하는 것이 좋습니다.



### 4.2 URL Scheme 등록

네이버앱을 통한 로그인 후, 서드파티 앱으로 돌아올 때 필요한 커스텀 URL Scheme을 `Info.plist`에 등록합니다.

```Swift
<key>CFBundleURLTypes</key>
  <array>
    <dict>
      <key>CFBundleURLName</key>
      <string>{URL Scheme Identifier}</string>
      <key>CFBundleURLSchemes</key>
      <array>
      	<string>{콜백 URL Scheme}</string>
      </array>
    </dict>
  </array>
```



> **참고**<br>
>
> `NidUrlScheme` 의 값과 `CFBundleURLSchemes`에 작성된 콜백 URL Scheme 값은 동일해야합니다.



서드파티 앱에서 네이버앱을 실행할 수 있도록  `Queried Url Schemes`에 다음과 같이 네이버앱 URL Scheme을 작성합니다.

```Swift
<key>LSApplicationQueriesSchemes</key>
  <array>
    <string>naversearchapp</string>
    <string>naversearchthirdlogin</string>
  </array>
```





## 5. 기본 설정

### 5.1 `NidOAuth` 초기화

`AppDelegate`의 `application(_:didFinishLaunchingWithOptions:)` 에서 `NidOAuth`의 `initialize()` 메서드를 호출해서 `NidOAuth` 객체를 초기화합니다.

**예제 코드**

```Swift
// AppDelegate.swift
import NidThirdPartyLogin

func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplication.LaunchOptionsKey: Any]?) -> Bool {
  NidOAuth.shared.initialize()
  return true
}
```





### 5.2 인증 방식 설정

`LoginBehavior` 를 사용해 네이버 로그인에 사용할 인증 방식을 설정합니다.

iOS에서 네이버 로그인을 사용할 때 설정 가능한 인증 방식은 3가지가 있습니다.

1. 네이버 앱을 활성화해서 인증하는 방식
2. 애플리케이션 내에서 `SafariViewController`를 실행해 인증하는 방식
3. 네이버 앱이 설치된 경우 네이버 앱으로 인증, 네이버 앱이 설치되어있지 않은 경우 `SafariViewController`를 실행해 인증하는 방식



각 방식에 대한 설정 방법은 다음과 같습니다.

```Swift
NidOAuth.shared.setLoginBehavior(.app) // 1번 방식
NidOAuth.shared.setLoginBehavior(.inAppBrowser) // 2번 방식
NidOAuth.shared.setLoginBehavior(.appPreferredWithInAppBrowserFallback) // 3번 방식
```

위 3가지 방식 중 하나를 선택하여 인증 방식을 설정할 수 있습니다.



> **참고**<br>
>
> 인증 방식을 개발자가 설정하지 않는 경우, 기본적으로 3번 방식 (`appPreferredWithInAppBrowserFallback`)으로 인증을 수행합니다.





### 5.3 앱 복귀 처리

네이버앱에서 서드파티 앱으로 돌아왔을 때의 URL을 처리하려면, `AppDelegate` 또는 `SceneDelegate` 에서 URL을 핸들링해줘야합니다. 

deployment target이 iOS 13.0 이상이라면, 기본적으로  `SceneDelegate`를 사용해서 URL을 처리하게 됩니다. 만약 `SceneDelegate`를 사용하고 있지 않다면, `AppDelegate` 에서 URL을 처리합니다.

아래 코드를 참고해서`NidOAuth`의 `handleURL()`을 작성해주세요.



> **참고**<br>
> `UIApplicationSceneManifest` 설정이 `Info.plist` 파일에 있다면 `SceneDelegate`에서, 그렇지 않다면 `AppDelegate` 에서 URL을 처리합니다.



**SceneDelegate 예제 코드**

```Swift
// SceneDelegate.swift
func scene(_ scene: UIScene, openURLContexts URLContexts: Set<UIOpenURLContext>) {
  if let url = URLContexts.first?.url {
    if (NidOAuth.shared.handleURL(url) == true) { // 네이버앱에서 전달된 Url인 경우
      return
    }
    
    // 다른 앱에서 들어온 Url 처리
  }
  ...
}
```



**AppDelegate 예제 코드**

```Swift
// AppDelegate.swift
func application(_ app: UIApplication, open url: URL, options: [UIApplication.OpenURLOptionsKey : Any] = [:]) -> Bool {
  if (NidOAuth.shared.handleURL(url) == true) { // 네이버앱에서 전달된 Url인 경우
    return true
  }
		
  // 다른 앱에서 들어온 url 처리
  
  return false
}
```



> **참고**<br>
>
> `handleURL()` 의 결과가 `false` 라면 네이버앱이 아닌 다른 앱에서 들어온 url로 처리해야합니다.



## 6. 로그인

`NidOAuth` 객체 싱글톤 인스턴스의 다음 API를 호출해 접근 토큰(Access Token)을 요청합니다.

```Swift
func requestLogin(callback: @escaping LoginResultCompletion)
```

API가 호출되면, 네이버앱 혹은 `SafariViewController`를 통해 로그인 프로세스가 시작됩니다.





 `callback` 파라미터에는 로그인 프로세스가 끝났을 때 호출할 `LoginResultCompletion` 타입의 클로저를 전달합니다.

```Swift
typealias LoginResultCompletion = (Result<LoginResult, NidError>) -> Void
```





로그인에 성공했을 때는 Result Type으로 `Success`와 함께 `LoginResult`가 전달됩니다.

`LoginResult` 는  `AccessToken`과 `RefreshToken`을 포함하고 있습니다.

```Swift
struct LoginResult {
  let accessToken: AccessToken
  let refreshToken: RefreshToken
}
```

`AccessToken`의 `tokenString` 속성에 접근해서 접근 토큰 값을 획득할 수 있습니다.





로그인에 실패했을 때는 Result Type으로 `Failure`와 함께 `NidError`가 전달됩니다.

`NidError`는 열거형 타입으로 발생한 에러에 대한 정의가 포함되어 있습니다.

> **참고**<br> [NidError](ios-api-reference.md#6--niderror)



**예제 코드**

```Swift
NidOAuth.shared.requestLogin { result in
  switch result {
  case .success(let loginResult):
    print("Access Token: ", loginResult.accessToken.tokenString)
  case .failure(let error):
    print("Error: ", error.localizedDescription)
  }
}
```





## 7. 접근 토큰 및 갱신 토큰 획득

`NidOAuth`을 통해 클라이언트에 저장된 `AccessToken`과 `RefreshToken`을 얻을 수 있습니다.

```Swift
// NidOAuth.swift
var accessToken: AccessToken? { get }
var refreshToken: RefreshToken? { get }
```

> **참고**<br>
>
> [AccessToken](ios-api-reference.md#4--accesstoken) <br>
>
> [RefreshToken](ios-api-reference.md#5--refreshtoken)





## 8. 접근 토큰 갱신

발급받은 접근 토큰의 유효 기간은 3,600초(1시간)입니다.

유효 기간이 지나면 갱신 토큰으로 접근 토큰을 재발급(갱신)받아야 합니다.



유효 기간이 만료되어서 접근 토큰 갱신이 필요한 경우, 최초 로그인 요청과 동일하게 아래 메서드를 호출해서 갱신이 가능합니다.

```Swift
func requestLogin(callback: @escaping LoginResultCompletion)
```



접근 토큰 유효 기간이 지났는지는 `AccessToken` 객체의 다음 속성으로 확인 가능합니다.

```Swift
var isExpired: Bool { get }
```



위 API는 유효 기간만 확인하므로,
`AccessToken`이 유효한지 서버를 통해 확인해보고 싶은 경우에는 다음 메서드를 통해서 확인할 수 있습니다.

```Swift
func verifyAccessToken(
    _ accessToken: String,
    callback: @escaping (Result<Bool, NidError>) -> Void
)
```



**예제 코드**

```Swift
if let accessToken = NidOAuth.shared.accessToken(),
     !accessToken.isExpired {
  print("AccessToken: " accessToken.tokenString)
} else {
  // AccessToken이 없거나 유효하지 않은 경우
  NidOAuth.shared.requestLogin {
    ...
  }
}
```





## 9. 로그아웃

사용자가 애플리케이션에서 로그아웃하면 애플리케이션에 저장된 토큰 정보를 삭제합니다. 다음은 클라이언트에 저장된 토큰 정보를 삭제하는 메서드입니다.

```Swift
func logout()
```

> **약전계에서 로그아웃 호출 시**<br>
>
> 애플리케이션에 저장된 토큰만 삭제하므로 약전계나 네트워크 오류에 영향을 받지 않습니다.





## 10. 연동 해제

사용자가 애플리케이션과 네이버 로그인 연동을 해제하면 애플리케이션에 저장된 토큰 정보와 네이버 서버에 저장된 인증 정보를 삭제합니다. 다음은 연동 해제를 요청하는 메서드입니다.

```Swift
func disconnect(callback: @escaping (Result<Void, NidError>) -> Void)
```

연동 해제 요청이 끝나면 파라미터로 넘어온 `callback`이 호출됩니다.

연동 해제에 성공했을 때는 콜백에 Result Type으로 `Success`가 전달 되며,
연동 해제에 실패했을 때는 콜백에 Result Type으로 `Failure`와 함께 `NidError`가 전달됩니다.



사용자가 PC에서 네이버의 `내정보` > `이력관리` > `연결된 서비스 관리` >`연결 계정 관리`에 접속하면, 연동이 해제된 것을 확인할 수 있습니다.



>  **약전계에서 연동 해제 시** <br>
> `disconnect()` 메서드로 연동을 해제할 때는 클라이언트에 저장된 토큰과 서버에 저장된 토큰을 모두 삭제합니다. 이때 네트워크 오류가 발생하면 서버 호출에 실패하기 때문에 서버에 저장된 토큰을 삭제하지 못할 수 있습니다.





## 11. 재인증 및 재동의

### 11.1 사용자 재인증이 필요한 경우

접근 토큰이 유효하더라도 사용자로 하여금 다시한번 인증을 수행하여 계정 보안 수준을 높이고자 할 때 재인증 API를 통해서 사용자 인증을 수행할 수 있습니다.



**SafariViewController로 재인증을 하는 경우**

1. 네이버 로그인 재인증 요청
2. 현재 로그인 상태와 관계없이 네이버 로그인 절차 요구
3. ID/PW 입력
4. 인증 완료



사용자 재인증 API는 `NidOAuth`의 `reauthenticate()` 메서드로 제공하고 있습니다.

```Swift
func reauthenticate(callback: @escaping LoginResultCompletion)
```



**네이버앱으로 재인증을 하는 경우**

네이버앱으로 재인증을 수행하는 경우, ID/PW 입력 절차가 사라집니다.

사용자로 하여금 ID/PW를 입력하게 하고 싶다면, `LoginBehavior` 를 `inAppBrowser`로 설정해주세요.



> **참고**<br>
>
> [인증 방식 설정](#5-2-인증-방식-설정)





### 11.2 사용자 재동의가 필요한 경우

사용자는 네이버 로그인 최초 연동 동의 과정에서 특정 프로필 항목에 대하여 제공하지 않음으로 선택할 수 있습니다. 제공이 거부된 프로필 항목이 서비스 이용에 반드시 필요한 항목일 경우에는 사용자로 하여금 다시한번 동의로 선택하도록 재동의를 요청하는 것이 가능합니다.



사용자 재동의 API는 `NidOAuth`의 `repromptPermissions()` 메서드로 제공하고 있습니다.

```Swift
func repromptPermissions(callback: @escaping LoginResultCompletion)
```





## 12. 오픈 API 호출

발급된 접근 토큰(Access Token)을 사용해서 오픈 API 호출과 같이 보호된 자원에 접근하는 기능을 실행할 수 있습니다. 

오픈 API 호출 전에는 발급 받은 `AccessToken`이 유효한지 확인해야합니다.



프로필 API 호출은 `NidOAuth`에서 `getUserProfile()`메서드로 제공하고 있습니다.

```Swift
func getUserProfile(
  accessToken: String,
  callback: @escaping (Result<[String : String], NidError>) -> Void
)
```



> **참고**<br>
>
> [프로필 API 필드](../profile/profile.md)



**예제 코드**

```Swift
func getUserProfile() {
  if let accessToken = NidOAuth.shared.accessToken(),
    !accessToken.isExpired { // 접근 토큰이 유효하다면 바로 프로필 API 호출
    fetchUserProfile(accessToken: accessToken)
  } else {
    // AccessToken이 없거나 유효하지 않은 경우
    NidOAuth.shared.requestLogin { result in
    case .success(let loginResult):
      fetchUserProfile(accessToken: loginResult.accessToken)
    case .failure(let error):
      print("Error: ", error.localizedDescription)
    }
  }
}

func fetchUserProfile(accessToken: AccessToken) {
  NidOAuth.shared.getUserProfile(accessToken.tokenString) { result in
    switch result {
      case .success(let profileResult):
        print("User Name: ", profileResult["name"])
      case .failure(let error):
        print("Error: ", error.localizedDescription)
    }
  }
}
```



그 외의 오픈 API 호출은 HTTP 요청 헤더에 다음과 같이 접근 토큰을 Bearer 형식으로 지정해서 가능합니다.

**예제 코드**

```Swift
guard let accessTokenRawValue = NidOAuth.shared.accessToken()?.tokenString else {
  return
}

let url = URL(string:"https://oppnapi.naver.com/v1/cafe/{CAFE_ID}/members")!
let urlRequest = URLRequest(url: url)
let authValue = "Bearer \(accessTokenRawValue)"
urlRequest.setValue(authValue, forHTTPHeaderField: "Authorization")
```
