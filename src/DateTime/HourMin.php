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

namespace PHPMentors\DomainCommons\DateTime;

class HourMin extends DateTime
{
    public function __construct($time = 'now', $timezone = null)
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
