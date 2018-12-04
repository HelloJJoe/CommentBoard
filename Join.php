<?php
    require('connection.php');

    $username = $_POST['username'];
    $passward = password_hash($_POST['passward'], PASSWORD_BCRYPT);
    $nickname = $_POST['nickname'];

    $sql = "INSERT INTO users (username, passward, nickname) VALUES ('$username', '$passward', '$nickname')";
    $result = $conn->query($sql);
    

    if ($result === true){

        $setcookie_sql = "SELECT user_id FROM users WHERE username = '$username' ";
        $setcookie_result = $conn->query($setcookie_sql);
        $setcookie_row = $setcookie_result->fetch_assoc();

        $session_id = uniqid();
        $session_sql = " INSERT INTO users_certificate (id, user_id) VALUES ('$session_id'," . addslashes( $setcookie_row['user_id'] ) . ")" ;
        $session_result = $conn->query($session_sql);

        echo $session_sql;
        
            setcookie("session_id", $session_id, time()+3600*24);
            header ('location: ./index.html');
        
    }
    else{
        header ('location: ./index.html');
    }
    
?>
