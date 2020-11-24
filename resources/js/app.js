require('./bootstrap');
const $ = require( "jquery" );
var places = require('places.js');

(function() {
  var placesAutocomplete = places({
    appId: 'pl0CZDFYINVV',
    apiKey: 'eadbe4e7e17871155036ed85b3b8f8c5',
    container: document.querySelector('#form-address'),
    templates: {
      value: function(suggestion) {
        return suggestion.name;
      }
    }
  }).configure({
    type: 'address'
  });
  placesAutocomplete.on('change', function resultSelected(e) {
    document.querySelector('#form-address2').value = e.suggestion.administrative || '';
    document.querySelector('#form-city').value = e.suggestion.city || '';
    document.querySelector('#form-zip').value = e.suggestion.postcode || '';
    document.querySelector('#form-lat').value = e.suggestion.latlng.lat || '';
    document.querySelector('#form-lng').value = e.suggestion.latlng.lng || '';
});
})();
