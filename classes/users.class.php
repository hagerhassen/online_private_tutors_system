<?php

include "DBH.class.php";

class users extends DBH{

    protected function setNewUser($firstName,$lastName,$email,$pass,$role){
        $sql = "INSERT INTO users (firstName,lastName,email,pass,role) VALUES (:firstName,:lastName,:email,:pass,:role)";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':firstName',$firstName,PDO::PARAM_STR);
        $stmt->bindParam(':lastName',$lastName,PDO::PARAM_STR);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $password_hash = password_hash($pass, PASSWORD_BCRYPT);
        $stmt->bindParam(':pass', $password_hash,PDO::PARAM_STR);
        $stmt->bindParam(':role',$role,PDO::PARAM_STR);
        $stmt->execute();
    }
    protected function getUser($email){
        $sql="SELECT * FROM users WHERE email = :email";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function addToUser($firstName,$lastName,$email){
        $sql="UPDATE users SET firstName = :firstName, lastName = :lastName WHERE users.email = :email";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':firstName',$firstName,PDO::PARAM_STR);
        $stmt->bindParam(':lastName',$lastName,PDO::PARAM_STR);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
    }

    protected function getTeachersRequest(){
        $sql="SELECT * FROM users WHERE role = 'teacher' AND approved = 0";
        $data=$this->connect()->query($sql);
        return $data->fetchAll();
    }

    protected function approveTeacher($email){
        $sql="UPDATE users SET approved = '1' WHERE users.email = :email";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
    }

    protected function approveMaterial($Uname){
        $sql="UPDATE materials SET approved = '1' WHERE materials.Uname = :uname";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':uname',$Uname,PDO::PARAM_STR);
        $stmt->execute();
    }

    protected function deleteUser($email){
        $sql="DELETE FROM users WHERE users.email = :email";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
    }

    protected function getAllTeachers(){
        $sql="SELECT * FROM users WHERE role = 'teacher' AND approved = 1";
        $data=$this->connect()->query($sql);
        return $data->fetchAll();
    }

    protected function getAllParents(){
        $sql="SELECT * FROM users WHERE role = 'parent'";
        $data=$this->connect()->query($sql);
        return $data->fetchAll();
    }

    protected function addMaterial($materialName,$subject,$email){
        $sql="INSERT INTO materials (Uname,Teacher,subjectName) VALUES (:materialName,:email,:subject)";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':materialName',$materialName,PDO::PARAM_STR);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':subject',$subject,PDO::PARAM_STR);
        $stmt->execute();
    }

    protected function getAllMaterialForOne($email){
        $sql="SELECT * FROM materials WHERE Teacher = :email";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function deleteOneMaterial($Uname){
        $sql="DELETE FROM materials WHERE materials.Uname = :uname";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':uname',$Uname,PDO::PARAM_STR);
        $stmt->execute();
    }

    protected function deleteAllMaterial($email){
        $sql="DELETE FROM materials WHERE materials.Teacher = :email";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
    }

    protected function getNeededApproveForMaterial(){
        $sql="SELECT * FROM materials WHERE approved = 0";
        $data=$this->connect()->query($sql);
        return $data->fetchAll();
    }

    protected function getApprovedMaterial(){
        $sql="SELECT * FROM materials WHERE approved = 1";
        $data=$this->connect()->query($sql);
        return $data->fetchAll();
    }
    protected function getApprovedMaterialForOne($email){
        $sql="SELECT * FROM materials WHERE approved = 1 AND Teacher= :email";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function isApproved($parentMail,$teacherMail){
        $sql="SELECT * FROM requests WHERE parent_mail = :parentMail AND teacher_mail = :teacherMail";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':parentMail',$parentMail,PDO::PARAM_STR);
        $stmt->bindParam(':teacherMail',$teacherMail,PDO::PARAM_STR);
        $stmt->execute();
        $data=$stmt->fetchAll();
        if ($data[0]['approved']==1){
            return true;
        }else{
            return false;
        }
    }

    protected function isRequested($parentMail,$teacherMail){
        $sql="SELECT * FROM requests WHERE parent_mail = :parentMail AND teacher_mail = :teacherMail";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':parentMail',$parentMail,PDO::PARAM_STR);
        $stmt->bindParam(':teacherMail',$teacherMail,PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->fetchAll()){
            return true;
        }else{
            return false;
        }
    }

    protected function freeTeachers($parentMail){
        $data=$this->getAllTeachers();
        $free=array();
        foreach ($data as $teacher){
            if (!($this->isRequested($parentMail,$teacher['email']))){
                array_push($free,$teacher);
            }
        }
        return $free;
    }

    protected function requestedTeachers($parentMail){
        $data=$this->getAllTeachers();
        $req=array();
        foreach ($data as $teacher){
            if ($this->isRequested($parentMail,$teacher['email'])&&!($this->isApproved($parentMail,$teacher['email']))){

                array_push($req,$teacher);
            }
        }
        return $req;
    }

    protected function approvedTeachers($parentMail){
        $data=$this->getAllTeachers();
        $req=array();
        foreach ($data as $teacher){
            if ($this->isRequested($parentMail,$teacher['email'])&&$this->isApproved($parentMail,$teacher['email'])){

                array_push($req,$teacher);
            }
        }
        return $req;
    }


    protected function makeRequest($parentMail,$teacherMail){
        $sql="INSERT INTO requests (parent_mail,teacher_mail) VALUES (:parentMail,:teacherMail)";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':parentMail',$parentMail,PDO::PARAM_STR);
        $stmt->bindParam(':teacherMail',$teacherMail,PDO::PARAM_STR);
        $stmt->execute();
    }
    protected function approveRequest($parentMail,$teacherMail){
        $sql="UPDATE requests SET approved = '1' WHERE requests.parent_mail = :parentMail AND requests.teacher_mail= :teacherMail";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':parentMail',$parentMail,PDO::PARAM_STR);
        $stmt->bindParam(':teacherMail',$teacherMail,PDO::PARAM_STR);
        $stmt->execute();
    }

    protected function deleteRequest($parentMail,$teacherMail){
        $sql="DELETE FROM requests  WHERE requests.parent_mail = :parentMail AND requests.teacher_mail= :teacherMail";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':parentMail',$parentMail,PDO::PARAM_STR);
        $stmt->bindParam(':teacherMail',$teacherMail,PDO::PARAM_STR);
        $stmt->execute();
    }

    protected function getParentsRequests($teacherMail){
        $sql="SELECT * FROM requests WHERE teacher_mail = :teacherMail";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(':teacherMail',$teacherMail,PDO::PARAM_STR);
        $stmt->execute();
        $data=$stmt->fetchAll();
        $pending=array();
        foreach ($data as $offer){
            if($offer['approved']==0){
                array_push($pending,$offer);
            }
        }
        return $pending ;
    }

}