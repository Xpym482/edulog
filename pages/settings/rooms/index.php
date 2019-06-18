<?php

    include('../../config.php');
    include('../../util/dateTime.php');

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    if($_GET) {
        $timezone_name = timezone_name_from_abbr("", $_GET['time_offset']*60, false);
        setcookie('time_offset', $timezone_name, time() + (86400 * 30), "/");
    }

    

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edulog register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/style.css" type="text/css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

        <script src="<?php echo $edulog_root . 'pages/tracker/js.cookie.js';?>"></script>
        <script src="register.js"></script>
        <script src="../navbar.js"></script>
    </head>

    <body>
        <div class="site-content">
            <?php include "../../" . 'pages/navbar/navbar.php'; ?>
            <form id="register-form" action="<?=$_SERVER['PHP_SELF'];?>" method="post" class="logreg">
                <section class="box-head">
                    <h1 id="title">Vali ruum</h1>
                </section>
                <div class="login-details">
                    <section>
                        <select id="register-locale" name="register-locale">
                            <option value="empty"></option>
                            <option value="room02">Room 01</option>
                            <option value="room03">Room 02</option>
                            <option value="room04">Room 02</option>
                        </select>
                    </section>
                    <section>
                        <input type="text" id="new-room" name="new-room" placeholder="Sisesta uus ruum">
                    </section>
                    
                    <section>
                        <div class="btn-wrap">
                            <button id="submit-btn" class="f-btn" type="submit">Edasi</button>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </body>
</html>
