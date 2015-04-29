<?php
namespace PHPMentors\DomainCommons\DateTime;

class YearMonth extends DateTime
{
    public function __construct($time = "now", $timezone = null)
    {
        $date = new \DateTime($time, $timezone);
        $dateStr = $date->format('Y-m-1 00:00:00');

        parent::__construct($dateStr, $timezone);
    }

    public static function fromLong($ym)
    {
        $month = $ym % 100;
        $year = (int)floor($ym / 100);

        $class = static::class;
        return new $class("$year-$month-1 00:00:00");
    }

    public function toLong()
    {
        return (int)$this->format('Ym');
    }

    public function addDays($days)
    {
        throw new \RuntimeException('not supported');
    }

    public function __toString()
    {
        return $this->format('Y-m');
    }
}
