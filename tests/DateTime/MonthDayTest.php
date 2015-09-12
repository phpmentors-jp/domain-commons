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

class MonthDayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider instanciateData
     */
    public function instanciate($dateStr, $expected)
    {
        $instance = new MonthDay($dateStr);

        $this->assertThat((string) $instance, $this->equalTo($expected));
    }

    public function instanciateData()
    {
        return [
            ['2014-03-21 12:34:55', '03-21'],
        ];
    }
}
