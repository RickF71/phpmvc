<?php

class UsersController {
	
	public function index() {
	  if (!PMLogin::getInstance()->isInGroup(1)) {
	    return call('pages', 'error', 'You do not have the necessary permissions to access this page.');
	  }
	  global $breadcrumb;
	  $breadcrumb = '<li class="breadcrumb-item"><a href="/">Home</a></li>';
	  $users = User::index();
	  require_once('views/users/index.php');
	}
	
	public function show() {
	  if (!isset($_GET['id']))
	    return call('pages', 'error');
	  $user = User::show($_GET['id']);
      require_once('views/users/show.php');
	}
	
	public function login() {
		// Check if user is logged in already, if so don't allow a new login
		if (!(PMLogin::getInstance()==null || PMLogin::getInstance()->id==0)) {
			return call('pages', 'error', 'User already logged in');
		}
		require_once('views/users/login.php');
	}
	
	public function logout() {
	  User::logout();
	  require_once('views/users/logout.php');
	}
	
	public function register() {
	  
	  require_once('views/users/register.php');
	}
	
	public function signin() {
		$inputEmail = $_POST['inputEmail'];
		$inputPassword = $_POST['inputPassword'];
    unset ($_SESSION['user']);
		// echo 'hi '.$inputEmail;
		$user_verified = User::signin($inputEmail, $inputPassword);
		require_once('views/users/signin.php');
		
	}
	
  public function mail() {
    $usermail = PMLogin::getInstance()->getAllMail();
    $allusers = PMLogin::getInstance()->getUserlist();
    require_once('views/users/mail.php');
  }
  
  public function getMailMessage() {
    $mail_id=$_GET['mail_id'];
    $usermail = PMLogin::getInstance()->getOneMail($mail_id);
    require_once('views/users/getMailMessage.php');
  }
  
  public function deleteMail() {
    $mail_id = $_GET['mail_id'];
    $blah = PMLogin::getInstance()->deleteMail($mail_id);
  }
  public function createMail() {
    $recipient_id = $_GET['recipientid'];
    $recipient = new User($recipient_id);
    require_once('views/users/createMail.php');
  }
  
  public function submitMail() {
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $recipient = $_POST['recipientid'];
    $data = PMLogin::getInstance()->sendMessage($recipient, $subject, $content); // acct : rickf
    $_SESSION['alert-success']= 'Mail has been sent.';
    header('Location: /?controller=users&action=mail');
  }
  public function ajaxGetUserReceivedMail() {
    $usermail = PMLogin::getInstance()->getAllMail();
    $allusers = PMLogin::getInstance()->getUserlist();
    require_once('views/users/ajaxGetUserRecievedMail.php');
  }
  public function ajaxGetUserSentMail() {
    $usermail = PMLogin::getInstance()->getAllSentMail();
    $allusers = PMLogin::getInstance()->getUserlist();
    require_once('views/users/ajaxGetUserSentMail.php');
  }
	public function notes() {
		if (!PMLogin::getInstance()) {return call('pages', 'error', 'User must be logged into the site to access notes.');}
		$db = Db::getInstance();
		if ($_POST['user_notes']) {
			$sql = 'UPDATE users SET notes=:notes WHERE id=:user_id LIMIT 1;';
			$sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':notes' => $_POST['user_notes'], 
	                    ':user_id' => PMLogin::getInstance()->id));
			
			//$db->query ('UPDATE users SET notes="'.$_POST['user_notes'].'" WHERE id='.PMLogin::getInstance()->id.' LIMIT 1;');
			echo 'SAVED';
		}
		$dat = $db->query ('SELECT notes FROM users WHERE id='.PMLogin::getInstance()->id);
		$dat = $dat->fetch();
		require_once('views/users/notes.php');
	}
	
  public function admin() {
    if (!PMLogin::getInstance()->isInGroup(1)) {
	  return call('pages', 'error', 'You do not have the necessary permissions to access this page.');
    }
    $tfsu = PMLogin::getInstance();
    require_once('views/users/admin.php');
  }
  
  public function actas() {
    if (!PMLogin::getInstance()->isInGroup(1)) {
	  return call('pages', 'error', 'You do not have the necessary permissions to access this page.');
    }
    if (!isset($_GET['act_as_user'])) {
      return call('pages', 'error', 'This function is only available to Site Admin');
    }
    $_SESSION['act_as_user'] = $_GET['act_as_user'];
    require_once('views/users/actas.php');
  }
  
  public function add_to_group() {
    if (!PMLogin::getInstance()->isInGroup(1)) {
      return call('pages', 'error', 'You do not have the necessary permissions to access this page.');
    }
    if (isset($_GET['group_id']))
      $groupadd_id = $_GET['group_id'];
    else 
      return call('pages', 'error', 'No group ID specified');
    
    if (isset($_GET['user_id']))
      $useradd_id = $_GET['user_id'];
    else 
      return call('pages', 'error', 'No user ID specified');
    
    $usermod = User::addToGroup($groupadd_id, $useradd_id);
    $_SESSION['alert-success']='User added to group';
    return call('users','index');
  }
  
  public function remove_from_group() {
    if (!PMLogin::getInstance()->isInGroup(1)) {
      return call('pages', 'error', 'You do not have the necessary permissions to access this page.');
    }
    
    if (isset($_GET['group_id']))
      $grouprem_id = $_GET['group_id'];
    else 
      return call('pages', 'error', 'No group ID specified');
  
    if (isset($_GET['user_id']))
      $userrem_id = $_GET['user_id'];
    else 
      return call('pages', 'error', 'No user ID specified');
  
    $usermod = User::removeFromGroup($grouprem_id, $userrem_id);
    $_SESSION['alert-success']='User removed from group';
    return call('users','index');
  }
  
  public function mailings() {
    include_once ('views/users/mailings.php');
  }

  public function contact() {
    include_once('views/users/contact.php');
  }
}