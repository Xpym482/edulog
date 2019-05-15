<?php
    include('./config.php');
    //redirect to tracker if logged in
    if(isset($_COOKIE['user_id'])) {
        Redirect($edulog_root .'pages/tracker', false);
    } else {

        // redirect to login
        Redirect($edulog_root .'pages/login', false);
    }


    // helper functions
    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }
?>
