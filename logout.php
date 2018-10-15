<?php
    require('connection.php');

    setcookie('session_id', '');
    header ('location: /joe/index.html' );
?>

