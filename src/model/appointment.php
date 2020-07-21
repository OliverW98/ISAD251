<?php


class appointment
{

    private $appointmentID,$userID,$appointmentDate,$appointmentDetails,$appointmentNotes,$numOfPatients;

    public function constructAppointment($aID,$uID,$aDate,$aDetails,$aNotes,$patients)
    {
        $this->appointmentID = &$aID;
        $this->userID = $uID;
        $this->appointmentDate = $aDate;
        $this->appointmentDetails = $aDetails;
        $this->appointmentNotes = $aNotes;
        $this->numOfPatients = $patients;
    }

}