<?php
session_start();

include '../classes/usersContr.class.php';

$maker=new usersContr();
$maker->refuse($_GET['mail'],$_SESSION['email']);

header("Location: ../pages/Teacher.php");