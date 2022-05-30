<?php

$output = [
    'postData' => $_POST,
];

$json = json_encode($output, JSON_UNESCAPED_UNICODE);
file_put_contents('./myself-18-dropforms.json',$json); //這個file put contents 可以把結果存成字串檔案。
/* 關於前端 轉到後端 因為有【】 的關係，會把內容物和文件都轉成字串，然後再送到後端伺服器裡。*/

echo $json;

