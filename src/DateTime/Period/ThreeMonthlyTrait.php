<?php
/*
 * Copyright (c) 2016 GOTO Hidenori <hidenorigoto@gmail.com>,
 * All rights reserved.
 *
 * This file is part of Domain Commons.
 *
 * This program and the accompanying materials are made available under
 * the terms of the BSD 2-Clause License which accompanies this
 * distribution, and is available at http://opensource.org/licenses/BSD-2-Clause
 */

namespace PHPMentors\DomainCommons\DateTime\Period;

use PHPMentors\DomainCommons\DateTime\Date;
use PHPMentors\DomainCommons\DateTime\Term;

trait ThreeMonthlyTrait
{
    protected $it;
    protected $_termFactory = null;

    public function getIterator()
    {
        return $this->it;
    }

    public function setTermFactory(\Closure $f)
    {
        $this->_termFactory = $f;
    }

    /**
     * @return \Generator
     * @requireProperty DateTime $start
     * @requireProperty DateTime $end
     */
    public function iterate()
    {
        $start = clone $this->start;
        while (true) {
            $end = clone $start->addMonths(2);
            $end = new Date($end->format('Y-m-t'));
            if ($end > $this->end) {
                $end = $this->end;
            }

            if ($this->_termFactory) {
                yield call_user_func($this->_termFactory, $start, $end);
            } else {
                yield new Term($start, $end);
            }

            $start = $end->addDays(1);
            if ($start > $this->end) {
                break;
            }
        }
    }
}
