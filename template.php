                        <!-- 主留言區 -->
                        <div class="main_review_block">
                            <h3><?php echo $row['nickname']; ?></h3>
                            <div class='time' ><?php echo $row['created_at']; ?></div>
                            <p class="lead"><?php echo htmlspecialchars ($row['content'], ENT_QUOTES, 'utf-8' ); ?></p>
                            <div class='btns'>
            <?php                
                                // 作者可以刪除留言或編輯留言   
                                if ( $is_login && $row['user_id'] === $security_row['user_id']){
                ?>                 
                                    <a class="btn btn-secondary" href="/joe/delete.php?parent_id=0&id=<?php echo $row['id']; ?>" role="button">Delete</a>
                    
                <?php
                                }
            ?>      
                            </div>
                            <hr class="my-4">
                        </div>

                        <!--撰寫子留言區 -->
                        <div class='reply'>
                            <h3>Reply</h3>
                            <div class='form_block'>
        <?php                   if (!$is_login){
        ?>                          <div class='cookieisnotset'><a href='/joe/login_form.php'>Sign In</a></div>
        <?php                   }
                                else{
        ?>

                                    <form action='/joe/insert_comm.php' method='POST'>
                                        <div class='nn'><?php echo $nn_row['nickname']; ?></div><br>              
                                        <textarea name='content' placeholder='Comment here'></textarea>
                                        <input name='parent_id' value='<?php echo $row["id"]; ?>' type='hidden' />
                                        <input name='user_id' value='<?php echo $nn_row['user_id']; ?>' type='hidden' />
                                        <button type="submit" class="btn btn-primary">Submit</button>                  
                                    </form>
        <?php                   }
    ?>  
                            </div>
                        </div>