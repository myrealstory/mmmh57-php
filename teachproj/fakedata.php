<?php require __DIR__ . './parts/connect_db.php';

// $sql = "INSERT INTO `address_book`(
//      `name`, `email`, `mobile`, `birthday`, `address`, `created_at`
//      ) VALUES (
//     '李曉明','blablalba@gmail.com','097514652','1987-11-23','台北市',NOW()
//     )";

// $stmt = $pdo->query($sql);

//避免 sql injection （SQL 隱碼攻擊）


$sql = "INSERT INTO `address_book`(
          `name`, `email`, `mobile`, `birthday`, `address`, `created_at`
        ) VALUES (
         ?, ?, ?, ?, ?, NOW()
         )";

$stmt = $pdo->prepare($sql); //如果資料外面來的，一律都是prepare
$stmt->execute([
    '李曉明',
    'blablalba@gmail.com',
    '097514652',
    '1987-11-23',
    '台北市',
]);

echo $stmt->rowCount();
