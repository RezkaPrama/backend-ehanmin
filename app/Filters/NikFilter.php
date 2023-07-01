<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class NikFilter
{
    public function apply(Builder $query, $value)
    {
        $query->where('nik', $value);
    }
}