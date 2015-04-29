<?php
namespace PHPMentors\DomainCommons\DateTime;

class Year extends DateTime
{
    public function __construct($time = "now", $timezone = null)
    {
        $date = new \DateTime($time, $timezone);
        $dateStr = $date->format('Y-1-1 00:00:00');

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
        return $this->format('Y');
    }
}
