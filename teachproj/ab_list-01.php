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

if (!empty($_GET['search'])) {
    //如果搜尋的input不是空白的值時
    $search = $_GET['search'];
    //$search就等於拿到‘search的值’
    $query = $pdo->prepare("SELECT * FROM address_book WHERE CONCAT(name,email,mobile,birthday,address) LIKE :keyword ORDER BY sid DESC"); //這裡就是用pdo準備好 SQL取值的寫法。用concat一口氣全部都拿然後用keyword定位。
    $query->bindValue(':keyword', '%' . $search . '%', PDO::PARAM_STR);
    //取出來的值我讓他變成string然後用execute演算。
    $query->execute();
    $results = $query->fetchAll();
    //結果是，這個取出來的值，我全都要。
    $rows2 = $query->rowCount();
    //再把它排列出來。
}
?>

<?php include __DIR__ . '/parts/html-head.php' ?>

<?php include __DIR__ . '/parts/navbar.php' ?>

<div class="container">
    <div class="row">
        <div class="col d-flex justify-content-between">
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
            <!-- 搜尋欄位就是這裡！ -->
            <form action="ab_list-01.php" method="get">
                <div class="d-flex" style="height:40px; margin-top: 10px;">

                    <input type="text" class="form-control" name="search" id="search" placeholder="搜需資料">

                    <button type="submit" value="Submit" name="submit" class="btn btn-primary " style="width:80px; margin-left:10px;">搜尋</button>
                </div>
            </form>
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
            <?php

            if ($rows2 != 0) {
                foreach ($results as $items) {
            ?>
                    <tr>
                        <td>
                            <a href="javascript: delete_it(<?= $items['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                        <td><?= $items['sid']; ?></td>
                        <td><?= $items['name']; ?></td>
                        <td><?= $items['email']; ?></td>
                        <td><?= $items['mobile']; ?></td>
                        <td><?= $items['birthday']; ?></td>
                        <td><?= $items['address']; ?></td>
                        <td><a href="ab-edit.php?sid=<?= $items['sid'] ?>">
                                <i class="fa-solid fa-file-pen">

                                </i></a></td>
                    </tr>
                <?php
                }
            } else if ($row2 == 0) {
                ?>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <?php /*
                    <td><a href="ab-delete.php?sid=<?= $r['sid'] ?>" onclick= "return confirm('確定要刪除編號<?= $r['sid']?>的資料嗎？')">
                        */ ?>
                        <td>
                            <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                        <td><?= $r['sid'] ?></td>
                        <td><?= htmlentities($r['name']) ?></td>
                        <td><?= $r['mobile'] ?></td>
                        <td><?= $r['email'] ?></td>
                        <td><?= $r['birthday'] ?></td>
                        <!-- <td><?= htmlentities($r['address']) ?></td> -->
                        <td><?= strip_tags($r['address']) ?></td>
                        <!-- 如果有任何tag的<>就會直接做跳脫 -->
                        <td><a href="ab-edit.php?sid=<?= $r['sid'] ?>">
                                <i class="fa-solid fa-file-pen">

                                </i></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php
            }
            ?>


        </tbody>

    </table>

</div>

<?php include __DIR__ . '/parts/script.php' ?>
<script>
    function delete_it(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎？`)) {
            location.href = `ab-delete.php?sid=${sid};`
        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>