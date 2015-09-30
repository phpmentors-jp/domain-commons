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

/**
 * @since Class available since Release 1.1.1
 */
class UniqueName
{
    /**
     * @var array
     */
    private $source;
    /**
     * @var string
     */
    private $numberingPattern;
    /**
     * @var string
     */
    private $numberingPatternRexex;
    private $numberingPatternExtractRegex;

    public function __construct($source, $numberingPattern = ' (n)')
    {
        $this->source = $source;
        $this->numberingPattern = $numberingPattern;
        $this->numberingPatternRegex = sprintf('/(%s)$/',
            str_replace('n', '\d+', preg_quote($this->numberingPattern)));
        $this->numberingPatternExtractRegex = sprintf('/#BASE#(%s)$/',
            str_replace('n', '(\d+)', preg_quote($this->numberingPattern)));
    }

    public function __invoke($name, $alreadyInSource = true)
    {
        $sameList = array_filter($this->source, function ($targetName) use ($name) {
            return $targetName === $name;
        });
        if (count($sameList) <= ($alreadyInSource ? 1 : 0)) {
            return $name;
        }

        $baseName = preg_replace($this->numberingPatternRegex, '', $name);

        $matchedList = array_filter($this->source, function($targetName) use ($baseName) {
            return strpos($targetName, $baseName) !== false;
        });

        $max = 0;
        $regex = str_replace('#BASE#', $baseName, $this->numberingPatternExtractRegex);
        foreach ($matchedList as $targetName) {
            if (preg_match($regex, $targetName, $match)) {
                $max = max($max, $match[2]);
            }
        }

        return $baseName . $this->makeNumber($max + 1);
    }

    private function makeNumber($number)
    {
        return str_replace('n', $number, $this->numberingPattern);
    }
}
