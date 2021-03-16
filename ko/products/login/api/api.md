# 네이버 아이디로 로그인

<html lang="ko">
<head>
    <title>NAVER Developers - 네이버 아이디로 로그인 소개</title>
</head>
<body>
<div class="con">
    <p class="p_desc">
        별도의 아이디, 비밀번호없이 네이버 아이디로 간편하게 외부 서비스에 로그인 할 수 있도록 하는 서비스입니다.
        이용자는 복잡하고 번거로운 회원 가입 절차 없이 편하게 서비스를 이용하고,
        사업자는 회원 가입, 로그인에 대한 허들을 낮춰 회원수가 늘고 매출은 오르는 경험을 할 수 있습니다.
    </p>
    <div class="naveridlogin_intro">
        <div class="naveridlogin_intro_section1">
            <h3 class="h_sub">4,200만 네이버 회원을 여러분의 사용자로!</h3>
            <p class="p_desc">
                네이버 회원이라면, 여러분의 사이트를 간편하게 이용할 수 있습니다. 전 국민 모두가 가지고 있는 네이버 아이디 한개만 있으면 별도 가입없이 어떤 플랫폼에서도 간편하게 로그인할 수 있습니다.
            </p>
        </div>
        <div class="naveridlogin_intro_section2">
            <h3 class="h_sub">불필요한 회원 정보 입력 과정을 없애 주는 프로필 조회 API 제공</h3>
            <p class="p_desc">
                프로필 조회 API를 통해 이름, 메일 주소, 휴대전화번호, 생일, 성별, 연령대 등 필요한 정보를 조회할 수 있습니다.
                가입 과정에서 많은 정보를 입력받지 않아도 되므로 개인정보 관리 부담은 줄어들고,
                사용자는 전달되는 정보를 선택할 수 있어 안심하고 로그인할 수 있습니다.
                또한, 다양한 네이버 서비스와 매시업이 가능합니다.
            </p>
        </div>
        <div class="naveridlogin_intro_section3">
            <h3 class="h_sub">빠른개발, 간편한 운영</h3>
            <p class="p_desc">
                플랫폼 별 SDK를 제공하여 쉽고 빠르게 개발할 수 있도록 지원합니다. 또한 환경별 로그인, 누적 사용자 등 다양한 통계를 제공하여 성과를 확인할 수 있습니다.
            </p>
        </div>
    </div>
    <div class="buttons buttons_center">
        <a class="btn_b_hi" href="https://developers.naver.com/apps/#/register?api=nvlogin">오픈 API 이용 신청</a>
        <a id="btnLoginGuide" class="btn_b_hi cursor btn_m_hide" href="https://developers.naver.com/docs/login/devguide/devguide.md#네이버아이디로그인-개발가이드">개발 가이드 보기</a>
        <a class="btn_b_hi cursor btn_m_view" href="https://developers.naver.com/docs/login/devguide/devguide.md#네이버아이디로그인-개발가이드">개발 가이드 보기</a>
        <a href="./downloads/naverlogin_docu_ver3.pdf" target="_blank" class="btn_b2 cursor">소개 다운받기</button></a>
    </div>
    <div id="loginGuide">
        <div id="dimmed" style="display:none"></div>
        <div id="guide_wrap" style="display:none">
            <div id="container">
                <a class="close_button sprite"><span class="blind">Close</span></a>
                <div id="nir_intro" class="nir_contents intro" style="display: block;">
                    <div class="intro_welcome sprite"><span class="blind">환영합니다</span></div>
                    <div class="intro_title sprite"><h1 class="blind">네아로의 올바른 적용방법을 알아볼까요?</h1></div>
                    <p class="intro_desc sprite"><span class="blind">네이버 아이디로 로그인을 통해 신규 회원을 늘리고, 기존 회원은 간편하게 로그인하게 하려면 <strong>제대로 적용하는 것이 중요합니다!</strong> 이에 올바른 적용방법을 여러분의 애플리케이션 환경에 맞게 알려드립니다.</span></p>
                    <div class="intro_artwork sprite"><span class="blind">'네이버 아이디로 로그인' 이미지</span></div>
                    <p class="nir_info">입력하신 정보는 서비스 안내를 위해서만 사용되며 별도로 보관되지 않습니다.</p>
                    <div class="intro_footer">
                        <a class="nir_button active sprite"><span class="blind">시작하기</span></a>
                    </div>
                </div>
                <div id="nir_question" class="nir_contents nir_question" style="display: none;">
                    <a href="javascript:void(0);" class="back_button sprite"><span class="blind">뒤로 가기</span></a>
                    <div class="question_context">
                        <div class="nir_navigation sprite">
                            <div class="step step1 sprite"><a href="javascript:void(0);"><span class="blind">스텝1</span></a></div>
                            <div class="step step2 sprite"><a href="javascript:void(0);"><span class="blind">스텝2</span></a></div>
                            <div class="step step3 sprite"><a href="javascript:void(0);"><span class="blind">스텝3</span></a></div>
                            <div class="step step4 sprite"><a href="javascript:void(0);"><span class="blind">스텝4</span></a></div>
                        </div>
                        <div class="question_title sprite_question"><h2 class="blind"></h2></div>
                        <div class="question_examples">
                            <form id="nir_answerForm">
                                <div class="question_example example1">
                                    <input type="radio" id="q_a1" name="nir_question" value="1">
                                    <label for="q_a1" class="question_artwork answer1 sprite_question">
                                        <span class="check sprite"><span class="blind">체크</span></span>
                                        <strong class="blind"></strong>
                                        <span class="blind"></span>
                                    </label>
                                </div><div class="question_example example2">
                                <input type="radio" id="q_a2" name="nir_question" value="2">
                                <label for="q_a2" class="question_artwork answer2 sprite_question">
                                    <span class="check sprite"><span class="blind">체크</span></span>
							<span class="subchecks">
								<a href="javascript:void(0);" class="subcheck1 sprite_question"></a>
								<a href="javascript:void(0);" class="subcheck2 sprite_question"></a>
								<a href="javascript:void(0);" class="subcheck3 sprite_question"></a>
								<a href="javascript:void(0);" class="subcheck4 sprite_question"></a>
								<a href="javascript:void(0);" class="subcheck5 sprite_question"></a>
								<a href="javascript:void(0);" class="subcheck6 sprite_question"></a>
								<a href="javascript:void(0);" class="subcheck7 sprite_question"></a>
								<a href="javascript:void(0);" class="subcheck8 sprite_question"></a>
								<a href="javascript:void(0);" class="subcheck9 sprite_question"></a>
								<a href="javascript:void(0);" class="subcheck10 sprite_question"></a>
							</span>
                                    <strong class="blind"></strong>
                                    <span class="blind"></span>
                                </label>
                            </div><div class="question_example example3">
                                <input type="radio" id="q_a3" name="nir_question" value="3">
                                <label for="q_a3" class="question_artwork answer3 sprite_question">
                                    <span class="check sprite"><span class="blind">체크</span></span>
                                    <strong class="blind"></strong>
                                    <span class="blind"></span>
                                </label>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="question_footer">
                        <a href="javascript:void(0);" class="nir_button sprite"><span class="blind">확인</span></a>
                    </div>
                </div>
                <div id="nir_answer" class="nir_contents nir_answer" style="display: none;">
                    <a href="javascript:void(0);" class="back_button sprite"><span class="blind">뒤로 가기</span></a>
                    <div class="answer_context">
                        <div class="nir_navigation sprite">
                            <div class="step step1 sprite"><a href="javascript:void(0);"><span class="blind">스텝1</span></a></div>
                            <div class="step step2 sprite"><a href="javascript:void(0);"><span class="blind">스텝2</span></a></div>
                            <div class="step step3 sprite"><a href="javascript:void(0);"><span class="blind">스텝3</span></a></div>
                            <div class="step step4 sprite"><a href="javascript:void(0);"><span class="blind">스텝4</span></a></div>
                        </div>
                        <div class="answer_wrap">
                            <a href="javascript:void(0);" class="case_button sprite"><span class="blind">잘못 적용한 사례 보기</span></a>
                            <div class="answer_title sprite_answer"><h2 class="blind"></h2></div>
                            <p class="answer_desc sprite_answer"><span class="blind"></span></p>
                            <div class="answer_artwork sprite_answer"><span class="blind">답변 이미지</span></div>
                            <a href="javascript:void(0);" class="nir_button active sprite"><span class="blind">다음단계</span></a>
                            <div id="answer_case" class="case_wrap">
                                <a href="javascript:void(0);" class="case_close_button sprite"><span class="blind">닫기</span></a>
                                <div class="case_type sprite_answer"><span class="blind">잘못 적용한 사례</span></div>
                                <div class="case_title sprite_answer"><span class="blind"></span></div>
                                <p class="case_desc sprite_answer"><span class="blind"></span></p>
                                <div class="case_artwork sprite_answer"></div>
                                <p class="case_info">* 웹사이트 방문자의 97%는 로그인 페이지에서 ID/PW를 입력하는데 집중하느라 페이지 디자인의 변화를 알아차리지 못함<br>&lt; S. E. Schechter, R. Dhamija, A. Ozment, and 1. Fischer, "The emperor's new security indicators," in SP 'OJ: Proceedings of the 200J IEEE Symposium on Security and Privacy. Washington, DC, USA: IEEE Computer Society, 2007, pp.51-65. &gt;</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="nir_appliances" class="nir_contents nir_appliances" style="display: none;">
                    <div class="nir_navigation sprite">
                        <div class="step step1 sprite"><a href="javascript:void(0);"><span class="blind">스텝1</span></a></div>
                        <div class="step step2 sprite"><a href="javascript:void(0);"><span class="blind">스텝2</span></a></div>
                        <div class="step step3 sprite"><a href="javascript:void(0);"><span class="blind">스텝3</span></a></div>
                        <div class="step step4 sprite"><a href="javascript:void(0);"><span class="blind">스텝4</span></a></div>
                    </div>
                    <div class="appliance_title sprite"><span class="blind">네아로를 효과적으로 적용한 사례를 소개합니다.<br> 가입과 로그인이 얼마나 편해졌는지, 직접 확인해보세요!</span></div>
                    <div class="appliance_context">
                        <a href="http://www.galleria.co.kr" target="_blank" class="appliance appliance1 sprite"><span class="blind">쇼핑 갤러리아</span></a>
                        <a href="http://www.happycampus.com/" target="_blank" class="appliance appliance2 sprite"><span class="blind">교육 해피캠퍼스</span></a>
                        <a href="http://www.toptoon.com/" target="_blank" class="appliance appliance3 sprite"><span class="blind">웹툰 탑툰</span></a>
                        <a href="http://www.webtour.com/" target="_blank" class="appliance appliance4 sprite"><span class="blind">여행 웹투어</span></a>
                        <a href="http://www.yesform.com/" target="_blank" class="appliance appliance5 sprite"><span class="blind">비지니스 예스폼</span></a>
                        <a href="https://rememberapp.co.kr/" target="_blank" class="appliance appliance6 sprite"><span class="blind">스타트업 리멤버</span></a>
                    </div>
                    <p class="nir_info">그밖에 더욱 자세한 내용은 <a href="/products/login/userguide" class="link">적용 가이드라인</a>에서 확인하실 수 있습니다.</p>
                    <div class="appliance_footer">
                        <a class="nir_button hover sprite" href="/docs/login/overview"><span class="blind">완료</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
