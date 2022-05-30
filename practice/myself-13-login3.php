<?php
session_start();

$users = [
    'ming' => [
        'password' => '1234',
        'nickname' => '孔明'
    ],
    'no_two' => [
        'password' => '5678',
        'nickname' => '關羽'
    ],

];

$output = [
    'postData' => $_POST,
];


if (isset($_POST['account'])) {
    // echo json_encode($_POST);
    // exit;

    if (!empty($_POST['account']) and !empty($_POST['password'])) {
        //如果賬號不是空的，密碼也不是空的，如果不是空的就不用比對
        //兩個欄位都要有值
        if (!empty($users[$_POST['account']])) {
            //這裡要對應賬號裡面的值，如果empty的東西是存在的，就等於true。
            //$_POST 就是把客戶輸入的值當成了判斷的key
            //如果賬號對的就會再繼續對密碼。
            if ($_POST['password'] === $users[$_POST['account']]['password']) {
                //登入成功
                $_SESSION['user'] = [
                    'account' => $_POST['account'],
                    'nickname' => $users[$_POST['account']]['nickname'],
                    //把資料設定到session裡面
                ];
            }
        }
    }
    if (!isset($_SESSION['user'])) {
        $error_msg = '賬號或密碼錯誤！';
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
</head>

<body>
    <?php if (isset($_SESSION['user'])) : ?>
        <h2><?= $_SESSION['user']['nickname'] ?> 您好</h2>
        <p><a href="./myself-14-logout.php">登出</a></p>
    <?php else : ?>
        <?php if (isset($error_msg)) : ?>
            <div style="color:red;"> <?= $error_msg ?> </div>
        <?php endif; ?>

        <form action="" method="post">
            <!-- action 空字串送給誰都一樣的，所以放空字串就好  -->

            <input type="text" name="account" placeholder="賬號" 
            value="<?= isset($_POST['account'])? htmlentities($_POST['account']): '' ?>"> <br> 
            <!-- value="<?= $_POST['account']?? '' ?>" -->
            <!-- 兩個問號的意思是 如果是undefined 就直接輸出內容。 -->
            <!-- 這裡如果是undefined就直接輸出空字串，而第一次輸入就會留下。 -->
            <input type="password" name="password" placeholder="密碼"> <br>
            <button>登入賬號</button>

        </form>
    <?php endif; ?>


    <script>

    </script>
</body>

</html>