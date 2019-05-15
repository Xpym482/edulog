<?php
    include('../../config.php');
    include('../../util/dateTime.php');

    if($_POST) {

        // make db connection
        $db = new Sqlite3("../../" . 'database.sqlite',  SQLITE3_OPEN_READWRITE);

        // get activity id
        $statement = $db->prepare('select * from activities where type = ? and slug = ?');
        $statement->bindValue(1, $_POST['type']);
        $statement->bindValue(2, $_POST['slug']);
        $tmp = $statement->execute();

        $query = $db->prepare("INSERT INTO logs (lesson, activity, started_at) VALUES (:lesson, :activity, :started_at)");
        $query->bindValue(':started_at', dateUTC('Y-m-d H:i:s'));
        $query->bindValue(':lesson', $_POST['lesson_id']);
        $query->bindValue(':activity', $tmp->fetchArray(SQLITE3_ASSOC)['id']);
        $query->execute();


    }







?>
