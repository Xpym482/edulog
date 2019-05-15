<?php
    include('../../config.php');
    include('../../util/dateTime.php');

    if($_POST) {

        // make db connection
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);

        // end unfinished activities
        $db->exec('BEGIN');
        $query = $db->prepare('UPDATE logs SET ended_at = ? WHERE ended_at IS NULL AND lesson = ?');
        $query->bindValue(1, dateUTC('Y-m-d H:i:s'));
        $query->bindValue(2, $_POST['lesson_id']);
        $query->execute();
        $db->exec('COMMIT');

        // end lesson
        $db->exec('BEGIN');
        $statement = $db->prepare("UPDATE lessons SET ended_at = ? WHERE user = ? AND id = ?");
        $statement->bindValue(1, dateUTC('Y-m-d H:i:s'));
        $statement->bindValue(2, $_POST['user_id']);
        $statement->bindValue(3, $_POST['lesson_id']);
        $statement->execute();
        $db->exec('COMMIT');
    }


?>
