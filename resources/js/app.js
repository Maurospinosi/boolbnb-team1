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

    var hamburger = $("li:last-child");
    
    hamburger.click(function () {
       $(".hamburger-menu").toggle("active");
      }
    );
  
    

  // ALGOLIA
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



  // RICERCA con filtri

  // Endpoint in cui si trova il database
  var endpoint = 'http://localhost:8000/getallhouses';

  // Prendiamo i dati dai filtri
  $("#provalaura").change(function(){
    callDatabase($("#provalaura").val());
  });

  // Chiamata ajax che prende i dati dai filtri
  function callDatabase(input) {
    $.ajax({
      "url": endpoint,
      "data": {
        "input": input
      },
      "method": "GET", 
      "success": function(data) {
        printResults(data);
      },
      "error": function(err) {
        alert("Error");
      }
    });
  }

  // Funzione che stampa le case richieste da callDatabase
  function printResults(dataArray) {
    for(var i = 0; i < dataArray.length; i++) {
      console.log(dataArray[i]['title']);
    }
  }
 
});

