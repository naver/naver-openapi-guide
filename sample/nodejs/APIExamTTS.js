var express = require('express');
var app = express();
var client_id = 'YOUR_CLIENT_ID';//개발자센터에서 발급받은 Client ID
var client_secret = 'YOUR_CLIENT_SECRET'; //개발자센터에서 발급받은 Client Secret
var fs = require('fs');
app.get('/tts', function (req, res) {
   var api_url = 'https://openapi.naver.com/v1/voice/tts.bin';
   var request = require('request');
   var options = {
       url: api_url,
       form: {'speaker':'mijin', 'speed':'0', 'text':'좋은 하루 되세요'},
       headers: {'X-Naver-Client-Id':client_id, 'X-Naver-Client-Secret': client_secret}
    };
    var writeStream = fs.createWriteStream('./tts1.mp3');
    var _req = request.post(options).on('response', function(response) {
       console.log(response.statusCode) // 200
       console.log(response.headers['content-type'])
    });
  _req.pipe(writeStream); // file로 출력
  _req.pipe(res); // 브라우저로 출력
 });
 app.listen(3000, function () {
   console.log('http://127.0.0.1:3000/tts app listening on port 3000!');
 });
