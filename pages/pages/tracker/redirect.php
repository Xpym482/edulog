<?php
    include('../../config.php');

    $lessonid = $_POST['lesson_id'];
    setcookie("lesson_start", "", time() + (86400 * 30), "/");
    setcookie("lesson_id", "", time() + (86400 * 30), "/");
    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    Redirect($edulog_root . 'pages/logs/single/index.php?log=' . $lessonid, false);

?>
