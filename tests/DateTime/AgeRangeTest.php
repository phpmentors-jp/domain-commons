<?php
/*
 * Copyright (c) 2015 KUBO Atsuhiro <kubo@iteman.jp>,
 * All rights reserved.
 *
 * This file is part of Domain Commons.
 *
 * This program and the accompanying materials are made available under
 * the terms of the BSD 2-Clause License which accompanies this
 * distribution, and is available at http://opensource.org/licenses/BSD-2-Clause
 */

namespace PHPMentors\DomainCommons\DateTime;

/**
 * @since Class available since Release 1.1.0
 */
class AgeRangeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $target
     *
     * @return \DateTime
     */
    private function date($target)
    {
        return new DateTime($target);
    }

    /**
     * @return array
     */
    public function getMaxAsDateData()
    {
        return [
            [$this->date('2015-09-12'), 40, '1974-09-13'],
            [$this->date('2015-02-28'), 39, '1975-03-01'],
            [$this->date('2016-02-29'), 39, '1976-03-01'],
            [$this->date('2016-02-29'), 40, '1975-03-01'],
            [$this->date('2015-12-31'), 40, '1975-01-01'],
        ];
    }

    /**
     * @test
     * @dataProvider getMaxAsDateData
     */
    public function getMaxAsDate(\DateTimeInterface $currentDate, $max, $maxAsDate)
    {
        $clock = $this->getMock('PHPMentors\DomainCommons\DateTime\Clock');
        $clock->method('now')->will($this->returnValue($currentDate));
        $ageRange = new AgeRange();
        $ageRange->setClock($clock);
        $ageRange->setMax($max);

        $this->assertThat($ageRange->getMaxAsDate()->format('Y-m-d'), $this->equalTo($maxAsDate));
    }

    /**
     * @return array
     */
    public function getMinAsDateData()
    {
        return [
            [$this->date('2015-09-12'), 20, '1995-09-12'],
            [$this->date('2015-02-28'), 19, '1996-02-28'],
            [$this->date('2016-02-29'), 19, '1997-02-28'],
            [$this->date('2016-02-29'), 20, '1996-02-29'],
            [$this->date('2015-12-31'), 20, '1995-12-31'],
        ];
    }

    /**
     * @test
     * @dataProvider getMinAsDateData
     */
    public function getMinAsDate(\DateTimeInterface $currentDate, $min, $minAsDate)
    {
        $clock = $this->getMock('PHPMentors\DomainCommons\DateTime\Clock');
        $clock->method('now')->will($this->returnValue($currentDate));
        $ageRange = new AgeRange();
        $ageRange->setClock($clock);
        $ageRange->setMin($min);

        $this->assertThat($ageRange->getMinAsDate()->format('Y-m-d'), $this->equalTo($minAsDate));
    }
}
