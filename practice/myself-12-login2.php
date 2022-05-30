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
                $output['msg'] = '登入成功';
                echo json_encode($output);
                exit;
            } else {
                //賬號對，但密碼錯誤
                $output['msg'] = '賬號對，但密碼錯誤';
                echo json_encode($output);
                exit;
            }
        } else {
            //賬號錯誤
            $output['msg'] = '賬號錯誤';
            echo json_encode($output);
            exit;
        }
    } else {
        $output['msg'] = '連賬號都沒有是衝三小';
        echo json_encode($output);
        exit;
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
    <form action="" method="post">
        <!-- action 空字串送給誰都一樣的，所以放空字串就好  -->

        <input type="text" name="account" placeholder="賬號"> <br>
        <input type="password" name="password" placeholder="密碼"> <br>
        <button>登入賬號</button>

    </form>

    <script>

    </script>
</body>

</html>