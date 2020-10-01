<?php

declare(strict_types=1);

namespace Product\List;

use Product\List\ComparatorInterface;
use Product\List\Course;

class CourseSorter
{
    /**
     * @var ComparatorInterface
     */
    private $comparator;

    /**
     * OrderSorter constructor.
     * @param ComparatorInterface $comparator
     */
    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    /**
     * @param Course[] $courses
     * @return Course[]
     */
    public function sort(array $courses): array
    {
        usort($courses, [$this->comparator, 'compare']);

        return $courses;
    }
}