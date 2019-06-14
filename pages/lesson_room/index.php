<?php
    include('../../config.php');

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    function __construct($pdo) {
        $this->pdo = $pdo;
    }


    if(isset($_COOKIE['user_id']))
    {

        // check if lesson already logging
        /*$db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);

        $query = "SELECT * FROM lessons WHERE ended_at IS NULL AND user='". $_COOKIE['user_id'] ."'";
        $result = $db->querySingle($query, true);

        if(!empty($result)) {

            // if active lesson already exists
            setcookie('lesson_start', $result['started_at'], time() + (86400 * 30), "/");
            setcookie('lesson_id', $result['id'], time() + (86400 * 30), "/");

        } else {
            setcookie("lesson_start", "", time() + (86400 * 30), "/");
            setcookie("lesson_id", "", time() + (86400 * 30), "/");
        }
        */
    } else {
        Redirect($edulog_root . 'pages/lesson_thread', false);
    }
    function getLessons(){
      $rooms = array();
      $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);
      $results = $db->query('SELECT room from activities');
      while ($row = $results->fetchArray()) {
        array_push($rooms, $row[0]);
      }
      return $rooms;
    }

    if(isset($_POST['addroom'])){
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);
        $db->exec('BEGIN');
        $statement = $db->prepare('INSERT INTO activities (room) VALUES (:room)');
        $statement->bindValue(':room', $_POST['Ruum']);
        $statement->execute();
        $db->exec('COMMIT');
    }



?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edulog Ruum</title>
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
            <form id="login-form" action="<?php $_SERVER["PHP_SELF"];?>" method="post" class="logreg">
                <section class="box-head">
                    <h1 id="title">VALI RUUM</h1>
                    <hr>
                </section>
                <div class="login-details">
                    <section>
                        <h1 id="title">Sinu ruumid:</h1>
                        <ul>
                          <?php
                          $ourarray = getLessons();
                          //var_dump($ourarray);
                          foreach ($ourarray as $key) {
                            ?><li><?php echo $key;?></li>
                            <?php
                          }
                           ?>
                        </ul>
                        <!--<input id="Ruum" name="Ruum" placeholder="Kirjutage ruum">-->
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h3 id="title">LISA UUS RUUM</h3>
                        <input id="Ruum" name="Ruum" placeholder="Kirjutage ruum" input="text">
                        <hr>
                        <div class="btn-wrap">
                        <hr>
                            <input id="login-btn" class="f-btn" type="submit" name="addroom" value="submit"></input>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </body>
</html>
