<?php

namespace app\valueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class UserId
{
    /**
     * @ORM\Column(type="integer")
     */
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function value(): ?int
    {
        return $this->id;
    }
}