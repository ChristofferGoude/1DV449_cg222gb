/**
 * @author Christoffer
 */

//Clearing searchbar if clicked
var html = "";
$("#main").on("click", "#bandname", function() {
    document.getElementById("bandname").value = "";
});

/**
 * The user submits a search.
 * Process starts with outlining the htmlcode that will be generated.
 * The searchquery is cleaned up and checked for any irregularities.
 * If everything is ok, the query is sent to the server.
 * If something is wrong, the user is notified.
 */
$("#main").on("submit", "#bandsearchform", function(event) {
    event.preventDefault();
    
    html = "<div class='row'>";
    $("#result").empty();
    var bandquery = $("#bandname").val();
    
    //Check searchquery for bad input
    if(bandquery.indexOf("<") > -1 || bandquery.indexOf(">") > -1){
        $("#result").append("<div class='col-md-12'><h2 class='headline'>Hey! Don't try to insert some fancy script here hacker!</h2></div>");
    }
    else if(bandquery != ""){
        bandquery = bandquery.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
        document.getElementById("bandsearchbtn").disabled = true; 
        $("#result").append("<div class='col-md-12'><h2 class='headline'>" + bandquery + "</h2></div>");
        $("#loading").append("<div class='container'><div class='col-md-12'><img class='cent margin-top-30' src='images/loading.gif' /></div></div>");

        bandquery = bandquery.replace(/\s/g, "%20");
        biography(bandquery);
    }
    else{
        $("#result").append("<div class='col-md-12'><h2 class='headline'>You should try entering something in the searchbar!</h2></div>");
    }
});

/**
 * The search begins with getting the biography which is added to the resulting html
 * The query is then sent to relatedArtists()
 * @param (Band/artist name) bandquery
 */
function biography(bandquery){
    $.ajax({
        type: "POST",
        url: "php/bandsearch.php",
        datatype: "json",
        data: {biography:bandquery}
        }).done(function(data) {
            var showBiography = JSON.parse(data);
            
            $.ajax({
                type: "POST",
                url: "php/htmlcode.php",
                datatype: "text",
                data: {showBiography:showBiography}
                }).done(function(data){    
                    html += data;
                    relatedArtists(bandquery);
            }); 
    }); 
}

/**
 * The search continues with getting related artists, is then sent to links()
 * @param (Band/artist name) bandquery
 */
function relatedArtists(bandquery){
    $.ajax({
        type: "POST",
        url: "php/bandsearch.php",
        datatype: "json",
        data: {relatedArtists:bandquery}
        }).done(function(data) {
            var showRelatedArtists = JSON.parse(data);

            $.ajax({
                type: "POST",
                url: "php/htmlcode.php",
                datatype: "text",
                data: {showRelatedArtists:showRelatedArtists}
                }).done(function(data){    
                    html += data;
                    links(bandquery);
            }); 
    }); 
}

/**
 * The search is concluded with links. The searchbutton is once again activated, html is closed up and appended to the correct div.
 * @param (Band/artist name) bandquery
 */
function links(bandquery){
    $.ajax({
        type: "POST",
        url: "php/bandsearch.php",
        datatype: "json",
        data: {links:bandquery}
        }).done(function(data) {
            var showLinks = JSON.parse(data);

            $.ajax({
                type: "POST",
                url: "php/htmlcode.php",
                datatype: "text",
                data: {showLinks:showLinks}
                }).done(function(data){    
                    html += data;
                    $("#loading").empty();
                    html += "</div>";
                    document.getElementById("bandsearchbtn").disabled = false;
                    $("#result").append(html);
            }); 
    });
}
