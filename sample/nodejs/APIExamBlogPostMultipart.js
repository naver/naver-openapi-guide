var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN" // 네아로 접근 토큰
var header = "Bearer " + token; // Bearer 다음에 공백 추가
var title = "네이버 블로그 api Test node js";
var contents = "<font color='red'>node js multi-part</font>로 첨부한 글입니다. <br> nodejs 이미지 2개 첨부 <br> <img src=\"#0\" /> <img src=\"#1\" />";
var fs = require('fs');
app.get('/blog/post/multipart', function (req, res) {
   var api_url = 'https://openapi.naver.com/blog/writePost.json';
   var request = require('request');
   var _formData = {
     title:title,
     contents:contents,
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
   console.log('http://127.0.0.1:3001/blog/post/multipart app listening on port 3001!');
 });
