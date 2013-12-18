var initialize = function() {
    var mapOptions = {            
        center: new google.maps.LatLng(60, 18),
        zoom: 6
    };
    
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
}

//----------------------------------------------------
// Hantering av knappklick och hämtning av trafikinfo!
//----------------------------------------------------

$("#request").click(function() {
    var tryRequest = (function (){
        $.ajax({
            type: "GET",
            url: "php/traffic.php",
            data: {
                action: "request"
            }
            }).done(function(data){
                console.log(data);
            });
        });
});

//----------------------------------------------------
// Händelser vid laddning av sidan
//----------------------------------------------------
window.onload = initialize;