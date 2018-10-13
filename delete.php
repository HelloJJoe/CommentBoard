<?php
    require('connection.php');

    $id = $_GET['id'];
    $parent_id = $_GET['parent_id'];

   

   $sql = " DELETE FROM comments WHERE id = $id AND parent_id = $parent_id"; 
   $result = $conn->query($sql);
    

    if ( $result === true ){
       header ('location: /joe/message.php?type=delete_suc');
    }

   

   
   
?>

