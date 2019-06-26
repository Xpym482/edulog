<?php
    include('../../config.php');
    include('../../util/dateTime.php');

    if($_POST) {
        // make db connection
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);

        $db->exec('BEGIN');
        $statement = $db->prepare('UPDATE lessons SET started_at=(:started_at) where thread is (:teema)');
        //$statement->bindValue(':user', $_POST['user_id']);
        $statement->bindValue(':started_at', date('Y-m-d H:i:s', strtotime("now -3 GMT")));
        $statement->bindValue(':teema', $_COOKIE['tunditeema']);
        $statement->execute();
        $db->exec('COMMIT');

        // set lesson id as cookie
        $result = $db->querySingle(
            "select id, started_at from lessons where ended_at is null and user='". $_POST['user_id'] ."'", true
        );
        setcookie('lesson_start', $result['started_at'], time() + (86400 * 30), "/");
        setcookie('lesson_id', $result['id'], time() + (86400 * 30), "/");
    } else {

    }

?>
