<?php
session_start();

include '../classes/usersContr.class.php';

$material=new usersContr();

$material->deleteMaterial($_GET['delete']);

unlink('../Files/'.$_GET['delete']);

if($_SESSION['role']=="admin"){
    header("Location: ../pages/Admin.php");
}else if ($_SESSION['role']=="Teacher"){
    header("Location: ../pages/Teacher.php");
}


