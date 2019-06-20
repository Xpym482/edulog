<?php
    include('../../config.php');
    session_start();

    /*function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }*/

    if(isset($_SESSION['id']))
    {
      if(isset($_COOKIE['tunditeema'])){
        // check if lesson already logging
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);

        $query = "SELECT * FROM lessons WHERE ended_at IS NULL AND user='". $_SESSION['id'] ."'";
        $result = $db->querySingle($query, true);

        if(!empty($result)) {
            // if active lesson already exists
            setcookie('lesson_start', $result['started_at'], time() + (86400 * 30), "/");
            setcookie('lesson_id', $result['id'], time() + (86400 * 30), "/");

        } else {
            setcookie("lesson_start", "", time() + (86400 * 30), "/");
            setcookie("lesson_id", "", time() + (86400 * 30), "/");
        }
      }
      else{
        Redirect($edulog_root . 'pages/lesson_thread', false);
      }

    } else {
        Redirect($edulog_root . 'pages/login', false);
    }


?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>EduLog</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script src="js.cookie.js"></script>
        <script src="main.js"></script>
        <script src="../navbar.js"></script>
    </head>

    <body>
        <?php include_once("../../" . 'pages/navbar/navbar.php'); ?>

        <div class="container">
          <?php //var_dump($result['started_at'], time() + (86400 * 30)); ?>
            <div class="slide-cam-audio">
                <div class="slide-cam">
                    <img src="../assets/camera.svg" alt="camera-icon" class="icon-slide">
                </div>
                <div class="slide-audio">
                    <img src="../assets/microphone.svg" alt="microphone" class="icon-slide">
                </div>
            </div>

            <div id="tracker">
                <div id="activities"></div>
                <footer></footer>
            </div>

            <button id="startBtn" class="bot-btn">Start</button>
            <button id="endBtn" class="bot-btn">Lõpeta logimine</button>
            <div class="overlay"></div>

        </div><!-- end of container -->
        <!-- <div id="results" class="hide">
            <div id="toMail">
                <div class="horizontal_graph" id="detailed_graph"></div>
                <div id="total_duration">
                    Total duration: 00:00:00
                </div>
                <div class="list" id="resultsList">

                </div>
            </div>
            <button id="sendToEmail">Saada tulemused emailile</button>
        </div> -->
        <!-- <button id="resetBtn" class="bot-btn">Lähtesta</button> -->
        </div>
    </body>
</html>