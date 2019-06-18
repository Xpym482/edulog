<?php

    include('../../config.php');

        if(isset($_COOKIE['user_id'])) {

            // make db connection
            
            $db = new Sqlite3("../../" . 'database.sqlite',  SQLITE3_OPEN_READWRITE);
            $statement = "";

            $sqlBase = 'SELECT u.email, l.id, l.started_at as "lesson start", l.ended_at as "lesson end",a.slug, logs.started_at as "log start", logs.ended_at as "log end", time(CAST ((julianday(logs.ended_at)-julianday(logs.started_at))* 24 * 60 * 60 AS Integer), "unixepoch")
            FROM users AS u, lessons AS l, activities AS a, logs';

            $justLogTime = 'SELECT logs.started_at
            FROM logs';

            if(is_numeric ($_GET['lesson_id'])){
                //One lesson
                $statement = $db->prepare("{$sqlBase}
                WHERE u.id = l.user AND l.id = :lesson_id AND logs.activity = a.id AND logs.lesson = :lesson_id");
                $statement->bindValue(':lesson_id', $_GET['lesson_id'] );
            } else if ($_GET['lesson_id'] == "All"){
                //All lessons
                $statement = $db->prepare("{$sqlBase}
                WHERE u.id = l.user AND l.id = logs.lesson AND logs.activity = a.id");
            } else if ($_GET['lesson_id'] == "Self"){
                //All your lessons
                $statement = $db->prepare("{$sqlBase}
                WHERE u.id = :user_id AND u.id = l.user AND l.id = logs.lesson AND logs.activity = a.id");
                $statement->bindValue(':user_id',$_COOKIE['user_id']);
            }

            $activities_raw = $statement->execute();

            $fp = fopen('file.csv', 'w');
            $separator = $_COOKIE['locale'] == 'et' ? ';':',';
            fputcsv($fp, array("User","Lesson","Lesson Start","Lesson End","Activity","Activity Start","Activity End", "Duration"), $separator);

            $tz = date_default_timezone_get();
            date_default_timezone_set($_COOKIE['time_offset']);         

            while ( $row = $activities_raw->fetchArray(SQLITE3_ASSOC) ) {
                $timeStamp = strtotime($row["lesson start"].' UTC');
                $row["lesson start"] = date("Y-m-d H:i:s", $timeStamp);
                $timeStamp = strtotime($row["lesson end"].' UTC');
                $row["lesson end"] = date("Y-m-d H:i:s", $timeStamp);
                $timeStamp = strtotime($row["log start"].' UTC');
                $row["log start"] = date("H:i:s", $timeStamp);
                $timeStamp = strtotime($row["log end"].' UTC');
                $row["log end"] = date("H:i:s", $timeStamp);
                fputcsv($fp, $row, $separator);
            }

            date_default_timezone_set($tz);

            fclose($fp);
            // free up memory
            $activities_raw->finalize();

            $file = 'file.csv';  

           
            echo json_encode("done");
        }
    
?>