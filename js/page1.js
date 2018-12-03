$(document).ready(function(){
	var urlParams = new URLSearchParams(window.location.search);
	var page = urlParams.get('page')
	$.ajax({
		type: 'POST',
		url: 'page.php',
		data:{
			page: page,
		},
		success: function(resp){
			var res = JSON.parse(resp)

			for (var i = 1; i <= res.pages; i++){
				var item = 
					`
					<a href='?page=${i}'>${i}</a>
					`
				$('.pages').append(item)
			}
		}


	})


})