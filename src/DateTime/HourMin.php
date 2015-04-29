<?php
namespace PHPMentors\DomainCommons\DateTime;

class HourMin extends DateTime
{
    public function __construct($time = "now", $timezone = null)
    {
        $date = new \DateTime($time, $timezone);
        $dateStr = $date->format('2012-1-1 H:i:00');

        parent::__construct($dateStr, $timezone);
    }

    public function addDays($days)
    {
        throw new \RuntimeException('not supported');
    }

    public function addMonths($months)
    {
        throw new \RuntimeException('not supported');
    }

    public function __toString()
    {
        return $this->format('H:i');
    }
}
