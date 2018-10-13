<?php

    require_once('connection.php');

    $is_login = '';
    if (isset($_COOKIE['session_id']) && !empty($_COOKIE['session_id'])){

        $security_sql = " SELECT * from users_certificate WHERE id =" . "'" . addslashes($_COOKIE['session_id']) . "'" ;
        $security_result = $conn->query($security_sql);
        $security_row = $security_result->fetch_assoc();

        
        if ( $security_result->num_rows > 0){
            $is_login = true;
        }
    }
?>