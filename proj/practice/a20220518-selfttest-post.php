<?php

$nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
$account = isset($_POST['account']) ? $_POST['account'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

printf("nickname %s<br> account: %s<br> password: %s<br>", $nickname, $account, $password);
