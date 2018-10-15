<?php   
    require('connection.php');

    $sql = "SELECT comments.id, users.user_id, comments.parent_id, users.nickname, comments.content, comments.created_at from users, comments WHERE users.user_id = comments.user_id AND parent_id=0 ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $results = array();
    

    if ($result->num_rows > 0){
    	while ($row = $result->fetch_assoc()){ 
    		$results[] = $row;
    	}
    }

    echo json_encode($results);
	$conn->close();
 ?>
