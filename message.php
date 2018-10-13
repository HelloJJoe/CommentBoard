<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>導入畫面</title>
    </head>
    <style>
        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px 20px;
        }
        .fail {
            font-size: 20px;
            text-align: center;
        }
        .suc {
            font-size: 30px;
            text-align: center;
        }
        h6 {
            font-size: 10px;
            color: grey;
        }

        
       

    </style>

    <body>
        <div class='container'>

<?php       // 登入失敗
            if ($_GET['type'] === 'login_fail'){
?>
                <div class='fail'>登入失敗！請重新確認帳號密碼!</div>
<?php            header("refresh:2;url=/joe/login_form.php");  
            }  

            // 登入成功
            if ($_GET['type'] === 'login_suc'){
?>
                <div class='suc'>
                    <?php echo 'Hello  ' . $_GET['username'] . '！' ;?>
                    <br>
                    <h6>//3秒後將自動導回留言板//</h6>     
                </div>  
<?php            header("refresh:3;url=/joe/index.php");
            } 

            // 註冊失敗
            if ($_GET['type'] === 'register_fail'){
?>
                <div class='fail'>帳號已經註冊過了!請重新輸入</div>
<?php            header("refresh:2;url=/joe/register_form.php");
            }

            // 註冊失敗
            if ($_GET['type'] === 'register_suc'){
?>
                <div class='suc'>
                    <?php echo '註冊成功！Wellcom  ' . $_GET['username'] . '！' ;?>
                    <br>
                    <h6>//3秒後將自動導回留言板//</h6>     
                </div>  
<?php            header("refresh:3;url=/joe/index.php");
            }

            // 更改暱稱成功
            if ($_GET['type'] === 'changenn_suc'){
?>
                <div class='suc'>
                        <?php echo '更改暱稱成功！Wellcom  ' . $_GET['nickname'] . '！' ;?>
                        <br>
                        <h6>//3秒後將自動導回留言板//</h6>     
                    </div>    
<?php            header("refresh:3;url=/joe/index.php");
            }

            // 刪除留言成功
            if ($_GET['type'] === 'delete_suc'){
?>
                <div class='suc'>
                    <?php echo '刪除留言成功！' ;?>
                    <br>
                    <h6>//3秒後將自動導回留言板//</h6>     
                </div>    
<?php            header("refresh:3;url=/joe/index.php");
            }
                
?>
      

        </div>
    </body>

    