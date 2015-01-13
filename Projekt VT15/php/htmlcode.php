<?php


class htmlcode{
	public function __construct(){
		
	}
	
	public function loggedInHeader(){
		$html = "<div class='container'>
		  			<div class='row'>
		  				<div class='col-md-4'>
				    		<img src='images/title.png' class='img-responsive pull-left' alt='Hakkiko' />
		  				</div>
		  				<div class='col-md-8'>
							<form id='logoutform' class='form-inline'>
							  	<button type='submit' id='logout' class='btn btn-default'>Logga ut</button>
							</form>
		  				</div>
	  				</div>
	  			</div>";
				
		return $html;
	}
	
	public function notLoggedInHeader(){
		$html = "<div class='container'>
		  			<div class='row'>
		  				<div class='col-md-4'>
				    		<img src='images/title.png' class='img-responsive pull-left' alt='Hakkiko' />
		  				</div>
		  				<div class='col-md-8'>
							<form id='loginform' class='form-inline'>
								<div class='form-group'>
							    	<label class='sr-only' for='username'>Användarnamn</label>
							    	<input type='text' class='form-control' id='username' placeholder='Användarnamn'>
							  	</div>
							  	<div class='form-group'>
							    	<label class='sr-only' for='password'>Lösenord</label>
							    	<input type='password' class='form-control' id='password' placeholder='Lösenord'>
							  	</div>
							  	<button type='submit' id='login' class='btn btn-default'>Logga in</button>
							</form>
		  				</div>
	  				</div>
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
							    	<input type='text' class='form-control' id='bandname' placeholder='Artist'>
							  	</div>
							  	<button type='submit' class='btn btn-default'>Sök</button>
							</form>
		  				</div>
	  				</div>
	  			</div>";
				
		return $html;
	}
	
	public function notLoggedInMain(){
		$html = "<div class='container'>
		  		<div id='openregformbutton' class='row'>
		  		</div>
		  		<div class='row margin-top-30'>	
					<div class='col-md-12'>
						<button type='submit' id='openregform' class='btn btn-primary btn-lg btn-block'>Registrera</button>		  			
			  			<div id='registerwindow' class='margin-top-20'>
			  				<form id='registerform'>
							  	<div class='form-group'>
							    	<label for='regusername'>Användarnamn</label>
							    	<input type='text' class='form-control' id='regusername' placeholder='Användarnamn'>
							  	</div>
							  	<div class='form-group'>
							    	<label for='regpassword'>Lösenord</label>
							    	<input type='password' class='form-control' id='regpassword' placeholder='Lösenord'>
							  	</div>
							  	<button type='submit' class='btn btn-default'>Registrera</button>
							</form>
			  			</div>
		  			</div>
		  		</div>
			</div>";
			
		return $html;
	}
	
	public function showBiography($content){
		$html = "<div class='col-md-4'>
			 		<h2>Artist biography</h2>
			 		<p>"; 
				 		
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
}

$htmlCode = new htmlcode();

if(isset($_GET["loggedInHeader"])){
	echo $htmlCode->loggedInHeader();
}

if(isset($_GET["notLoggedInHeader"])){
	echo $htmlCode->notLoggedInHeader();
}

if(isset($_GET["loggedInMain"])){
	echo $htmlCode->loggedInMain();
}

if(isset($_GET["notLoggedInMain"])){
	echo $htmlCode->notLoggedInMain();
}

if(isset($_POST["showBiography"])){
	echo $htmlCode->showBiography($_POST["showBiography"]);
}

if(isset($_POST["showRelatedArtists"])){
	echo $htmlCode->showRelatedArtists($_POST["showRelatedArtists"]);
}

if(isset($_POST["message"])){
	echo $htmlCode->messages($_POST["message"]);
}
