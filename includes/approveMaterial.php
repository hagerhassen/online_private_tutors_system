<?php

include '../classes/usersContr.class.php';

$material=new usersContr();

$material->approveM($_GET['name']);

header("Location: ../pages/Admin.php");