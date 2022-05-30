<div>
<?php require __DIR__ . './parts/connect_db.php';
exit;
echo microtime(true)."<br>";


$lname = ['陳'. '林','李','吳','王'];
$fname = ['小明','小雅','小花','小鬼','小歸'];


$sql = "INSERT INTO `address_book`(
          `name`, `email`, `mobile`, `birthday`, `address`, `created_at`
        ) VALUES (
         ?, ?, ?, ?, ?, NOW()
         )";

         //每次要放資料的格式就用這樣就好。

$stmt = $pdo->prepare($sql); //如果資料外面來的，一律都是prepare

for($i = 0 ; $i < 100 ; $i ++){
    shuffle($lname);
    shuffle($fname);
    $ts = rand(strtotime('1980-01-01'),strtotime('1995-12-31'));
    $stmt->execute([
        $lname[0]. $fname[0],
        "blablalba{$i}@gmail.com",
        '0975'.rand(100000,999999),
        date('Y-m-d',$ts), //時間搭配 ts 的random 運算
        '台北市',
    ]);

}
// echo $stmt->rowCount();
echo microtime(true)."<br>";

?>
</div>