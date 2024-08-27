window.jquery = window.$ = require("jquery/src/jquery")
require("bootstrap/dist/js/bootstrap.min")

window.owlCarousel = require("owl.carousel/dist/owl.carousel.min")
// $(".overlay").click(function (){
//         $(this).remove();
// })

import swal from 'sweetalert';
import lightGallery from 'lightgallery';
console.log(lightGallery);
lightGallery((document.getElementById('animated-thumbnails')), {
    thumbnail: true,
});



$(document).ready(function (){
    $("#category-toggler").on("click" ,function (){
        $(".category-list > li").slideToggle(.5)
    })
})




window.leaflet = require("leaflet/dist/leaflet")

//convert to english number

// String.prototype.toEnDigit = function () {
//     return this.replace(/[\u06F0-\u06F9]+/g, function (digit) {
//         var ret = '';
//         for (var i = 0, len = digit.length; i < len; i++) {
//             ret += String.fromCharCode(digit.charCodeAt(i) - 1728);
//         }
//
//         return ret;
//     });
// };

$(document).ready(function (){
    $("i.fa-chevron-down").parent("li").on("click" , function (e){
        if (e.target == this){
            $(this).children("ul").slideToggle(1000);
            $(this).children("i.fa-chevron-down").toggleClass("rotate-0 rotate-180")
        }
    })
    $("i.fa-chevron-down").on("click" , function(e){
        if (e.target == this){
            $(this).parent("li").children("ul").slideToggle(1000);
            $(this).toggleClass("rotate-0 rotate-180")
        }
    })
})



