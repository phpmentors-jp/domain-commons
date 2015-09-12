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

namespace PHPMentors\DomainCommons\Matrix;

use PHPMentors\DomainCommons\Matrix\Operation\ZeroableInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Entity\Operation\CopyableInterface;
use PHPMentors\DomainKata\Entity\Operation\EquatableInterface;

class TypedMatrix implements EntityInterface, EquatableInterface, CopyableInterface, ZeroableInterface
{
    /**
     * @var int
     */
    protected $_rows;
    /**
     * @var int
     */
    protected $_cols;

    /**
     * 2 dimension array data (= matrix elements).
     *
     * @var array
     */
    protected $_data;

    /**
     * @var \Closure
     */
    protected $factory;

    /**
     * @param $rows
     * @param $cols
     * @param \Closure $elementFactory
     */
    public function __construct($rows, $cols, $elementFactory = null)
    {
        $this->_rows = $rows;
        $this->_cols = $cols;
        $this->factory = $elementFactory;

        if (!$this->factory) {
            $this->factory = function () {
                return 0;
            };
        }
        $this->initializeElements();
    }

    /**
     * Return row count.
     *
     * @api
     *
     * @return int
     */
    public function rows()
    {
        return $this->_rows;
    }

    /**
     * Return column number.
     *
     * @api
     *
     * @return int
     */
    public function cols()
    {
        return $this->_cols;
    }

    /**
     * Return an element located with row/col.
     *
     * @api
     *
     * @param $row
     * @param $col
     *
     * @return mixed
     *
     * @throws \OutOfRangeException
     */
    public function get($row, $col)
    {
        if (!$this->checkRange($row, $col)) {
            throw new \OutOfRangeException();
        }

        return $this->_data[$row][$col];
    }

    /**
     * Set an element located with row/col.
     *
     * @api
     *
     * @param $row
     * @param $col
     * @param $value
     *
     * @return $this
     *
     * @throws \OutOfRangeException
     */
    public function set($row, $col, $value)
    {
        if (!$this->checkRange($row, $col)) {
            throw new \OutOfRangeException();
        }

        $this->_data[$row][$col] = $value;

        return $this;
    }

    /**
     * Return an array of elements in a specified row.
     *
     * @param $row
     *
     * @return mixed
     *
     * @throws \OutOfRangeException
     */
    public function getRow($row)
    {
        if (!$this->checkRange($row, 0)) {
            throw new \OutOfRangeException();
        }

        return $this->_data[$row];
    }

    /**
     * Return an array of elements in a specified column.
     *
     * @param $col
     *
     * @return array
     *
     * @throws \OutOfRangeException
     */
    public function getCol($col)
    {
        if (!$this->checkRange(0, $col)) {
            throw new \OutOfRangeException();
        }

        return array_column($this->_data, $col);
    }

    /**
     * returns whether this matrix is `zero matrix`.
     *
     * @api
     *
     * @return bool
     */
    public function isZero()
    {
        return $this->reduce(function ($current, $element) {
            if ($element instanceof ZeroableInterface) {
                return $current & ($element->isZero());
            } elseif (is_numeric($element)) {
                return $current & ($element == 0);
            } else {
                throw new \RuntimeException('Cannot evaluate whether element is zero or not.');
            }
        }, true);
    }

    /**
     * apply closure to each element.
     *
     * @api
     *
     * @param callable $f
     *
     * @return TypedMatrix
     */
    public function map(\Closure $f)
    {
        array_walk_recursive($this->_data, $f);

        return $this;
    }

    /**
     * @api
     *
     * @param callable $f arguments $current, $element, $rowIndex, $colIndex
     * @param $initial
     *
     * @return mixed
     */
    public function reduce(\Closure $f, $initial)
    {
        $current = $initial;
        for ($rowIndex = 0; $rowIndex < $this->_rows; ++$rowIndex) {
            for ($colIndex = 0; $colIndex < $this->_cols; ++$colIndex) {
                $current = call_user_func($f, $this->_data[$rowIndex][$colIndex], $current, $rowIndex, $colIndex);
            }
        }

        return $current;
    }

    /**
     * builds array of elements.
     */
    protected function initializeElements()
    {
        for ($i = 0; $i < $this->_rows; ++$i) {
            for ($j = 0; $j < $this->_cols; ++$j) {
                $this->_data[$i][$j] = call_user_func($this->factory);
            }
        }
    }

    /**
     * Check whether row/col are valid.
     *
     * @param $row
     * @param $col
     *
     * @return bool
     */
    private function checkRange($row, $col)
    {
        if ($this->_rows <= $row || $row < 0) {
            return false;
        }
        if ($this->_cols <= $col || $col < 0) {
            return false;
        }

        return true;
    }

    /**
     * @api
     * {@inheritdoc}
     */
    public function copyFrom(EntityInterface $target)
    {
        /* @var $target TypedMatrix */
        $this->_data = $target->_data;
        $this->_cols = $target->_cols;
        $this->_rows = $target->_rows;
    }

    /**
     * {@inheritdoc}
     */
    public function copyTo(EntityInterface $destination)
    {
        /* @var $destination TypedMatrix */
        $destination->_data = $this->_data;
        $destination->_cols = $this->_cols;
        $destination->_rows = $this->_rows;
    }

    /**
     * @param EntityInterface $target
     *
     * @return bool
     */
    public function equals(EntityInterface $target)
    {
        /** @var TypedMatrix $target */
        if (
            $this->_cols !== $target->_cols ||
            $this->_rows !== $target->_rows
        ) {
            return false;
        }

        for ($i = 0; $i < $this->_rows; ++$i) {
            for ($j = 0; $j < $this->_cols; ++$j) {
                if (is_object($this->_data[$i][$j])) {
                    if ($this->_data[$i][$j]->equals($target->_data[$i][$j]) === false) {
                        return false;
                    }
                } else {
                    if ($this->_data[$i][$j] !== $target->_data[$i][$j]) {
                        return false;
                    }
                }
            }
        }

        return true;
    }
}
