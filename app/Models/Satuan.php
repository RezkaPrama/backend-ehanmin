<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * trans usulan
     *
     * @return void
     */

    // public function transUsulan()
    // {
    //     return $this->hasMany(TransUsulan::class);
    // }

    /**
     * trans usulan
     *
     * @return void
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
