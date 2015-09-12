<?php
/*
 * Copyright (c) 2015 GOTO Hidenori <hidenorigoto@gmail.com>,
 * All rights reserved.
 *
 * This file is part of Domain Commons.
 *
 * This program and the accompanying materials are made available under
 * the terms of the BSD 2-Clause License which accompanies this
 * distribution, and is available at http://opensource.org/licenses/BSD-2-Clause
 */

namespace PHPMentors\DomainCommons\DateTime\Period;

trait DailyTrait
{
    protected $it;

    public function getIterator()
    {
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
        while (true) {
            yield $current;
            $current = $current->addDays(1);
            if ($current > $this->end) {
                break;
            }
        }
    }
}
