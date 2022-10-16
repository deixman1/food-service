<?php

declare(strict_types=1);

namespace App\Domain\Model;

class Food
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly int $calories,
    ) {}
}