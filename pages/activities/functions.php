<?php

function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function getTeacherActivities(){
      $teacherActivities = array();
      $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);
      $results = $db->query('SELECT activity from activities WHERE type = "teacher"');
      while ($row = $results->fetchArray()) {
        array_push($teacherActivities, $row[0]);
      }
      return $teacherActivities;
    }

      function getStudentActivities(){
        $studentActivities = array();
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);
        $results = $db->query('SELECT activity from activities WHERE type = "student"');
        while ($row = $results->fetchArray()) {
          array_push($studentActivities, $row[0]);
        }
        return $studentActivities;
    }

    if(!empty($_POST['addTeacherActivity'])){
        echo("test");
        $addStudentActivity = $_POST['activity'];
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);
        $db->exec('BEGIN');
        $statement = $db->prepare('INSERT INTO activities (activity, type) VALUES (:activity, :type)');
        $statement->bindValue(':activity', $_POST['addTeacherActivity']);
        $statement->bindValue(':type', 'teacher');
        $statement->execute();
        $db->exec('COMMIT');

    }

    if(!empty($_POST['addStudentActivity'])){
        echo("test");
        $addStudentActivity = $_POST['activity'];
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);
        $db->exec('BEGIN');
        $statement = $db->prepare('INSERT INTO activities (activity, type) VALUES (:activity, :type)');
        $statement->bindValue(':activity', $_POST['addStudentActivity']);
        $statement->bindValue(':type', 'student');
        $statement->execute();
        $db->exec('COMMIT');

    }

    
    if(!empty($_POST['student'])){
        echo("test");
        $addStudentActivity = $_POST['activity'];
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);
        $db->exec('BEGIN');
        $statement = $db->prepare('INSERT INTO activities (type) VALUES (:type)');
        $statement->bindValue(':type', $_POST['student']);
        $statement->execute();
        $db->exec('COMMIT');

    }



    



    if(isset($_COOKIE['user_id']))
    {
        // check if lesson already logging
        $db = new Sqlite3("../../" . 'database.sqlite', SQLITE3_OPEN_READWRITE);

        $query = "SELECT * FROM lessons WHERE ended_at IS NULL AND user='". $_COOKIE['user_id'] ."'";
        $result = $db->querySingle($query, true);
        if(!empty($result)) {
            // if active lesson already exists
            setcookie('lesson_start', $result['started_at'], time() + (86400 * 30), "/");
            setcookie('lesson_id', $result['id'], time() + (86400 * 30), "/");
        } else {
            setcookie("lesson_start", "", time() + (86400 * 30), "/");
            setcookie("lesson_id", "", time() + (86400 * 30), "/");
        }

    } else {
        Redirect($edulog_root . 'pages/login', false);
    }

    ?>