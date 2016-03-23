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

namespace PHPMentors\DomainCommons\DateTime;

use PHPMentors\DomainCommons\DateTime\Period\MonthlyIteratableInterface;
use PHPMentors\DomainCommons\DateTime\Period\ThreeMonthlyTrait;

class LongTerm extends Term implements MonthlyIteratableInterface
{
    use ThreeMonthlyTrait;

    public function __construct($start, $end)
    {
        parent::__construct($start, $end);
        $this->setTermFactory(function($start, $end){
            return new OneTerm($start, $end);
        });
        $this->it = $this->iterate();
    }

    public function getStart(){return $this->start;}
    public function getEnd(){return $this->end;}
}

class OneTerm extends Term
{
    public function getStart(){return $this->start;}
    public function getEnd(){return $this->end;}
}

class ThreeMonthlyTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider everyTheeMonthsTest
     */
    public function everyTheeMonthsPeriod($start, $end, $expectedTerms)
    {
        $term = new LongTerm(new Date($start), new Date($end));

        $count = 0;
        foreach ($term as $oneTerm) {
            $this->assertThat(
                $oneTerm->getStart()->format('Y-m-d'),
                $this->equalTo($expectedTerms[$count][0]));
            $this->assertThat(
                $oneTerm->getEnd()->format('Y-m-d'),
                $this->equalTo($expectedTerms[$count][1]));
            ++$count;
        }
        $this->assertThat($count, $this->equalTo(count($expectedTerms)));
    }

    public function everyTheeMonthsTest()
    {
        return [
            ['2015-01-01', '2015-10-31',  [
                ['2015-01-01', '2015-03-31'],
                ['2015-04-01', '2015-06-30'],
                ['2015-07-01', '2015-09-30'],
                ['2015-10-01', '2015-10-31'],
            ]],
            ['2015-02-01', '2015-03-31',  [
                ['2015-02-01', '2015-03-31'],
            ]],
            ['2015-02-01', '2015-04-30',  [
                ['2015-02-01', '2015-04-30'],
            ]],
            ['2015-02-01', '2016-03-31',  [
                ['2015-02-01', '2015-04-30'],
                ['2015-05-01', '2015-07-31'],
                ['2015-08-01', '2015-10-31'],
                ['2015-11-01', '2016-01-31'],
                ['2016-02-01', '2016-03-31'],
            ]],
        ];
    }
}
