<?php

namespace Strategy\Comparator;

use Product\List\ComparatorInterface;
use Product\List\Course;

class IdComparator implements ComparatorInterface
{
    /**
     * @param Order $a
     * @param Order $b
     * @return int
     */
    public function compare($a, $b): int
    {
        return $a->getId() <=> $b->getId();
    }
}