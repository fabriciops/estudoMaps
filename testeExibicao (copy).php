<html>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCkaKvxxUsIUb4kOTg_tkGcysiHIRCqdGE"></script>
<style type="text/css">
#map {
  width: 100%;
  height: 500px;
  border: 1px solid #000;
}
</style>
<script type="text/javascript">
(function() {
  window.onload = function() {
      
    // Creating a reference to the mapDiv
    var mapDiv = document.getElementById('map');
    
    // Creating a latLng for the center of the map
    // var latlng = new google.maps.LatLng(51.4975941, -0.0803232);
    var latlng = new google.maps.LatLng(-27.6490069, -48.7115124);
    
    // Creating an object literal containing the properties 
    // we want to pass to the map  
    var options = {
      center: latlng,
      zoom: 11,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    // Creating the map
    var map = new google.maps.Map(mapDiv, options);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(-27.6490069, -48.7115124),
        map: map,
        title: 'Set lat/lon values for this property'
    });    
  }
})();
</script>
<body>
<div id="map"></div>
</body>
</html>