<?php

include 'users.class.php';

class usersContr extends users{
    public function addUser($firstName,$lastName,$email,$pass,$role){
            if ($this->getUser($email)){
                echo "<p>this email is already registered with another account please try new one</p>";
                return;
            }
            $this->setNewUser($firstName,$lastName,$email,$pass,$role);
            $_SESSION['email']=$email;
            $_SESSION['role']=$role;
            if($_SESSION['role']=="Teacher"){
                echo "<p>please wait for admin to review your request</p>";
                session_unset();
                return;
            }else if($_SESSION['role']=="Parent"){
                header("Location: pages/parent.php");
            }
    }


    public function letUserIn($email,$pass){
        if(!$this->getUser($email)){
            echo "<p>this email is not registered with any account please try to sign up</p>";
            return;
        }
        if(password_verify($pass,$this->getUser($email)[0]['pass'])){
            $_SESSION['email']=$email;
            $_SESSION['role']=$this->getUser($email)[0]['role'];
            if($_SESSION['role']=="admin"){
                header("Location: pages/admin.php");
            }else if($_SESSION['role']=="Teacher"&&$this->getUser($email)[0]['approved']==1){
                header("Location: pages/teacher.php");
            }else if($_SESSION['role']=="Teacher"&&$this->getUser($email)[0]['approved']==0){
                echo "<p>please wait for admin to review your request</p>";
                session_unset();
                return;
            }else if($_SESSION['role']=="Parent"){
                header("Location: pages/Parent.php");
            }
        }
    }

    public function deleteMaterial($name){
        $this->deleteOneMaterial($name);
    }

    public function deleteMaterials($email){
        $this->deleteAllMaterial($email);
    }

    public function updateUser($firstName,$lastName,$email){
        $this->addToUser($firstName,$lastName,$email);
    }

    public function addSubject($materialName,$subject,$email){
        $this->addMaterial($materialName,$subject,$email);
    }


    public function approve($email){
        $this->approveTeacher($email);
    }

    public function approveM($name){
        $this->approveMaterial($name);
    }

    public function delete($email){
        $this->deleteUser($email);
    }

    public function addRequest($parent,$teacher){
        $this->makeRequest($parent,$teacher);
    }

    public function accept($parent,$teacher){
        $this->approveRequest($parent,$teacher);
    }

    public function refuse($parent,$teacher){
        $this->deleteRequest($parent,$teacher);
    }

}