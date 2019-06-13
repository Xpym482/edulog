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

    if(!empty($_POST['activity'])){
        echo("test");
        $addStudentActivity = $_POST['name_et'];
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);
        $db->exec('BEGIN');
        $statement = $db->prepare('INSERT INTO activities (name) VALUES (:name)');
        $statement->bindValue(':name', $_POST['activity']);
        $statement->execute();
        $db->exec('COMMIT');
        var_dump($_POST['activity']);

    }




    if(isset($_COOKIE['user_id']))
    {
        // check if lesson already logging
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);

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
    </head>

    <body>
        <?php include "../../" . 'pages/navbar/navbar.php'; ?>

        <div class="container">


            <div id="tracker">
             <!--   <div id="activities"></div> -->
                <footer></footer>
            </div>
            <div id="addStudent">
            <h2>Add student activity</h2>
            <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" id="addStudentActivity" placeholder="Lisa õpejudude tegevust" name="activity"/><br />
                <input type="submit" value="Submit" name="addActivity"/><br />
            </form>
            </div>
            <div id="addTeacher">
            <h2>Add teacher activity</h2>
            <input type="text" id="addTeacherActivity" placeholder="Lisa õpejudude tegevust" /><br /></button>
            <input type="button" value="Submit"  /><br /></button>
            </div>
            <span id="response">

            </span>


    </body>
</html>
