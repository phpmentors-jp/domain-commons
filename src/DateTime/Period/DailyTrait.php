<?php

namespace PHPMentors\DomainCommons\DateTime\Period;

trait DailyTrait
{
    protected $it;

    public function getIterator() {
        return $this->it;
    }

    /**
     * @return \Generator
     * @requireProperty DateTime $start
     * @requireProperty DateTime $end
     */
    public function iterate()
    {
        $current = clone $this->start;
        while (true)
        {
            yield $current;
            $current = $current->addDays(1);
            if ($current > $this->end) {
                break;
            }
        }
    }
}
