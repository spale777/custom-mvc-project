<?php
$err = isset($_GET['err']) ? $_GET['err'] : false;

if ($err) {
    switch ($err) {
        case $err == '1':
            echo '<h2>Nemate pristup ovoj sekciji</h2>';
            break;
        default:
            echo '<h2>Doslo je do nepredvidjene greske</h2>';
            break;
    }
}
?>