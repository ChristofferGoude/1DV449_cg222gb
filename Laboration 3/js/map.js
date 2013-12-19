//-----------------------------------------------------//
//------Kartan laddas när resten av DOMen är redo------//
//-----------------------------------------------------//

$(document).ready(
    function() {
        var mapOptions = {            
            center: new google.maps.LatLng(62, 18),
            zoom: 6
        };
        
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    }
)
//-----------------------------------------------------//
//-Hantering av knappklick och hämtning av trafikinfo!-//
//-----------------------------------------------------//

$("#request").click(function() {
    $.ajax({
        type: "GET",
        url: "traffic.php?request",
        datatype: "json"
        }).done(function(data){
            var trafficMessages = JSON.parse(data);
                       
            addAllMarkers(trafficMessages);
            
            //För övervakning av data
            //console.log(trafficMessages);    
        });
});

$("#roads").click(function() {
    $.ajax({
        type: "GET",
        url: "traffic.php?roads",
        datatype: "json"
        }).done(function(data){
            var trafficMessages = JSON.parse(data);
                       
            addAllMarkers(trafficMessages);
        });
});

$("#public").click(function() {
    $.ajax({
        type: "GET",
        url: "traffic.php?public",
        datatype: "json"
        }).done(function(data){
            var trafficMessages = JSON.parse(data);
                       
            addAllMarkers(trafficMessages);
        });
});

$("#planned").click(function() {
    $.ajax({
        type: "GET",
        url: "traffic.php?planned",
        datatype: "json"
        }).done(function(data){
            var trafficMessages = JSON.parse(data);
                       
            addAllMarkers(trafficMessages);
        });
});

$("#other").click(function() {
    $.ajax({
        type: "GET",
        url: "traffic.php?other",
        datatype: "json"
        }).done(function(data){
            var trafficMessages = JSON.parse(data);
                       
            addAllMarkers(trafficMessages);
        });
});

$("#info").click(function() {
    
    if(document.getElementById("information").style.display == "block")
    {
        document.getElementById("information").style.display = "none";
    }
    else{
        document.getElementById("information").style.display = "block";
    }
});

$("#ok").click(function() {
    document.getElementById("information").style.display = "none";
});

//-----------------------------------------------------//
//---------------------Funktioner----------------------//
//-----------------------------------------------------//

function addAllMarkers(trafficMessages){
    var mapOptions = {            
            center: new google.maps.LatLng(62, 18),
            zoom: 6
    };
    
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    
    trafficMessages.forEach(function(entry){
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h2 id="firstHeading" class="firstHeading">' + entry.title + '</h2>'+
            '<div id="bodyContent">'+
            '<p><b>Kategori</b></p>'+
            '<p>' + entry.priority + ', ' + entry.category + '</p>'+
            '<p><b>Beskrivning</b></p>'+
            '<p>' + entry.description + '</p>'+
            '<p><b>Rapporterad den:</b> ' + entry.createddate + '</p>' +
            '</div>'+
            '</div>';
        
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(entry.latitude, entry.longitude),
            map: map,
            title: entry.title
        });
        
        google.maps.event.addListener(marker, "click", function() {
          infowindow.open(map, marker);
        });
    });
}
