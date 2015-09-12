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

class Date extends DateTime
{
    public function __construct($time = 'now', $timezone = null)
    {
        $date = new \DateTime($time, $timezone);
        $dateStr = $date->format('Y-m-d 00:00:00');

        parent::__construct($dateStr, $timezone);
    }

    public function __toString()
    {
        return $this->format('Y-m-d');
    }
}
