var express = require('express');
var app = express();
var token = "YOUR_ACCESS_TOKEN" // 네아로 접근 토큰
var header = "Bearer " + token; // Bearer 다음에 공백 추가
app.get('/member', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/nid/me';
   var request = require('request');
   var options = {
       url: api_url,
       headers: {'Authorization': header}
    };
   request.get(options, function (error, response, body) {
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
   console.log('http://127.0.0.1:3000/member app listening on port 3000!');
 });
