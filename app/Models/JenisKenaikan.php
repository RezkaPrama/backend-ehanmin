<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKenaikan extends Model
{
    use HasFactory;
     /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * file usulan
     *
     * @return void
     */
    public function fileUsulan()
    {
        return $this->hasMany(FileUsulan::class);
    }

    /**
     * file usulan
     *
     * @return void
     */
    // public function TransUsulan()
    // {
    //     return $this->hasMany(TransUsulan::class);
    // }
}
