/**
 * @author Christoffer
 */

$("#submitsearch").click(function() {
    var query = Math.floor((Math.random()*100)+1);
    var SChtml = "";
    var DZhtml = "";
    var deezerUser;
    var deezerTracks;
    var soundCloudUser;
    var soundCloudTracks;
    
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

            $("#content").html(SChtml); 
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
            
            //$("#content").html(SChtml + DZhtml);    
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
function addDZUser(user){
    var html = "";
    html += "<div class='musicright'>";
    html += "<p class='soft text-center'>What Deezer came up with</p>";
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
        html += "</div>";
    }   
    
    html += "</div>";
    
    return html;
}

function addSCUser(user){
    var html = "";
    html += "<div class='musicleft'>";
    html += "<p class='soft text-center'>What Soundcloud came up with</p>";
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
    
    html += "</div>";
    
    return html;
}

function userDoesNotExist(){
    var html = "";
    html += "<div class='musicleft'>";
    html + "<h3>A user was not found</h3>";
    return html;
}

function tracksDoesNotExist(){
    var html = "";
    html += "<div class='track'>";
    html += "This user have no tracks.";
    html += "</div>";
    
    html += "</div>";    
}
