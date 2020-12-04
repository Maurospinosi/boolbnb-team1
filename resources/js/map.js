require('./bootstrap');
const $ = require("jquery");
$(document).ready(function() {
    
    var prova = {
        lat: $("#latitudine").val(),
        lng: $("#longitudine").val()
      };

    var placesAutocomplete = places({
      appId: 'pl0CZDFYINVV',
      apiKey: 'eadbe4e7e17871155036ed85b3b8f8c5',
      container: document.querySelector('#input-map')
    });
  
    var map = L.map('map-example-container', {
      scrollWheelZoom: true,
      zoomControl: true
    });
  
    var osmLayer = new L.TileLayer(
      'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom:0,
        maxZoom: 17,
      }
    );
  
    var markers = [];

    map.setView(new L.LatLng(prova.lat, prova.lng), 12);
    map.addLayer(osmLayer);
  
    placesAutocomplete.on('suggestions', handleOnSuggestions);
    placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
    placesAutocomplete.on('change', handleOnChange);
    placesAutocomplete.on('clear', handleOnClear);
  
    function handleOnSuggestions(e) {
      markers.forEach(removeMarker);
      markers = [];
      
      if (e.suggestions.length === 0) {
        map.setView(new L.LatLng(prova.lat, prova.lng), 12);
        return;
      }
      e.suggestions.forEach(addMarker);
      findBestZoom();
    }
  
    function handleOnChange(e) {
      markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            markers = [marker];
            marker.setOpacity(1);
            findBestZoom();
          } else {
            removeMarker(marker);
          }
        });
    }
  
    function handleOnClear() {
        map.setView(new L.LatLng(prova.lat, prova.lng), 12);
        markers.forEach(removeMarker);
    }
  
    function handleOnCursorchanged(e) {
      markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            marker.setOpacity(1);
            marker.setZIndexOffset(1000);
          } else {
            marker.setZIndexOffset(0);
            marker.setOpacity(0.5);
          }
        });
    }
  
    function addMarker(prova) {
      var marker = L.marker(prova, {opacity: .4});
      marker.addTo(map);
      markers.push(marker);
    }
    console.log(prova)
  
    function removeMarker(marker) {
      map.removeLayer(marker);
    }
  
    function findBestZoom() {
      var featureGroup = L.featureGroup(markers);
      map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
    }
    
  })();