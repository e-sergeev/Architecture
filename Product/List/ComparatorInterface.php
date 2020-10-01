<?php

namespace Product\List;

interface ComparatorInterface
{
    /**
     * @param $a
     * @param $b
     * @return int
     */
    public function compare($a, $b): int;
}