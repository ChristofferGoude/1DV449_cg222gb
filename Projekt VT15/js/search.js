/**
 * @author Christoffer
 */
$("#main").on("submit", "#bandsearchform", function(event) {
    event.preventDefault();
    
    var bandquery = $("#bandname").val();

    var posting = $.ajax({
                      type: "POST",
                      url: "php/bandsearch.php",
                      datatype: "text",
                      data: {bandquery:bandquery}
                  });
     
    posting.done(function(data) {
        var showSearchQuery = data;
        console.log("showSearchQuery: " + showSearchQuery);
        $.ajax({
            type: "POST",
            url: "php/htmlcode.php",
            datatype: "text",
            data: {showSearchQuery:showSearchQuery}
        }).done(function(data){
            
            console.log("data: " + data);
            $("#main").append(data);
        }); 
    });   
});