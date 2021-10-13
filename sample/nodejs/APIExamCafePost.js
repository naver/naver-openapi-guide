var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN" // 네이버 로그인 로그인 접근 토큰
var header = "Bearer " + token; // Bearer 다음에 공백 추가
var clubid = "28339939";// 카페의 고유 ID값 http://cafe.naver.com/apiexam
var menuid = "3"; // 카페 게시판 id
var subject = encodeURI("네이버 카페 api Test node js");
var content = encodeURI("네이버 카페 api로 글을 카페에 글을 올려봅니다.");
app.get('/cafe/post', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/cafe/' + clubid + '/menu/' + menuid + '/articles';
   var request = require('request');
   var options = {
       url: api_url,
       form: {'subject':subject, 'content':content},
       headers: {'Authorization': header}
    };
   request.post(options, function (error, response, body) {
     if (!error && response.statusCode == 200) {
       res.writeHead(200, {'Content-Type': 'text/json;charset=utf-8'});
       res.end(body);
     } else {
       console.log('error');
       if(response != null) {
         res.status(response.statusCode).end();
         console.log('error = ' + response.statusCode);
       }
     }
   });
 });
 app.listen(3000, function () {
   console.log('http://127.0.0.1:3000/cafe/post app listening on port 3000!');
 });
