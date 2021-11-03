<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>地理位置测试</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
    <script type="text/javascript" src="http://developer.baidu.com/map/jsdemo/demo/convertor.js"></script>
    <script type="text/javascript">

        /*
         移动端通过浏览器获取地理位置的相关方法，深入了解一下百度地图API的相关功能。
         实现以下功能：
         (1)通过IP地址获取城市地址（并不完全准确，存在代理IP或IP中转时定位与实际位置不一致的情况）
         (2)通过移动端浏览器及GPS定位位置坐标
         (3)根据位置坐标转换百度地图坐标
         (4)根据位置坐标逆推城市具体地址功能（存在一定误差）
         (5)通过使用百度API展示地理位置及添加标注功能
         */

        var map;
        var gpsPoint;
        var baiduPoint;
        var gpsAddress;
        var baiduAddress;

        function getLocation() {
            //根据IP获取城市
            var myCity = new BMap.LocalCity();
            myCity.get(getCityByIP);

            //获取GPS坐标
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showMap, handleError, { enableHighAccuracy: true, maximumAge: 1000 });
            } else {
                alert("您的浏览器不支持使用HTML 5来获取地理位置服务");
            }
        }

        function showMap(value) {
            var longitude = value.coords.longitude;
            var latitude = value.coords.latitude;

            console.log(longitude);
            console.log(latitude);
            map = new BMap.Map("map");
            //alert("坐标经度为：" + latitude + "， 纬度为：" + longitude );
            gpsPoint = new BMap.Point(longitude, latitude);    // 创建点坐标
            map.centerAndZoom(gpsPoint, 15);

            //根据坐标逆解析地址
            var geoc = new BMap.Geocoder();
            geoc.getLocation(gpsPoint, getCityByCoordinate);

            BMap.Convertor.translate(gpsPoint, 0, translateCallback);
        }

        translateCallback = function (point) {
            baiduPoint = point;
            var geoc = new BMap.Geocoder();
            geoc.getLocation(baiduPoint, getCityByBaiduCoordinate);
        }

        function getCityByCoordinate(rs) {
            gpsAddress = rs.addressComponents;
            var address = "GPS标注：" + gpsAddress.province + "," + gpsAddress.city + "," + gpsAddress.district + "," + gpsAddress.street + "," + gpsAddress.streetNumber;
            var marker = new BMap.Marker(gpsPoint);  // 创建标注
            map.addOverlay(marker);              // 将标注添加到地图中
            var labelgps = new BMap.Label(address, { offset: new BMap.Size(20, -10) });
            marker.setLabel(labelgps); //添加GPS标注
        }

        function getCityByBaiduCoordinate(rs) {
            baiduAddress = rs.addressComponents;
            var address = "百度标注：" + baiduAddress.province + "," + baiduAddress.city + "," + baiduAddress.district + "," + baiduAddress.street + "," + baiduAddress.streetNumber;
            console.log(address);
            var marker = new BMap.Marker(baiduPoint);  // 创建标注
            map.addOverlay(marker);              // 将标注添加到地图中
            var labelbaidu = new BMap.Label(address, { offset: new BMap.Size(20, -10) });
            marker.setLabel(labelbaidu); //添加百度标注
        }

        //根据IP获取城市
        function getCityByIP(rs) {
            var cityName = rs.name;
            alert("根据IP定位您所在的城市为:" + cityName);
        }

        function handleError(value) {
            switch (value.code) {
                case 1:
                    alert("位置服务被拒绝");
                    break;
                case 2:
                    alert("暂时获取不到位置信息");
                    break;
                case 3:
                    alert("获取信息超时");
                    break;
                case 4:
                    alert("未知错误");
                    break;
            }
        }

        function init() {
            getLocation();
        }

        window.onload = init;

    </script>
</head>
<body>
<div id="map" style="width:1000px;height:1400px;"></div>
</body>
</html>