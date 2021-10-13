import os
import sys
import urllib.request
token = "YOUR_ACCESS_TOKEN" # 네이버 로그인 접근 토큰
header = "Bearer " + token # Bearer 다음에 공백 추가
clubid = "28339939" # 카페의 고유 ID값 http://cafe.naver.com/apiexam
url = "https://openapi.naver.com/v1/cafe/" + clubid + "/members"
nickname = urllib.parse.quote("Python")
data = "nickname=" + nickname
request = urllib.request.Request(url, data=data.encode("utf-8"))
request.add_header("Authorization", header)
response = urllib.request.urlopen(request)
rescode = response.getcode()
if(rescode==200):
    response_body = response.read()
    print(response_body.decode('utf-8'))
else:
    print("Error Code:" + rescode)
