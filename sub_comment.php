<?php   
    require('CommentBoard/connection.php');

     $sub_sql = "SELECT comments.id, users.user_id, comments.parent_id, users.nickname, comments.content, comments.created_at from users, comments WHERE users.user_id = comments.user_id AND parent_id =" . $_POST['parent_id'] . " ORDER BY created_at ASC";
    
    $sub_result = $conn->query($sub_sql);                        
    $sub_results = array();
    

    if ($sub_result->num_rows > 0){
    	while ($sub_row = $sub_result->fetch_assoc()){ 
    		$sub_results[] = $sub_row;
    	}
    }

    echo json_encode($sub_results);
	$conn->close();
 ?>
