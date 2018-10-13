<?php
    include('security.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>hw5-2留言板</title>
        <link rel="stylesheet" type="text/css" href="style1.css" />
        <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src='script.js'></script>
        <script src='script2.js'></script> 
    </head>
  
    <body>            
        <?php
            //分頁功能
            include_once('page.php');           
        ?>
        
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
            <span class="navbar-brand mb-0 h1">Comment Board</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
<?php           
                    //登入/註冊鍵，登出鍵
                    if (!$is_login){
?>   
                        <li class="nav-item">
                            <a class="nav-link" href="/joe/login_form.php">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/joe/register_form.php">Join</a>
                        </li>
<?php               }else{
?>                      
                        <li class="nav-item">
                            <a class="nav-link" href="/joe/logout.php">Sign Out</a>
                        </li>   
<?php               }
?> 
                </ul>

            </div>
        </nav>
        

       
        <div class='container'>
            <!-- 留言區 -->
            <div class='main_block'>

                <div class="jumbotron">
                    <h1 class="display-3">Comment Board</h1>
                    <div class='form_block'>
    <?php               if (!$is_login){
    ?>                      <div class='cookieisnotset'><a href='/joe/login_form.php'>Sign In</a></div>
    <?php               }
                        else{

                            $nn_sql = "SELECT users.nickname, users.user_id from users, users_certificate WHERE users.user_id = users_certificate.user_id AND users_certificate.id =" . "'" . addslashes( $_COOKIE['session_id']) . "'";
                            $nn_result = $conn->query($nn_sql);
                            $nn_row = $nn_result->fetch_assoc();
                            
    ?>

                            <form action='/joe/insert_comm.php' method='POST'>
                                
                                <div class='nn'><?php echo $nn_row['nickname'];?></div>            
                                <textarea name='content' placeholder='Comment here'></textarea>
                                <input name='parent_id' value='0' type='hidden'/>
                                <input name='user_id' value=<?php echo $nn_row['user_id'] ;?> type='hidden'/>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        
    <?php               }            
    ?>                            
                    </div>
                </div>
            </div>

            <!-- 顯示留言區 -->
            <div class="sub_block">
<?php   
            $sql = "SELECT comments.id, users.user_id, comments.parent_id, users.nickname, comments.content, comments.created_at from users, comments WHERE users.user_id = comments.user_id AND parent_id=0 ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){ 
                    
?>        
                    <div class="jumbotron">

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


                        <!-- 子留言區 -->
                        <div class='sub_review_block'>  
        <?php
                            $sub_sql = "SELECT comments.id, users.user_id, comments.parent_id, users.nickname, comments.content, comments.created_at from users, comments WHERE users.user_id = comments.user_id AND parent_id =" . $row['id'] . " ORDER BY created_at ASC";
                            $sub_result = $conn->query($sub_sql);
                            
                            if ($sub_result->num_rows > 0){
                                while ($sub_row = $sub_result->fetch_assoc()){
                                
                                    //使用者如果在自己的主留言下回應，背景換色
                                    if ( $row['user_id'] === $sub_row['user_id']){                                     
        ?>                              
                                         <div class='sub_review' style='background: #f7e4e8'> 
                                            
        <?php
                                    }else{
        ?>                               <div class='sub_review'>
        <?php                       }

                ?>               
                                        <div class='nickname'><?php echo $sub_row['nickname']; ?></div>
                                        <div class='btns'>
                                            <!--子留言刪除功能 -->
                        <?php               if ( $is_login && $sub_row['user_id'] === $security_row['user_id']){                                     
                        ?>                      <a class='btn btn-secondary' href='/joe/delete.php?id=<?php echo $sub_row['id']; ?>&parent_id=<?php echo $row['id']; ?>'>Delete</a>
                        <?php               }
                        ?>              </div>
                                            <div class='time' ><?php echo $sub_row['created_at']; ?></div>
                                            <div class='content' ><?php echo htmlspecialchars($sub_row['content'], ENT_QUOTES, 'utf-8') ; ?></div> 
                                        </div>                           
                        
        <?php
                                }
                            }
                            
        ?>               
                        </div>
                              
                        <!-- <input type='button' class='sub_review_explorer' value='hide'/> -->
                    
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
                    
                    </div>          
                    
<?php  
                }
            }
?>
            </div>


            <div class='pages'>
<?php
                
                for ($i = 1; $i<=$pages; $i++){
                    echo ' ' . '<a href="?page='.$i.'">' . $i . '</a>' . ' ';
                }
              
?>
            </div>
    </body>
