<?php

namespace PHPMentors\DomainCommons\DateTime\Period;

trait MonthlyTrait
{
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
            $current = $current->addMonths(1);
            if ($current > $this->end) {
                break;
            }
        }
    }
}
