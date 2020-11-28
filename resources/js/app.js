require('./bootstrap');
const $ = require("jquery");
const Handlebars = require("handlebars");

$(document).ready(function () {

  /* Funzione per aggiungere una classe dopo lo scroll di 150px */
    var nav = $('.header-style');
	
    $(window).scroll(function () {
      if ($(this).scrollTop() > 150) {
        nav.addClass("header-color");
      } else {
        nav.removeClass("header-color");
      }
    }); 

    var hamburger = $(".hamburger-menu");
    
    hamburger.click(function () {
       $(".hamburger-menu").tooggle("active");
      }
    );
    

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
      // type: 'city',
      // aroundLatLngViaIP: false,
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

 
});

