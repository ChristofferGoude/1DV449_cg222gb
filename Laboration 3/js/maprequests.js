// Hantering av knappklick och hämtning av trafikinfo!

$("#request").click(function() {
    $.ajax({ 
        type: "POST",
        url: "~/php/traffic.php",
        data: {
            action: "trafficNewsRequest"
        },
        success: function(data) {
            var info = JSON.parse(data);
            }
    });
});