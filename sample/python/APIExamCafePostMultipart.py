import os
import sys
import requests
import urllib.request
token = "YOUR_ACCESS_TOKEN" # 네아로 접근 토큰
header = "Bearer " + token # Bearer 다음에 공백 추가
clubid = "28339939" # 카페의 고유 ID값 http://cafe.naver.com/apiexam
menuid = "1"
url = "https://openapi.naver.com/v1/cafe/" + clubid + "/menu/" + menuid + "/articles"

subject = urllib.parse.quote("네이버 Cafe api Test Python")
content = urllib.parse.quote("<font color='red'>python multi-part</font>로 첨부한 글입니다. <br> python 이미지 첨부 <br> <img src='#0' /> <img src='#1' />")
data = {'subject': subject, 'content': content}
files = [
    ('image', ('captcha.jpg', open('captcha.jpg', 'rb'), 'image/jpeg', {'Expires': '0'})),
    ('image', ('ptest.jpg', open('ptest.jpg', 'rb'), 'image/jpeg', {'Expires': '0'}))
    ]

headers = {'Authorization': header }
response = requests.post(url, headers=headers, data=data, files=files)

rescode = response.status_code
if(rescode==200):
    print (response.text)
else:
    print(rescode)
