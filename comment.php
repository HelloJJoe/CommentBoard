<?php   
    require('CommentBoard/connection.php');

    $page_sql = 'SELECT COUNT(id) FROM comments where parent_id=0'; 
    $page_result = $conn->query($page_sql);                  
    $page_row = $page_result->fetch_assoc();                    
    $pages = ceil( $page_row['COUNT(id)'] / 10 );  


    if ($_POST['page'] === ''){                      
        $page = 1;    
    }else{
        $page = intval($_POST['page']);                          
    }

    $start = ($page-1)*10; 

    $sql = "SELECT comments.id, users.user_id, comments.parent_id, users.nickname, comments.content, comments.created_at from users, comments WHERE users.user_id = comments.user_id AND parent_id=0 ORDER BY created_at DESC LIMIT $start, 10";
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
