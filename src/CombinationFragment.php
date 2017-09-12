<?php

namespace Matok\Util;

class CombinationFragment extends \InfiniteIterator
{
    private $firstItem;
    private $count;

    /**
     * @param string|array $charset
     */
    public function __construct($charset)
    {
        if (is_scalar($charset)) {
            $charset = str_split($charset, 1);
        }

        $this->checkArgument($charset);
        $this->init($charset);
        parent::__construct(new \ArrayIterator($charset));
        $this->rewind();
    }

    private function checkArgument($charset)
    {
        if (!isset($charset[0])) {
            throw new \InvalidArgumentException('One of fragment is empty!');
        }
    }

    private function init($charset)
    {
        $this->firstItem = $charset[0];
        $this->count = count($charset);
    }

    /**
     * @return bool
     */
    public function isBeginning()
    {
        return $this->current() == $this->firstItem;
    }
}