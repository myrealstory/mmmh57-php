<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* table,
    tr,
    td {
        border: 1px solid black;
    }
    tr {
    }
    td{
        padding: 10px;
    }
    tbody {
    } */
    td{
        width: 30px;
        height: 30px;
    }
</style>

<body>



    <!-- <?php

            echo __DIR__ . "<br>";
            echo __FILE__ . "<br>";
            echo __LINE__ . "<br>";

            define('MY_CONST', 33.33);
            echo MY_CONST . "<br>";

            for ($i = 0; $i < 10; $i++) {
                echo $i . "<br>";
            };
            ?> -->

    <!-- <table>
        <?php $x = "x";
        $equal = "=";  ?>
        <?php for ($j = 1; $j < 10; $j++) { ?>
            <tr>
                <?php for ($i = 1; $i < 10; $i++) { ?>

                    <td>
                        <?php printf("%s x %s = %s", $i,$j,$i*$j); ?>
                    </td>


                <?php }; ?>
            </tr>
        <?php }; ?>
    </table> -->
    <table>
        <?php for($i = 0 ; $i < 16 ; $i ++){ ?>
        <tr>
            <?php for($j = 0 ; $j < 16 ; $j ++) {?>
            <td style="background-color:#<?php printf("%X%X00%X%X" , $j ,$j ,$i , $i  ); ?>"></td> <?php } ?>
        </tr> 
        <?php }?>
    </table>
</body>

</html>