<?php
session_start();
include '../classes/usersContr.class.php';

$maker=new usersContr();

$maker->refuse($_SESSION['email'],$_GET['mail']);

header("Location: ../pages/Parent.php");