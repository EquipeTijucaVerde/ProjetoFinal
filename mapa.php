<head>
    <link rel="stylesheet" href="css/mapa.css">
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
 <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

</head>
<div class="container" id="app">

  <section>
    <h4><a href="#">Denúncias</a> > <span><a href="#">Local</a></span></h4>
  </section>

  <section>
    <div class="card">
      <div class="card-info">
        <h1>Escolha um local</h1>
        
        <p>Local escolhido: </p>
        <a href="#">
          <p>Enviar</p>
          <svg viewBox="0 0 20 10">
            <line x1="0" y1="5" x2="20" y2="5" />
            <line x1="15" y1="0" x2="20" y2="5" />
            <line x1="15" y1="10" x2="20" y2="5" />
          </svg>
        </a>
      </div>
      <div id="map"></div>      
    </div>
    </div>
  </section>
</div>
<script>
    // Nominatim does not map some actual addresses
'use strict';

// Map
const map = L.map('map', {
   center: [-22.9318,-43.2536],
   zoom: 12,               
});

// Open Street Map 
const osm = L.tileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&#169; <a href="//www.openstreetmap.org/">OpenStreetMap</a> contributors, CC BY-SA license'
}).addTo(map);

// container for address search results
const addressSearchResults = new L.LayerGroup().addTo(map);

/*** Geocoder ***/
// OSM Geocoder
const osmGeocoder = new L.Control.geocoder({
    collapsed: false,
    position: 'topright',
    text: 'Address Search',
    placeholder: 'Endereço',
   defaultMarkGeocode: false
}).addTo(map);    

// handle geocoding result event
osmGeocoder.on('markgeocode', e => {
   // to review result object
   console.log(e);
   // coordinates for result
   const coords = [e.geocode.center.lat, e.geocode.center.lng];
   // center map on result
   map.setView(coords, 16);
   // popup for location
   // todo: use custom icon
   const resultMarker = L.marker(coords).addTo(map);
   // add popup to marker with result text
   resultMarker.bindPopup(e.geocode.name).openPopup();
});
</script>