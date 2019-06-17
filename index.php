<?php
    include('./config.php');
    //require('pages/login/login.php');
    //redirect to tracker if logged in


  /*  if(isset($_SESSION["id"])){
      Redirect($edulog_root .'pages/tracker', false);
    }
    else {*/
        // redirect to login
    header('Location:' . $edulog_root .'pages/login');
  //  }

    /*if(isset($_COOKIE['user_id'])) {
        Redirect($edulog_root .'pages/tracker', false);
    } else {

        // redirect to login
        Redirect($edulog_root .'pages/login', false);
    }*/


?>
