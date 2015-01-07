/**
 * @author Christoffer
 */    

/*
 * Functions and calls used when logging in a user
 */

$("#header").on("submit", "#loginform", function(event) {
    var userinfo = [$("#username").val(), $("#password").val()]; 
    var url = "php/login.php";
    
    sendForm(userinfo, url);
    
    location.reload();
});

/*
 * User logout
 */
$("#header").on("click", "#logout", function(){
    $.ajax({
        type: "GET",
        url: "php/login.php",
        datatype: "text",
        data: {logout:"logout"}
        }).done(function(data){
            location.reload();
        }); 
});

/*
 * Functions and calls used when registrating a user
 */

$("#main").on("click", "#openregform", function(){   
    if(document.getElementById("registerwindow").style.display == "block")
    {
        $("#registerwindow").slideUp("slow");
    }
    else{
        $("#registerwindow").slideDown("slow");
    }
});

$("#main").on("submit", "#registerform", function(event) {
    var userinfo = [$("#regusername").val(), $("#regpassword").val()]; 
    var url = "php/register.php";  
    
    sendForm(userinfo, url);
});

/*
 * Function for showing the user messages
 */

function showMessage(message){
    url = "php/htmlcode.php";
    
    $.ajax({
        type: "POST",
        url: "php/htmlcode.php",
        datatype: "text",
        data: {message:message}
        }).done(function(data){
            $("#messages").empty();
            $("#messages").append(data);
        }); 
}

/*
 * Function for sending login- and register-forms
 */

function sendForm(userinfo, url){
    event.preventDefault();

    var posting = $.ajax({
                      type: "POST",
                      url: url,
                      datatype: "text",
                      data: {userinfo:userinfo}
                  });
     
    posting.done(function(data) {
        showMessage(data);
    });
}













