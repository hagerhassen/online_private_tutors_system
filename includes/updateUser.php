<?php
session_start();
include '../classes/usersContr.class.php';

$user=new usersContr();

$user->updateUser($_POST['firstName'],$_POST['lastName'],$_SESSION['email']);

if($_SESSION['role']=="Teacher"){
    header("Location: ../pages/teacher.php");
}
