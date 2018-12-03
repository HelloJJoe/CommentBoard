 <?
    require_once('CommentBoard/connection.php');

    if (!isset($_COOKIE['session_id'])){
    	$nn_results = array('result' => 'false');

    }else{
    	$session_id = $_COOKIE['session_id'];

	    $nn_sql = "SELECT users.nickname, users.user_id from users, users_certificate WHERE users.user_id = users_certificate.user_id AND users_certificate.id ='$session_id'";
	    $nn_result = $conn->query($nn_sql);
	    $nn_row = $nn_result->fetch_assoc();

	    $nn_results = array('result' => 'success', 'nickname' => $nn_row['nickname'], 'user_id' => $nn_row['user_id'], 'parent_id' => $_POST['parent_id']);
	}

    echo json_encode($nn_results);

 ?>    
