<?php

include '../../config.php';

// make db connection
$db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);

// get logged lessons
$db->exec('BEGIN');
$statement = $db->prepare('SELECT * FROM lessons WHERE user = :user ORDER BY started_at DESC');
$statement->bindValue(':user', $_COOKIE['user_id']);
$lessons = $statement->execute();

$tz = date_default_timezone_get();
date_default_timezone_set($_COOKIE['time_offset']);       

$result = [];
while ($row = $lessons->fetchArray()) {
    $timeStamp = strtotime($row["started_at"].' UTC');
    $row["started_at"] = date("Y-m-d H:i:s", $timeStamp);
    array_push($result, $row);
}

date_default_timezone_set($tz);

/*$to      = 'joonas@localhost';
$subject = 'the subject';
$message = 'shalom';
$headers = 'From: joonas@localhost' . "\r\n" .
'Reply-To: joonas@localhost' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);*/
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>EduLog</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="<?php echo $edulog_root . 'pages/tracker/js.cookie.js'; ?>"></script>

</head>

<body>
    <div class="container">
        <?php include "../../" . 'pages/navbar/navbar.php';?>
        <div class="logreg">
            <section class="box-head">
                <h1 id="title">
                    <?php if ($_COOKIE['locale'] == 'et') {
                        echo 'Tundide logi';
                    } else {
                        echo 'Logged lessons';

                    }
                    ?>
                </h1>
            </section>
            <?php foreach ($result as $log): ?>

            <div>
                <a
                    href="./single/index.php?log=<?php echo $log['id']; ?>"><label><?php echo $log['started_at']; ?></label></a>
                <span>
                    <span class="delete-button" onclick="deleteLog(<?php echo $log['id']; ?>)" > </span>
                    <span class="circle" onclick="fetchCsv(<?php echo $log['id']; ?>)">
                        <span class="download-arrow" />
                    </span>
                </span>
            </div>

            <?php endforeach;?>
        </div>
    </div><!-- end of container -->
</body>

<script src="functions.js"></script>
</html>