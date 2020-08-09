<?php


class user
{

    private $userID;
    private $appointmentsArray = array();
    private $deadlineArray = array();

    public function __construct($userId, array $appointmentArray, array $deadlineArray){
        $this->userID = $userId;
        $this->appointmentsArray = $appointmentArray;
        $this->deadlineArray = $deadlineArray;
    }

    /**
     * @return array
     */
    public function getAppointmentsArray()
    {
        return $this->appointmentsArray;
    }

    /**
     * @return array
     */
    public function getDeadlineArray()
    {
        return $this->deadlineArray;
    }

}