<?php


class deadline
{

    private $deadlineID, $deadlineUserID , $deadlineDate , $deadlineDetails, $deadlineMet;

    public function __construct($dID,$userID, $dDate,$dDetails,$dMet)
    {
        $this->deadlineID = $dID;
        $this->deadlineUserID=$userID;
        $this->deadlineDate = $dDate;
        $this->deadlineDetails = $dDetails;
        $this->deadlineMet = $dMet;
    }

    /**
     * @return mixed
     */
    public function getDeadlineID()
    {
        return $this->deadlineID;
    }

    /**
     * @return mixed
     */
    public function getDeadlineUserID()
    {
        return $this->deadlineUserID;
    }

    /**
     * @return mixed
     */
    public function getDeadlineDate()
    {
        return $this->deadlineDate;
    }

    /**
     * @return mixed
     */
    public function getDeadlineDetails()
    {
        return $this->deadlineDetails;
    }

    /**
     * @return mixed
     */
    public function getDeadlineMet()
    {
        return $this->deadlineMet;
    }
}