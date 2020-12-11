/* global require */

require('./bootstrap');
const $ = require("jquery");
const Handlebars = require("handlebars");
var places = require('places.js');


$(document).ready(function () {

  //// SPONSORIZZAZIONE ////
  $("#open-sponsor-menu").on("click", function () {
    $("#host-sponsorship").toggleClass("d-none");
  });
  //// FINE SPONSORIZZAZIONE ////

  //// CANCELLAZIONE CASA ////
    $("#open-delete-menu").on("click", function(){
      $(this).siblings("form").toggleClass("d-none");
    });

    $("#button-annulla").on("click", function(){
      $(this).parent(".delete-menu").addClass("d-none");
    });
  //// FINE CANCELLAZIONE CASA ////

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

  // Customizzazione Braintree
  $(".braintree-sheet__text").text("Pagamento con carta");
  /// FINE BRAINTREE ////

  /*Funzione che al click sull'hamburger fa apparire il menù */
  $('.hamburger').click(function () {
    $(".hamburger-menu").toggle();
  });

  /* Funzione che controlla l'hamburger-menu al passaggio del mouse */
  $(".hamburger-menu").mouseenter(function () {
    $(".hamburger-menu").fadeIn('active');
  });
  $("header").mouseleave(function () {
    $(".hamburger-menu").fadeOut('active');
  });



  // ALGOLIA
  // Ricerca per città
  var headerCitySearch = function () {
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
      type: 'city',
      aroundLatLngViaIP: true,
    });
    placesAutocomplete.on('change', function resultSelected(e) {
      document.querySelector('#form-city-lat').value = e.suggestion.latlng.lat || '';
      document.querySelector('#form-city-lng').value = e.suggestion.latlng.lng || '';
    });
  };
  headerCitySearch();


  // RICERCA con filtri
  // Endpoint in cui si trova il database
  var endpoint = 'http://localhost:8000/api/getallhouses';

  const queryString = window.location.href;
  const urlParams = new URLSearchParams(queryString);


  // Prendiamo i dati dai filtri
  $("#searchresults-form").change(function () {

    // Prendiamo latitudine e longitudine
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
    $('#houses-container').html("");
    $('#sponsored-houses-container').html("");
    if (dataArray.length > 0) {
      var nrResults = dataArray.length;
      $(".nrResults").text('Case trovate: ' + nrResults);

      for (var i = 0; i < dataArray.length; i++) {
        // Cloniamo il template
        var template = $("#searchresults-wrapper .res-temp .card").clone();
        //Riempiamo il template
        // Il valore di "coverImage" dipende se inizia con "http"
        if (dataArray[i]['cover_image'].startsWith("http")) {
          var coverImage = dataArray[i]['cover_image'];
        } else {
          var coverImage = "{{asset('storage/" + dataArray[i]['cover_image'] + "')}}"
        }
        template.find(".card_img img").attr("src", coverImage);
        template.find(".card-title").text(dataArray[i]['title']);
        template.find(".card_price").text(dataArray[i]['price']+"€");
        template.find("button a").attr("href", "http://localhost:8000/host/house/"+dataArray[i]['house_id']);
        template.find("input.latitudine").val(dataArray[i]['lat']);
        template.find("input.longitudine").val(dataArray[i]['lon']);
        // Ciclo per mettere i tag della singola casa in un array
        var tags = dataArray[i]['house']['tags'];
        if (tags.length > 0) {
          var houseTags = [];
          for (var t = 0; t < tags.length; t++) {
            houseTags.push(tags[t]['name']);
          }
          // Ciclo per appendere i tags in pagina
          var cardBadges = template.find(".card_badges");
          for (var c = 0; c < houseTags.length; c++) {
            var tagTemplate = $(".badge-template .badge-light").clone();
            tagTemplate.text(houseTags[c]);
            tagTemplate.removeClass("d-none");
            cardBadges.append(tagTemplate);
          }
        }
        // Se la casa è sponsorizzata, la appendo nel container delle sponsorizzate
        var sponsors = dataArray[i]['house']['sponsors'];
        if (sponsors.length > 0) {
          template.addClass("sponsor-bg-color");
          template.find("span.sponsorizzata").removeClass("d-none");
          $("#sponsored-houses-container").append(template);
        } else {
          $('#houses-container').append(template);
        }
      }
    } else {
      $(".nrResults").text('Nessuna casa trovata');
    }
    pushMarker();
  }


  
/*******************************************
   *********** MAPPE ****************
   ******************************************/

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

  const latURL = urlParams.get('lat') || parseFloat($(".coordinate-container .latitudine").val());
  const lonURL = urlParams.get('lon') || parseFloat($(".coordinate-container .longitudine").val());

  map.setView(new L.LatLng(latURL, lonURL), 11);
  map.addLayer(osmLayer);

  var markers = [];

  pushMarker();

  function pushMarker() {

    markers.forEach(e => removeMarker(e));

    var cardBodyArr = $(".coordinate-container");
    // console.log(cardBodyArr);

    for (let index = 0; index < cardBodyArr.length; index++) {

      const element = cardBodyArr[index];
      // console.log(element);
      console.log(element);
      var lat = $(element).find('input.latitudine').val();
      var lng = $(element).find('input.longitudine').val();
      var latParse = parseFloat(lat);
      var lngParse = parseFloat(lng);
      console.log(lat);
      var coordinate = {
        lat: latParse,
        lng: lngParse
      };

      addMarker(coordinate);
    }

    handleOnCursorchanged();

    function handleOnCursorchanged() {
      markers.forEach(function (marker) {
        marker.setZIndexOffset(0);
        marker.setOpacity(0.9);
      });
    }
    function addMarker(coordinate) {
      var marker = L.marker(coordinate, { opacity: .9 });
      marker.addTo(map);
      markers.push(marker);
    }

    function removeMarker(marker) {
      map.removeLayer(marker);
    }

  }




});