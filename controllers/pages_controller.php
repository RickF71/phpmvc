<?php
	class PagesController {
		public function home() {
			// For the main resume page, make sure we include all the models we need!
			// require_once('models/MODEL.php');	  
			// $MODELS = MODEL::all();	  
			require_once('views/pages/home.php');
    }

    public function error($message='') {
      require_once('views/pages/error.php');
    }
	
  }
?>