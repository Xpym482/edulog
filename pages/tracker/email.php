<?php
    if($_POST) {
        $to      = $_POST['email'];
        $subject = 'Kiri EduLogist.';
        $message = 'Edulogist on saabunud uus kiri. Tulemused on vaadatavad <a href="http://www.saargraafika.ee/edulog/logs/'.$_POST['uuid'] .".html".'">siit.</a>';
        $headers ='From: EduLog'. "\r\n" .
            'Reply-To: ' . $_POST['email']. "\r\n" .
            'X-Mailer: PHP/' . phpversion(). "\r\n" .
            'MIME-Version: 1.0'. "\r\n" .
            'Content-Type: text/html; charset=UTF-8'. "\r\n";
        mail($to, $subject, $message, $headers);
    }
?> 
