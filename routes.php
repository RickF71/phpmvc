<?php
  function call($controller, $action, $message='') {
    // require the file that matches the controller name
    require_once('controllers/' . $controller . '_controller.php');

    // create a new instance of the needed controller
		// for "phpmvc" purposes all of these except PagesController
		// are examples
    switch($controller) {
      case 'pages':
        $controller = new PagesController();
				break;
			case 'users': // everything to do with logins
        require_once('models/user.php');
        $controller = new UsersController();
      break;
			case 'companies':
				// model will query db later in the controller
				require_once('models/company.php');
				require_once('models/job.php');
				$controller = new CompaniesController();
				break;
			break;
    } // end switch

    // call the action
    $controller->{ $action }($message);
  }

  // just a list of the controllers we have and their actions
  // we consider those "allowed" values
  $controllers = array('pages' => ['home', 'error'],
					'companies' => ['index', 'show'],
					'users' => ['index', 'login', 'logout', 'edit']);

  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error', 'Controller <strong>'.$controller.'</strong> found, but action <strong>'.$action.'</strong> not found');
    }
  } else {
    call('pages', 'error','Controller <strong>'.$controller.'</strong> was not found');
  }
?>