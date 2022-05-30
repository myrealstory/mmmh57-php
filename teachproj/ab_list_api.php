<?php require __DIR__ . '/parts/connect_db.php';
//DIR 這個就是相連的。
$pageName = 'ab_list_api';
$title = '通訊錄列表- api';


$perPage = 20; //每一頁有幾筆

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//$_GET['page']是取的目前的“頁”的值然後給予 $page ，intval轉換成整數值的倍數 = 1
//query string 拿到的都是字串，所以字串不等於文字，就必須把字串換成文字 

if ($page < 1) {
    header('Location: ?page=1');
    //因為如果到0就會報錯，所以最小就 = 1 這樣。
    exit;
}

$t_sql = "SELECT COUNT(1) FROM address_book";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
//這一段就是input output 的程式。所以這裡比較吃loading
// $pdo->query($t_sql) 指的是 table的statement 
//fetch取得是索引式陣列 然後參數是從0開始


$totalPages = ceil($totalRows / $perPage); //ceil 如果是正數的時候就無條件進位。 
// echo $totalRows;
// exit;

$row = [];

if ($totalRows > 0) { //設定最小值
    //如果頁碼 大過於 0 的時候，
    if ($page > $totalPages) {
        header("Location: ?page= $totalPages");
        //頁碼就同等於最後的頁面
        exit;
    }
}

$sql = sprintf("SELECT * FROM address_book ORDER BY sid DESC LIMIT %s , %s", ($page - 1) * $perPage, $perPage);
//追加 ORDER BY 排序
$row = $pdo->query($sql)->fetchAll();

$output = [
    'perPage' => $perPage,
    'Page' => $Page,
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'rows' => $rows,
];

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>