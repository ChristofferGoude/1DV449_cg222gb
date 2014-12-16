/**
 * @author Christoffer
 */

var deezerUser;
var deezerTracks;
var soundCloudUser;
var soundCloudTracks;

$("#submitsearch").click(function() {
    var query = Math.floor((Math.random()*200)+1);
    var SChtml = "<div class='musicleft'><p class='soft text-center'>What Soundcloud came up with</p>";
    var DZhtml = "<div class='musicright'><p class='soft text-center'>What Deezer came up with</p>";

    $.ajax({
        type: "POST",
        url: "soundCloud.php",
        datatype: "json",
        data: {user:query}
        }).done(function(data){
            soundCloudUser = JSON.parse(data); 
            SChtml += addSCUser(soundCloudUser); 
        });
    
    $.ajax({
        type: "POST",
        url: "soundCloud.php",
        datatype: "json",
        data: {tracks:query}
        }).done(function(data){
            soundCloudTracks = JSON.parse(data); 
            SChtml += addSCTrackList(soundCloudTracks);
            SChtml += "<button type='submit' class='btn btn-warning btn-sm center-block scsave'>Save!</button></div>";
            $("#contentleft").html(SChtml);
        }); 
    
    $.ajax({
        type: "POST",
        url: "deezer.php",
        datatype: "json",
        data: {user:query}
        }).done(function(data){
            deezerUser = JSON.parse(data);    
            DZhtml += addDZUser(deezerUser);       
        });
        
    $.ajax({
        type: "POST",
        url: "deezer.php",
        datatype: "json",
        data: {tracks:query}
        }).done(function(data){
            deezerTracks = JSON.parse(data);    
            DZhtml += addDZTrackList(deezerTracks);  
            DZhtml += "<button type='submit' class='btn btn-warning btn-sm center-block dzsave'>Save!</button></div>"; 
            $("#contentright").html(DZhtml);    
        });
});

$(document).on("click", ".scsave", function() {
    //TODO: Fix database and add save functionality here.
    alert("Soundcloud sparning!");
});

$(document).on("click", ".dzsave", function() {
    //TODO: Fix database and add save functionality here.
    alert("Deezer sparning!");
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
function addSCUser(user){
    var html = "";
    html += user.username; 
    html += user.avatar_url;
    return html;
}


function addSCTrackList(trackList){
    var html = "";
    var x;

    if(Object.keys(trackList).length <= 5){
        x = Object.keys(trackList).length;
    }
    else if(Object.keys(trackList).length > 5){
        x = 5;
    }
    
    for (var i = 0; i < x; i++){ 
        html += "<div class='track'>";
        //html += trackList[i].artwork_url;
        html += trackList[i].title;
        html += trackList[i].permalink_url; 
        html += "</div>";
    }   
    
    return html;
}

function addDZUser(user){
    var html = "";
    html += user.name; 
    html += user.picture;
    return html;
    
}

function addDZTrackList(trackList){
    var html = "";
    var x;

    if(Object.keys(trackList).length <= 5){
        x = Object.keys(trackList).length;
    }
    else if(Object.keys(trackList).length > 5){
        x = 5;
    }
    
    for (var i = 0; i < x; i++){ 
        html += "<div class='track'>";
        html += trackList[i].title;
        html += trackList[i].link;
        html += "</div>";
    }   
    
    return html;
}
