<?php 

################################ Helper function for flash messages ################
class FlashMessage{
	public static function DisplayAlert($message, $type){
		return "<h4 class='alert alert-" . $type ."' style='color:red;' align='center' >". $message."</h4>";
	} //end of display alert function
}


