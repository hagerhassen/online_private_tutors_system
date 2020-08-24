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
                $user=new usersView();
                $data=$user->getUserInfo($_SESSION['email']);
                echo('
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" name="firstName" value="'.$data[0]['firstName'].'" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" name="lastName" value="'.$data[0]['lastName'].'" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="'.$data[0]['email'].'" disabled>
                </div>
                ');
                ?>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Change</button>
            </form>
        </div>
        <div class="col">
            <h3>Add Subjects</h3>
            <form action="../includes/upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="materialName">Subject Name</label>
                    <input type="text" class="form-control" name="materialName" required>
                </div>
                <div class="form-group">
                    <label for="File Input">Material</label>
                    <input type="file" class="form-control-file" name="material" required>
                    <small class="form-text text-muted">Only pdf materials is allowed</small>
                </div>
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Add</button>
            </form>
            <?php
            if(isset($_GET['Error'])){
                if($_GET['Error']=="ErrorType"){
                    echo '<p>Please submit a pdf File</p>';
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <br>
            <h3>Requests</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">email</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $user2 = new usersView();
                $data = $user2->getOffer($_SESSION['email']);
                if ($data) {
                    foreach ($data as $offer) {
                        echo(
                            '
             <tr>
                <td>' . $offer['parent_mail'] . '</td>
                <td>
                    <a href="../includes/acceptOffer.php?mail=' . $offer['parent_mail'] . '">Approve </a>
                </td>
                <td>
                    <a href="../includes/refuseOffer.php?mail=' . $offer['parent_mail'] . '">Delete </a>
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
            <?php
            $material=new usersView();
            $data=$material->getMyMaterial($_SESSION['email']);
            foreach ($data as $materialData){
                echo ('
                <div class="card d-inline-block" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">'.$materialData['subjectName'].'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">'.$materialData['Teacher'].'</h6>
                        <a href="../Files/'.$materialData['Uname'].'" class="card-link">Download</a>
                        <a href="../includes/deleteMaterial.php?delete='.$materialData['Uname'].'" class="card-link">Delete</a>
                ');
                if($materialData['approved']==0){
                    echo ('<span class="badge badge-danger">pending</span>');
                }else if ($materialData['approved']==1){
                    echo ('<span class="badge badge-success">approved</span>');
                }
                echo ('
                    </div>
                </div>
                ');
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
