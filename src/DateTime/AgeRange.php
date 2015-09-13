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

use PHPMentors\DomainKata\Entity\EntityInterface;

/**
 * @since Class available since Release 1.1.0
 */
class AgeRange implements EntityInterface
{
    /**
     * @var Clock
     */
    private $clock;

    /**
     * @var int
     */
    private $max;

    /**
     * @var int
     */
    private $min;

    public function __construct()
    {
        $this->setClock(new Clock());
    }

    /**
     * @param Clock $clock
     */
    public function setClock(Clock $clock)
    {
        $this->clock = $clock;
    }

    /**
     * @param int $max
     */
    public function setMax($max)
    {
        $this->max = $max;
    }

    /**
     * @param int $min
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return \DateTime
     */
    public function getMaxAsDate()
    {
        return $this->convertAgeToDate($this->max + 1, false);
    }

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return \DateTime
     */
    public function getMinAsDate()
    {
        return $this->convertAgeToDate($this->min, true);
    }

    /**
     * @param int  $numberOfYears
     * @param bool $correctionMatcher
     *
     * @return \DateTime
     */
    private function convertAgeToDate($numberOfYears, $correctionMatcher)
    {
        $currentDate = $this->clock->now();
        $baseDate = new \DateTime($currentDate->format('Y-m-d'));
        $baseDate->modify(sprintf('-%d years', $numberOfYears));

        if (($currentDate->format('L') == 1 && $currentDate->format('m-d') === '02-29' && $baseDate->format('L') == 0) === $correctionMatcher) {
            $baseDate->modify(sprintf('%s1 days', $correctionMatcher ? '-' : '+'));
        }

        return $baseDate;
    }
}
