<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SatuanFilter
{
    public function apply(Builder $query, $value)
    {
        $query->where('satuans_id', $value);
    }
}