var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN" // 네이버 로그인 접근 토큰
var header = "Bearer " + token; // Bearer 다음에 공백 추가
var clubid = "28339939";// 카페의 고유 ID값 http://cafe.naver.com/apiexam
var menuid = "1"; // 카페 게시판 id
var subject = encodeURI("네이버 카페 api Test node js");
var content = encodeURI("node js multi-part 네이버 카페 api로 글을 카페에 글을 올려봅니다. <br> <img src=\"#0\" /> <img src=\"#1\" />");
var fs = require('fs');
app.get('/cafe/post/multipart', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/cafe/' + clubid + '/menu/' + menuid + '/articles';
   var request = require('request');
   var _formData = {
     subject:subject,
     content:content,
     image: [
        {
          value: fs.createReadStream(__dirname + '/test.jpg'),
          options: { filename: 'test.jpg',  contentType: 'image/jpeg'}
        },
        {
          value: fs.createReadStream(__dirname + '/captcha.jpg'),
          options: {filename: 'captcha.jpg', contentType: 'image/jpeg'}
        }
     ]
   };
    var _req = request.post({url:api_url, formData:_formData,
       headers: {'Authorization': header}}).on('response', function(response) {
       console.log(response.statusCode) // 200
       console.log(response.headers['content-type'])
    });
    console.log( request.head  );
    _req.pipe(res); // 브라우저로 출력
 });
 app.listen(3001, function () {
   console.log('http://127.0.0.1:3001/cafe/post/multipart app listening on port 3001!');
 });
