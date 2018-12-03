<?php
    require('CommentBoard/connection.php');

    setcookie('session_id', '');
    header ('location: CommentBoard/index.html' );
?>

