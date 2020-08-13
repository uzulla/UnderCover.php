<?php
require(__DIR__."/../vendor/autoload.php");

$array = new \UnderCover\UCArray();

$list= ['a'=>1];
$array[] = $list;
echo $array->logBook->dumpStr(); exit;

$a = function(){
    $array = new \UnderCover\UCArray();
    $array[0] = "test";
    echo $array->logBook->dumpStr(); exit;

};

$a();
exit;

$array[0] = "test";
echo $array->logBook->dumpStr(); exit;
$array[] = "test2";

foreach($array as $line){
    echo $line;
}

unset($array[0]);

var_dump($array->logBook);
