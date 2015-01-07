/**
 * @author Christoffer
 */

window.onload = function(){
    var posting = $.ajax({
                  type: "GET",
                  url: "php/login.php",
                  datatype: "text",
                  data: {checksessionstatus:"session"}
              });
     
    posting.done(function(data) {
        if(data != false){
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
        else{          
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
    });
}
