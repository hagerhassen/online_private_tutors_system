<?php
session_start();

include '../classes/usersContr.class.php';

$user=new usersContr();

$user->delete($_GET['pmail']);
$user->deleteMaterials($_GET['pmail']);

$scanned_directory = array_diff(scandir('../Files'), array('..', '.'));

foreach ($scanned_directory as $dir){
    $array1 = explode('.', $dir);
    $firstPart=array_diff($array1,array(end($array1)));
    $firstPart=join(".",$firstPart);
    $array2 = explode('$', $firstPart);
    $firstPart=end($array2);
    if($firstPart==$_GET['pmail']){
        unlink('../Files/'.$dir);
    }
}

header("Location: ../pages/admin.php");