<?php
    if($_POST) {
        $file = fopen("./logs/".$_POST['uuid'] .".html", "w");
        fwrite($file, file_get_contents("template.html") . stripcslashes($_POST['content']));
        fclose($file);
        $to      = 'merike.saar@gmail.com';
        $subject = 'Kiri EduLogist (' . $_POST['email'] . ') - ' . 'Uus log.';
        $message = 'Edulogist on saabunud uus kiri. Saatja: ' . $_POST['name'] . ' ('. $_POST['email'] . ')<br>Tulemused on vaadatavad <a href="http://www.saargraafika.ee/edulog/logs/'.$_POST['uuid'] .".html".'">siit.</a>';
        $headers ='From: EduLog'. "\r\n" .
            'Reply-To: ' . $_POST['email']. "\r\n" .
            'X-Mailer: PHP/' . phpversion(). "\r\n" .
            'MIME-Version: 1.0'. "\r\n" .
            'Content-Type: text/html; charset=UTF-8'. "\r\n";
        mail($to, $subject, $message, $headers);
    }
?>
