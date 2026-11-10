<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface ViewModelInterface
{
    public static function make(Collection $collection): ViewModelInterface;
}
