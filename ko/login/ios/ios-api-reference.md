# 네이버 로그인 라이브러리 API Reference

## 1. `NidOAuth`

```Swift
class NidOAuth
```

네이버 아이디로 로그인에서 제공하는 기본 클래스입니다. NidOAuth 클래스의 메서드는 다음과 같습니다.



### Type Properties

#### 1.1. `shared`

**설명**

`NidOAuth` 싱글턴 인스턴스를 얻습니다.

**구문**

```Swift
static let shared: NidOAuth
```



### Instance Properties

#### 1.2. `accessToken`

**설명**

현재 애플리케이션에 저장된 `AccessToken`(접근 토큰)을 가져옵니다. 저장된 접근 토큰이 없는 경우 `nil`을 반환합니다.

**구문**

```Swift
var accessToken: AccessToken? { get }
```

> **참고** <br/>
> [AccessToken](#4-accesstoken)


#### 1.3. `refreshToken`

**설명**

현재 애플리케이션에 저장된 `RefreshToken`(갱신 토큰)을 가져옵니다. 저장된 갱신 토큰이 없는 경우 `nil`을 반환합니다.

**구문**

```Swift
var refreshToken: RefreshToken? { get }
```

> **참고** <br/>
> [RefreshToken](#5-refreshtoken)

### Instance Methods

#### 1.4. `initialize()`

**설명**

`NidOAuth` 싱글턴 인스턴스를 초기화합니다. `NidOAuth` 를 사용하기 전에 `AppDelegate`의 `application(_:didFinishLaunchingWithOptions:)` 에서 해당 메서드를 호출해야합니다. 

**구문**

```Swift
func initialize()
```

**파라미터**

없음

**반환값**

없음



#### 1.5. `handleURL(_ url:)`

**설명**

네이버 앱으로 인증 후에 서드파티 앱으로 돌어온 URL을 처리합니다. `SceneDelegate` 의 `scene(_ scene: UIScene, openURLContexts: Set<UIOpenURLContext>)` 이나 `application(_ app: UIApplication, open url: URL, options: [UIApplication.OpenURLOptionsKey : Any]) -> Bool`에서 호출되어야합니다.

**구문**

```Swift
func handleURL(_ url: URL) -> Bool
```

**파라미터**

| 파라미터 | 타입  | 필수 여부 |      설명      |
| :------: | :---: | :-------: | :------------: |
|   Url    | `URL` |     Y     | 반환받은 `url` |

**반환값**

`NidOAuth`가 URL을 처리했다면 `true` , 그렇지 않다면 `false`를 반환합니다.



#### 1.6. `setLoginBehavior(_:)`

**설명**

인증을 수행할 수단을 설정합니다.

**구문**

```Swift
func setLoginBehavior(_ behavior: LoginBehavior)
```

**파라미터**

| 파라미터 |      타입       | 필수 여부 |                             설명                             |
| :------: | :-------------: | :-------: | :----------------------------------------------------------: |
| behavior | `LoginBehavior` |     Y     | 설정할 인증 방식<br />기본 값: `appPreferredWithInAppBrowserFallback` |

**반환값**

없음

>  **참고** <br/>[LoginBehavior](#2-loginbehavior)



#### 1.7. `requestLogin(callback:)`

**설명**

네이버 로그인 인증 과정을 시작해서 접근 토큰을 발급 받습니다. 애플리케이션에 저장된 갱신 토큰(refresh token)이 있는 경우 접근 토큰을 갱신합니다.

**구문**

```Swift
func requestLogin(callback: @escaping LoginResultCompletion)
```

**파라미터**

| 파라미터 |          타입           | 필수 여부 |                           설명                            |
| :------: | :---------------------: | :-------: | :-------------------------------------------------------: |
| callback | `LoginResultCompletion` |     Y     | 로그인 프로세스가 끝난 후 결과를 전달할 클로져(`Closure`) |

**반환값**

없음

> **참고** <br/>
> [LoginResultCompletion](#114-loginresultcompletion)



#### 1.8. `logout()`

**설명**

로그아웃을 수행합니다. 클라이언트(애플리케이션)에 저장된 토큰 정보를 삭제합니다.

**구문**

```Swift
func logout()
```

**파라미터**

없음

**반환값**

없음



#### 1.9. `disconnect(callback:)`

**설명**

클라이언트(애플리케이션)와 서버에 저장된 토큰 정보를 삭제합니다. 연동 정보가 삭제됩니다.

**구문**

```Swift
func disconnect(callback: @escaping (Result<Void, NidError>) -> Void)
```

**파라미터**

| 파라미터 |                타입                | 필수 여부 |                             설명                             |
| :------: | :--------------------------------: | :-------: | :----------------------------------------------------------: |
| callback | `(Result<Void, NidError>) -> Void` |     Y     | 연동 해제 프로세스가 끝난 후 결과를 전달할 클로져(`Closure`) |

**반환값**

없음



#### 1.10. `getUserProfile(accessToken:callback:)`

**설명**

사용자가 동의한 프로필 항목을 가져옵니다.

**구문**

```Swift
func getUserProfile(
    accessToken: String,
    callback: @escaping (Result<[String : String], NidError>) -> Void
)
```

**파라미터**

|  파라미터   |                      타입                       | 필수 여부 |                             설명                             |
| :---------: | :---------------------------------------------: | :-------: | :----------------------------------------------------------: |
| accessToken |                    `String`                     |     Y     |      로그인 결과로 받은  `AccessToken`의 `tokenString`       |
|  callback   | `(Result<[String : String], NidError>) -> Void` |     Y     | 가져온 프로필 항목에 대한 결과를 전달할 클로져(`Closure`)<br />프로필 항목 이름과 이에 대한 값이 `Dictionary` 타입으로 전달됨 |

**반환값**

없음



#### 1.11. `reauthenticate(callback:)`

**설명**

사용자로 하여금 다시 한번 인증을 수행하도록 합니다. 네이버앱으로 재인증을 수행하고 간편 로그인이 되어있는 경우 인증 절차가 바로 끝날 수 있습니다. 



**구문**

```Swift
func reauthenticate(callback: @escaping LoginResultCompletion)
```

**파라미터**

| 파라미터 |          타입           | 필수 여부 |                           설명                            |
| :------: | :---------------------: | :-------: | :-------------------------------------------------------: |
| callback | `LoginResultCompletion` |     Y     | 로그인 프로세스가 끝난 후 결과를 전달할 클로져(`Closure`) |

**반환값**

없음



#### 1.12. `repromptPermissions(callback:)`

**설명**

사용자에게 프로필 항목에 대한 동의를 다시 한번 요청합니다.

**구문**

```Swift
func repromptPermissions(callback: @escaping LoginResultCompletion)
```

**파라미터**

| 파라미터 |          타입           | 필수 여부 |                           설명                            |
| :------: | :---------------------: | :-------: | :-------------------------------------------------------: |
| callback | `LoginResultCompletion` |     Y     | 로그인 프로세스가 끝난 후 결과를 전달할 클로져(`Closure`) |

**반환값**

없음



#### 1.13 `verifyAccessToken(_:callback:)`

**설명**

서버 API를 호출해 접근 토큰이 유효한지 확인합니다.

**구문**

```Swift
func verifyAccessToken(
    _ accessToken: String,
    callback: @escaping (Result<Bool, NidError>) -> Void
)
```

**파라미터**

|  파라미터   |                타입                | 필수 여부 |                          설명                           |
| :---------: | :--------------------------------: | :-------: | :-----------------------------------------------------: |
| accessToken |              `String`              |     Y     |    로그인 결과로 받은  `AccessToken`의 `tokenString`    |
|  callback   | `(Result<Bool, NidError>) -> Void` |     Y     | 접근 토큰의 유효성 검사 결과를 처리할 클로져(`Closure`) |

**반환값**

없음



### Type Aliases

#### 1.14. `LoginResultCompletion`

**설명**

로그인 프로세스가 끝났을 때 호출되는 클로져입니다.

**구문**

```Swift
typealias LoginResultCompletion = (Result<LoginResult, NidError>) -> Void
```



## 2. `LoginBehavior`

```Swift
enum LoginBehavior
```

인증 방식을 나타내는 `Enumeration` 입니다.



#### 2.1. `app`

**설명**

네이버 앱으로 인증을 수행합니다.

**구문**

```Swift
case app
```



#### 2.2. `inAppBroswer`

**설명**

 `SafariViewController` 를 사용해서 인증을 수행합니다.

**구문**

```Swift
case inAppBroswer
```



#### 2.3. `appPreferredWithInAppBrowserFallback` 

**설명**

네이버 앱이 설치되어 있는 경우 네이버 앱으로, 그렇지 않은 경우 `SafariViewController` 로 인증을 수행합니다.

**구문**

```Swift
case appPreferredWithInAppBrowserFallback
```



## 3. `LoginResult`

```Swift
struct LoginResult
```

로그인 결과를 포함하고 있는 객체입니다.



#### 3.1. `accessToken`

**설명**

네이버 로그인 서버에서 받은 `AccessToken` 객체를 반환합니다.

**구문**

```Swift
let accessToken: AccessToken
```

**참고** <br/>

[AccessToken](#4-accesstoken)

#### 3.2. `refreshToken`

**설명**

네이버 로그인 서버에서 받은  `RefreshToken` 객체를 반환합니다.

**구문**

```Swift
let refreshToken: RefreshToken
```

**참고** <br/>

[RefreshToken](#5-refreshtoken)

## 4. `AccessToken`

```Swift
struct AccessToken
```

네이버 로그인에서 사용하는 접근 토큰을 나타내는 객체입니다.



#### 4.1. `tokenString`

**설명**

접근 토큰 값을 나타냅니다.

**구문**

```Swift
let tokenString: String
```



#### 4.2. `expiresAt`

**설명**

접근 토큰의 만료 시각을 나타냅니다. 접근 토큰이 발급된 GMT+0에서 유효 기간(3,600초)만큼을 더한 값으로 계산합니다.

**구문**

```Swift
let expiresAt: Date
```



#### 4.3. `isExpired`

**설명**

접근 토큰이 만료 되었는지 반환합니다. 만료되었다면 `true`, 그렇지 않다면 `false`를 반환합니다.

**구문**

```Swift
var isExpired: Bool { get }
```



## 5. `RefreshToken`

```Swift
struct RefreshToken
```

네이버 로그인에서 사용하는 갱신 토큰(refresh token)을 나타내는 객체입니다.



#### 5.1. `tokenString`

**설명**

갱신 토큰 값을 나타냅니다.

**구문**

```Swift
let tokenString: String
```



## 6. `NidError`

```Swift
enum NidError
```

네이버 아이디로 로그인 SDK에서 발생할 수 있는 에러들을 정의하는 `Enumeration` 타입입니다.



#### 6.1. `clientError(NidError.ClientErrorDetail)`

**설명**

클라이언트(서드파티 앱)에서 발생한 에러를 나타냅니다.

**구문**

```Swift
case clientError(NidError.ClientErrorDetail)
```



#### 6.2. `serverError(NidError.ServerErrorDetail)`

**설명**

서버에서 발생한 에러를 나타냅니다.

**구문**

```Swift
case serverError(NidError.ServerErrorDetail)
```



#### 6.3. `ClientErrorDetail`

**설명**

클라이언트에서 발생한 에러에 대한 설명을 나타내는 `Enumeration` 타입입니다.

**구문**

```Swift
enum ClientErrorDetail
```



##### 6.3.1. `canceledByUser`

**설명**

사용자가 로그인 프로세스를 취소했을 때 발생하는 에러입니다.

**구문**

```Swift
case canceledByUser
```



##### 6.3.2. `initalizeNotCalled`

**설명**

`NidOAuth`의 `initialize()` 가 `AppDelegate` 의 `application(_:didFinishLaunchingWithOptions:)` 에서 호출되지 않았을 때 발생하는 에러입니다.

**구문**

```Swift
case initalizeNotCalled
```



##### 6.3.3. `invalidClientConfigurationFormat`

**설명**

`Info.plist`에 작성한 값들이 유효한 포맷이지 않을 때 발생하는 에러입니다.

**구문**

```Swift
case invalidClientConfigurationFormat
```



##### 6.3.4. `missingClientConfiguration(key: String)`

**설명**

`Info.plist`에 `key`에 해당하는 값이 없을 때 발생하는 에러입니다. `NidClientID`, `NidClientSecret`, `NidAppName`, `NidUrlScheme`이 `Info.plist`에 작성되어있는지 확인해주세요.

**구문**

```Swift
case missingClientConfiguration(key: String)
```



##### 6.3.5. `naverAppNotInstalled`

**설명**

`NidOAuth`의 `loginBehavior`가 `app`으로 설정되어있지만, 사용자가 네이버앱을 설치하지 않아 로그인이 불가능할 때 발생하는 에러입니다.

**구문**

```Swift
case naverAppNotInstalled
```



##### 6.3.6. `unsupportedResponseType`

**설명**

정의되지 않은 반환 형식으로 요청했을 때 서버에서 내려주는 에러입니다.

**구문**

```Swift
case unsupportedResponseType
```



#### 6.4. `ServerErrorDetail`

**설명**

서버에서 발생한 에러에 대한 설명을 나타내는 `Enumeration` 타입입니다.

**구문**

```Swift
enum ServerErrorDetail
```

#### 

##### 6.4.1. `authError`

**설명**

네이버 로그인 서버에서 전달한 에러를 나타냅니다.

**구문**

```Swift
case authError(
    errorCode: String,
    errorDescription: String?
)
```

> **참고** <br/>
>
> [네이버 로그인 에러 코드](https://developers.naver.com/docs/login/api/api.md#5--%EC%97%90%EB%9F%AC-%EC%BD%94%EB%93%9C)



##### 6.4.2. `invalidResponseFormat`

**설명**

네아로 SDK가 정의하지 않은 응답이 서버로부터 내려올 때 발생하는 에러입니다.

**구문**

```Swift
case invalidResponseFormat
```



##### 6.4.3. `invalidState`

**설명**

인가 코드 발급 요청 할 때 생성한 state와 인가 코드와 함께 응답 받은 state 값이 다를 때 발생하는 에러입니다.

`expected` 값을 기대했지만 `actual`이 전달되었다는 것을 뜻합니다.

**구문**

```Swift
case invalidState(
    expected: String,
    actual: String?
)
```



##### 6.4.4. `invalidURLResponse`

**설명**

서드파티앱으로 돌아왔을 때 전달된 url이 네아로 SDK가 정의하지 않은 형태일 때 발생하는 에러입니다.

**구문**

```Swift
case invalidURLResponse(URL)
```



##### 6.4.5. `networkError`

**설명**

네트워크 에러를 나타냅니다.

**구문**

```Swift
case networkError((any Error)?)
```



##### 6.4.6. `webAuthenticationInternalError`

**설명**

`SafariViewController` 내부에서 발생한 에러를 나타냅니다.



**구문**

```Swift
case webAuthenticationInternalError((any Error)?)
```
