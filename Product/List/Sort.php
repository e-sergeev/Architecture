<?php

namespace Product\List;

use Product\List\IdComparator;
use Product\List\Course;
use Product\List\CourseSorter;


$courses = [
    new Order(1 new \DateTime('2010-01-01')),
    new Order(5, new \DateTime('2011-01-01')),
    new Order(4, new \DateTime('2015-01-01')),
    new Order(3, new \DateTime('2013-01-01')),
    new Order(2, new \DateTime('2019-01-01')),
];

$idSorter = new CourseSorter(new IdComparator());