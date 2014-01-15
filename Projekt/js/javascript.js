/**
 * @author Christoffer
 */

$("#submitsearch").click(function() {
    var query = $("#searchbar").val();
    
    $.ajax({
        type: "POST",
        url: "query.php",
        datatype: "json",
        data: {query:query}
        }).done(function(data){
            var trackList = JSON.parse(data);
            var html = htmlTrackList(trackList);
            
            $("#content").html("<h3>" + query + "</h3>" + html); 
        });
});
// --------------------------------------------------//
// Simple information window handling
// --------------------------------------------------//

$("#info").click(function() {   
    if(document.getElementById("information").style.display == "block")
    {
        $("#information").slideUp("slow");
    }
    else{
        $("#information").slideDown("slow");
    }
});

$("#ok").click(function() {
    $("#information").slideUp("slow");
});

// --------------------------------------------------//
// Functions
// --------------------------------------------------//

function htmlTrackList(trackList){
    var html = "";
    
    for (var i = 0 ;i < Object.keys(trackList).length ;i++){ 
        html += "<div class='track'>";
        html += trackList[i].artwork_url;
        html += trackList[i].title;
        html += trackList[i].genre;
        html += "</div>";
    }
    
    return html;
}
