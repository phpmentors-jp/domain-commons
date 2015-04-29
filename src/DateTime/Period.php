<?php
namespace PHPMentors\DomainCommons\DateTime;

class Period
{
    /**
     * @var DateTime
     */
    protected $start;

    /**
     * @var DateTime
     */
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }
}
