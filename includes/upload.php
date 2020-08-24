<?php
session_start();

include '../classes/usersContr.class.php';

$user=new usersContr();

$file=$_FILES['material'];
$fileName=$file['name'];
$fileTmpLocation=$file['tmp_name'];
$fileType=$file['type'];
$array = explode('.', $fileName);
$fileEXT=strtolower(end($array));
$allowed="pdf";

if(!($fileEXT==$allowed)){
    header("Location: ../pages/Teacher.php?Error=ErrorType");
}

$fileNewName=$_POST['materialName'].'$'.$_SESSION['email'].'.'.$fileEXT;
$fileDist="../Files/".$fileNewName;
move_uploaded_file($fileTmpLocation,$fileDist);

$user->addSubject($fileNewName,$_POST['materialName'],$_SESSION['email']);

header("Location: ../pages/Teacher.php?upload=success");