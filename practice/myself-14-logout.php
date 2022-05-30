<?php 

session_start();

//session_destroy();
//這個會清楚所有的session 的內容和內存。 不建議這麼用

unset($_SESSION['user']); //unset是清楚某一個值，因為登入是用user 所以，這裡就清楚user。
//如果是購物車，也可以用$_SESSION來做記錄。去記錄user的個人喜好。

header('Location: myself-13-login3.php');//轉向 網站, redirect 
