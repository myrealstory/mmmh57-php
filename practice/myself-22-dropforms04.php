<?php

$json = file_get_contents('myself-18-dropforms.json');
$data = json_decode($json, true); //true 因要用關聯式陣列，所以為true
echo $json;


$hobbies = [
    '3' => '游泳',
    '5' => '爬山',
    '6' => '靠腰',
    '9' => '吃飯',
];
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


    <title>Document</title>
</head>

<body>

    <div class="container">
        <form name="form1" action="" onsubmit="sendData(); return false;">
            <label for="exampleInputEmail" class="form-label">請選擇嗜好</label>
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" data-multiple name="hobby1">
                <!-- data-multiple 的意思是多選，格式就是放在select的最後面即可使用 -->
                <!-- combo box -->
                <option value="" selected disabled> -- 請選擇 -- </option>
                <!-- 這是多選一選單，這裡的selected disable 是做預設值 -->
                <?php foreach ($hobbies as $k => $v) : ?>
                    <option value="<?= $k ?>"><?= $v ?></option>
                    <!-- 因為是combobox，所以才會下selected，選擇 -->
                <?php endforeach ?>
            </select>
            <div class="mb-3">
                <label for="exampleInputEmail" class="form-label">請點選你的喜好</label>
                <!-- 如果項目不多，基本上可以選擇用radio button -->
                <!-- radio button group的用意基本上是希望可以做獨立選單 -->
                <?php foreach ($hobbies as $k => $v) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hobby2" id="hobb2-<?= $k ?>" value="<?= $k ?>" checked>
                        <label class="form-check-label" for="hobby2-<?= $k ?>">
                            <?= $v ?>
                        </label>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail" class="form-label">請點選你的喜好</label>
                <!-- 如果項目不多，基本上可以選擇用radio button -->
                <!-- radio button group的用意基本上是希望可以做獨立選單 -->
                <?php foreach ($hobbies as $k => $v) : ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="hobby3-<?= $k ?>" value="<?= $k ?>" name="hobby3[]">
                        <!-- hobby3[]這樣寫是因為php是後端程式，要告訴電腦說，這裡是回傳陣列。 -->
                        <label class="form-check-label" for="hobby3-<?= $k ?>"><?= $v ?></label>
                        <!-- 如果今天要取checkbox的值，可以這樣寫 document.querySelectorAll('input[name=hobby3\\[\\]]') -->
                        <!-- hobby3[]是因為php才會這樣寫 -->
                    </div>
                <?php endforeach ?>
            </div>
            <input type="hidden" name="test[]" value="hello">
            <input type="hidden" name="test[]" value="哈嘍">


            <!-- <button type="submit" class="btn btn-primary"> Submit </button> -->
        </form>



    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script>
        const data = <?= json_encode($data, JSON_UNESCAPED_UNICODE); ?>; //這裡是一個陣列
        //用javaScript可以吃到的資料。
        document.form1.hobby1.value = data.postData.hobby1;
        document.form1.hobby2.value = data.postData.hobby2;

        document.querySelectorAll('input[name=hobby3\\[\\]]').forEach(el => {
            if (data.postData.hobby3.includes(el.value)) {
                el.checked = true; //在checkbox比較麻煩。
                //這裡先選擇所有的box(靠 querySelectorAll) 選好以後，再用forEach一個個判斷。
                //如果data的post裡面（hobby3）的值有被點選，那格子就被判打勾勾。
            }
        });
    </script>
</body>

</html>