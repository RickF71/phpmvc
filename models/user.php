<?php
class User {
	
  // important variables that need to be automatically available
  public $id; // user's ID
  public $name; // user's account name
  public $color; // user's color
  public $bio; // user's bio/profile description 
  public $email;
  public $mailcount;
  public $groups = Array(); // Array of user groups
	
  function __construct($user_id) {
		
		if ($user_id==0) {
			return 0;
		}
	  //echo 'uid:'.$user_id;
	  $db = Db::getInstance();
	  $sql = 'SELECT * FROM users WHERE id="'.$user_id.'";';
	  $stmt = $db->query($sql);
	  $dat = $stmt->fetch();
		
	  // get all the basic user stuff
	  $this->id = $user_id;
	  $this->name = $dat['usernm'];
	  $this->email = $dat['emailaddy'];

	  }


  // ************  The rest are static functions **************
  public static function index() {
    // get user data using email
    $db = Db::getInstance();
    $req = $db->query('SELECT * FROM users;');
	
    foreach ($req->fetchall() as $user) {
      $userdata[$user['id']] = new User($user['id']);
    }
    return $userdata;	
  }
  
  public static function show($uid) {
	// get user data using email
    $db = Db::getInstance();
    $req = $db->query('SELECT * FROM users WHERE id='.$uid.';');
    $user=$req->fetch();
	
    return new User($user['id']);
  }
  
  public static function getUserlist () {
    $db = Db::getInstance();
    $sql = "SELECT id,usernm FROM users ORDER BY usernm";
    $data = $db->query($sql);
    $returndata = $data->fetchAll();
    return $returndata;
  }
  
  public static function logout() {
    $_SESSION['TFSuser'] = null;
    $_SESSION['act_as_user'] = null;
  }

  public static function signin($userEmail, $userPassword) {

    // get user data using email
    $db = Db::getInstance();
    $req = $db->query('SELECT * FROM users where emailaddy="'.$userEmail.'";');
    
    $userdata = $req->fetch();
    //print_r($userdata);
    //hash the form password with the same salt
    
    $salt = base64_decode($userdata["salt"]);

    $hashedPassword = hash('sha256', $salt . $userPassword);
	
    //compare the db password with that hash
    if ($hashedPassword == $userdata['passwd']) {
      //login succeeded
      $_SESSION['TFSuser'] = $userdata;
      return true;
    } else {
      // login failed
      return false;
    }
    
    //die("success");
    
    //success
  }
  public static function addToGroup($group_id, $user_id) {
    $db = Db::getInstance();
    $req = $db->query('INSERT INTO group_users SET group_id='.$group_id.', user_id='.$user_id.';');
  }
  public static function removeFromGroup($group_id, $user_id) {
    $db = Db::getInstance();
    $req = $db->query('DELETE FROM group_users WHERE group_id='.$group_id.' AND user_id='.$user_id.' LIMIT 1;');
  }
}
?>