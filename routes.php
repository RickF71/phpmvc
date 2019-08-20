<?php
  function call($controller, $action, $message='') {
    // require the file that matches the controller name
    require_once('controllers/' . $controller . '_controller.php');

    // create a new instance of the needed controller
    switch($controller) {
      case 'pages':
        $controller = new PagesController();
				break;
			case 'companies':
				// model will query db later in the controller
				require_once('models/company.php');
				require_once('models/job.php');
				$controller = new CompaniesController();
				break;
			case 'jobs':
				// model will query db later in the job
				require_once('models/job.php');
				// jobs needs the tasks also
				require_once('models/task.php');
				$controller = new JobsController();
				break;
			case 'skills':
				require_once('models/skill.php');
				$controller = new SkillsController();
				break;
			case 'jobskills':
				require_once('models/jobskill.php');
				$controller = new JobskillsController();
				break;
			case 'tasks':
				require_once('models/task.php');
				require_once('models/job.php');
				$controller = new TasksController();
			break;
    } // end switch

    // call the action
    $controller->{ $action }($message);
  }

  // just a list of the controllers we have and their actions
  // we consider those "allowed" values
  $controllers = array('pages' => ['home', 'error'],
					'companies' => ['index', 'show'],
					'jobs' => ['index', 'show', 'create', 'submitnew','edit','submit'],
					'skills' => ['index', 'show'],
					'jobskills' => ['index', 'show'],
					'tasks' => ['find','createtask','savesort']);

  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error', 'Controller "'.$controller.'" found, but action "'.$action.'" not found');
    }
  } else {
    call('pages', 'error','Controller"'.$controller.'" not found');
  }
?>