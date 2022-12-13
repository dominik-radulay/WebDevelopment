window.addEventListener('load', function () {
 "use strict";

 const URL_OFFERS = 'getOffers.php';
 const URL_OFFERS_JSON = URL_OFFERS + '?useJSON';

const fetchOffers = function() {
 fetch(URL_OFFERS)
   .then(
     function(response) {
       return response.text();
   })
   .then(
     function(text) {
      text = text.replace("<p>","");
      text = text.replace("&#8220;","<h2>");
      text = text.replace("&#8220;","<h2>");
      text = text.replace("&#8221;","</h2>");
      text = text.replace("<br>","");
      text = text.replace('<span class="category">','<p><span class="category">');
     	document.getElementById("offers").innerHTML = text;
     }
   )
   .catch(
     function(err) {
       console.log("Something went wrong!", err);
   });
   }

   const fetchJSONOffers = function() {
    fetch(URL_OFFERS_JSON)
      .then(
      function(response) {
         const contentType = response.headers.get('content-type');
        if (contentType.includes('application/json')) {
          return response.json();
        }
        return response.text();
        })
        .then(
      function(json) {
    	  let html = "<h2>"+ json.bookTitle +"</h2>"
        html += "<p>Category:"+ json.catDesc + "<br>Price:" + json.bookPrice + "</p>";
        document.getElementById("JSONoffers").innerHTML = html;
        })
      .catch(
        function(err) {
          console.log("Something went wrong!", err);
      });
      }



const htmlrequest = function () {
      fetchOffers();
      }


fetchJSONOffers()
htmlrequest();
setInterval(htmlrequest, 5000);
});
