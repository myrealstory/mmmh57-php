<?php

header('Content-Type: application/json');

$folder = __DIR__. '/uploaded/' ;

if(move_uploaded_file($_FILES['myfile']['tmp_name'],$folder. $_FILES['myfile']['name'])){
    $output['sucess'] = true;

}else {
    
}