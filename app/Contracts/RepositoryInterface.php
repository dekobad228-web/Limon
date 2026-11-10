<?php

namespace App\Contracts;

use App\Contracts\DataInterface;

interface RepositoryInterface
{
    public function findById(int $id): DataInterface;
}
