<?php

namespace App\Service;

use DateTime;

class TimerService 
{

    private $currentDate;

    /**
     * constructor 
     */
    public function __construct()
    {
        $this->currentDate = new DateTime('now');
    }

    /**
     * function that will return a dateInterval of the time left before the moving date
     */
    public function timer($movingDate)
    {
            $timeLeft = $this->currentDate->diff($movingDate);
            return $timeLeft;

    }
}