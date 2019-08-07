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

namespace PHPMentors\DomainCommons\String;

use PHPUnit\Framework\TestCase;

/**
 * @since Class available since Release 1.1.1
 */
class UniqueNameTest extends TestCase
{
    public function test()
    {
        $list = [
            'test1','test2','apple banana','test1 (1)','test2 (3)','php',''
        ];
        $uniqueName = new UniqueName($list);
        $result = $uniqueName('test1');
        $this->assertThat($result, $this->equalTo('test1'));
        $result = $uniqueName('test1', false);
        $this->assertThat($result, $this->equalTo('test1 (2)'));
        $result = $uniqueName('test2 (2)');
        $this->assertThat($result, $this->equalTo('test2 (2)'));


        $list = [
            'test1','test1',
        ];
        $uniqueName = new UniqueName($list);
        $result = $uniqueName('test1');
        $this->assertThat($result, $this->equalTo('test1 (1)'));
        $result = $uniqueName('test1', false);
        $this->assertThat($result, $this->equalTo('test1 (1)'));


        $list = [
            'test1','test1 (1)',
        ];
        $uniqueName = new UniqueName($list);
        $result = $uniqueName('test1', false);
        $this->assertThat($result, $this->equalTo('test1 (2)'));
    }
}
