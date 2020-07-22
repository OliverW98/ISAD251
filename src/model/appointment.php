<?php


class appointment
{

    private $appointmentID,$userID,$appointmentDate,$appointmentDetails,$appointmentNotes,$numOfPatients;


    public function __construct($aID,$uID,$aDate,$aDetails,$aNotes,$patients)
    {
        $this->appointmentID = &$aID;
        $this->userID = $uID;
        $this->appointmentDate = $aDate;
        $this->appointmentDetails = $aDetails;
        $this->appointmentNotes = $aNotes;
        $this->numOfPatients = $patients;
    }

    /**
     * @return mixed
     */
    public function getAppointmentID()
    {
        return $this->appointmentID;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }
    /**
     * @return mixed
     */
    public function getAppointmentDate()
    {
        return $this->appointmentDate;
    }

    /**
     * @return mixed
     */
    public function getAppointmentDetails()
    {
        return $this->appointmentDetails;
    }

    /**
     * @return mixed
     */
    public function getAppointmentNotes()
    {
        return $this->appointmentNotes;
    }

    /**
     * @return mixed
     */
    public function getNumOfPatients()
    {
        return $this->numOfPatients;
    }
}