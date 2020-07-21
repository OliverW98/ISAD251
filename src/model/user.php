<?php


class user
{

    private $userID;
    private $appointmentsArray = array();

    public function constructUser($userId, $appointmentArray){
        $this->userID = $userId;
        $this->appointmentsArray = $appointmentArray;
    }
}