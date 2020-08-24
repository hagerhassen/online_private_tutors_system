<?php

include "users.class.php";

class usersView extends users{

    public function getTeachers(){
        return $this->getTeachersRequest();
    }

    public function getUserInfo($email){
        return $this->getUser($email);
    }
    public function getAllT(){
        return $this->getAllTeachers();
    }

    public function getParents(){
        return $this->getAllParents();
    }

    public function getMyMaterial($email){
        return $this->getAllMaterialForOne($email);
    }

    public function getNeededMaterial(){
        return $this->getNeededApproveForMaterial();
    }

    public function getSystemMaterial(){
        return $this->getApprovedMaterial();
    }

    public function getSystemMaterialForOne($email){
        return $this->getApprovedMaterialForOne($email);
    }

    public function getTeacherForRequest($parentMail){
        return $this->freeTeachers($parentMail);
    }

    public function getRequested($parentMail){
        return $this->requestedTeachers($parentMail);
    }

    public function getApproved($parentMail){
        return $this->approvedTeachers($parentMail);
    }

    public function getOffer($teacher){
        return $this->getParentsRequests($teacher);
    }

}
