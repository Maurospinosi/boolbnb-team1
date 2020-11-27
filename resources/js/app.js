require('./bootstrap');
const $ = require("jquery");
const Handlebars = require("handlebars");

$(document).ready(function () {

  var places = require('places.js');

  // Ricerca in create.blade.php
  (function () {
    var placesAutocomplete = places({
      appId: 'pl0CZDFYINVV',
      apiKey: 'eadbe4e7e17871155036ed85b3b8f8c5',
      container: document.querySelector('#form-address'),
      templates: {
        value: function (suggestion) {
          return suggestion.name;
        }
      }
    }).configure({
      type: 'address'
    });
    placesAutocomplete.on('change', function resultSelected(e) {
      document.querySelector('#form-address2').value = e.suggestion.administrative || '';
      document.querySelector('#form-city').value = e.suggestion.city || '';
      document.querySelector('#form-country').value = e.suggestion.country || '';
      document.querySelector('#form-zip').value = e.suggestion.postcode || '';
      document.querySelector('#form-lat').value = e.suggestion.latlng.lat || '';
      document.querySelector('#form-lng').value = e.suggestion.latlng.lng || '';
    });
  })();

  // Ricerca in search.blade.php
  // (function () {
  //   var placesAutocomplete = places({
  //     appId: 'pl0CZDFYINVV',
  //     apiKey: 'eadbe4e7e17871155036ed85b3b8f8c5',
  //     container: document.querySelector('#search-address'),
  //     templates: {
  //       value: function (suggestion) {
  //         return suggestion.name;
  //       }
  //     }
  //   }).configure({
  //     type: 'address'
  //   });
  //   placesAutocomplete.on('change', function resultSelected(e) {
  //     document.querySelector('#search-latitude').value = e.suggestion.latlng.lat || '';
  //     document.querySelector('#search-longitude').value = e.suggestion.latlng.lng || '';
  //   });
  // })();

// // for the default version
// const algoliasearch = require('algoliasearch');

// // for the default version
// import algoliasearch from 'algoliasearch';

// // for the search only version
// import algoliasearch from 'algoliasearch/lite';

// // or just use algoliasearch if you are using a <script> tag
// // if you are using AMD module loader, algoliasearch will not be defined in window,
// // but in the AMD modules of the page

// const client = algoliasearch('pl0CZDFYINVV', 'eadbe4e7e17871155036ed85b3b8f8c5');
// const index = client.initIndex('your_index_name');


 
});

