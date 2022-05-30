<?php

$db_host = 'localhost';  //連主機名稱
$db_user = 'tester'; //資料庫連線的用戶
$db_pass = 'test0101'; //連線用戶的密碼
$db_name = 'mfee26'; //用的資料庫名稱

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";
//db host 主機的意思， dbname 主機的名字


$pdo_option = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //pdo error的模式 => 設定值，如果預設的話普通的模式 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // fetch Assoc 拿出來會變成關聯式陣列
    // PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //連線一建議要變成什麼類型的文字設定。

];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_option); //一個專案針對一個資料庫。
    //這就是資料庫的製作
    //pdo 的 option 不一定要有，但是有的話就比較方便一些。
} catch (PDOException $ex) { //cathc可以抓到erro 這裡可以做除錯
    echo $ex->getMessage();
}
