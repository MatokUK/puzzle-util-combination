<?php

namespace Matok\Util;

class CombinationInterval  implements \Iterator, \Countable
{
    private $charset;

    private $currentLength;

    private $maxLength;

    private $valid = true;

    private $possibilities = 0;

    /** @var Combination */
    private $combination;

    public function __construct($charset, $startLength, $maxLength)
    {
        $this->charset = $charset;
        $this->currentLength = $startLength;
        $this->maxLength = $maxLength;

        $this->initCombination($startLength);
        $this->initCount($startLength, $maxLength);
    }

    private function initCombination($length)
    {
        $combinationVector = [];
        for ($i = 0; $i < $length; $i++) {
            $combinationVector[] = $this->charset;
        }

        $this->combination = new Combination($combinationVector);
    }

    private function initCount($startLength, $maxLength)
    {
        for ($i = $startLength; $i <= $maxLength; $i++) {
            $combinationVector = [];
            for ($length = 0; $length < $i; $length++) {
                $combinationVector[] = $this->charset;
            }

            $combination = new Combination($combinationVector);
            $this->possibilities += $combination->count();
        }
    }

    public function current()
    {
        return implode('', $this->combination->current());
    }

    public function next()
    {
        $this->combination->next();
        if (!$this->combination->valid() && $this->currentLength < $this->maxLength) {
            $this->currentLength++;
            $this->initCombination($this->currentLength);
        }
    }

    public function key()
    {
        return ;
    }

    public function valid()
    {
        return $this->valid;
    }

    public function rewind()
    {
        $this->combination->rewind();
    }

    public function count()
    {
        return $this->possibilities;
    }
}