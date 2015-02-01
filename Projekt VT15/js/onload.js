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
    /*window.fbAsyncInit = function() {
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
                $.ajax({
                    type: "GET",
                    url: "php/login.php",
                    datatype: "text",
                    data: {facebookLogin:"facebookLogin"}
                    }).done(function(data){
                        console.log("Result: " + data);
                    }); 
            } 
            else if (response.status === "not_authorized") {
                notLoggedIn();
            } 
            else {
                notLoggedIn();                
            }
        });
    });

    $("#header").on("click", "#logout", function(){
        FB.logout();
    });*/

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