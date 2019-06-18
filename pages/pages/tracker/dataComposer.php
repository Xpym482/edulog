<?php
    if($_POST) {
        $file = fopen("./data/data.csv", "w");
        fwrite($file, $_POST['csv']);
        fclose($file);
    }
?>
 
