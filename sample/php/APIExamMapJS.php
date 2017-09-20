<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>간단한 지도 표시하기</title>
      <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=FtBWzeNmpuNxn3BytwEA"></script>
  </head>
  <body>
    <div id="map" style="width:100%;height:400px;"></div>
    <script>
      var map = new naver.maps.Map('map', {center: new naver.maps.LatLng(37.3595704, 127.105399)});
    </script>
  </body>
</html>
