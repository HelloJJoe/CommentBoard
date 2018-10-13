<?php
    require('connection.php');

    $sql = " INSERT INTO comments (parent_id, user_id, content) VALUES ('" .  addslashes( $_POST['parent_id'] ) . "', '" . addslashes( $_POST['user_id'] ) . "', '" . addslashes( $_POST['content'] ) . "')";
    $conn->query($sql);
    $last_id = $conn->insert_id;
    $conn->close();

  
/*
    if ($conn->query($sql)){
        header ('Location: /joe/index.php');
    }
    else{
        echo 'error : ' . $conn->error;
    }
*/
    if ($_POST['parent_id'] === '0')
    {
        $arr = array('result' => 'success', 'id' => $last_id);
        echo json_encode($arr); 
    }
    else
        header ('Location: /joe/index.php');
  
?> 

