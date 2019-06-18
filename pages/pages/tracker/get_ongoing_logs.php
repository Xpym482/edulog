<?php
    include('../../config.php');

    if($_POST) {

        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);

        // get active lessons
        $statement = $db->prepare('SELECT l.started_at, l.id as log_id, a.id as activity_id, a.type, a.slug FROM logs AS l LEFT JOIN activities AS a ON l.activity = a.id WHERE l.lesson = ? AND l.ended_at IS NULL');
        $statement->bindValue(1, $_POST['lesson_id']);
        $activities = $statement->execute();

        $result = [];
        while ($row = $activities->fetchArray()) {
            array_push($result, $row);
        }

        echo json_encode($result);
    }
?>
