<style>
/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
  height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

</style>
<!DOCTYPE html>
<html>
  <head>
    <title>Circles</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script src="./index.js"></script>
  </head>
  <body>
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkaKvxxUsIUb4kOTg_tkGcysiHIRCqdGE&callback=initMap&v=weekly"
      async
    ></script>
  </body>
</html>


<script>
  
  const citymap = {
  chicago: {
    center: { lat: -27.649006, lng: -48.711512 },
    raius: 50,
  },
};

function initMap() {
  // Create the map.
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    center: {  lat: -27.649006, lng: -48.711512 },
    mapTypeId: "terrain",
  });

  // Construct the circle for each value in citymap.
  // Note: We scale the area of the circle based on the population.
  for (const city in citymap) {
    // Add the circle for this city to the map.
    const cityCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map,
      center: citymap[city].center,
      radius: Math.sqrt(citymap[city].raius) * 100,
    });
  }
}


</script>
