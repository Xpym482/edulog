<?php

    include('../../config.php');

    if($_POST) {
        // make db connection
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);

        $db->exec('BEGIN');
        
        $slug = $_POST['activity'].' User:'.$_COOKIE['user_id'];
        $statement = $db->prepare('SELECT * FROM activities
            WHERE slug = :slug');
            $statement->bindValue(':slug', $slug );
        $doesExist = $statement->execute()->fetchArray(SQLITE3_ASSOC); 

        if($doesExist){
            $statement = $db->prepare('UPDATE activities SET user=:user
            WHERE slug = :slug');
            $statement->bindValue(':user', $_COOKIE['user_id']);
            $statement->bindValue(':slug', $slug );
        }
        else {
            $statement = $db->prepare('INSERT INTO activities (slug, user, name_et, name_en) 
            VALUES (:slug, :user, :name_et, :name_en)');
            $statement->bindValue(':slug', $slug);
            $statement->bindValue(':user', $_COOKIE['user_id']);
            $statement->bindValue(':name_et', $_POST['activity']);
            $statement->bindValue(':name_en', $_POST['activity']);
        }
        $statement->execute();
        $db->exec('COMMIT');
    } 

    header('Location: ' . $edulog_root. 'pages/activityManagement', true, 301);
?>
