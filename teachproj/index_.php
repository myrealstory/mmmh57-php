<?php include __DIR__ . '/parts/connect_db.php';
$pageName = 'index';
$title = '首頁 - 拉拉的網站';

?>

<?php include __DIR__ . '/parts/html-head.php'?>
<?php include __DIR__ . '/parts/html-foot.php'?>
<?php include __DIR__ . '/parts/navbar.php'?>
<div class="container">
    <h2>Home</h2>
    <p><?= $pdo->quote("Alice's wonderland") ?></p>
</div>
<?php include __DIR__ . '/parts/script.php'?>