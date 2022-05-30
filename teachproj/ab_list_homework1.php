<?php include __DIR__ . '/parts/connect_db.php';
//DIR 這個就是相連的。
$pageName = 'ab_list';
$title = '通訊錄列表 - 拉拉的網站';


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
$rows = $pdo->query($sql)->fetchAll();
//SELECT * FROM address_book LIMIT 0,5 這樣也是5筆，可是這樣可以選擇從第幾筆取到第幾筆
//MVC 資料處理，呈現，跟客戶的互動
?>

<?php include __DIR__ . '/parts/html-head.php' ?>

<?php include __DIR__ . '/parts/navbar.php' ?>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?> ">
                        <a class="page-link" href="?page=<?= $page == 1 ?>">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?> ">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>
                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) {
                        if ($i >= 1 and $i <= $totalPages) : //這裡是如果小於0就不要秀出來，而最大值是 5+5+1 
                    ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php
                        endif;
                    } ?>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                <th scope="col">#</th>
                <th scope="col">姓名</th>
                <th scope="col">手機</th>
                <th scope="col">電郵</th>
                <th scope="col">生日</th>
                <th scope="col">地址</th>
                <th scope="col"><i class="fa-solid fa-file-pen"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td><a href="javascript:" onclick="transcanClicked(event); return false;"><i class="fa-solid fa-trash-can"></i></a></td>
                    <td><?= $r['sid'] ?></td>
                    <td><?= $r['name'] ?></td>
                    <td><?= $r['mobile'] ?></td>
                    <td><?= $r['email'] ?></td>
                    <td><?= $r['birthday'] ?></td>
                    <td><?= $r['address'] ?></td>
                    <td><a href="#"><i class="fa-solid fa-file-pen"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</div>

<?php include __DIR__ . '/parts/script.php' ?>

<script>
    function transcanClicked(event) {
        console.log(event.currentTarget);
        console.log(event);
        const a_tag = event.currentTarget;
        const tr = a_tag.closest('tr');
        console.log(tr);
        tr.remove();
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>