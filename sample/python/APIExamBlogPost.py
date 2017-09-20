import os
import sys
import urllib.request
token = "YOUR_ACCESS_TOKEN" # 네아로 접근 토큰
header = "Bearer " + token # Bearer 다음에 공백 추가
url = "https://openapi.naver.com/blog/writePost.json"
title = urllib.parse.quote("네이버 블로그 api Test Python")
contents = urllib.parse.quote("네이버 블로그 api로 글을 블로그에 올려봅니다.")
data = "title=" + title + "&contents=" + contents
request = urllib.request.Request(url, data=data.encode("utf-8"))
request.add_header("Authorization", header)
response = urllib.request.urlopen(request)
rescode = response.getcode()
if(rescode==200):
    response_body = response.read()
    print(response_body.decode('utf-8'))
else:
    print("Error Code:" + rescode)
