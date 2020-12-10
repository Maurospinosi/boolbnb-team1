require('./bootstrap');
const $ = require("jquery");

var places = require('places.js');

$(document).ready(function () {

  var citySearch = function () {
    var placesAutocomplete = places({
      appId: 'pl0CZDFYINVV',
      apiKey: 'eadbe4e7e17871155036ed85b3b8f8c5',
      container: document.querySelector('#form-city-info'),
      templates: {
        value: function (suggestion) {
          return suggestion.name;
        }
      }
    }).configure({
      // type: 'address'
      type: 'city',
      aroundLatLngViaIP: true,
    });
  };
  citySearch();

});