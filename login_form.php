<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>會員登入</title>
    
    <style>
        .container {
            max-width: 300px;
            margin: 100px auto;
            padding: 20px 20px;
            background: #ebf6f9;
        }
        .title {
            font-size: 30px;
            text-align: center;
        }
        form {
            margin: 10px;
            text-align:center;
        }
        .btn {
            background: #0095ff;
            border-radius: 4px;
            color: white;
            width: 100%;
            height: 40px;
            display: block;
            overflow: hidden;
            margin-top: 10px;
            font-size: 15px;
        }
        .membership_blank {
            width: 90%;
            height: 30px;
            margin: 10px;
            overflow: hidden;
            font-size: 15px;
        }
       

    </style>

    <script type=text/javascript>
       document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.btn')[0].addEventListener('click', e =>{
                var membership = document.querySelectorAll('.membership_blank')
                if  (membership[0].value === '' && membership[1].value === '') {
                    alert ('請輸入您的帳號密碼')
                    e.preventDefault()
                }else if (membership[0].value === ''){
                    alert ('您的帳號是？？')
                    e.preventDefault()
                }else if (membership[1].value === ''){
                    alert ('密碼沒填喔')
                    e.preventDefault()
                }
            })
        })
    
    </script>

    </head>
    <body>
        <div class='container'>
            <div class='title'>登入留言板會員</div>
            <form action='/joe/login.php' method='POST'>
                <input class='membership_blank' name='username' placeholder=' Username'/><br>
                <input class='membership_blank' name='passward' placeholder=' Password' type='password'/>
                <input class='btn' type='submit' value='登入'/>
                <input type='button' class='btn' onclick="location='/joe/register_form.php'" value='還不是會員嗎？點我註冊'/>
            </form>          
        </div>
    </body>

  