<?php


class user
{

    private $userID;
    private $appointmentsArray = array();

    public function __construct($userId, $appointmentArray){
        $this->userID = $userId;
        $this->appointmentsArray = $appointmentArray;
    }

    /**
     * @return array
     */
    public function getAppointmentsArray()
    {
        return $this->appointmentsArray;
    }

    /**
     * @param array $appointmentsArray
     */
    public function setAppointmentsArray($appointmentsArray)
    {
        $this->appointmentsArray = $appointmentsArray;
    }

}