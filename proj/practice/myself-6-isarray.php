<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <?php
            $ar = [3=>'abc','3'=>'def','name' => '小新','age'=> 27,'date'=>[1,3,5]];

            foreach($ar as $k => $v){
                if(is_array($v)) $v = implode(',',$v);
                echo "$k : $v<br>";
            }

            ?>
</body>
</html>