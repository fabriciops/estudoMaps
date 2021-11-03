<!DOCTYPE html>
<html>
<body>
<p id="demo">Clique no botão para obter sua localização:</p>
<button onclick="getLocation()">Clique aqui</button>
<div id="mapholder"></div>
<script src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCkaKvxxUsIUb4kOTg_tkGcysiHIRCqdGE"></script>
<script>
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(locSucesso,showError);
    }
  else{x.innerHTML="Geolocalização não é suportada nesse browser.";}
  }
 
function showPosition(position)
  {
  lat=position.coords.latitude;
  lon=position.coords.longitude;
  latlon=new google.maps.LatLng(lat, lon)
  mapholder=document.getElementById('mapholder')
  mapholder.style.height='1000px';
  mapholder.style.width='1000px';
 
  var myOptions={
  center:latlon,zoom:14,
  mapTypeId:google.maps.MapTypeId.ROADMAP,
  mapTypeControl:false,
  navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
  };
  var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
  var marker=new google.maps.Marker({position:latlon,map:map,title:"Você está Aqui!"});
  }

  
function locSucesso(position) {
    var latlngGeo = new google.maps.LatLng(position.coords.latitude,position.coords.longitude); //pegando localização do usuário
    var myOptions = {//opções do mapa
        zoom: 15, //configuração da proximidade de visualização do mapa quando iniciado
        mapTypeId: google.maps.MapTypeId.ROADMAP, //tipo do mapa (ROADMAP --> normal, default 2D map)
        center: latlngGeo
};

map = new google.maps.Map(document.getElementById("mapa"), myOptions);
geocoder = new google.maps.Geocoder();

marker = new google.maps.Marker({
    map: map,
    draggable: true,
    title:"Você está aqui!" //texto quando usuário passar mouse por cima do marcador
});

marker.setPosition(latlngGeo);

var infowindow = new google.maps.InfoWindow({
    content: 'Você está aqui!' //mostrar texto quando usuário clicar no marcador
});
 
function showError(error)
  {
  switch(error.code) 
    {
    case error.PERMISSION_DENIED:
      x.innerHTML="Usuário rejeitou a solicitação de Geolocalização."
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML="Localização indisponível."
      break;
    case error.TIMEOUT:
      x.innerHTML="O tempo da requisição expirou."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML="Algum erro desconhecido aconteceu."
      break;
    }
  }
</script>
</body>
</html>