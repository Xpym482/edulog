<?php
    include('../../config.php');
    session_start();
    $threadError = "";

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }
    if(isset($_SESSION['id'])){
      if(isset($_POST['addroom'])){
        if(isset($_POST['Teema']) && !empty($_POST['Teema']))
        {
            $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);
            setcookie('tunditeema', $_POST['Teema'], time() + (86400 * 30), "/");
            $db->exec('BEGIN');
            $statement = $db->prepare('INSERT INTO lessons (user, thread) VALUES (:user, :teema)');
            $statement->bindValue(':user', $_SESSION['id']);
            $statement->bindValue(':teema', $_POST['Teema']);
            $statement->execute();
            $db->exec('COMMIT');
            Redirect($edulog_root . 'pages/tracker', false);
        }
        else{
          $threadError = "Teema ei saa olla tühi!";
          }
        }
      }
      else {
        header('Location:' . $edulog_root .'pages/login');
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
                    <h1 id="title">Tunni teema</h1>
                </section>
                <div class="login-details">
                    <section>
                        <input id="Teema" name="Teema" placeholder="Kirjutage teema">
                        <div class="btn-wrap">
                            <button id="login-btn" class="f-btn" type="submit" name="addroom">Edasi</button>
                        </div>
                        <?php echo $threadError; ?>
                    </section>
                </div>
            </form>
        </div>
    </body>
</html>
