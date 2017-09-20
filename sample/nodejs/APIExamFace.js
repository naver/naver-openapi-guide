var express = require('express');
var app = express();
var client_id = 'YOUR_CLIENT_ID';
var client_secret = 'YOUR_CLIENT_SECRET';
var fs = require('fs');
app.get('/vision', function (req, res) {
   var request = require('request');
   var api_url = 'https://dev.openapi.naver.com/v1/vision/face';
   var _formData = {
     image:'image',
     image: fs.createReadStream(__dirname + '/test.jpg')
   };
    var _req = request.post({url:api_url, formData:_formData,
      headers: {'X-Naver-Client-Id':client_id, 'X-Naver-Client-Secret': client_secret}}).on('response', function(response) {
       console.log(response.statusCode) // 200
       console.log(response.headers['content-type'])
    });
    console.log( request.head  );
    _req.pipe(res); // 브라우저로 출력
 });

 app.listen(3000, function () {
   console.log('http://127.0.0.1:3000/vision app listening on port 3000!');
 });
