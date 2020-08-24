<?php
ob_start();
include "classes/usersContr.class.php";
session_start();
if(isset($_SESSION['email'])&&isset($_SESSION['role'])){
    if($_SESSION['role']=="admin"){
        header("Location: pages/admin.php");
    }else if ($_SESSION['role']=="Teacher"){
        header("Location: pages/teacher.php");
    }else if($_SESSION['role']=="Parent"){
        header("Location: pages/parent.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/style.css">
    <title>Tutors Finder</title>
</head>
<body>
   <div class="container-fluid full">
       <div class="row">
           <div class="col-md-6 left">
               <h1>Tutors finder system app</h1>
               <p>Our online tutors are ready to help you 24/7</p>
           </div>
           <div class="col-md-6">
               <div class="signUp">
                   <form method="post">
                       <div class="row">
                           <div class="col">
                               <div class="form-group">
                                   <label for="First Name">First Name</label>
                                   <input type="text" class="form-control" placeholder="Enter Your First Name" name="firstName" required>
                                   <small class="form-text text-muted">Numbers and Symbols aren't allowed</small>
                               </div>
                           </div>
                           <div class="col">
                               <div class="form-group">
                                   <label for="Last Name">Last Name</label>
                                   <input type="text" class="form-control" placeholder="Enter Your Last Name" name="lastName" required>
                                   <small class="form-text text-muted">Numbers and Symbols aren't allowed</small>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col">
                               <div class="form-group">
                                   <label for="Email">Email</label>
                                   <input type="email" class="form-control" placeholder="Enter Your Email" name="email" required>
                                   <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col">
                               <div class="form-group">
                                   <label for="Password">Password</label>
                                   <input type="password" class="form-control" placeholder="Enter Your Password" name="password" min="8" required>
                                   <small class="form-text text-muted">We'll never Know Your Password.</small>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col">
                               <div class="form-group">
                                   <label for="signUpAs">Sign up as a</label>
                                   <select class="form-control" name="role" required>
                                       <option value="">--Select a Role--</option>
                                       <option value="Teacher">Teacher</option>
                                       <option value="Parent">Parent</option>
                                   </select>
                                   <small class="form-text text-muted">Teachers will have to wait for confirmation email.</small>
                               </div>
                           </div>
                       </div>
                       <button type="submit" class="btn btn-primary">Sign Up</button><p class="switch">or Log in</p>
                   </form>
               </div>
               <div class="signIn show">
                   <form method="post">
                       <div class="row">
                           <div class="col">
                               <div class="form-group">
                                   <label for="Email">Email</label>
                                   <input type="email" class="form-control" placeholder="Enter Your Email" name="emailIn" required>
                                   <small class="form-text text-muted">That You used to Sign Up Here</small>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col">
                               <div class="form-group">
                                   <label for="Password">Password</label>
                                   <input type="password" class="form-control" placeholder="Enter Your Password" name="passwordIn" required>
                                   <small class="form-text text-muted">That You used to Sign Up Here</small>
                               </div>
                           </div>
                       </div>
                       <button type="submit" class="btn btn-primary">Log In</button><p class="switch">or Sign Up</p>
                   </form>
               </div>
               <?php
               if(isset($_POST['firstName'])&&isset($_POST['lastName'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['role'])){
                   $user=new usersContr();
                   $user->addUser($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['password'],$_POST['role']);
               }
               ?>
               <?php
               if(isset($_POST['emailIn'])&&isset($_POST['passwordIn'])){
                   $user2=new usersContr();
                   $user2->letUserIn($_POST['emailIn'],$_POST['passwordIn']);
               }
               ?>
           </div>
       </div>
   </div>
   <script src="styles/js/action.js"></script>
</body>
</html>