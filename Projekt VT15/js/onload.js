/**
 * @author Christoffer
 */

$("#aboutbtn").click(function() {   
    if(document.getElementById("about").style.display == "block")
    {
        $("#about").slideUp("slow");
    }
    else{
        $("#about").slideDown("slow");
    }
});

window.onload = function(){
    var posting = $.ajax({
            type: "GET",
            url: "php/login.php",
            datatype: "text",
            data: {checksessionstatus:"session"}
        });
         
        posting.done(function(data) {
            if(data != false){
                loggedIn(data);
            }
            else{          
                notLoggedIn();
        }
    });
    
    window.fbAsyncInit = function() {
        FB.init({
        appId      : '758678914223395',
        xfbml      : true,
        version    : 'v2.2'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
    $("#header").on("click", "#facebook", function(){     
        FB.login(function(response) {
            if (response.status === "connected") {
                var user = "";
                FB.api('/me', function(response) {
                    $.ajax({
                        type: "POST",
                        url: "php/login.php",
                        datatype: "text",
                        data: {facebookLogin:response["name"]}
                        }).done(function(data){
                            $("#innerheader").empty();
                            $("#main").empty();
                            
                            $("#innerheader").append("<div class='col-md-4'><img src='images/title.png' class='img-responsive pull-left' alt='Hakkiko' /></div>");
                            loggedIn(data);
                        }); 
                });
            } 
            else if (response.status === "not_authorized") {
                //TODO: Handle this response via messages
            } 
            else {
                //TODO: Handle this response via messages
            }
        });
    });

    $("#header").on("click", "#logout", function(){
        FB.logout();
    });
    
    function notLoggedIn(){    
        $.ajax({
            type: "GET",
            url: "php/htmlcode.php",
            datatype: "text",
            data: {notLoggedIn:"notLoggedIn"}
            }).done(function(data){
                var html = JSON.parse(data);

                $("#innerheader").append(html[0]);
                $("#main").append(html[1]);
            });     
    }
    
    function loggedIn(username){
        $.ajax({
            type: "GET",
            url: "php/htmlcode.php",
            datatype: "text",
            data: {loggedIn:username}
            }).done(function(data){
                var html = JSON.parse(data);

                $("#innerheader").append(html[0]);
                $("#main").append(html[1]);
            });       
    }
}