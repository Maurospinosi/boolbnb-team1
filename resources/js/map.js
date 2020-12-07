const $ = require("jquery");
$(function () {
  var lat = $("#latitudine").val();
  var latParse = parseFloat(lat);
  var lng = $("#longitudine").val()
  var lngParse = parseFloat(lng);
  
  var coordinate = {
    lat: latParse,
    lng: lngParse
  };
  var map = L.map('map-example-container', {
    scrollWheelZoom: true,
    zoomControl: true
  });
  var osmLayer = new L.TileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    minZoom: 1,
    maxZoom: 22,
  }
  );
  var markers = [];
  map.setView(new L.LatLng(coordinate.lat, coordinate.lng), 13);
  map.addLayer(osmLayer);
  addMarker(coordinate);
  handleOnCursorchanged();
 
  function handleOnCursorchanged() {
    markers.forEach(function (marker) {
      marker.setZIndexOffset(0);
      marker.setOpacity(0.9);
    });
  }
  function addMarker(coordinate) {
    var marker = L.marker(coordinate, { opacity: .4 });
    marker.addTo(map);
    markers.push(marker);
  }

});
