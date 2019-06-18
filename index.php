<?php
    include('./config.php');
    //require('pages/login/login.php');
    //redirect to tracker if logged in
    header('Location: ' . $edulog_root . 'pages/login');
    /*if(isset($_COOKIE['user_id'])) {
        Redirect($edulog_root .'pages/tracker', false);
    } else {

        // redirect to login
        Redirect($edulog_root .'pages/login', false);
    }*/


?>
