<?php
namespace PHPMentors\DomainCommons\DateTime;

class Date extends DateTime
{
    public function __construct($time = "now", $timezone = null)
    {
        $date = new \DateTime($time, $timezone);
        $dateStr = $date->format('Y-m-d 00:00:00');

        parent::__construct($dateStr, $timezone);
    }

    public function __toString()
    {
        return $this->format('Y-m-d');
    }
}
