require('./bootstrap');
const $ = require("jquery");
const Handlebars = require("handlebars");
var places = require('places.js');


$(document).ready(function () {

  //// SPONSORIZZAZIONE ////
    $("#host-sponsorship h5").on("click", function(){
      $(this).siblings(".sponsorContent").toggleClass("d-none");
    });
  //// FINE SPONSORIZZAZIONE ////
  //// BRAINTREE ////
  const form = document.getElementById('payment-form');
  braintree.dropin.create({
    authorization: 'sandbox_csp9zxcv_7fvbtn5hs7yp3kb2',
    container: '#dropin-container'
  }, (error, dropinInstance) => {
    if (error) console.error(error);
    form.addEventListener('submit', event => {
      event.preventDefault();
      dropinInstance.requestPaymentMethod((error, payload) => {
        if (error) console.error(error);
        document.getElementById('nonce').value = payload.nonce;
        form.submit();
      });
    });
  });
/// FINE BRAINTREE ////
/*Funzione che al click sull'hamburger fa apparire il menù */
  $('.hamburger').click(function () {
    $(".hamburger-menu").toggle();
  });

  /* Funzione che controlla l'hamburger-menu al passaggio del mouse */
  $(".hamburger-menu").mouseenter(function() {
    $(".hamburger-menu").fadeIn('active');
  });
  $("header").mouseleave(function() {
    $(".hamburger-menu").fadeOut('active');
  });

  /*Funzione che al doppio click sul body fa sparire il menù */
  /*$("body").dblclick(function(){
      $(".hamburger-menu").fadeOut('active');
    }); */

  // ALGOLIA
  // Ricerca per città
  var citySearch = function () {
    var placesAutocomplete = places({
      appId: 'pl0CZDFYINVV',
      apiKey: 'eadbe4e7e17871155036ed85b3b8f8c5',
      container: document.querySelector('#form-city-address'),
      templates: {
        value: function (suggestion) {
          return suggestion.name;
        }
      }
    }).configure({
      // type: 'address'
      type: 'city',
      aroundLatLngViaIP: false,
    });
    placesAutocomplete.on('change', function resultSelected(e) {
      document.querySelector('#form-city-address2').value = e.suggestion.administrative || '';
      document.querySelector('#form-city-city').value = e.suggestion.city || '';
      document.querySelector('#form-city-country').value = e.suggestion.country || '';
      document.querySelector('#form-city-zip').value = e.suggestion.postcode || '';
      document.querySelector('#form-city-lat').value = e.suggestion.latlng.lat || '';
      document.querySelector('#form-city-lng').value = e.suggestion.latlng.lng || '';
    });
  };
  citySearch();


  // RICERCA con filtri
  // Endpoint in cui si trova il database
  var endpoint = 'http://localhost:8000/api/getallhouses';

  // Prendiamo i dati dai filtri
  $("#search-results-form").change(function(){

    // Prendiamo latitudine e longitudine
    const queryString = window.location.href;
    const urlParams = new URLSearchParams(queryString);
    const lat = urlParams.get('lat')
    const lon = urlParams.get('lon')
    console.log(lat);
    console.log(lon);
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
    if(services.length == 0) {
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
      "success": function(data) {
        console.log(data);
        printResults(data);
      },
      "error": function(err) {
        alert("Error");
      }
    });
  }
  // Funzione che stampa le case richieste da callDatabase
  function printResults(dataArray) {
    $('#house-container').html("");
    if (dataArray.length > 0) {
      for (var i = 0; i < dataArray.length; i++) {
        var source = $("#house-template").html();
        var template = Handlebars.compile(source);
        var context = {
          'title': dataArray[i]['title'],
          'slug': dataArray[i]['house']['slug'],
          'house_id': dataArray[i]['house']['house_id'],
          'user_id': dataArray[i]['house']['user_id'],
          'cover_image': dataArray[i]['cover_image'],
        };
        var html = template(context);
        $('#house-container').append(html);
      }
    } else {
      $('#house-container').append("<h2>Nessun risultato trovato</h2>");
    }
  }

});