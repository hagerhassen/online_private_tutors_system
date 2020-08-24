<?php
session_start();

include '../classes/usersContr.class.php';

$maker=new usersContr();
$maker->accept($_GET['mail'],$_SESSION['email']);

header("Location: ../pages/Teacher.php");
