<?php

    include('../../../config.php');


    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    if(isset($_COOKIE['user_id'])) {

    } else {

        // if no cookie, return to login
        Redirect($edulog_root . 'pages/login', false);
    }



?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" href="../../css/style.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>EduLog</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script src="<?php echo $edulog_root . 'pages/tracker/js.cookie.js';?>"></script>
        <script src="single.js"></script>
        <script src="../../navbar.js"></script>
    </head>

    <body>
        <div class="container">
            <?php include 'navbar.php'; ?>
            <div class="logreg">
                <section class="box-head">
                    <h1 id="title">Tundide logi</h1>
                </section>

            </div><!-- end of container -->
                <div id="results">
                   <div id="total_duration">
                       <span>Total duration: 00:00:00</span>
                   </div>
                   <div class="horizontal_graph" id="detailed_graph"></div>

                   <div id="resultsList">

                   </div>
                </div>
            </div>

        </div><!-- end of container -->
    </body>
</html>
