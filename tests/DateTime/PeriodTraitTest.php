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

use PHPUnit\Framework\TestCase;
use PHPMentors\DomainCommons\DateTime\Period\DailyIteratableInterface;
use PHPMentors\DomainCommons\DateTime\Period\DailyTrait;

class DailyPeriod extends Period implements DailyIteratableInterface
{
    use DailyTrait;

    public function __construct($start, $end)
    {
        parent::__construct($start, $end);
        $this->it = $this->iterate();
    }
}

class PeriodTraitTest extends TestCase
{
    /**
     * @test
     * @dataProvider dailyPeriodTest
     */
    public function dailyPeriod($start, $end, $expectedCount)
    {
        $period = new DailyPeriod(new Date($start), new Date($end));

        $count = 0;
        foreach ($period as $one) {
            ++$count;
        }
        $this->assertThat($count, $this->equalTo($expectedCount));
    }

    public function dailyPeriodTest()
    {
        return [
            ['2015-04-02', '2015-04-05',  4],
            ['2015-04-03', '2015-05-10', 38],
        ];
    }
}
