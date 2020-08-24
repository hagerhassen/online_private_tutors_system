<?php
include '../classes/usersContr.class.php';

$user=new usersContr();

$user->approve($_GET['pmail']);

unset($_GET['pmail']);

header("Location: ../pages/admin.php");