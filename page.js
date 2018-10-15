$(document).ready(function(){
	$.ajax({
		type: 'GET',
		url: 'page.php',
		success: function(resp){
			var res = JSON.parse(resp)

			for (var i = 1; i <= res.page; i++){
				var item = 
					`
					<a href='?page=${res.page}'>${res.page}</a>
					`
				$('.pages').append(item)
			}
		}


	})


})