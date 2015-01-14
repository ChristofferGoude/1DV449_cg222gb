/**
 * @author Christoffer
 */

window.onload = function(){
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
    });
    
    var posting = $.ajax({
          type: "GET",
          url: "php/login.php",
          datatype: "text",
          data: {checksessionstatus:"session"}
          });
 
        posting.done(function(data) {
            if(data != false){
                loggedIn();
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
            data: {notLoggedInHeader:"notLoggedInHeader"}
            }).done(function(data){
                $("#header").append(data);
            });            
        
        $.ajax({
            type: "GET",
            url: "php/htmlcode.php",
            datatype: "text",
            data: {notLoggedInMain:"notLoggedInMain"}
            }).done(function(data){
                $("#main").append(data);
            });
    }
    
    function loggedIn(){
        $.ajax({
            type: "GET",
            url: "php/htmlcode.php",
            datatype: "text",
            data: {loggedInHeader:"loggedInHeader"}
            }).done(function(data){
                $("#header").append(data);
            }); 
            
        $.ajax({
            type: "GET",
            url: "php/htmlcode.php",
            datatype: "text",
            data: {loggedInMain:"loggedInMain"}
            }).done(function(data){
                $("#main").append(data);
            });       
    }
}
