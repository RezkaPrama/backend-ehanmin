<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUsulan extends Model
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

     public function jenisKenaikan()
     {
         return $this->belongsTo(JenisKenaikan::class);
     }

    // /**
    //  * trans usulan
    //  *
    //  * @return void
    //  */
    public function transUsulan()
    {
        return $this->belongsToMany(TransUsulan::class);
    }

    /**
     * jenis kenaikan
     *
     * @return void
     */

     public function fileUsulanDetail()
     {
         return $this->hasOne(FileUsulanDetail::class);
     }
}
