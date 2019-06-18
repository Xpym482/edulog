<?php
    include('../../config.php');

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }




    if(isset($_COOKIE['user_id']))
    {
        // check if lesson already logging
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);

        $query = "SELECT * FROM lessons WHERE ended_at IS NULL AND user='". $_COOKIE['user_id'] ."'";
        $result = $db->querySingle($query, true);


    } else {
        Redirect($edulog_root . 'pages/tracker', false);
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edulog Teema</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css" type="text/css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script src="login.js"></script>
        <script src="../navbar.js"></script>
    </head>

    <body>
        <div class="site-content">
            <?php include "../../" . 'pages/navbar/navbar.php'; ?>

            <form id="login-form" action="<?=$_SERVER['PHP_SELF'];?>" method="post" class="logreg">
                <section class="box-head">
                    <h1 id="title">Tundi teema</h1>
                </section>
                <div class="login-details">
                    <section>
                        <input id="Teema" name="Teema" placeholder="Kirjutage teema">
                        <div class="btn-wrap">
                            <button id="login-btn" class="f-btn" type="submit">Edasi</button>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </body>
</html>
