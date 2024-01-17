# 한글인명 - 로마자 변환 API 소개

> **지원 종료 안내**
>
> 한글 인명-로마자 변환 기능의 지원이 **2024년 1월 17일(수)**<!-- -->부로 종료됐습니다.

<html lang="ko">
<head>
    <title>NAVER Developers - 네이버 한글인명-로마자 변환 API 소개</title>
</head>
<body>
<div class="con">
    <p class="p_desc">한글로 된 이름을 로마자 표기로 변환해주는 API입니다. 현행 로마자 표기법을 따라 변환한 이름과 통계적으로 많이 사용되고 있는 로마자 이름도 함께 제안 받을 수 있습니다.</p>
    <h3 class="h_sub">일상 속 높은 활용성</h3>
    <p class="p_desc">영어판 명함을 작성할 때, 신용카드를 만들 때, 여권을 새로 만들 때 등 고객들이 본인의 이름에 대한 표준 로마자 표기를 궁금해 하는 경우가 점차 증가하고 있습니다. 이러한 고객의 요구가 있는 서비스들에서 유용하게 활용할 수 있습니다.</p>
    <h3 class="h_sub">편리한 이용</h3>
    <p class="p_desc">한국 인명 로마자 변환 서비스를 독자적으로 구축하기 위해서는 현행 로마자 표기법(문화관광부 고시 2000-8호)을 따로 이해하고 규정에 맞도록 시스템을 개발하여야 합니다. 이러한 개발에 대한 수고와 비용 지출을 덜어드립니다.</p>
    <h3 class="h_sub">다양한 기능 제공</h3>
    <p class="p_desc">본 API에서는 '한국 인명을 로마자 표기법에 의한 표기로 변환'하는 기능과 '한국 인명을 로마자 표기 사용 빈도순에 의한 표기로 변환'하는 두 가지 기능을 모두 제공하므로 용도에 맞게 기능을 선택하여 사용할 수 있습니다.</p>
    <div class="blockquote_area">예 : 강나래 -> Gang Narae, Kang Narae</div>
    <div class="blockquote_area">
        예 : 강나래 -> Kang Narae, Gang Narae, Kang Nare, Kang Nalae, Gang Nare, Gang Nalae
    </div>
    <p class="p_desc"><em class="color_p3">일 처리한도 : 25,000 글자/일</em></p>
    <div class="buttons buttons_center">
        <a class="btn_b_hi" href="https://developers.naver.com/apps/#/register?defaultScope=roman">오픈 API 이용 신청</a>
        <a class="btn_b_hi" href="https://developers.naver.com/docs/papago/papago-romanization-overview.md#한글-인명로마자-변환">개발 가이드 보기</a>
    </div>
</div>
</body>
</html>
