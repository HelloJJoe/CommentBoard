$(document).ready(function(){
    $('form').submit(function(e){
        const nickname = $(e.target).find('.nn').text()
        const user_id = $(e.target).find('input[name=user_id]').val()
        const content = $(e.target).find('textarea').val()
        const parent_id = $(e.target).find('input[name=parent_id]').val()
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'insert_comm.php',
            data:{
                nickname: nickname,
                user_id: user_id,
                content: content,
                parent_id: parent_id,
            },
            success: function(resp){
                var res = JSON.parse(resp)
                if (res.result === 'success'){
                    if (parent_id === '0')
                        $('.sub_block').prepend(
                        `
                        <div class="jumbotron">
                            <!-- 主留言區 -->
                            <div class="main_review_block">
                                <h3>${nickname}</h3>
                                <div class='time' >date</div>
                                <p class="lead">${content}</p>
                                <div class='btns'>

                                </div>
                                <hr class="my-4">
                            </div>                    
                            <!--撰寫子留言區 -->
                            <div class='reply'>
                                <h3>Reply</h3>
                                <div class='form_block'>

                                    <form action='/joe/insert_comm.php' method='POST'>
                                        <div class='nn'>${nickname}</div><br>              
                                        <textarea name='content' placeholder='Comment here'></textarea>
                                        <input name='parent_id' value='${res.id}' type='hidden' />
                                        <input name='user_id' value='${user_id}' type='hidden' />
                                        <button type="submit" class="btn btn-primary">Submit</button>                  
                                    </form>

                                </div>
                            </div>

                        </div>                                         
                        `                            
                    )

                    
                }

    
            }
            
        });
    })

})