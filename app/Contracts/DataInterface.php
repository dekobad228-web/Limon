<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface DataInterface
{
    public function toArray(): array;

    public function toCollection(): Collection;

    public static function createData(object $object): self;
}
