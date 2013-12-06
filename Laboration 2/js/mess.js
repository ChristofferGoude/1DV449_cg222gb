$( document ).ready( 
				function() {
					$("#logout").bind( "click", function() {
	  				  	window.location = "index.php";
				 	});
				}
			)
			
			$( document ).ready( 		
				function() {
					
					$('#mess_container').hide();
					
					$("#add_btn").bind( "click", function() {			  	
						var name_val = $('#name_txt').val();
						var message_val = $('#message_ta').val();
						var pid =  $('#mess_inputs').val();
						// make ajax call to logout
						$.ajax({
							type: "GET",
						  	url: "functions.php",
						  	data: {function: "add", name: name_val, message: message_val, pid: pid}
						}).done(function(data) {
						  alert(data);
						});
					});
				}
			)