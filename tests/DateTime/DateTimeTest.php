<?php
/*
 * Copyright (c) 2015 GOTO Hidenori <hidenorigoto@gmail.com>,
 * All rights reserved.
 *
 * This file is part of PHPMentors/Domain Commons.
 *
 * This program and the accompanying materials are made available under
 * the terms of the BSD 2-Clause License which accompanies this
 * distribution, and is available at http://opensource.org/licenses/BSD-2-Clause
 */

namespace PHPMentors\DomainCommons\DateTime;

class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider addDaysData
     */
    public function addDays($dateStr, $days, $expected)
    {
        $date = new DateTime($dateStr);
        $added = $date->addDays($days);

        $this->assertThat($added->format('Y-m-d'), $this->equalTo($expected));
    }

    public function addDaysData()
    {
        return [
            ['2015-03-21',  3, '2015-03-24'],
            ['2014-12-19', 25, '2015-01-13'],
            ['2014-12-19', -3, '2014-12-16'],
        ];
    }

    /**
     * @test
     * @dataProvider addMOnthsData
     */
    public function addMonths($dateStr, $months, $expected)
    {
        $date = new DateTime($dateStr);

        if ($expected === null) {
            $this->setExpectedException('RuntimeException');
        }

        $added = $date->addMonths($months);

        $this->assertThat($added->format('Y-m-d'), $this->equalTo($expected));
    }

    public function addMonthsData()
    {
        return [
            ['2015-03-21',  3, '2015-06-21'],
            ['2015-01-30',  1, null],
            ['2014-12-19',  5, '2015-05-19'],
            ['2014-12-19', -2, '2014-10-19'],
        ];
    }
}
