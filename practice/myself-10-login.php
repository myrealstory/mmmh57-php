<?php
session_start();


if (isset($_POST['account'])) {
    echo json_encode($_POST); //只是要把表單的資料show在頁面上。
    exit; //立即停止 php的程式執行
    // die（）; 寫這個也可以。可能不夠吉利哈哈哈哈
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