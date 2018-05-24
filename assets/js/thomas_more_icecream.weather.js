(function ($) {
  alert();

  $.getJSON( "http://api.wunderground.com/api/291369cc63912a1e/forecast/geolookup/lang:NL/q/51.160854,4.961262.json", function( data ) {

    console.log(JSON.parse(data));
    if(data[''] >= '20'){

    }

  });

}(jQuery));