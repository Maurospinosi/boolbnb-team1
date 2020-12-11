// require('./bootstrap');
// const $ = require("jquery");

// $(document).ready(function() {

//     $(".next").click(
//       function() {
//         var imgActive = $("img.active");
//         imgActive.removeClass("active");
  
  
//         if(imgActive.hasClass("last")) {
//           var nextImg = $("img.first");
//           //var nextCircle = $("i.first");
//         } else {
//           var nextImg = imgActive.next();
//           //var nextCircle = circleActive.next();
//         }
  
//         nextImg.addClass("active");
//         //nextCircle.addClass("active");
//       }
//     );
  
  
//     $(".prev").click(
//       function() {
//         var imgActive = $("img.active");
//         imgActive.removeClass("active");
  
//         var circleActive = $("i.active");
//         circleActive.removeClass("active");
  
//         if(imgActive.hasClass("first")) {
//           var nextImg = $ ("img.last");
//           //var nextCircle = $("i.first");
//         } else {
//           var nextImg = imgActive.prev();
//           //var nextCircle = circleActive.prev();
//         }
        
//         nextImg.addClass("active");
//         //nextCircle.addClass("active");
//       }
//     );
//   });