<?php

declare(strict_types=1);

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait AutoCreateAt
{
    #[ORM\Column]
    protected \DateTimeImmutable $createdAt;
}