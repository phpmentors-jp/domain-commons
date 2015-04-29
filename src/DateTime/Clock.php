<?php
namespace PHPMentors\DomainCommons\DateTime;

class Clock
{
    public function now()
    {
        return new DateTime();
    }
}
