<?php
session_start();

$users = [
    'admin' => [
        'password' => 'admin',
        'nickname' => 'master',
    ],
];

$output = [
    'postData' => $_POST,
];

if(isset($_POST['account'])){
    if(!empty($_POST['account'])and !empty($_POST['password'])){
        if(!empty($users[$_POST['account']])){
            if($_POST['password'] === $users[$_POST['account']]['password']){
                $_SESSION['user'] =[
                    'account' => $_POST['account'],
                    'nickname' => $users[$_POST['account']]['nickname'],
                ];
            }
        }
    }
    if(!isset($_SESSION['user'])){
        $error_msg = '賬號密碼錯誤！';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .grybg {
            background-color: #E3E3E3;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loginbox {
            width: 40%;
            height: 40%;
            border: 3px solid blue;
            box-shadow: 5px 7px 5px 3px rgba(0,0,0,0.23);
        }

        .btnbox {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 20px;
            text-align: center;
            position: relative;
        }
        .icon {
            width: 20%;
            margin: 0 auto;
            padding: 40px;
        }
        .icon img {
            width: 100%;
        }
        input {
            height: 30px;
            margin-right: 15px;
            width: 250px;
        }

        button, .signout {
            height: 35px;
            width: 70px;
            background-color: #949494;
            color: white;
            border: none;
        }
        .sm-p {
            position: absolute;
            bottom: -80px;
            left: 50%;
            transform: translateX(-50%);
        }
        .server_m_info {
            display: flex;
            justify-content: space-between;
            width: 90%;
            margin: 0 auto;
        }
        /* body{
            overflow: hidden;
        } */
        a{
            text-decoration: none;
        }
         
    </style>
</head>

<body>
<?php if(isset($_SESSION['user'])): ?>
        <div class="server_m_info">
            <h2><?= $_SESSION['user']['nickname'] ?> ，您好</h2>
            <button><a href="./servermainpage.php" class="signout">登出</a></button>
        </div>
        <?php else: ?>
    <div class="grybg">
        <div class="loginbox" style="position:relative;">
            <div class="icon">
                <img src="./img/ServerLOGO.png" alt="">
            </div>
           
            <?php if(isset($error_msg)): ?>
                <div style="color:red ; position:absolute; z-index:2; left:80px;"><?= $error_msg ?></div>
                <?php  endif; ?>
            <form method="post" class="btnbox">
           
                <input type="text" name="account" placeholder="賬號輸入" 
                value="<?= isset($_POST['account'])? htmlentities($_POST['account']):'' ?>"> <br>
                <input type="password" name="password" placeholder="密碼輸入"> <br>
                <button> 登入 </button>
            </form>
            <p class="sm-p">copyright © Serverbase corporation. all rights reserved</p>
        </div>
    </div>
    <?php endif; ?>

    <script>

    </script>
</body>

</html>