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


  // ALGOLIA
  var places = require('places.js');

  // Ricerca in create.blade.php

  if (window.location.pathname != "/host/house/create" && window.location.pathname != "/host/house/update") {
    console.log("guest");
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
        // type: 'address'
        type: 'city',
        aroundLatLngViaIP: true,
      });
      placesAutocomplete.on('change', function resultSelected(e) {
        document.querySelector('#form-lat').value = e.suggestion.latlng.lat || '';
        document.querySelector('#form-lng').value = e.suggestion.latlng.lng || '';
      });
    })();

  } else {
    console.log("loggato");
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
  }





  // RICERCA con filtri

  // const queryString = window.location.href;

  // const urlParams = new URLSearchParams(queryString);

  // const lat = urlParams.get('lat')
  // console.log(lat);

  // const lon = urlParams.get('lon')
  // console.log(lon);

  // Endpoint in cui si trova il database
  var endpoint = 'http://localhost:8000/api/getallhouses';

  // Prendiamo i dati dai filtri
  $("#search-results-form").change(function () {

    // Prendiamo latitudine e longitudine
    const queryString = window.location.href;

    const urlParams = new URLSearchParams(queryString);

    const lat = urlParams.get('lat')
    const lon = urlParams.get('lon')

    // Servizi
    var services = [];

    // Prendiamo il valore di wi-fi
    if ($('input#1').is(':checked')) {
      services.push($('input#1').val());
    }

    // Prendiamo il valore di parking
    if ($('input#2').is(':checked')) {
      services.push($('input#2').val());
    }

    // Prendiamo il valore di swimming pool
    if ($('input#3').is(':checked')) {
      services.push($('input#3').val());
    }

    // Prendiamo il valore di reception
    if ($('input#4').is(':checked')) {
      services.push($('input#4').val());
    }

    // Prendiamo il valore di sauna
    if ($('input#5').is(':checked')) {
      services.push($('input#5').val());
    }

    // Prendiamo il valore di see view
    if ($('input#6').is(':checked')) {
      services.push($('input#6').val());
    }


    // Prendiamo il valore di rooms
    var rooms = $(this).find('input[name="rooms"]').val();

    // Prendiamo il valore di beds
    var beds = $(this).find('input[name="beds"]').val();

    // Prendiamo il valore di bathrooms
    var bathrooms = $(this).find('input[name="bathrooms"]').val();

    // Prendiamo il valore di mq
    var mq = $(this).find('input[name="mq"]').val();

    // Prendiamo il valore di price
    var price = $(this).find('input[name="price"]').val();

    var distance = $(this).find('input[name="distance"]').val();

    console.log(distance);

    if (services.length == 0) {
      services = "";
    }

    callDatabase(lat, lon, services, rooms, beds, bathrooms, mq, price, distance);
  });


  // Chiamata ajax che prende i dati dai filtri
  function callDatabase(lat, lon, services, rooms, beds, bathrooms, mq, price, distance) {
    $.ajax({
      "url": endpoint,
      "data": {
        "lat": lat,
        "lon": lon,
        "services": services,
        "rooms": rooms,
        "beds": beds,
        "bathrooms": bathrooms,
        "mq": mq,
        "price": price,
        "distance": distance
      },
      "method": "GET",
      "success": function (data) {
        console.log(data);
        printResults(data);
      },
      "error": function (err) {
        alert("Error");
      }
    });
  }

  // Funzione che stampa le case richieste da callDatabase
  function printResults(dataArray) {

    $('#house-container').html("");

    if (dataArray.length > 0) {
      for (var i = 0; i < dataArray.length; i++) {

        // console.log(dataArray[i]['title']);
        console.log(dataArray[i]);

        var source = $("#house-template").html();
        var template = Handlebars.compile(source);
        var context = {
          'title': dataArray[i]['title'],
          'slug': dataArray[i]['house']['slug'],
          'cover_image': dataArray[i]['cover_image'],
        };
        var html = template(context);

        $('#house-container').append(html);
      }
    } else {
      $('#house-container').append("<h2>Nessun risultato trovato</h2>");

    }
  }



  // PAGAMENTI SPONSORIZZAZIONE
  // Step two: create a dropin instance using that container (or a string
  //   that functions as a query selector such as `#dropin-container`)
    braintree.dropin.create({
      container: document.getElementById('dropin-container'),
      // ...plus remaining configuration
    }, (error, dropinInstance) => {
      // Use `dropinInstance` here
      // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
    });



});




/* Funzione per aggiungere una classe dopo lo scroll di 150px */
var nav = $('.header-style');

$(window).scroll(function () {
  if ($(this).scrollTop() > 150) {
    nav.addClass("header-color");
  } else {
    nav.removeClass("header-color");
  }
});

/*Funzione che al click sull'hamburger fa apparire il menù */
var hamburger = $(".hamburger");

hamburger.click(function () {
  $(".hamburger-menu").toggle("active");
});


