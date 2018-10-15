$(document).ready(function(){    	
    $.ajax({
        type: 'GET',
        url: 'security.php',
        success: function(resp){
            var res = JSON.parse(resp)
            if(res.is_login){
            	var item = 
            		`
            		<li class="nav-item">
                		<a class="nav-link" href="/joe/logout.php">Sign Out</a>
            		</li>
            		`
                $.ajax({
                    type: 'POST',
                    url: 'nickname.php',
                    data:{
                        parent_id : 1,
                    },
                    success: function(resp){
                        var res = JSON.parse(resp)
                        $('.nn').text(res.nickname)
                        $('input[name=user_id]').val(res.user_id)
                    }
                })

        	}
        	else{
        		var item =
        			`
        			<li class="nav-item">
                        <a class="nav-link" href="/joe/signin.html">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/joe/Join.html">Join</a>
                    </li>
                    `

                $('.form_block').prepend(
                    `
                    <div class='cookieisnotset'><a href='/joe/signin.html'>Sign In</a></div>
                    `
                    )

                $('.form_block > form').hide()
        	}
        	$('.navbar-nav.mr-auto').append(item)
        }

    })


})

	