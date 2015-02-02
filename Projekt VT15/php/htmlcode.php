<?php


class htmlcode{
	public function __construct(){
		
	}
	
	public function loggedInHeader($username){
		$html = "<div class='col-md-8'>
				 	<form id='logoutform' class='form-inline'>
					 	<div class='form-group'>
					 		<p id='user'>Welcome <b>" . $username . "</b></p>	
					 	</div>
					 	<button type='submit' id='logout' class='btn btn-default'>Log Out</button>
					</form>
  				 </div>";
				
		return $html;
	}
	
	public function notLoggedInHeader(){
		$html = "<div class='col-md-8'>
					<form id='loginform' class='form-inline'>
						<div class='form-group'>
					    	<label class='sr-only' for='username'>Username</label>
					    	<input type='text' class='form-control' id='username' placeholder='Username'>
					  	</div>
					  	<div class='form-group'>
					    	<label class='sr-only' for='password'>Password</label>
					    	<input type='password' class='form-control' id='password' placeholder='Password'>
					  	</div>
					  	<button type='submit' id='login' class='btn btn-default'>Log In</button>
					  	<button type='button' id='facebook' class='btn btn-primary'>Facebook Login</button>
					</form>
				</div>";
				
		return $html;
	}
	
	public function loggedInMain(){
		$html = "<div class='container'>
		  			<div class='row'>
		  				<div class='col-md-12'>
			  				<form id='bandsearchform'>
							  	<div class='form-group'>
							    	<label for='bandname'>Artist</label>
							    	<input type='text' class='form-control' maxlength='40' id='bandname' placeholder='Artist'>
							  	</div>
							  	<button type='submit' id='bandsearchbtn' class='btn btn-default'>Search</button>
							</form>
		  				</div>
	  				</div>
	  			</div>";
				
		return $html;
	}
	
	public function notLoggedInMain(){
		$html = "<div class='container'>
			   	 	<div class='row margin-top-30'>	
						<div class='col-md-12'>
							<button type='submit' id='openregform' class='btn btn-primary btn-lg btn-block'>Register</button>		  			
				  			<div id='registerwindow' class='margin-top-20'>
				  				<form id='registerform'>
									<div class='form-group'>
								    	<label for='regusername'>Username</label>
								    	<input type='text' class='form-control' id='regusername' placeholder='Username'>
								  	</div>
								  	<div class='form-group'>
								    	<label for='regpassword'>Password</label>
								    	<input type='password' class='form-control' id='regpassword' placeholder='Password'>
								  	</div>
									<button type='submit' class='btn btn-default'>Register</button>
								</form>
			  			 	</div>
	  					</div>
			  		</div>
		 		</div>";
			
		return $html;
	}
	
	public function showBiography($content){
		$html = "<div class='col-md-4'>
			 		<h2>Artist biography</h2>"; 
				 		
 		foreach($content as $bio){
 			$html .= "<p>" . $bio . "</p>";
 		}
				 		
		$html .= "</div>";
 		
 		return $html; 
	}
	
	public function showRelatedArtists($content){
		$html = "<div class='col-md-4'>
			 		<h2>Related Artists</h2>"; 
				 			
		foreach($content as $artist){
			$html .= "<p>" . $artist . "</p>";	
		}
		
		$html .= "</div>";
		 		
 		return $html;
	}
	
	public function showLinks($content){
		$html = "<div class='col-md-4'>
			 		<h2>Links</h2>"; 
		 			
		foreach($content as $link){
			if(!(preg_match('/\s/', $link))){
				$html .= "<p><a href=" . $link . " target='_blank'>" . $this->trimString($link) . "</a></p>";	
			}
			else{
				$html .= "<p><a href='#'>" . $link . "</a></p>";
			}
		}
		
		$html .= "</div>";
		 		
 		return $html;
	}
	
	public function messages($message){
		$html = "<div class='container'>
				 	<div class='row'>
				 		<div class='col-md-12'>
				 			<p>" . $message . "</p>
				 		</div>
			 		</div>
		 		</div>";
		 		
 		return $html;
	}
	
	public function trimString($string){
		return mb_strimwidth($string, 0, 50, "...");
	}
}

$htmlCode = new htmlcode();

if(isset($_GET["loggedIn"])){
	$htmlArray = array();
	array_push($htmlArray, $htmlCode->loggedInHeader($_GET["loggedIn"]));
	array_push($htmlArray, $htmlCode->loggedInMain());
	
	echo json_encode($htmlArray);
}

if(isset($_GET["notLoggedIn"])){
	$htmlArray = array();
	array_push($htmlArray, $htmlCode->notLoggedInHeader());
	array_push($htmlArray, $htmlCode->notLoggedInMain());
	
	echo json_encode($htmlArray);
}

if(isset($_POST["showBiography"])){
	echo $htmlCode->showBiography($_POST["showBiography"]);
}

if(isset($_POST["showRelatedArtists"])){
	echo $htmlCode->showRelatedArtists($_POST["showRelatedArtists"]);
}

if(isset($_POST["showLinks"])){
	echo $htmlCode->showLinks($_POST["showLinks"]);
}

if(isset($_POST["message"])){
	echo $htmlCode->messages($_POST["message"]);
}
