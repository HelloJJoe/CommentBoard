
$(document).ready(function(){
	$.ajax({
		type: 'GET',
		url: 'comment.php',
		success: function(resp) {
		  	var res = JSON.parse(resp)
	
		  	for (var i = 0; i < res.length; i++){
		  		appendMainComment(res[i]);
				$.ajax({
					type: 'POST',
					url: 'sub_comment.php',
					data:{
						parent_id : res[i].id,
					},
					success: function(sub_resp){
						var sub_res = JSON.parse(sub_resp)

							for (var j = 0; j < sub_res.length; j++){
								appendSubComment(sub_res[j]);
							}
											
					}
				});
			
		
				$.ajax({
					type: 'POST',
					url: 'nickname.php',
					data:{
						parent_id : res[i].id,
					},
					success: function(resp){
						var res = JSON.parse(resp)
						var item = 
							`									
							<h3>Reply</h3>
							<div class='form_block'>
								 <form action='/joe/insert_comm.php' method='POST'>
						            <div class='nn'>${res.nickname}</div>
						            <br>              
						            <textarea name='content' placeholder='Comment here'></textarea>
						            <input name='parent_id' value='${res.parent_id}' type='hidden' />
						            <input name='user_id' value='${res.user_id}' type='hidden' />
						            <button type="submit" class="btn btn-primary">Submit</button>                  
								</form>
							</div>
							`
						$(`.reply_block[name=${res.parent_id}]`).append(item)
					}

				})
				}
			
		},
	  
	});

})


function appendMainComment(res){
	var	item = 
		`
		<div class="jumbotron">

	    <div class="main_review_block">
		    <h3>${res.nickname}</h3>
	        <div class='time'>${res.created_at}</div>
	        <p class="lead">${res.content}</p>
		    <hr class="my-4">
	    </div>

		<div class='sub_review_block' name='${res.id}'></div>
		<div class='reply_block' name='${res.id}'></div>  

		`
	$('.sub_block').append(item)
}

function appendSubComment(sub_res){
	var item = 
		`
		<div class='sub_review'>
			<div class='nickname'>${sub_res.nickname}</div>
			<div class='time' >${sub_res.created_at}</div>
			<div class='content' >${sub_res.content}</div>
		</div>
		`
	$(`.sub_review_block[name=${sub_res.parent_id}]`).append(item)
}
