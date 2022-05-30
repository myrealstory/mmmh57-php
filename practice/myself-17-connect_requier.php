<?php
require __DIR__ . '/myself-16-connect_db.php'; //把某一個檔案鏈接進來

//方法的多載，過載 overload，方法會依照客戶需求去選擇用哪一種。 
$stmt = $pdo->query("SELECT * FROM address_book LIMIT 5"); //這裡有三個方法，可以在php.net 看到參考。
//$stmt 可以視為一個取資料的代理物件 的概念
//可以透過￥stmt去讀取資料

// $row = $stmt -> fetch();

// echo json_encode($row);

while ($r = $stmt->fetch()) { //如果用fetchall 就會把全部資料全部抓出來，如果今天十萬筆，電腦就會壞掉。

    echo "{$r['name']} <br>";
}
//所以在sql拿自己的欄位就好，這樣也可以用fetchall比較方便的方式去調資料。
