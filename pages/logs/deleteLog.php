<?php

    include('../../config.php');
    session_start();
        if(isset($_SESSION['id'])) {

            // make db connection
            $db = new Sqlite3("../../" . 'database.sqlite',  SQLITE3_OPEN_READWRITE);

            $statement = $db->prepare('DELETE FROM lessons
            WHERE id = :lesson_id');
            $statement->bindValue(':lesson_id', $_POST['lesson_id'] );

            $statement->execute();

            $statement = $db->prepare('DELETE FROM logs
            WHERE lesson = :lesson_id');
            $statement->bindValue(':lesson_id', $_POST['lesson_id'] );

            $statement->execute();

            echo json_encode("done");
        }

?>
