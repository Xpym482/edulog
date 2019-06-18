<?php
// make db connection
$db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);
// get user activities
$db->exec('BEGIN');
$statement = $db->prepare('SELECT * FROM activities WHERE user = :user');
$statement->bindValue(':user', $_COOKIE['user_id']);
$result = $statement->execute();     

$userActivities = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    array_push($userActivities, $row);
}

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

</head>

<body>
    <div class="container">
        <?php include "../../" . 'pages/navbar/navbar.php';?>
        <div class="logreg">
            <section class="box-head">
                <h1 id="title">
                    <?php if ($_COOKIE['locale'] == 'et') {
                        echo 'Tegevuste haldamine';
                    } else {
                        echo 'Managing your activities';

                    }
                    ?>
                </h1>
            </section>
            <?php foreach ($userActivities as $activity): ?>

            <div>
                <label>
                    <?php if ($_COOKIE['locale'] == 'et') {
                        echo $activity['name_et'];
                    } else {
                        echo $activity['name_en'];

                    }
                    ?>
                </label>
                <span>
                    <span class="delete-button" onclick="deleteActivity(<?php echo $activity['id']; ?>)" > </span>
                </span>
            </div>

            <?php endforeach;?>
            
            <form action="addActivity.php" method="post">
                <div>
                    <?php echo($_COOKIE['locale'] == 'et') ? "Uus tegevus" : "New activity"?>
                    <input id="activityInput" type="text" name="activity">
                    <input id="activityInput" class="f-btn" type="submit" value=<?php echo($_COOKIE['locale'] == 'et') ? "Sisesta" : "Submit"?>>
                </div>
            </form>
        </div>
    </div><!-- end of container -->
</body>

<script src="functions.js"></script>
</html>