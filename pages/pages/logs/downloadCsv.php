<?php
    $file = 'file.csv';  

        if (file_exists($file) && is_readable($file)) {

            header('Content-Description: File Transfer'); 
            header('Content-type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');

            readfile($file); 
        }
?>