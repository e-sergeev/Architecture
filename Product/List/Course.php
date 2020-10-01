<?php

namespace Product\List;

use DateTime;

class Course
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * Order constructor.
     * @param int $id
     * @param float $sum
     * @param DateTime $createdAt
     */
    public function __construct(int $id, DateTime $createdAt)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }


}