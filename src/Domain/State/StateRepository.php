<?php

declare(strict_types=1);

namespace App\Domain\State;

interface StateRepository
{
    /**
     * @return State[]
     */
    public function findAll(): array;

    public function getCounties(): array;
}
