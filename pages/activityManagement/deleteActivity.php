<?php

    // make db connection
    $db = new Sqlite3("../../" . 'database.sqlite',  SQLITE3_OPEN_READWRITE);

    $statement = $db->prepare('UPDATE activities SET user="deprecated"
    WHERE id = :activity_id');
    $statement->bindValue(':activity_id', $_POST['activity_id'] );
    
    $statement->execute();

    echo json_encode("done");

?>