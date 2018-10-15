<?php
    require('connection.php');
    
    //先撈使用者密碼出來還原，
    $username = $_POST['username'];
    $passward = $_POST['passward'];

    $hash_sql = $conn->prepare( " SELECT * FROM users WHERE username = ? ");
    $hash_sql->bind_param("s", $username);
    $hash_sql->execute();
    $hash_result = $hash_sql->get_result();
    $hash_row = $hash_result->fetch_assoc();

    
    if ( password_verify($passward, $hash_row['passward']) ){
        $session_sql = " SELECT id FROM users_certificate WHERE user_id = " . addslashes($hash_row['user_id']) ;
        $session_result = $conn->query($session_sql);
        $session_row = $session_result->fetch_assoc();
    
        setcookie("session_id", $session_row['id'], time()+3600*24);
        header ('location: /joe/index.html');
    }else{
        header ('location: /joe/index.html') ;
    }
    
    $sql->close();
        
?>
    
    
    <!--
    /* 舊的程式碼
    $sql = " SELECT username, passward, user_id FROM users WHERE username = '$username'  AND passward = '$passward' ";
    $result = $conn->query($sql);
    */
    
  

    /*
    $sql = $conn->prepare( " SELECT * FROM users WHERE username = ? AND passward = ? ");
    $sql->bind_param("ss", $username, $passward);
    $sql->execute();
    $result = $sql->get_result();
    */
    
    
    if ( $result->num_rows > 0 ){
        while ( $row = $result->fetch_assoc()){

            $session_sql = " SELECT id FROM users_certificate WHERE user_id = " . addslashes($row['user_id']) ;
            $session_result = $conn->query($session_sql);
            $session_row = $session_result->fetch_assoc();
        
            setcookie("session_id", $session_row['id'], time()+3600*24);
            header ('location: /joe/message.php?type=login_suc&username=' . $username );
        }
    }else{
        header ('location: /joe/message.php?type=login_fail') ;
    }

    $sql->close();
        
    }
    -->

    
  


