<?php
/*
 * Copyright (c) 2017 GOTO Hidenori <hidenorigoto@gmail.com>,
 * All rights reserved.
 *
 * This file is part of Domain Commons.
 *
 * This program and the accompanying materials are made available under
 * the terms of the BSD 2-Clause License which accompanies this
 * distribution, and is available at http://opensource.org/licenses/BSD-2-Clause
 */

namespace PHPMentors\DomainCommons\DateTime;

use DateTimeImmutable;
use PHPMentors\DomainCommons\DateTime\Exception\UnsupportedCalculation;

class DateTime extends DateTimeImmutable
{
    public function addDays($days)
    {
        $class = static::class;
        $daysStr = (($days < 0) ? '-' : '+').abs($days).' days';

        return new $class(date('Y-m-d H:i:s', strtotime($daysStr, $this->getTimestamp())));
    }

    /**
     * @param  int       $months
     * @return DateTime
     * @throws UnsupportedCalculation
     *
     * NOTE: This method throws UnsupportedCalculation exception when
     *       the day of the result is not equal to the original date.
     *       Don't forget to handle this situation before calling this method.
     */
    public function addMonths($months)
    {
        $class = static::class;
        $monthsStr = (($months < 0) ? '-' : '+').abs($months).' month';

        $newInstance = new $class(date('Y-m-d H:i:s', strtotime($monthsStr, $this->getTimestamp())));

        if ($newInstance->format('d') != $this->format('d')) {
            throw new UnsupportedCalculation();
        }

        return $newInstance;
    }

    public function __toString()
    {
        return $this->format('Y-m-d H:i:s');
    }
}
