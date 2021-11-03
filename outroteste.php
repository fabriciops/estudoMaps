

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCkaKvxxUsIUb4kOTg_tkGcysiHIRCqdGE" type="text/javascript"></script>


<br>

<div id="map" style="width: 500px; height: 400px; float: right;"></div>
<input type="hidden" id="lat" value="-27.649006">
<input type="hidden" id="long" value="-48.711512">

<script>

document.reay(function({
    init_map(locations);
});
var lat = document.getElementById("lat").value;
var long = document.getElementById("long").value;
var locations = [
      ['Você está aqui', lat, long],
    ];

function init_map(locations) {

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: new google.maps.LatLng(lat,  long),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
  }



$('#add').on('click', function() {
  var zona = $('#zona').val();
  var newCoords = $('#coords').val().split(',');
  newCoords.unshift(zona);
  locations.push(newCoords);
  init_map(locations);
  // aqui colocas o teu ajax e envias para o servidor as novas coordenadas e zona: newCoords
});

</script>