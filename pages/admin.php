<?php
session_start();
include '../classes/usersView.class.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/css/admin.css">
    <title>Dashboard</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">Admin</a>
    <form action="../includes/logout.php" class="form-inline">
        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">log out</button>
    </form>
</nav>
<br>
<div class="row">
    <div class="col">
        <h2>Teachers Request</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">email</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $user=new usersView();
            $data=$user->getTeachers();
            if($data){
                foreach ($data as $teacher){
                    echo (
                        '
             <tr>
                <td>'.$teacher['firstName'].'</td>
                <td>'.$teacher['lastName'].'</td>
                <td>'.$teacher['email'].'</td>
                <td>
                    <a href="../includes/approve.php?pmail='.$teacher['email'].'">approve</a>
                </td>
                <td>
                    <a href="../includes/delete.php?pmail='.$teacher['email'].'">delete</a>
                </td>
            </tr>
                '
                    );
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col">
        <h2>Teachers in system</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">email</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $user2=new usersView();
            $data=$user2->getAllT();
            if($data){
                foreach ($data as $teacher){
                    echo (
                        '
             <tr>
                <td>'.$teacher['firstName'].'</td>
                <td>'.$teacher['lastName'].'</td>
                <td>'.$teacher['email'].'</td>
                <td>
                    <a href="../includes/delete.php?pmail='.$teacher['email'].'">delete</a>
                </td>
            </tr>
                '
                    );
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Material That Need Approve</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Subject Name</th>
                <th scope="col">Download</th>
                <th scope="col">Uploader</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $user2=new usersView();
            $data=$user2->getNeededMaterial();
            if($data){
                foreach ($data as $material){
                    echo (
                        '
             <tr>
                <td>'.$material['subjectName'].'</td>
                <td><a href="../Files/'.$material['Uname'].'">View</a></td>
                <td>'.$material['Teacher'].'</td>
                <td>
                    <a href="../includes/approveMaterial.php?name='.$material['Uname'].'">approve</a>
                </td>
                <td>
                    <a href="../includes/deleteMaterial.php?delete='.$material['Uname'].'">delete</a>
                </td>
            </tr>
                '
                    );
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col">
        <h2>Material in System</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Subject Name</th>
                <th scope="col">Download</th>
                <th scope="col">Uploader</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $user2=new usersView();
            $data=$user2->getSystemMaterial();
            if($data){
                foreach ($data as $material){
                    echo (
                        '
             <tr>
                <td>'.$material['subjectName'].'</td>
                <td><a href="../Files/'.$material['Uname'].'">View</a></td>
                <td>'.$material['Teacher'].'</td>
                <td>
                    <a href="../includes/deleteMaterial.php?delete='.$material['Uname'].'">delete</a>
                </td>
            </tr>
                '
                    );
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<h2>Parents in system</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">email</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $user2=new usersView();
    $data=$user2->getParents();
    if($data){
        foreach ($data as $parent){
            echo (
                '
             <tr>
                <td>'.$parent['firstName'].'</td>
                <td>'.$parent['lastName'].'</td>
                <td>'.$parent['email'].'</td>
                <td>
                    <a href="../includes/delete.php?pmail='.$parent['email'].'">delete</a>
                </td>
            </tr>
                '
            );
        }
    }
    ?>
    </tbody>
</table>
</body>
</html>
