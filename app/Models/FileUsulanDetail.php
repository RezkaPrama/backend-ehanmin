<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUsulanDetail extends Model
{
    use HasFactory;

     /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

     /**
     * jenis kenaikan
     *
     * @return void
     */

     public function fileUsulan()
     {
         return $this->belongsTo(FileUsulan::class);
     }
}
