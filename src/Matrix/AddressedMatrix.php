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

namespace PHPMentors\DomainCommons\Matrix;

use PHPMentors\DomainKata\Entity\EntityInterface;

class AddressedMatrix extends TypedMatrix
{
    /**
     * @var string[]
     */
    protected $_columnNames;

    public function __construct($columnNames, \Closure $elementFactory)
    {
        $this->_columnNames = $columnNames;

        parent::__construct(count($this->_columnNames), count($this->_columnNames), $elementFactory);
    }

    /**
     * Get element using Column name addressing
     *
     * @api
     * @param $a
     * @param $b
     * @return EntityInterface
     * @throws \RuntimeException
     */
    public function addressGet($a, $b)
    {
        $aIndex = $this->getColumnIndex($a);
        $bIndex = $this->getColumnIndex($b);

        if ($aIndex === false || $bIndex === false) throw new \RuntimeException();

        return $this->get($bIndex, $aIndex);
    }

    /**
     * Get an elements array of specified row
     *
     * @param $a
     * @return mixed
     * @throws \RuntimeException
     */
    public function addressGetRow($a)
    {
        $aIndex = $this->getColumnIndex($a);

        if ($aIndex === false) throw new \RuntimeException();

        return $this->getCol($aIndex);
    }

    /**
     * Get an elements array of specified column
     *
     * @param $a
     * @return mixed
     * @throws \RuntimeException
     */
    public function addressGetCol($a)
    {
        $aIndex = $this->getColumnIndex($a);

        if ($aIndex === false) throw new \RuntimeException();

        return $this->getRow($aIndex);
    }

    /**
     * Set element using Column name addressing
     *
     * @param $a
     * @param $b
     * @param EntityInterface $newValue
     * @throws \RuntimeException
     */
    public function addressSet($a, $b, $newValue)
    {
        $aIndex = $this->getColumnIndex($a);
        $bIndex = $this->getColumnIndex($b);

        if ($aIndex === false || $bIndex === false) throw new \RuntimeException();

        $this->set($bIndex, $aIndex, $newValue);
    }

    /**
     * @api
     * @return \string[]
     */
    public function columnNames()
    {
        return $this->_columnNames;
    }

    /**
     * @param $columnName
     * @return mixed
     */
    private function getColumnIndex($columnName)
    {
        return array_search($columnName, $this->_columnNames);
    }

    /**
     * @api
     * @param $target
     */
    public function copyFrom(EntityInterface $target)
    {
        /** @var $target AddressedMatrix */
        assert($target instanceof AddressedMatrix);
        $this->_columnNames = $target->_columnNames;
        $this->copyFromParent($target);
    }

    /**
     * @param $target
     */
    private function copyFromParent(TypedMatrix $target)
    {
        /** @var $target TypedMatrix */
        parent::copyFrom($target);
    }
}
