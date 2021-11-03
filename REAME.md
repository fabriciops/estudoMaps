Desenvolvimento - HTML
Usando Geolocalização com HTML5

Veja nesse artigo como usar a API de Geolocalização disponível na versão 5 do HTML e veja também como exibir a localização do usuário em um Mapa do Google.
por Ricardo Arrigoni
 579 6 8 13 


Olá pessoal, no artigo de hoje iremos ver como trabalhar com a API Geolocation do HTML5.

Primeiro de tudo devemos saber que existem três maneiras de se descobrir a posição de alguma coisa no globo terrestre que são as mais usadas, são elas:

    Geolocalização IP
    Triangulação GPRS
    GPS

Nota: Lembrando que para funcionar a geolocalização é necessário que o navegador do usuário tenha suporte a essa tecnologia.

Utilizando o método getCurrentPosition() é possível pegar a posição do usuário, como podemos ver no exemplo abaixo:

Listagem 1: Obtendo posição de Latitude e Longitude
	
<!DOCTYPE html>
<html>
<body>
<p id="demo">Clique no botão para receber sua localização em Latitude e Longitude:</p>
<button onclick="getLocation()">Clique Aqui</button>
<script>
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{x.innerHTML="O seu navegador não suporta Geolocalização.";}
  }
function showPosition(position)
  {
  x.innerHTML="Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;  
  }
</script>
</body>
</html>

O código acima irá exibir no seu navegador as suas coordenadas de localização.

Basicamente o que fizemos foi:

    Verificamos se a Geolocalização é suportada pelo browser, caso positivo executamos o método getCurrentPosition(), caso contrário, exibimos uma mensagem de erro para o usuário.
    Após isso, se o método getCurrentPosition() for executado com sucesso, ele irá retornar as coordenadas para a função específica no parâmetro (showPosition).
    A função showPosition() exibe a Latitude e a Longitude para o usuário.

No exemplo acima não tivemos nenhum tratamento de um possível erro que possa acontecer, no exemplo abaixo iremos ver como tratar esses erros.

Listagem 2: Obtendo Geolocalização com tratamento de erros

<!DOCTYPE html>
<html>
<body>
<p id="demo">Clique no botão para receber as coordenadas:</p>
<button onclick="getLocation()">Clique Aqui</button>
<script>
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
  else{x.innerHTML="Seu browser não suporta Geolocalização.";}
  }
function showPosition(position)
  {
  x.innerHTML="Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;  
  }
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
      x.innerHTML="A requisição expirou."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML="Algum erro desconhecido aconteceu."
      break;
    }
  }
</script>
</body>
</html>

Abaixo veremos o que quer dizer cada um dos códigos de erro:

    Permission denied - O usuário não permitiu o uso de Geolocalização
    Position unavailable - Não foi possível obter a localização
    Timeout - O tempo de resposta expirou

Exibindo a localização em um Mapa

Caso você não queria apenas exibir as coordenadas de latitude e longitude e queira exibir a posição do usuário em um mapa, basta utilizar o código abaixo.

Listagem 3: Exibindo a localização em um mapa com imagem estática
	
<!DOCTYPE html>
<html>
<body>
<p id="demo">Clique no botão para obter sua localização:</p>
<button onclick="getLocation()">Clique aqui</button>
<div id="mapholder"></div>
<script>
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
  else{x.innerHTML="Geolocation is not supported by this browser.";}
  }
 
function showPosition(position)
  {
  var latlon=position.coords.latitude+","+position.coords.longitude;
 
  var img_url="http://maps.googleapis.com/maps/api/staticmap?center="
  +latlon+"&zoom=14&size=400x300&sensor=false";
  document.getElementById("mapholder").innerHTML="<img src='"+img_url+"'>";
  }
 
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

Dessa forma o que será exibido ao usuário será a localização dele no mapa do Google Maps.

No exemplo da listagem 3 é exibido uma imagem estática do mapa, como se fosse um printscreen, mas é possível fazer com que seja exibido o mapa em si, onde o usuário pode editar e manipular dentro da API do Google Maps.

Listagem 4: Obtendo geolocalização e exibindo um mapa do google maps
	
<!DOCTYPE html>
<html>
<body>
<p id="demo">Clique no botão para obter sua localização:</p>
<button onclick="getLocation()">Clique aqui</button>
<div id="mapholder"></div>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
  else{x.innerHTML="Geolocalização não é suportada nesse browser.";}
  }
 
function showPosition(position)
  {
  lat=position.coords.latitude;
  lon=position.coords.longitude;
  latlon=new google.maps.LatLng(lat, lon)
  mapholder=document.getElementById('mapholder')
  mapholder.style.height='250px';
  mapholder.style.width='500px';
 
  var myOptions={
  center:latlon,zoom:14,
  mapTypeId:google.maps.MapTypeId.ROADMAP,
  mapTypeControl:false,
  navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
  };
  var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
  var marker=new google.maps.Marker({position:latlon,map:map,title:"Você está Aqui!"});
  }
 
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
Conclusão

Existem outras maneiras de se usar a API de Geolocalização, nesse artigo mostrei apenas as formas mais comuns de se trabalhar com elas.

Read more: http://www.linhadecodigo.com.br/artigo/3653/usando-geolocalizacao-com-html5.aspx#ixzz78YwyTm9N
