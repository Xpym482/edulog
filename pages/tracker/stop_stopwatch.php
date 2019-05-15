<?php
    include('../../config.php');
    include('../../util/dateTime.php');

    if($_POST) {

        // make db connection
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        // get activity id
        $statement = $db->prepare('select * from activities where type = ? and slug = ?');
        $statement->bindValue(1, $_POST['type']);
        $statement->bindValue(2, $_POST['slug']);
        $activity = $statement->execute();

        // get log id
        $statement = $db->prepare('select * from logs where ended_at is null and activity=?');
        $statement->bindValue(1, $activity->fetchArray(SQLITE3_ASSOC)['id']);
        $id = $statement->execute();

        // update log
        $statement = $db->prepare("UPDATE logs SET ended_at = ? WHERE id = ?");
        $statement->bindValue(1, dateUTC('Y-m-d H:i:s'));
        $statement->bindValue(2, $id->fetchArray(SQLITE3_ASSOC)['id']);
        $statement->execute();

    }







?>
