<?php
include('../../config.php');

// helper functions
session_start();

function signin($email, $password){
  $db = new Sqlite3('../../database.sqlite', SQLITE3_OPEN_READWRITE);
  //get user and set token
  $query = "select * from users where password='" . md5($_POST['login-email'] . $_POST['login-password']) . "'";
  $result = $db->querySingle($query, true);
  if(empty($result)) {
      // invalid email or password combination
      $invalid = true;
      //header("../tracker/index.php");

  } else {
      $invalid = false;
      // set cookie and redirect to tracker
      setcookie('user_id', $result['id'], time() + (86400 * 30), "/");
      setcookie('locale', $_POST['login-locale'], time() + (86400 * 30), "/");
      $_SESSION["user-name"] = $email;
      $_SESSION["id"] =  $result['id'];
      //header("http://localhost/edulog/pages/tracker/index.php");
      header("Location: http://xpym.ddns.net/edulog/pages/lesson_thread");
      //Redirect($edulog_root .'pages/tracker/index.php', false);

  }
}

function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}

?>
