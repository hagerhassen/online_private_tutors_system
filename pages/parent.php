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
    <title>Welcome</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">Control panel</a>
    <form action="../includes/logout.php" class="form-inline">
        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">log out</button>
    </form>
</nav>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h3>Your Info</h3>
            <form action="../includes/updateUser.php" method="post">
                <?php
                $user = new usersView();
                $data = $user->getUserInfo($_SESSION['email']);
                echo('
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" name="firstName" value="' . $data[0]['firstName'] . '" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" name="lastName" value="' . $data[0]['lastName'] . '" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="' . $data[0]['email'] . '" disabled>
                </div>
                ');
                ?>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Change</button>
            </form>
            <br>
            <h3>Material from Teachers I Have: </h3>
            <?php
            $material=new usersView();
            $listOfTeachers=$material->getApproved($_SESSION['email']);
            foreach ($listOfTeachers as $teacher){
                $data=$material->getSystemMaterialForOne($teacher['email']);
                foreach ($data as $materialData){
                    echo ('
                <div class="card d-inline-block" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">'.$materialData['subjectName'].'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">'.$materialData['Teacher'].'</h6>
                        <a href="../Files/'.$materialData['Uname'].'" class="card-link">Download</a>
                    </div>
                </div>
                ');
            }
            }
            ?>
        </div>
        <div class="col">
            <h3>Request a Teacher</h3>
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
                $user2 = new usersView();
                $data = $user2->getTeacherForRequest($_SESSION['email']);
                if ($data) {
                    foreach ($data as $teacher) {
                        echo(
                            '
             <tr>
                <td>' . $teacher['firstName'] . '</td>
                <td>' . $teacher['lastName'] . '</td>
                <td>' . $teacher['email'] . '</td>
                <td>
                    <a href="../includes/requestTutor.php?mail=' . $teacher['email'] . '">Request</a>
                </td>
            </tr>
                '
                        );
                    }
                }
                ?>
                </tbody>
            </table>
            <br>
            <h3>Requested Teachers</h3>
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
                $user2 = new usersView();
                $data = $user2->getRequested($_SESSION['email']);
                if ($data) {
                    foreach ($data as $teacher) {
                        echo(
                            '
             <tr>
                <td>' . $teacher['firstName'] . '</td>
                <td>' . $teacher['lastName'] . '</td>
                <td>' . $teacher['email'] . '</td>
                <td>
                    <a href="../includes/removeTutor.php?mail=' . $teacher['email'] . '">Delete Request</a>
                </td>
            </tr>
                '
                        );
                    }
                }
                ?>
                </tbody>
            </table>
            <br>
            <h3>Teachers I have</h3>
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
                $user2 = new usersView();
                $data = $user2->getApproved($_SESSION['email']);
                if ($data) {
                    foreach ($data as $teacher) {
                        echo(
                            '
             <tr>
                <td>' . $teacher['firstName'] . '</td>
                <td>' . $teacher['lastName'] . '</td>
                <td>' . $teacher['email'] . '</td>
                <td>
                    <a href="../includes/removeTutor.php?mail=' . $teacher['email'] . '">Delete</a>
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
</div>
</body>
</html>
