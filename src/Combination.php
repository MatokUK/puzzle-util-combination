<?php

namespace Matok\Util;

class Combination implements \Iterator, \Countable
{
    private $list = [];
    private $valid = true;
    private $fragments;
    private $key;
    private $possibilities = 1;

    public function __construct(array $charsets)
    {
        $this->checkArgument($charsets);
        $this->initFragmentCount($charsets);
        $this->initFragments($charsets);
    }

    private function checkArgument(array $charsets)
    {
        if (empty($charsets)) {
            throw new \InvalidArgumentException(sprintf('Cannot construct %s from empty value!', __CLASS__));
        }
    }

    private function initFragmentCount(array $charsets)
    {
        $this->fragments = count($charsets);
    }

    private function initFragments(array $charsets)
    {
        foreach ($charsets as $charset) {
            $it = new CombinationFragment($charset);
            $this->list[] = $it;
            $this->possibilities *= $it->count();
        }
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->valid;
    }

    /**
     * @return array
     */
    public function current()
    {
        $result = array();
        foreach ($this->list as $fragment) {
            $result[] = $fragment->current();
        }

        return $result;
    }

    public function next()
    {
        $pos = 0;
        $this->list[$pos]->next();

        while ($this->list[$pos]->isBeginning()) {
            $pos ++;
            if ($pos > $this->fragments - 1) {
                $this->valid = false;
                break;
            }
            $this->list[$pos]->next();
        }
    }

    public function rewind()
    {
        foreach ($this->list as $fragment) {
            $fragment->rewid();
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->possibilities;
    }
}