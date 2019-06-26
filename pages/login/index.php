<?php

    $invalid = false;
    include('../../config.php');
    require('login.php');

    $email = "";
    $emailError = "";
    $passwordError = "";
    $notice = "";
    if(!isset($_SESSION["user-name"])){
      if(isset($_POST["login"])){
      	if (isset($_POST["login-email"]) and !empty($_POST["login-email"])){
      	     $email = $_POST["login-email"];
          } else {
      	     $emailError = "Palun sisesta kasutajatunnusena e-posti aadress!";
          }

          if (!isset($_POST["login-password"])) {
      	     $passwordError = "Palun sisesta parool, vähemalt 8 märki!";
          }

        if(empty($emailError) and empty($passwordError)){
      	  $notice = signin($email, $_POST["login-password"]);
      	 } else {
      	  $notice = "Ei saa sisse logida!";
        }
      }
    }
    else{
      header("Location: http://localhost/edulog/pages/lesson_thread");
    }

    /*function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }*/

    if($_GET) {
        $timezone_name = timezone_name_from_abbr("", $_GET['time_offset']*60, false);
        setcookie('time_offset', $timezone_name, time() + (86400 * 30), "/");
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edulog login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css" type="text/css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script src="login.js"></script>
        <script src="../navbar.js"></script>
    </head>

    <body>
        <div class="site-content">
            <?php //include "../../" . 'pages/navbar/navbar.php'; ?>

            <form id="login-form" action="<?=$_SERVER['PHP_SELF'];?>" method="post" class="logreg">
                <section class="box-head">
                    <h1 id="title">Logi sisse</h1>
                </section>
                <div class="login-details">
                    <section>
                        <select id="login-locale" name="login-locale">
                            <option value="et">Eesti</option>
                            <option value="en">English</option>
                        </select>
                    </section>
                    <section>
                        <input id="login-email" name="login-email" placeholder="E-mail">
                    </section>
                    <section>
                        <input type="password" id="login-password" name="login-password" placeholder="Password">
                    </section>
                    <section>
                        <div class="btn-wrap">
                            <button id="login-btn" class="f-btn" type="submit" name="login">Edasi</button>
                        </div>
                    </section>
                </div>
            </form>
            <?php
            echo $notice;
            if($invalid) {
                echo '<span style="color: red; font-weight: bold; margin-top: 10px;" id="invalid-combination">Vale salasõna või emaili kombinatsioon</span>';
            } ?>
            <p class="not-user">Don't have an account? <a class="links" href="../register">Register here</a></p>
        </div>
    </body>
</html>
